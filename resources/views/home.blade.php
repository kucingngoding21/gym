@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8">
          @if (session('status'))
          <div class="alert alert-success">
          {{ session('status') }}
          </div>
          @endif
            <div class="p-4">
            @if(Auth::check())
                @if(Auth::user()->first_name && Auth::user()->role_name ==  'admin')
            <a href="{{ route('create.ebook') }}" class="btn btn-warning btn-sm " style="">Add E-Book</a>
                @endif
            @endif
            </div>

            <div class="card border-primary shadow">
              <h1 class="text-center card-header py-4 border-bottom bg-primary">E-Book</h1>
                <table class="table border border-2 table-striped">
                    <thead class="table-warning">
                      <tr>
                        <th scope="col" style="">Author</th>
                        <th scope="col" style="">Title</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $data)
                      <tr>
                        <td style="">{{ $data->author }}</td>
                        <td><a href="{{ route('show.book',$data->id) }}" style="">{{ $data->title }}</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div> --}}
        <div class="col-12">
            @if (session('status'))
            <div class="alert alert-success">
            {{ session('status') }}
            </div>
            @endif
              <div class="p-4 text-right">
              @if(Auth::check())
                  @if(Auth::user()->first_name && Auth::user()->role_name ==  'admin')
              <a href="{{ route('create.item') }}" class="btn btn-warning btn-sm " style="">Add Item</a>
                  @endif
              @endif
              </div>
                <div class="row">
                    @foreach ($data as $d)
                    <div class="col-2">
                        <div class="card border-0 text-center">
                            <img src="{{ asset('img/vegan.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <p class="card-text">{{ $d->item_name }}</p>
                              <p class="card-text"><a href="{{ route('show.item',$d->id) }}" style="">Detail</a></p>
                            </div>
                          </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>
@endsection
