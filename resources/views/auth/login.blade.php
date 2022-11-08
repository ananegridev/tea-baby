@extends('layouts.main')
@section('title', 'Login')
@section('content')

@section('content')

    <section class="contato">
        <div class="container">
            <div class="row content align-items-center gy-4">
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('img/login-836.svg') }}" alt="Entrar">
                </div>
                <div class="col-md-5 text-center loginform">

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif


                    <h1 class="signin-text mb-3 h5 fw-semibold"> Faça seu Acesso na Plataforma</h1>

                    <!-- Fazer login com facebook ou google -->
                    <div class="">
                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <a href="{{ route('login.redirect.socialite', 'facebook') }}" class="text-decoration-none"
                                title="Login com Facebook">
                                <img src="{{ asset('img/facebook.svg') }}" alt="" style="width: 30px !important">
                            </a>
                            <a href="{{ route('login.redirect.socialite', 'google') }}" class="text-decoration-none"
                                title="Login com Google">
                                <img src="{{ asset('img/google.png') }}" alt="" style="width: 30px !important">
                            </a>
                        </div>
                        <div class=" text-muted text-center mb-2 mt-1" style="font-size: 12px">
                            Login com mídias sociais
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-3 px-1">
                            <hr class="w-100">
                            <div class="px-2 text-muted">ou</div>
                            <hr class="w-100">
                        </div>
                    </div>

                    <!-- Formulário -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email"
                                class="form-control mb-1 @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail" autofocus>
                            @error('email')
                                <span class="invalid-feedback text-start" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Senha -->
                        <div class="form-group mt-3">
                            <input id="password" type="password"
                                class="form-control mb-1 @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Senha">
                            @error('password')
                                <span class="invalid-feedback text-start" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <div class="px-2">Login</div>
                            </button><br>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="recupsenha" href="{{ route('password.request') }}">
                                Esqueceu a Senha?
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
