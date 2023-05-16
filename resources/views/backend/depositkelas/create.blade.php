@extends('layouts.backend')

@section('content')
    <h3 class="text-dark mb-4">Data Deposit Kelas</h3>
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
        <a href="{{ route('index.depositkelas') }}" class="btn btn-primary btn-sm">Back</a>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <p class="text-primary m-0 fw-bold">Form Member</p>
                </div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('store.depositkelas') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nomor_struk" value="member">
                <div class="mb-3">
                    <label class="form-label">Member</label>
                    <select name="id_member" class="form-select">
                        @foreach ($user as $user)
                            @if ($user->role_name === 'member')
                                <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelas</label>
                    <select name="jenis_kelas" class="form-select" id="jenis_kelas">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('jenis_kelas')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Biaya</label>
                    <input type="text" readonly="" name="biaya" id="biaya" value="" class="form-control"
                           id="exampleInputEmail1" aria-describedby="emailHelp" oninput="formatRupiah(this)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jangka Waktu (Minggu)</label>
                    <input type="number" name="jangka_waktu" value="{!! old('jangka_waktu') !!}" class="form-control"
                        id="jangka_waktu" aria-describedby="jangkaWaktuHelp">
                    <small id="jangkaWaktuHelp" class="form-text text-muted">Masukkan jangka waktu dalam minggu.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Pembayaran</label>
                    <input type="number" readonly name="nominal_deposit" id="nominal_deposit" value="" class="form-control"
                           id="exampleInputEmail1" aria-describedby="emailHelp" oninput="formatRupiah(this)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Masa Aktif</label>
                    <input type="text" name="expired" id="expired" class="form-control">
                    <small class="form-text text-muted">Masa aktif akan di-generate berdasarkan jangka waktu.</small>
                </div>
{{--                <div class="mb-3">--}}
{{--                    <label class="form-label">Tanggal</label>--}}
{{--                    <input type="date" name="tanggal" value="{!! old('tanggal') !!}" class="form-control"--}}
{{--                        id="exampleInputEmail1" aria-describedby="emailHelp">--}}
{{--                </div>--}}
                <button type="submit" class="btn btn-primary">Submit</button>
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
                var biaya = parseFloat($("#biaya").val());
                var total = biaya * jangkaWaktu;
                var expirationDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + (7 * parseInt(jangkaWaktu)));
                var formattedDate = expirationDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                $('#expired').val(formattedDate);
                $('#nominal_deposit').val(total);
            });


            $('#jenis_kelas').change(function(){
                var kelasId = $(this).val();
                var url = '{{ route("getDetails", ":kelasId") }}';
                url = url.replace(':kelasId', kelasId);
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if(response != null){
                            $("#biaya").val(response.biaya);
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{--  <script>
        function formatRupiah(input) {
            // Remove non-digit characters from the input value
            let value = input.value.replace(/\D/g, '');

            // Format the value as rupiah
            let rupiah = 'Rp ' + new Intl.NumberFormat('id-ID').format(value);

            // Update the input value with the formatted rupiah value
            input.value = rupiah;
        }
    </script>  --}}
@endsection
@section('bottom-content')
@endsection
