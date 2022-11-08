@extends('layouts.admin')
@section('title', 'Novo Evento')
@section('content')

    <!--Configuração de Evento-->
    <div class="row">
        <div class="row mb-4">
            <h2 class="text-left"> Novo Evento</h2>
        </div>

        <!--Alteração de dados-->
        <section class="alterar-dados">

            <div class="row">
                <!--Form-->
                <form method="POST" action="{{ route('admin.eventos.salvar-novo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-10">

                        <div class="row">
                            <!-- Nome do evento-->
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <input id="nome" type="text"
                                        class="form-control @error('nome') is-invalid mb-0 @enderror" name="nome"
                                        value="{{ old('nome') }}" required placeholder="Nome do Evento">
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
                                        name="icone" required placeholder="Ícone do Evento">
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
                                    required>{{ old('descricao') }}</textarea>
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
                                        @if (old('assinatura') == null || old('assinatura') == 'gratuito') checked @endif>
                                    <label for="gratuito">Gratuito</label>

                                    <input type="radio" name="assinatura" value="premium" id="premium"
                                        @if (old('assinatura') == 'premium') checked @endif>
                                    <label for="premium">Premium</label>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-11">
                        <div class="btnSalvar">
                            <button type="submit" class="btn btn-primary cadastre">ADICIONAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>


@stop
