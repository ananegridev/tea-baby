@extends('layouts.admin')
@section('title', 'Configurações de Evento')
@section('content')

    <!--Configuração de Evento-->
    <div class="container">
        <div class="row">
            <div class="row">

                <h2 class="text-left"> Configurações de Evento</h2>

            </div>
            <div class="row detalhesa">

                <div class="col-md-11">
                    <div class="btnsUser">
                        <a href="{{ route('admin.eventos') }}" class="btn btn-primary cadastre">CANCELAR</a>
                    </div>
                </div>
                <hr>
            </div>

            <!--dados Usuários-->
            <section class="dados-usuario">
                <div class="row">
                    <div class="col-md-9 dadosu pt-3">
                        <p>NOME DO EVENTO: {{ $evento->nome }}</p>

                        <p>DESCRIÇÃO: {{ $evento->descricao }}</p>
                    </div>

                </div>
                <div class="col-md-3 icone">
                    <div class="imgevento text-center">
                        <div class="text-uppercase mb-2 small fw-bold">
                            Ícone do evento
                        </div>
                        <img src="{{ asset($evento->icone) }}">
                    </div>
                </div>
            </section>
            <hr>
            <!--Alteração de dados-->
            <section class="alterar-dados">
                <div class="row">
                    <h2 class="text-left"> ALTERAR DADOS</h2>
                </div>

                <div class="row mb-5">
                    <!--Form-->
                    <form method="POST" action="{{ route('admin.eventos.salvar-evento', $evento->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-10">

                            <div class="row">
                                <!-- Nome do evento-->
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <input id="nome" type="text"
                                            class="form-control @error('nome') is-invalid mb-0 @enderror" name="nome"
                                            value="{{ old('nome', $evento->nome) }}" required placeholder="Nome do Evento">
                                        @error('nome')
                                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Ícone-->
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <input id="icone" type="file"
                                            class="form-control @error('icone') is-invalid mb-0 @enderror" accept="image/*"
                                            name="icone" placeholder="Ícone do Evento">
                                        @error('icone')
                                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <!-- Descrição -->
                                <div class="col-12">
                                    <textarea class="form-control @error('descricao') is-invalid mb-0 @enderror" name="descricao" placeholder="Descrição"
                                        required>{{ old('descricao', $evento->descricao) }}</textarea>
                                    @error('descricao')
                                        <span class="invalid-feedback mb-3 text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Assinatura -->
                            <div class="row detalhes">
                                <div class="col-12">
                                    <strong>Asinatura: </strong>
                                    <div class="inputsp">
                                        <input type="radio" name="assinatura" value="gratuito" id="gratuito" required
                                            @if (old('assinatura', $evento->assinatura) == null || old('assinatura', $evento->assinatura) == 'gratuito') checked @endif>
                                        <label for="gratuito">Gratuito</label>

                                        <input type="radio" name="assinatura" value="premium" id="premium"
                                            @if (old('assinatura', $evento->assinatura) == 'premium') checked @endif>
                                        <label for="premium">Premium</label>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-11">
                            <div class="btnSalvar">
                                <button type="submit" class="btn btn-primary cadastre">SALVAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        </div>

    </div>

    <!-- Msg sucesso -->
    <x-modal-com-msg-sucesso />



@stop
