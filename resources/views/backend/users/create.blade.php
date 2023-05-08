@extends('layouts.backend')

@section('content')
<h3 class="text-dark mb-4">Data User</h3>
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
    <a href="{{ route('index.user') }}" class="btn btn-primary btn-sm">Back</a>
</div>
<div class="card shadow">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <p class="text-primary m-0 fw-bold">Form User</p>
            </div>
            <div class="col text-right">
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('store.user') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="role_name" value="admin">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" value="{!! old('name') !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" name="email" value="{!! old('email') !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

              </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>

@endsection
@section('bottom-content')
@endsection
