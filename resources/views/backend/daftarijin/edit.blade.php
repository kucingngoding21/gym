@extends('layouts.backend')

@section('content')
    <h3 class="text-dark mb-4">Data Daftar Ijin</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="p-2">
        <a href="{{ route('index.daftarijin') }}" class="btn btn-primary btn-sm">Back</a>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <p class="text-primary m-0 fw-bold">Form Daftar Ijin</p>
                </div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('update.daftarijin', $data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Instruktur</label>
                    <input type="text" readonly="" name="instruktur_id" value="{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Pengajuan</label>
                    <input type="date" readonly name="tanggal_pengajuan" value="{!! old('', $data->tanggal_pengajuan) !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" id="">
                        <option value="Menunggu Persejutuan" @if($data->status == 'Menunggu Persetujuan') selected @endif>Menunggu Persejutuan</option>
                        <option value="Diterima" @if($data->status == 'Diterima') selected @endif>Diterima</option>
                        <option value="Ditolak" @if($data->status == 'Ditolak') selected @endif>Ditolak</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
@section('bottom-content')
@endsection
