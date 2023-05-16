<?php

namespace App\Http\Controllers;

use App\Models\DaftarIjin;
use Illuminate\Http\Request;

class DaftarIjinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DaftarIjin::join('users','users.id','daftar_ijin.instruktur_id')
                            ->select('daftar_ijin.*','users.first_name','users.middle_name','users.last_name')
                            ->get();

        return view('backend.daftarijin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarIjin  $daftarIjin
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarIjin $daftarIjin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarIjin  $daftarIjin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DaftarIjin::join('users','users.id','daftar_ijin.instruktur_id')
            ->select('daftar_ijin.*','users.first_name','users.middle_name','users.last_name')
            ->where('daftar_ijin.id', $id)
            ->first();

        return view('backend.daftarijin.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarIjin  $daftarIjin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = DaftarIjin::find($id);
        $data->status = $request->status;
        $data->save();

        return redirect(route('index.daftarijin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarIjin  $daftarIjin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DaftarIjin::find($id);
        $data->delete();

        return redirect(route('index.daftarijin'));
    }
}
