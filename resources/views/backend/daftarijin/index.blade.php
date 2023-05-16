@extends('layouts.backend')

@section('content')
    <style>
        table.dataTable {
            width: 100% !important;
            margin: 0 auto !important;
            clear: both !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            color: #333 !important;
            font-size: 14px !important;
        }

        table.dataTable th {
            background-color: #f5f5f5 !important;
            color: #333 !important;
            border-bottom: 2px solid #ddd !important;
            font-weight: bold !important;
            padding: 10px !important;
            text-align: left !important;
            vertical-align: top !important;
        }

        table.dataTable td {
            background-color: #fff !important;
            border-bottom: 1px solid #ddd !important;
            padding: 10px !important;
            vertical-align: top !important;
        }

        table.dataTable tr.odd {
            background-color: #f9f9f9 !important;
        }

        table.dataTable tr.even {
            background-color: #f0f0f0 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 50% !important;
            width: 30px !important;
            height: 30px !important;
            line-height: 30px !important;
            padding: 0 !important;
            margin: 0 5px !important;
            background-color: transparent !important;
            border: 0px solid #ddd !important;
            font-weight: bold !important;
            color: #333 !important;
            text-align: center !important;
            cursor: pointer !important;
            display: inline-block !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #ffffff !important;
            color: #333 !important;
        }
        .dataTables_wrapper .dataTables_filter input[type=search] {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 6px 12px;
            margin-bottom: 10px;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            width: 80%;
        }

        .dataTables_wrapper .dataTables_filter input[type=search]:focus {
            outline: none;
            border-color: #66afe9;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
        }
        .dataTables_length select {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 6px 12px;
            margin-bottom: 10px;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            width: auto;
        }

        .dataTables_length select:focus {
            outline: none;
            border-color: #66afe9;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
        }
    </style>
    <h3 class="text-dark mb-4">Data Ijin Instruktur</h3>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <p class="text-primary m-0 fw-bold">Data Ijin Info</p>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="datatable-buttons">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Instruktur</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->first_name }} {{ $d->middle_name }} {{ $d->last_name }}</td>
                            <td>{{ $d->tanggal_pengajuan }}</td>
                            <td>{{ $d->status }}</td>
                            <td>
                                <a href="{{ route('edit.daftarijin', $d->id) }}" title="Edit Ijin"  style="padding-left: 10px;">
                                    <i class="fas fa-edit" style="--bs-primary: #094067;--bs-primary-rgb: 9,64,103;"></i>
                                </a>
                                <a href="{{ route('destroy.daftarijin', $d->id) }}" onclick="return confirm('are you sure?')" style="padding-left: 10px;" title="Hapus Ijin">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('bottom-content')

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "ordering": true,
                "lengthChange": true,
                "searching": true,
                "responsive": true,
                "language": {
                    "search": "Cari:",
                    "paginate": {
                        "first": "&laquo;",
                        "last": "&raquo;",
                        "next": "&rsaquo;",
                        "previous": "&lsaquo;"
                    }
                }
            });
        });
    </script>
@endsection
