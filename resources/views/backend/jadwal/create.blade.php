@extends('layouts.backend')

@section('content')
    <h3 class="text-dark mb-4">Data Jadwal Instruktur</h3>
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
        <a href="{{ route('index.jadwal') }}" class="btn btn-primary btn-sm">Back</a>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <p class="text-primary m-0 fw-bold">Form Jadwal Instruktur</p>
                </div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('store.jadwal') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Instruktur</label>
                    <select class="form-select" name="id_instruktur" id="">
                        <option value="">Pilih Instruktur</option>
                        @foreach($instruktur as $i)
                            <option value="{{ $i->id_user }}">{{ $i->first_name }} {{ $i->middle_name }} {{ $i->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="title" value="{!! old('title') !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tgl" value="{!! old('tgl') !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="" class="form-control">{!! old('keterangan') !!}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
@section('bottom-content')
@endsection
