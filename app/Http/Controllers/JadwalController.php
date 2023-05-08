<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Models\Jadwal;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jadwal::join('instrukturs','instrukturs.id_user','=','jadwal.id_instruktur')
            ->join('users','users.id','=','jadwal.id_instruktur')
            ->select('jadwal.*', 'users.id as id_user', 'users.first_name','users.middle_name','users.last_name','instrukturs.id as id_instruktur')
            ->get();
//        dd($data);
        return view('backend.jadwal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instruktur = Instruktur::join('users','users.id','=','instrukturs.id_user')->get();
//        dd($instruktur);
        return view('backend.jadwal.create', compact('instruktur'));
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
            'id_instruktur' => 'required',
            'tgl' => 'required',
            'title' => 'required',
        ]);

        $cekInstruktur = Jadwal::where('id_instruktur', $request->id_instruktur)
            ->where('tgl', '=',$request->tgl)
            ->count();
//        dd($cekInstruktur);

        if ($cekInstruktur > 0)
        {
            return redirect(route('index.jadwal'))->with('message','Jadwal Instruktur di tanggal '. $request->tgl .' sudah ada, silahkan ubah lagi jadwal');
        }
        $tanggal = Carbon::parse($request->tgl);
        $namaHari = $tanggal->format('l');

        $data = new Jadwal();
        $data->id_instruktur = $request->id_instruktur;
        $data->tgl = $request->tgl;
        $data->title = $request->title;
        $data->day = $namaHari;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect(route('index.jadwal'))->with('message','Data jadwal Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jadwal::join('instrukturs','instrukturs.id_user','=','jadwal.id_instruktur')
            ->join('users','users.id','=','jadwal.id_instruktur')
            ->select('jadwal.*', 'users.id as id_user', 'users.first_name','users.middle_name','users.photo','instrukturs.no_telpon','instrukturs.alamat','instrukturs.no_telpon','users.last_name','instrukturs.id as id_instruktur')
            ->where('jadwal.id', $id)
            ->first();

//        dd($data);

        return view('backend.jadwal.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instruktur = Instruktur::join('users','users.id','=','instrukturs.id_user')->get();

        $data = Jadwal::join('instrukturs','instrukturs.id_user','=','jadwal.id_instruktur')
            ->join('users','users.id','=','jadwal.id_instruktur')
            ->select('jadwal.*', 'users.id as id_user', 'users.first_name','users.middle_name','users.photo','instrukturs.no_telpon','instrukturs.alamat','instrukturs.no_telpon','users.last_name','instrukturs.id as instruktur_id')
            ->where('jadwal.id', $id)
            ->first();

//        dd($data);
        return view('backend.jadwal.edit', compact('data', 'instruktur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_instruktur' => 'required',
            'tgl' => 'required',
            'title' => 'required',
        ]);
        $cekInstruktur = Jadwal::where('id_instruktur', $request->id_instruktur)
            ->where('tgl', '=',$request->tgl)
            ->count();
//        dd($cekInstruktur);

        if ($cekInstruktur > 0)
        {
            return redirect(route('index.jadwal'))->with('message','Jadwal Instruktur di tanggal '. $request->tgl .' sudah ada, silahkan ubah lagi jadwal');
        }
        $tanggal = Carbon::parse($request->tgl);
        $namaHari = $tanggal->format('l');

        $data = Jadwal::find($id);
        $data->id_instruktur = $request->id_instruktur;
        $data->tgl = $request->tgl;
        $data->title = $request->title;
        $data->day = $namaHari;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect(route('index.jadwal'))->with('message','Data jadwal Telah Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Jadwal::find($id);
        $data->delete();
        return redirect(route('index.jadwal'))->with('message','Data jadwal Telah Dihapus');
    }

    public function indexCetak()
    {

            $data = Jadwal::join('instrukturs','instrukturs.id_user','=','jadwal.id_instruktur')
                ->join('users','users.id','=','jadwal.id_instruktur')
                ->select('jadwal.*', 'users.id as id_user', 'users.first_name','users.middle_name','users.last_name','instrukturs.id as id_instruktur')
                ->get();


        return view('backend.jadwalHarian.index', compact('data'));
    }

    public function review($tglawal,$tglakhir)
    {
        if (request()->date != '') {
            $date = explode(' - ',request()->date);
            $tglawal = \Illuminate\Support\Carbon::parse($date[0])->format('m-d-Y').'00:00:01';
            $tglakhir = Carbon::parse($date[0])->format('m-d-Y').'23:59:59';
        }

            $data = Jadwal::join('instrukturs', 'instrukturs.id_user', '=', 'jadwal.id_instruktur')
                ->join('users', 'users.id', '=', 'jadwal.id_instruktur')
                ->select('jadwal.*', 'users.id as id_user', 'users.first_name', 'users.middle_name', 'users.last_name', 'instrukturs.id as id_instruktur')
                ->whereBetween('jadwal.tgl', [$tglawal, $tglakhir])
                ->get();
        return view('backend.jadwalHarian.index', compact('data','tglawal','tglakhir'));

    }

    public function printJadwal(Request $request)
    {
        $startDate = $request->tglawal;
        $endDate = $request->tglakhir;
        $data = Jadwal::join('instrukturs','instrukturs.id_user','=','jadwal.id_instruktur')
            ->join('users','users.id','=','jadwal.id_instruktur')
            ->select('jadwal.*', 'users.id as id_user', 'users.first_name','users.middle_name','users.last_name','instrukturs.id as id_instruktur')
            ->whereBetween('jadwal.tgl',[$startDate,$endDate])
            ->orderBy('jadwal.tgl', 'asc')
            ->get();
        $pdf = PDF::loadView('backend.jadwalHarian.print', compact('data', 'startDate', 'endDate'));
        return $pdf->stream();
    }

}
