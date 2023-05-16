<?php

namespace App\Http\Controllers;

use App\Models\Depositutama;
use App\Models\Transaksi;
use App\Models\User; 
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Auth;
use PDF;

class DepositutamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{
    $data = Depositutama::join('users', 'users.id', '=', 'deposit_utama.id_member')
        ->select('deposit_utama.*', 'users.first_name')
        ->get();

    return view('backend.depositutama.index', compact('data'));
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $user = User::all();
         return view('backend.depositutama.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $now = Carbon::now()->format('Y-m-d');
//    dd($now);
   $this->validate($request, [
    'id_member' => 'required',
    'nominal_deposit' => 'required|numeric|min:500000',
//    'tgl' => 'required|date',
    ], [
    'nominal_deposit.min' => 'Untuk :attribute Minimal Harus Rp 500,000.',
    ]);

    $tahunIni = date('Y');
    $tanggalIni = date('m');
    $lastInvoice = Depositutama::orderBy('id', 'desc')->first();
    $lastInvoiceId = $lastInvoice ? intval(substr($lastInvoice->nomor_struk, -2)) : 0;
    $invoiceId = str_pad($lastInvoiceId + 1, 2, '0', STR_PAD_LEFT);
    $invoiceNumber = substr($tahunIni, -2) . '.' . $tanggalIni . '.' . $invoiceId;

    $kasir = Auth::user()->id;
    $data = new Depositutama();
    $data->nomor_struk = $invoiceNumber;
    $data->id_kasir = $kasir;
    $data->id_member = $request->id_member;
    $data->nominal_deposit = $request->nominal_deposit;
    $data->bonus_deposit = 0; // Set initial bonus to 0
    $data->total_deposit = $request->nominal_deposit;
    $data->tgl = $now;
    $data->masa_aktif = Carbon::now()->addMonths($request->jangka_waktu); // Generate expiration date
    $data->save();

    // Calculate bonus
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
    $transaksi->expired = $data->masa_aktif;
     $transaksi->nama_deposit = 'Deposit Utama';
    $transaksi->save();

    return redirect(route('index.depositutama'))->with('message', 'Data Deposit Utama Telah Ditambahkan');
     

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depositutama  $depositutama
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all();
        $data = Depositutama::join('users', 'users.id', '=', 'deposit_utama.id_member')
            ->join('users as kasir', 'kasir.id', '=', 'deposit_utama.id_kasir')
            ->leftjoin('members', 'members.id_user', '=', 'deposit_utama.id_member')
            ->select('deposit_utama.*', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.id', 'kasir.first_name as first_name_kasir', 'kasir.middle_name as middle_name_kasir', 'kasir.last_name as last_name_kasir', 'members.format_id_member')
            ->where('deposit_utama.id', $id)
            ->first();
//        dd($data);
        return view('backend.depositutama.show', compact('user', 'data','id'));
    }

    public function printStruk(Request $request)
    {
        $data = Depositutama::join('users', 'users.id', '=', 'deposit_utama.id_member')
            ->join('users as kasir', 'kasir.id', '=', 'deposit_utama.id_kasir')
            ->leftjoin('members', 'members.id_user', '=', 'deposit_utama.id_member')
            ->select('deposit_utama.*', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.id', 'kasir.first_name as first_name_kasir', 'kasir.middle_name as middle_name_kasir', 'kasir.last_name as last_name_kasir', 'members.format_id_member')
            ->where('deposit_utama.id', $request->id)
            ->first();
//        dd($data);
        $pdf = PDF::loadView('backend.depositutama.struk', compact('data'))->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depositutama  $depositutama
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = User::all();
         $depositutama = Depositutama:: find($id);
         return view('backend.depositutama.edit', compact('user', 'depositutama'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depositutama  $depositutama
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    $this->validate($request, [
        'id_member' => 'required',
        'nominal_deposit' => 'required|numeric|min:500000',
        'tgl' => 'required|date',
    ], [
        'nominal_deposit.min' => 'Untuk :attribute Minimal Harus Rp 500,000.',
    ]);

    $data = Depositutama::findOrFail($id);
    $data->id_member = $request->id_member;
    $data->nominal_deposit = $request->nominal_deposit;
    $data->total_deposit = $request->nominal_deposit;
    $data->tgl = $request->tgl;
    $data->masa_aktif = Carbon::now()->addMonths($request->jangka_waktu); // Generate expiration date
    $data->save();

    // Calculate bonus
    if ($request->nominal_deposit > 3000000) {
        $bonus = 300000;
        $data->bonus_deposit = $bonus;
        $data->total_deposit += $bonus;
        $data->save();
    }

    $transaksi = Transaksi::where('nomor_struk', $data->nomor_struk)->first();
    $transaksi->id_member = $request->id_member;
    $transaksi->nominal_deposit = $request->nominal_deposit;
    $transaksi->bonus_deposit = $data->bonus_deposit;
    $transaksi->total_deposit = $data->total_deposit;
    $transaksi->tgl_transaksi = $data->tgl;
    $transaksi->save();

    return redirect(route('index.depositutama'))->with('message', 'Data Deposit Utama Telah Diperbarui');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depositutama  $depositutama
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
{
    $data = Depositutama::find($id);

    if ($data) {
        $data->delete();
        return redirect(route('index.depositutama'))->with('message', 'Data Deposit Utama Telah Dihapus');
    } else {
        return redirect(route('index.depositutama'))->with('error', 'Data Deposit Utama tidak ditemukan');
    }
}


}
