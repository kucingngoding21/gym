@extends('layouts.backend')

@section('content')
<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Dashboard</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Instruktur</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>1</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Member</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-clipboard-check fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-info py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Pemasukan</span></div>
                        <div class="row g-0 align-items-center">
                            <div class="col-auto">
                                <div class="text-dark fw-bold h5 mb-0 me-3"><span>0</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Total Kasir</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>1</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-user fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<div class="row">--}}
{{--    <div class="col-lg-12 col-xl-12">--}}
{{--        <div class="card shadow mb-4">--}}
{{--            <div class="card-header d-flex justify-content-between align-items-center">--}}
{{--                <h6 class="text-primary fw-bold m-0">5 Film Teratas</h6>--}}
{{--                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>--}}
{{--                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">--}}
{{--                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>--}}
{{--                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">No</th>--}}
{{--                        <th scope="col">Judul Film</th>--}}
{{--                        <th scope="col">Tahun Rilis</th>--}}
{{--                        <th scope="col">Rate</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <th scope="row">1</th>--}}
{{--                        <td>The Shawshank Redemption</td>--}}
{{--                        <td>1994</td>--}}
{{--                        <td>5/5</td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
