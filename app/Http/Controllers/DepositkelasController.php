<?php

namespace App\Http\Controllers;

use App\Models\Depositkelas;
use App\Models\Kelas;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\User; 
use Carbon\Carbon;
use Auth;
use PDF;

class DepositkelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    $data = Depositkelas::join('users', 'users.id', '=', 'deposit_kelas.id_member')
        ->join('kelas','kelas.id','deposit_kelas.jenis_kelas')
        ->select('deposit_kelas.*', 'users.first_name','kelas.nama_kelas')
        ->get();
    return view('backend.depositkelas.index', compact('data'));
    }

    public function getBiaya($kelasId)
    {
        $kelas = Kelas::find($kelasId);

        if ($kelas) {
            return response()->json([
                'biaya' => $kelas->biaya,
            ]);
        } else {
            return response()->json([
                'error' => 'Kelas not found.',
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $kelas = Kelas::all();
         $user = User::all();
         return view('backend.depositkelas.create', compact('user','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   $this->validate($request, [
    'id_member' => 'required',
//    'nominal_deposit' => 'required|numeric|min:500000',
//    'tanggal' => 'required|date',
    ]);

    $tahunIni = date('Y');
    $tanggalIni = date('m');
    $lastInvoice = Depositkelas::orderBy('id', 'desc')->first();
    $lastInvoiceId = $lastInvoice ? intval(substr($lastInvoice->nomor_struk, -2)) : 0;
    $invoiceId = str_pad($lastInvoiceId + 1, 2, '0', STR_PAD_LEFT);
    $invoiceNumber = substr($tahunIni, -2) . '.' . $tanggalIni . '.' . $invoiceId;
    $now = Carbon::now()->format('Y-m-d');

    $kasir = Auth::user()->id;
    $data = new Depositkelas();
    $data->nomor_struk = $invoiceNumber;
    $data->id_kasir = $kasir;
    $data->id_member = $request->id_member;
    $data->nominal_deposit = $request->nominal_deposit;
    $data->jangka_waktu = $request->jangka_waktu;
    $data->jenis_kelas = $request->jenis_kelas;
    $data->biaya_kelas = $request->biaya;
    $data->bonus_deposit = 0; // Set initial bonus to 0
    $data->total_deposit = $request->nominal_deposit;
    $data->tanggal = $now;
    $data ->jenis_kelas = $request->jenis_kelas;
    $data->expired = Carbon::now()->addDays($request->jangka_waktu * 7);
    $data->save();

    if ($request->nominal_deposit >= 3000000) {
        $bonus = 300000;
        $data->bonus_deposit = $bonus;
        $data->total_deposit += $bonus;
        $data->save();
    }

    $transaksi = new Transaksi();
    $transaksi->nomor_struk = $invoiceNumber;
    $transaksi->id_member = $request->id_member;
    $transaksi->id_kasir =  $data->id_kasir ;
    $transaksi->nominal_deposit = $request->nominal_deposit;
    $transaksi->bonus_deposit = $data->bonus_deposit;
    $transaksi->total_deposit = $data->total_deposit;
    $transaksi->tgl_transaksi = $now;
     $transaksi->jangka_waktu = $request->jangka_waktu;
    $transaksi->expired = $data->expired;
     $transaksi->jenis_kelas =  $data ->jenis_kelas ;
     $transaksi->nama_deposit = 'Deposit status';
    $transaksi->save();

    return redirect(route('index.depositkelas'))->with('message', 'Data Deposit Status Telah Ditambahkan');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depositkelas  $depositkelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Depositkelas::join('users', 'users.id', '=', 'deposit_kelas.id_member')
            ->join('kelas', 'kelas.id', '=', 'deposit_kelas.jenis_kelas')
            ->join('users as kasir', 'kasir.id', '=', 'deposit_kelas.id_kasir')
            ->leftjoin('members', 'members.id_user', '=', 'deposit_kelas.id_member')
            ->select('deposit_kelas.*', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.id', 'kelas.nama_kelas', 'kasir.first_name as first_name_kasir', 'kasir.middle_name as middle_name_kasir', 'kasir.last_name as last_name_kasir', 'members.format_id_member')
            ->where('deposit_kelas.id', $id)
            ->first();

//        dd($data);
        return view('backend.depositKelas.show', compact('data','id'));
    }

    public function printStruk(Request $request)
    {
        $data = Depositkelas::join('users', 'users.id', '=', 'deposit_kelas.id_member')
            ->join('kelas', 'kelas.id', '=', 'deposit_kelas.jenis_kelas')
            ->join('users as kasir', 'kasir.id', '=', 'deposit_kelas.id_kasir')
            ->leftjoin('members', 'members.id_user', '=', 'deposit_kelas.id_member')
            ->select('deposit_kelas.*', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.id', 'kelas.nama_kelas', 'kasir.first_name as first_name_kasir', 'kasir.middle_name as middle_name_kasir', 'kasir.last_name as last_name_kasir', 'members.format_id_member')
            ->where('deposit_kelas.id', $request->id)
            ->first();
//        dd($data);
        $pdf = PDF::loadView('backend.depositkelas.struk', compact('data'))->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depositkelas  $depositkelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = User::all();

        $kelas = Kelas::all();

        $depositkelas = Depositkelas::find($id);
        //  $depositkelas = Depositkelas::join('users','users.id','=','deposit_kelas.id_member')->where('deposit_kelas.id_member', $id)->first();
         return view('backend.depositkelas.edit', compact('user', 'depositkelas','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depositkelas  $depositkelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'id_member' => 'required',
//        'nominal_deposit' => 'required|numeric|min:500000',
    ]);
//dd($request);
    $now = Carbon::now()->format('Y-m-d');
    $data = Depositkelas::findOrFail($id);
    $data->id_member = $request->id_member;
    $data->nominal_deposit = $request->nominal_deposit;
    $data->jangka_waktu = $request->jangka_waktu;
    $data->jenis_kelas = $request->jenis_kelas;
    $data->biaya_kelas = $request->biaya;
    $data->bonus_deposit = 0; // Set initial bonus to 0
    $data->total_deposit = $request->nominal_deposit;
    $data->tanggal = $now;
    $data ->jenis_kelas = $request->jenis_kelas;
    $data->expired = Carbon::now()->addDays($request->jangka_waktu * 7); // Generate expiration date
    $data->save();

    // Calculate bonus
    if ($request->nominal_deposit > 3000000) {
        $bonus = 300000;
        $data->bonus_deposit = $bonus;
        $data->total_deposit += $bonus;
        $data->save();
    }

    // $transaksi = Transaksi::where('nomor_struk', $data->nomor_struk)->first();
    // $transaksi->id_member = $request->id_member;
    // $transaksi->nominal_deposit = $request->nominal_deposit;
    // $transaksi->bonus_deposit = $data->bonus_deposit;
    // $transaksi->total_deposit = $data->total_deposit;
    // $transaksi->tgl_transaksi = $data->tanggal;
    // $transaksi->save();

    return redirect(route('index.depositkelas'))->with('message', 'Data Deposit Utama Telah Diperbarui');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depositkelas  $depositkelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Depositkelas::find($id);
        $data->delete();
        return redirect(route('index.depositkelas'))->with('message','Data jadwal Telah Dihapus');
        
    }
}
