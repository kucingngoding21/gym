@extends('layouts.backend')

@section('content')
    <div class="mb-3">
        <a href="{{ route('index.member') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <h3 class="text-dark mb-4">Detail Data Deposit</h3>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Deposit Kelas Info</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>No. Struk</th>
                            <th>{{ $data->nomor_struk }}</th>
                        </tr>
                        <tr>
                            <th>Tanggal Input</th>
                            <th>{{ $data->created_at }}</th>
                        </tr>
                        <tr>
                            <th>Member</th>
                            <th>{{ $data->format_id_member }}/{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }}</th>
                        </tr>
                        <tr>
                            <th>Deposit</th>
                            <th>{{ $data->nominal_deposit }}</th>
                        </tr>
                        <tr>
                            <th>Bonus Deposit</th>
                            <th>{{ $data->bonus_deposit }}</th>
                        </tr>
                        <tr>
                            <th>Total Deposit</th>
                            <th>{{ $data->total_deposit }}</th>
                        </tr>
                        <tr>
                            <th>Nama Kasir</th>
                            <th>P{{ $data->id_kasir }}/{{ $data->first_name_kasir }} {{ $data->middle_name_kasir }} {{ $data->last_name_kasir }}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-right p-2">
                <a href="{{ route('print.depositutama', ['id' => $id]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print" title="Print Member" style="--bs-primary: #094067;--bs-primary-rgb: 9,64,103;"></i> Cetak Struk</a>
            </div>
        </div>
    </div>


@endsection
@section('bottom-content')
@endsection
