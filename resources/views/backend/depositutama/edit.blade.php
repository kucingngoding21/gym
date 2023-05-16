@extends('layouts.backend')

@section('content')
    <h3 class="text-dark mb-4">Data Member</h3>
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
        <a href="{{ route('index.depositutama') }}" class="btn btn-primary btn-sm">Back</a>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <p class="text-primary m-0 fw-bold">Edit Member</p>
                </div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('update.depositutama', $depositutama->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Member</label>
                    <select name="id_member" class="form-control">
                        @foreach ($user as $user)
                            @if ($user->role_name === 'member')
                                <option value="{{ $user->id }}" @if ($user->id == $depositutama->id_member) selected @endif>
                                    {{ $user->first_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jangka Waktu (bulan)</label>
                    <input type="number" name="jangka_waktu" value="{{ $depositutama->jangka_waktu }}" class="form-control"
                        id="jangka_waktu" aria-describedby="jangkaWaktuHelp">
                    <small id="jangkaWaktuHelp" class="form-text text-muted">Masukkan jangka waktu dalam bulan.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nominal Deposit</label>
                    <input type="text" name="nominal_deposit" id="nominal_deposit" value="{{ $depositutama->nominal_deposit }}"
                           class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           oninput="formatRupiah(this)">
                    @error('nominal_deposit')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Masa Aktif</label>
                    <input type="text" name="masa_aktif" id="masa_aktif" value="{{ $depositutama->masa_aktif }}"
                        class="form-control" disabled>
                    <small class="form-text text-muted">Masa aktif akan di-generate berdasarkan jangka waktu.</small>
                </div>
{{--                <div class="mb-3">--}}
{{--                    <label class="form-label">Tanggal</label>--}}
{{--                    <input type="date" name="tgl" value="{{ $depositutama->tgl }}" class="form-control"--}}
{{--                        id="exampleInputEmail1" aria-describedby="emailHelp">--}}
{{--                </div>--}}
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Calculate and update the expiration date field based on the duration input
            $('#jangka_waktu').on('input', function() {
                var jangkaWaktu = $(this).val();
                var today = new Date();
                var expirationDate = new Date(today.getFullYear(), today.getMonth() + parseInt(jangkaWaktu),
                    today.getDate());
                var formattedDate = expirationDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                $('#masa_aktif').val(formattedDate);
            });
            $('#jangka_waktu').on('input', function () {
                var jangkaWaktu = $(this).val();
                var nominalDeposit = jangkaWaktu * 500000;

                $('#nominal_deposit').val(nominalDeposit);
            });
        });
    </script>
@endsection
@section('bottom-content')
@endsection
