@extends('layouts.frontend')

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card shadow-lg bg-dark o-hidden border-0 my-5 text-light">
                        <h2 class="py-4 border-bottom card-header " style="">Register</h2>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role_name" value="user">
                                <div class="form-group row mb-2" enctype="multipart/form-data">
                                    <label style="" for="name" class="col-md-2 col-form-label text-md-left">{{ __('First Name') }}</label>
                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control   @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label style="" for="name" class="col-md-2 col-form-label text-md-left">{{ __('Middle Name') }}</label>
                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control   @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="name" autofocus>
                                        @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label style="" for="name" class="col-md-2 col-form-label text-md-left">{{ __('Last Name') }}</label>
                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control   @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label style="" for="gender" class="col-md-2 col-form-label text-md-left">Gender</label>
                                    <div class="col-md-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="male" id="male">
                                            <label style="" class="form-check-label" for="fmale">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="female" id="female">
                                            <label style="" class="form-check-label" for="female">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label style="" for="email" class="col-md-2 col-form-label text-md-left ">{{ __('E-Mail') }}</label>

                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control   @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="password" style="" class="col-md-2 col-form-label text-md-left ">{{ __('Password') }}</label>

                                    <div class="col-md-10">
                                        <input id="password" type="password" class="form-control   @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="password-confirm" style="" class="col-md-2 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-10">
                                        <input id="password-confirm" type="password" class="form-control  " name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <br>
                                <div class="d-grid gap-2">
                                    <button style="" type="submit" class="btn  btn-warning btn-block ">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="text-light">Already Have an account? click here tp login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
