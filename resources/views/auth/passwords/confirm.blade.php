@extends('layouts.main')
@section('title', 'Confirmação de senha')

@section('content')
    <div class="container py-5 mt-5 " style="min-height: 75vh">
        <div class="row justify-content-center">
            <div class="col-md-5 mx-auto pt-5 pb-md-5">
                <h1 class="h5 fw-bold">{{ __('Confirm Password') }}</h1>

                <div class="">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}" class="p-0">
                        @csrf

                        <div class="mb-3">
                            <label for="password"
                                class="d-none col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="mt-3 p-0">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password" placeholder="Senha">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
