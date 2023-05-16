@extends('layouts.frontend')

@section('content')

    <div class=".container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets2/img/products/bg1.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets2/img/products/bg1.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets2/img/products/bg1.jpg') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    </div>

    <section class="mb-3">
        <div class="container p-4">
            <div>
                <h3 class="pb-2 fw-bold">Film Terpopuler</h3>
                <a href=""><p>Lihat Semua Film =></p></a>
                <div class="d-flex flex-row">
                    <div class="card-group">
                        <div class="row justify-content-center">
                            @foreach($data as $d)
                                <div class="col-lg-3 col-6 col-sm-3 col-xs-6 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="@if (empty($d->poster))
                                                https://via.placeholder.com/350x200
@else
                                        {{url('')}}/produk/{{$d->poster}}
                                        @endif" alt="Poster Image" style="">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $d->judul_film }}</h5>
                                            <p class="card-text"><small class="text-body-secondary">{{ $d->kategori }}</small></p>
                                            <span class="badge text-bg-secondary">{{ $d->genre }}</span>

                                        </div>
                                        <div>
                                            <a href="{{ route('detail',$d->id) }}" class="btn btn-dark btn-sm">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="mb-3">
        <div class="container p-4">
            <div>
                <h3 class="pb-2 fw-bold">Film Terbaru</h3>
                <div class="d-flex flex-row">
                    <div class="card-group">
                        <div class="row justify-content-center">
                            @foreach($data as $d)
                                <div class="col-lg-3 col-6 col-sm-3 col-xs-6 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="@if (empty($d->poster))
                                                https://via.placeholder.com/350x200
@else
                                        {{url('')}}/produk/{{$d->poster}}
                                        @endif" alt="Poster Image" style="">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $d->judul_film }}</h5>
                                            <p class="card-text"><small class="text-body-secondary">{{ $d->kategori }}</small></p>
                                            <span class="badge text-bg-secondary">{{ $d->genre }}</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('detail',$d->id) }}" class="btn btn-dark btn-sm">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection