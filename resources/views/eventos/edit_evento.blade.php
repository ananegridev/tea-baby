@extends('layouts.main')
@section('title', 'Editar Evento')
@section('content')

@section('content')

    <!-- Cadastro do evento -->
    <section class="contato">
        <div class="container">


            <div class="col-md-4 text-center eventoform">
                <h1 class="signin-text mb-3 h2"> Editar Evento</h1>
                <form method="POST" action="{{ route('editar-evento.update', $evento->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group p-4">
                        <h5 class="fw-bold text-start mb-4">Informação sobre a Gestação</h5>

                        <!-- Mês previsto -->
                        <input id="mes_gestacao"
                            type="{{ old('mes_gestacao', $evento->mes_gestacao) == null ? 'text' : 'month' }}"
                            class="form-control @error('mes_gestacao') is-invalid mb-0 @enderror" name="mes_gestacao"
                            value="{{ old('mes_gestacao', $evento->mes_gestacao) }}" required
                            placeholder="Mês Previsto do Parto">
                        @error('mes_gestacao')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Sexo do bebê -->
                        <input id="sexo_bebe" type="text"
                            class="form-control @error('sexo_bebe') is-invalid mb-0 @enderror" name="sexo_bebe"
                            value="{{ old('sexo_bebe', $evento->sexo_bebe) }}" required placeholder="Sexo do Bebê">
                        @error('sexo_bebe')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group p-4">
                        <h5 class="fw-bold text-start mb-4">Informação sobre o Baby </h5>

                        <!-- Data do evento -->
                        <input id="data_evento"
                            type="{{ old('data_evento', $evento->data_evento) == null ? 'text' : 'date' }}"
                            class="form-control @error('data_evento') is-invalid mb-0 @enderror" name="data_evento"
                            value="{{ old('data_evento', $evento->data_evento) }}" onfocus="(this.type='date')" required
                            placeholder="Data do Evento">
                        @error('data_evento')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Nome do baby -->
                        <input id="nome_baby" type="text"
                            class="form-control @error('nome_baby') is-invalid mb-0 @enderror" name="nome_baby"
                            value="{{ old('nome_baby', $evento->nome_baby) }}" required placeholder="Nome do Baby">
                        @error('nome_baby')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Link da página -->
                        <input id="link_pagina" type="text"
                            class="form-control @error('link_pagina') is-invalid mb-0 @enderror" name="link_pagina"
                            value="{{ old('link_pagina', $evento->link_pagina) }}" required placeholder="Link da Página">
                        @error('link_pagina')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="text-start" id="exibir-link-pagina" style="display: block">
                            <div>Exibição do link:</div>
                            <strong id="link-pagina">{{ route('landing-page-one', $evento->link_pagina) }}</strong>
                        </div>
                    </div>

                    <div class="form-group p-4">

                        <!-- Sobre o evento -->
                        <h5 class="fw-bold text-start mb-4">Sobre o evento </h5>

                        <!-- Título -->
                        <input id="titulo" type="text" class="form-control @error('titulo') is-invalid mb-0 @enderror"
                            name="titulo" value="{{ old('titulo', $evento->titulo) }}" required="titulo"
                            placeholder="Título do evento">
                        @error('titulo')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Sobre -->
                        <textarea class="form-control @error('sobre') is-invalid mb-0 @enderror" name="sobre"
                            placeholder="Digite uma descrição sobre o evento" required>{{ old('sobre', $evento->sobre) }}</textarea>
                        @error('sobre')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Contato -->
                        <h5 class="fw-bold text-start mb-3 mt-4">Contato</h5>
                        <input id="celular" type="text"
                            class="form-control @error('celular') is-invalid mb-0 @enderror" name="celular"
                            value="{{ old('celular', $evento->celular) }}" required="celular" placeholder="Celular">
                        @error('celular')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>


                    <div class="form-group p-4">
                        <h5 class="fw-bold text-start mb-4">Endereço do Evento </h5>

                        <!-- Cep -->
                        <input id="cep" type="text" class="form-control @error('cep') is-invalid mb-0 @enderror"
                            name="cep" value="{{ old('cep', $evento->cep) }}" required placeholder="CEP">

                        @error('cep')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Endereço -->
                        <input id="endereco" type="text"
                            class="form-control @error('endereco') is-invalid mb-0 @enderror" name="endereco"
                            value="{{ old('endereco', $evento->endereco) }}" required placeholder="Endereço">
                        @error('endereco')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Número -->
                        <input id="numero_endereco" type="text"
                            class="form-control @error('numero_endereco') is-invalid mb-0 @enderror"
                            name="numero_endereco" value="{{ old('numero_endereco', $evento->numero_endereco) }}"
                            required placeholder="Número">
                        @error('numero_endereco')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Complemento -->
                        <input id="complemento" type="text"
                            class="form-control @error('complemento') is-invalid mb-0 @enderror" name="complemento"
                            value="{{ old('complemento', $evento->complemento) }}" required placeholder="Complemento">
                        @error('complemento')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Cidade -->
                        <input id="cidade" type="text"
                            class="form-control @error('cidade') is-invalid mb-0 @enderror" name="cidade"
                            value="{{ old('cidade', $evento->cidade) }}" required placeholder="Cidade">
                        @error('cidade')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Estado -->
                        <input id="estado" type="text"
                            class="form-control @error('estado') is-invalid mb-0 @enderror" name="estado"
                            value="{{ old('estado', $evento->estado) }}" required placeholder="Estado">
                        @error('estado')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Ponto de Referência  -->
                        <input id="ponto_referencia" type="text"
                            class="form-control @error('ponto_referencia') is-invalid mb-0 @enderror"
                            name="ponto_referencia" value="{{ old('ponto_referencia', $evento->ponto_referencia) }}"
                            required placeholder="Ponto de Referência">
                        @error('ponto_referencia')
                            <span class="invalid-feedback mb-3 text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <!-- Qual festa organizar -->
                    <div class="form-group p-4">
                        <h5 class="fw-bold mb-4">Qual festa gostaria de organizar?</h5>

                        <style>
                            .carousel-indicators button {
                                width: 20px !important;
                                height: 20px !important;
                                background: #c4c4c4 !important;
                                border-radius: 50%;
                                border: none !important
                            }

                            @media (max-width: 768px) {
                                .carousel {
                                    margin-left: 0
                                }

                                .carousel-item {
                                    height: 1250px !important
                                }
                            }

                            @media (min-width: 768px) {
                                .categorias-eventos {
                                    margin-left: -340px;
                                    margin-right: -340px
                                }
                            }
                        </style>

                        <div class="categorias-eventos ">
                            <!-- Carousel -->
                            <div id="carouselExampleCaptions" class="carousel slide" style="margin-top: 0 !important"
                                data-bs-ride="false">
                                <div class="carousel-indicators ">
                                    @foreach ($categoriaEventos as $key => $grupoCategoria)
                                        <button type="button" data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="{{ $key }}"
                                            @if ($key == 0) class="active" aria-current="true" @endif
                                            aria-label="Slide {{ $key }}"></button>
                                    @endforeach

                                </div>
                                <div class="carousel-inner text-white p-4 bg-dadnger">

                                    <!-- Itens -->
                                    @foreach ($categoriaEventos as $key => $grupoCategoria)
                                        <div class="carousel-item @if ($key == 0) active @endif"
                                            style="height: 450px">
                                            <div class="carousel-caption " style="left: 0; right: 0">

                                                <div class="d-flex flex-column flex-md-row gap-4 justify-content-center">
                                                    <!-- itens -->
                                                    @foreach ($grupoCategoria as $item)
                                                        <div class="overflow-hidden mx-auto mx-lg-0"
                                                            style="width: 250px; max-width: 300px; min-width:200px">
                                                            <input type="radio" class="btn-check"
                                                                name="categoria_evento_id"
                                                                id="categoria_evento{{ $item->id }}"
                                                                value="{{ $item->id }}" required autocomplete="off"
                                                                {{ old('categoria_evento_id', $evento->categoria_evento_id) == $item->id ? 'checked' : '' }}>
                                                            <label for="categoria_evento{{ $item->id }}"
                                                                class="btn btn-primary border border-3 m-0  bg-white p-0 h-100 w-100">
                                                                <div class="card border-0 overflow-hidden ">
                                                                    <div class="d-flex align-items-center"
                                                                        style="height: 170px">
                                                                        <img src="{{ asset($item->icone) }}"
                                                                            class="card-img-top w-100 mx-auto"
                                                                            alt="" style="max-width: 150px;">
                                                                    </div>
                                                                    <div class="card-body py-0">
                                                                        <h5 class="card-title">{{ $item->nome }}</h5>
                                                                        <p class="card-text text-muted">
                                                                            {{ $item->descricao }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success">Salvar</button><br>

                </form>
            </div>
        </div>
    </section>



@endsection


@section('js')
    <!-- Script -->
    <script>
        // Adicionar url da página
        document.querySelector('#link_pagina').onkeyup = function() {
            if (this.value != '') {
                let pagina = this.value.slugify()
                document.querySelector('#exibir-link-pagina').style.display = 'block'
                document.querySelector('#link-pagina').innerHTML = "{{ route('landing-page-one', '') }}/" + pagina
            } else {
                document.querySelector('#exibir-link-pagina').style.display = 'none'
            }
        }



        // Converter string em slug para url
        if (!String.prototype.slugify) {
            String.prototype.slugify = function() {

                return this.toString().toLowerCase()
                    .replace(/[àÀáÁâÂãäÄÅåª]+/g, 'a') // Special Characters #1
                    .replace(/[èÈéÉêÊëË]+/g, 'e') // Special Characters #2
                    .replace(/[ìÌíÍîÎïÏ]+/g, 'i') // Special Characters #3
                    .replace(/[òÒóÓôÔõÕöÖº]+/g, 'o') // Special Characters #4
                    .replace(/[ùÙúÚûÛüÜ]+/g, 'u') // Special Characters #5
                    .replace(/[ýÝÿŸ]+/g, 'y') // Special Characters #6
                    .replace(/[ñÑ]+/g, 'n') // Special Characters #7
                    .replace(/[çÇ]+/g, 'c') // Special Characters #8
                    .replace(/[ß]+/g, 'ss') // Special Characters #9
                    .replace(/[Ææ]+/g, 'ae') // Special Characters #10
                    .replace(/[Øøœ]+/g, 'oe') // Special Characters #11
                    .replace(/[%]+/g, 'pct') // Special Characters #12
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, ''); // Trim - from end of text

            };
        }
        // var frase = "Lorem ipsum";
        // var url = frase.slugify();
    </script>

    <!-- Mascaras de input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
    <script>
        var cep = IMask(document.getElementById('cep'), {
            mask: [{
                    mask: '00000-000'
                },
                {
                    mask: '00.000-000'
                }
            ]
        });
        var celular = IMask(document.getElementById('celular'), {
            mask: '(00) 00000-0000'
        });
        var numero_endereco = IMask(document.getElementById('numero_endereco'), {
            mask: '000000000'
        });
    </script>

    <!-- Msg sucesso -->
    <x-modal-com-msg-sucesso />
@endsection
