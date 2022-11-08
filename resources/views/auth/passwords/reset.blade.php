@extends('layouts.main')
@section('title', 'Modificar Senha')

@section('content')
    <div class="container py-5 mt-5" style="min-height: 75vh">
        <div class="row justify-content-center">
            <div class="col-md-5 mx-auto">
                <h1 class="h5 text-center my-4 fw-semibold">{{ __('Reset Password') }}</h1>

                <div class="">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class=" mb-3">
                            <label for="email"
                                class="col-form-label ">E-mail</label>

                            <div class="">
                                <input id="email" type="email"
                                    class="form-control mb-1 @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" mb-3">
                            <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password"
                                    class="form-control mb-1 @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" mb-3">
                            <label for="password-confirm"
                                class=" col-form-label ">{{ __('Confirm Password') }}</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class=" mb-0">
                            <div class=" ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
