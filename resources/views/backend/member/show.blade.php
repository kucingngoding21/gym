@extends('layouts.backend')

@section('content')
    <div class="mb-3">
        <a href="{{ route('index.member') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <h3 class="text-dark mb-4">Detail Data Member</h3>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-4">
            <div class="card">
                <img class="card-img-top" src="@if (empty($data->photo))
                {{url('img/default-image.png')}}
                @else
                {{url('')}}/users/{{$data->photo}}
                @endif" alt="">
                <div class="card-body">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"><h5>{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }}</h5></li>
                </ul>
            </div>
        </div>
        <div class="col-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Member Info</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }}</th>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <th>{{ $data->no_telpon }}</th>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>{{ $data->alamat }}</th>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <th>{{ $data->gender }}</th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>{{ $data->email }}</th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>{{ $data->active_status }}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-right p-2">
                <a href="" class="btn btn-sm btn-primary">Cetak Member Card</a>
            </div>
        </div>
    </div>


@endsection
@section('bottom-content')
@endsection
