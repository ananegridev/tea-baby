@extends('layouts.main')
@section('title', 'Editar cadastro')
@section('content')

@section('content')
    <div class="container cadastro pb-5">

        <form action="{{ route('editar-cadastro.salvar') }}" method="post">
            @csrf
            @method('PUT')
            <section class="contato">
                <div class="row justify-content-center">
                    <h1 class="h2 text-center mb-4">Editar Cadastro</h1>
                    <div class="col-md-5 col-lg-4 mx-auto">
                        <div class="card cadastrese">

                            <h2 class=" h5 fw-semibold text-start ps-4">
                                <div class="px-1">Dados Pessoais</div>
                            </h2>
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end visually-hidden">{{ __('Name') }}</label>

                                    <div class="">
                                        <input id="name" type="text"
                                            class="form-control mb-1 @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', auth()->user()->name) }}" placeholder="Nome"
                                            autocomplete="name" autofocus required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end visually-hidden">{{ __('Cpf') }}</label>

                                    <div class="">
                                        <input id="cpf" type="text"
                                            class="form-control mb-1 @error('cpf') is-invalid @enderror" name="cpf"
                                            value="{{ old('cpf', auth()->user()->cpf) }}" placeholder="CPF" required>

                                        @error('cpf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nascimento"
                                        class="col-md-4 col-form-label text-md-end visually-hidden">{{ __('Data de Nascimento') }}</label>

                                    <div class="">
                                        <input id="dt_nasc"
                                            type="{{ old('dt_nasc', auth()->user()->dt_nasc) != null ? 'date' : 'text' }}"
                                            class="form-control mb-1 @error('dt_nasc') is-invalid @enderror" name="dt_nasc"
                                            onfocus="(this.type='date')"
                                            value="{{ old('dt_nasc', auth()->user()->dt_nasc) }}"
                                            placeholder="Data de Nascimento" required>

                                        @error('dt_nasc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end visually-hidden">{{ __('Email') }}</label>

                                    <div class="">
                                        <input id="email" type="email"
                                            class="form-control mb-1 @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email', auth()->user()->email) }}" placeholder="Email" required
                                            autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end visually-hidden">{{ __('Password') }}</label>

                                    <div class="">
                                        <input id="password" type="password"
                                            class="form-control mb-1 @error('password') is-invalid @enderror"
                                            name="password" placeholder="Senha" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- confirmar senha -->
                                <div class="row mb-3">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end visually-hidden">{{ __('Confirm Password') }}</label>

                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" placeholder="Confirmação de senha" required
                                            autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="col-md-8">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section id="cards-container">

                <!-- Gratuito  -->
                <input type="radio" class="btn-check" name="plano" id="option1" value="gratuito" autocomplete="off"
                    {{ old('plano', auth()->user()->plano) == 'gratuito' || old('plano', auth()->user()->plano) == null ? 'checked' : '' }}>
                <label class="btn btn-primary border m-3  bg-white p-0" for="option1">
                    <div class="card border-0 " style="width: 18rem;">
                        <img src="{{ asset('/img/tree.png') }}" class="card-img-top" alt="...">
                        <div class="card-body h-100 pb-1 px-2">
                            <h5 class="card-title">Gratuito</h5>
                            <p class="card-text text-muted">
                                <i class="fa-solid fa-check text-success " style="font-size: 14px"></i> LISTA DE ITENS<BR>
                                <i class="fa-solid fa-check text-success " style="font-size: 14px"></i> ATÉ 15
                                CONVIDADOS<BR>
                                <i class="fa-solid fa-check text-success " style="font-size: 14px"></i> ÚNICO EVENTO
                                DISPONÍVEL
                            </p>

                        </div>
                    </div>

                </label>


                <!-- Premium -->
                <input type="radio" class="btn-check" name="plano" id="option2" value="premium"
                    autocomplete="off" {{ old('plano', auth()->user()->plano) == 'premium' ? 'checked' : '' }}>
                <label class="btn btn-primary overflow-hidden border m-3  bg-white p-0" for="option2">
                    <div class="card border-0   " style="width: 18rem;">

                        <!-- Preço do premium -->
                        <div class="preco-premium bg-warning text-dark fw-bolder">
                            @php
                                $pixAdmin = \App\Models\PixAdmin::first();
                                $preco = 0;
                                if ($pixAdmin) {
                                    $preco = $pixAdmin->valor;
                                }
                            @endphp
                            R$ {{ number_format($preco, 2, ',', '.') }}
                        </div>

                        <img src="{{ asset('/img/tree2.png') }}" class="card-img-top" alt="...">
                        <div class="card-body h-100 pb-1 px-2">
                            <h5 class="card-title">Premium</h5>
                            <p class="card-text text-muted">
                                <i class="fa-solid fa-check text-success " style="font-size: 14px"></i> LISTA DE ITENS<BR>
                                <i class="fa-solid fa-check text-success " style="font-size: 14px"></i> CONVIDADOS
                                ILIMITADOS<BR>
                                <i class="fa-solid fa-check text-success " style="font-size: 14px"></i> TODOS EVENTOS
                                DISPONÍVEIS<BR>
                                <i class="fa-solid fa-check text-success " style="font-size: 14px"></i> CADSTRO DE PIX<BR>
                            </p>

                        </div>
                    </div>
                </label>

                <div class="row mb-0 pt-4">
                    <div class=" offset-md-4 mt-5 pb-5">
                        <button type="submit" class="btn btn-primary btncadastrese">
                            Atualizar
                        </button>

                    </div>
                </div>

            </section>
        </form>
    </div>

    <div class="" style="height: 150px"></div>

    <!-- Mascara de input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
    <script>
        var maskCPF = IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });
    </script>

    <!-- Msg sucesso -->
    <x-modal-com-msg-sucesso />

@endsection
