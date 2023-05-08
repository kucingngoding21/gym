@extends('layouts.backend')

@section('content')
    <h3 class="text-dark mb-4">Data Instruktur</h3>
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
        <a href="{{ route('index.instruktur') }}" class="btn btn-primary btn-sm">Back</a>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <p class="text-primary m-0 fw-bold">Form Instruktur</p>
                </div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('update.instruktur', $data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="role_name" value="instruktur">
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Depan</label>
                    <input type="text" name="first_name" value="{!! old('first_name', $data->first_name) !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Tengah</label>
                    <input type="text" name="middle_name" value="{!! old('middle_name', $data->middle_name) !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Belakang</label>
                    <input type="text" name="last_name" value="{!! old('last_name', $data->last_name) !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control">{!! old('alamat', $data->alamat) !!}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_telpon" value="{!! old('no_telpon', $data->no_telpon) !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Spesialisasi</label>
                    <input type="text" name="spesialisasi" value="{!! old('spesialisasi', $data->spesialisasi) !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" id="" class="form-select">
                        <option value="Laki-laki" @if($data->gender == 'Laki-laki') selected @endif>Laki-laki</option>
                        <option value="Perempuan" @if($data->gender == 'Perempuan') selected @endif>Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="active_status" id="" class="form-select">
                        <option value="Aktif" @if($data->active_status == 'Aktif') selected @endif>Aktif</option>
                        <option value="Nonaktif" @if($data->active_status == 'Nonaktif') selected @endif>Nonaktif</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" value="{!! old('email', $data->email) !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
@section('bottom-content')
@endsection