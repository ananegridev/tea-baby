@extends('layouts.main')
@section('title', $evento->titulo)
@section('content')

    <!--Landing page 1-->
    <div class="row">
        <!--seção Slide principal-->
        <section class="slide">

            <div class="row">
                <div class="col-md-12 area_img">
                    <h2>{{ $evento->titulo }}</h2>
                </div>

            </div>
        </section>
        <!--Seção Contador -->
        <section class="contadorl text-center">
            @php
                $daysTo = \Carbon\Carbon::parse(date('Y-m-d'));
                $daysFrom = \Carbon\Carbon::parse($evento->data_evento);
            @endphp
            <h4>Falta <strong>{{ $daysTo->diffInDays($daysFrom) }}</strong> dias para evento acontecer </h4>
            @php
                $weeksTo = \Carbon\Carbon::parse(date('Y-m-d'));
                $weeksFrom = \Carbon\Carbon::parse($evento->mes_gestacao . '-01');
            @endphp
            <h4>Falta <strong>{{ $weeksTo->diffInWeeks($weeksFrom) }}</strong> semanas para o(a)
                <strong>{{ $evento->nome_baby }}</strong>
                nascer
            </h4>
        </section>
        <!--Seção Sobre-->
        <section class="sobre_evento text-center">
            <h3>SOBRE EVENTO</h3>
            <div class="col-md-8 info">
                <p>{{ $evento->sobre }}.</p>
            </div>
        </section>
        <!-- Seção Pix-->
        <section class="pixl">

            <h3 class="text-center">PIX</h3>
            <div class="row">

                <div class="col col-md-4">
                    <div class="titulo">PREFERE COLABORAR COM PIX?</div>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                        magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.
                    </p>
                    @isset($evento->user->pixUsuario->qrcode)
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-colaborar-com-pix">
                            COLABORAR COM PIX</a>
                    @endisset
                </div>
                <div class="col col-md-4">
                    @isset($evento->user->pixUsuario->qrcode)
                        <img src="{{ asset($evento->user->pixUsuario->qrcode) }}" class="qrcodeimg" alt="QrCode">
                    @else
                        <div class="text-center small text-danger mb-2">QR Code não disponível.</div>
                        <div class=" p-5 bg-white rounded-3">
                            <div class="py-4 text-dark text-center">
                                QR CODE
                            </div>
                        </div>
                    @endisset

                </div>

            </div>
    </div>
    </section>
    <!--Seção Presente-->
    <section class="presentesl">



        <h3 class="text-center w-100 m-0 mb-3">PRESENTES</h3>

        <div class="col-md-11 carros">
            <div class="row">
                <div class="col-md-10 mx-auto sld_present">
                    @if ($categorias->count() > 0)
                        <!-- Carousel -->
                        <div class="">
                            <style>
                                /*.carousel-caption {
                                                right: 1%;
                                                left: 1%;
                                                background: #f2f2f2;
                                            }*/

                                .carousel-indicators button {
                                    width: 20px !important;
                                    height: 20px !important;
                                    background: #c4c4c4 !important;
                                    border-radius: 50%;
                                    border: none !important
                                }
                            </style>
                            <div class="">
                                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false"
                                    style="background: #f2f2f2">
                                    <div class="carousel-indicators">

                                        @foreach ($categorias as $key => $item)
                                            @if ($item->presentes()->where('nome', '!=', null) &&
                                                $item->presentes()->where('nome', '!=', null)->count() > 0)
                                                @if ($key == 0)
                                                    <button type="button" data-bs-target="#carouselExampleCaptions"
                                                        data-bs-slide-to="{{ $key }}" class="active"
                                                        aria-current="true" aria-label="Slide {{ $key }}"></button>
                                                @else
                                                    <button type="button" data-bs-target="#carouselExampleCaptions"
                                                        data-bs-slide-to="{{ $key }}"
                                                        aria-label="Slide {{ $key }}"></button>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="carousel">
                                        <!-- Carousel item -->
                                        @foreach ($categorias as $key => $categoria)
                                            <div class="carousel-item @if ($key == 0) active @endif">
                                                <!--<img src="{{ asset('img/presente.jpg') }}" class="d-block w-100"
                                                                alt="{{ asset('img/presente.jpg') }}">-->
                                                <div class="carousel-caption">
                                                    <h4 class="text-dark text-center">{{ $categoria->nome }}</h4>
                                                    <div class="d-flex gap-1 pb-4 justify-content-center">
                                                        <!-- itens -->
                                                        @foreach ($categoria->presentes as $indiceFilho => $presente)
                                                            @if ($presente->nome != null)
                                                                <div class=" text-dark h-100" style="max-width: 250px">
                                                                    <div class="card h-100"
                                                                        style="cursor: default; width: 170px">
                                                                        <img src="{{ asset('/img/presente.jpg') }}"
                                                                            class="card-img-top" alt="...">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">
                                                                                {{ $presente->nome }}</h5>

                                                                            <div
                                                                                class="d-flex justify-content-center align-items-centser pt-3 mb-3">
                                                                                <i class="fa-solid fa-circle-minus"
                                                                                    onclick="subtrairTotalItem(`{{ $key }}-{{ $indiceFilho }}`, {{ $presente->total }})"></i>
                                                                                <!-- Input total -->
                                                                                <input type="text"
                                                                                    id="input-total-item-{{ $key }}-{{ $indiceFilho }}"
                                                                                    class=" p-0 small d-flex align-middle fw-bold align-items-center border border-1 border-secondary text-center mx-2 bg-white rounded-circle py-0"
                                                                                    value="0"
                                                                                    style="width: 22px; height: 22px; "
                                                                                    name="item_categoria_" readonly>
                                                                                <i class="fa-solid fa-circle-plus"
                                                                                    onclick="somarTotalItem(`{{ $key }}-{{ $indiceFilho }}`, {{ $presente->total }})"></i>
                                                                            </div>

                                                                            <a href="#"
                                                                                class="btn btn-primary @if ($presente->total == 0) btn-secondary @endif disabled"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modal-confirm-presenca-presente"
                                                                                id="btn-presente-{{ $key }}-{{ $indiceFilho }}"
                                                                                onclick="vouPresentear({{ $presente->id }}, document.querySelector('#input-total-item-{{ $key }}-{{ $indiceFilho }}').value)">
                                                                                Presentear
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class=" py-4 text-center px-5 mb-4" style="background: #f2f2f2">
                            Não contém lista de presentes
                        </div>
                    @endif

                </div>

            </div>
        </div>

        </div>

    </section>

    <!-- Endereço -->
    <section class="enderecol pt-5">
        <h3 class="text-center mb-3">ENDEREÇO</h3>
        <p class="mb-4">It is a long established fact that a reader will be distracted by the readable content of a page
            when looking at its layout. </p>

        <div class="text-center col-12  mx-auto py-4" style="background: #f2f2f2">
            <div class="">
                <div class="h4 fw-bold mb-3"> {{ $evento->endereco }}</div>
            </div>
            <div class="">
                <div class="h4 fw-bold"> <span class="fw-normal h6">Número:</span> {{ $evento->numero_endereco }}</div>
            </div>
            <!--  -->
            <div class="">
                <div class="h4 fw-bold"><span class="fw-normal h6">Complemento:</span> {{ $evento->complemento }}</div>
            </div>
            <!--  -->
            <div class="">
                <div class="h4 fw-bold"> <span class="fw-normal h6">Cidade:</span> {{ $evento->cidade }}</div>
            </div>
            <!--  -->
            <div class="">
                <div class="h4 fw-bold"><span class="fw-normal h6">Estado:</span> {{ $evento->estado }}</div>
            </div>
            <!--  -->
            <div class="">
                <div class="h4 fw-bold"> <span class="fw-normal h6">Ponto de referência:</span>
                    {{ $evento->ponto_referencia }}</div>
            </div>


        </div>

    </section>


    <!-- Confirmar presença modal presente -->
    <div class="modal fade" id="modal-confirm-presenca-presente" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-3">
                        <!-- Formulário -->
                        <form action="{{ route('landing-page.presentear', $evento->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="presente_id" value="{{ old('presente_id') }}"
                                id="confirm-presenca-presente-id" required>
                            <input type="hidden" name="qtd_presente" value="{{ old('qtd_presente') }}"
                                id="confirm-presenca-qtd-presente" required>
                            <div class="fs-5">
                                CONFIRME SUA PRESENÇA
                            </div>
                            <div class="mt-3">
                                <div class="row gx-2">
                                    <div class="mb-3 col-12 col-lg-6">
                                        <input
                                            class="form-control mb-1 bg-white border-dark shadow-none rounded-0 @error('nome') is-invalid @enderror"
                                            type="text" style="font-size: 13px" name="nome"
                                            value="{{ old('nome') }}" placeholder="Seu Nome" required>
                                        @error('nome')
                                            <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-12 col-lg-6">
                                        <input id="telefone-presente"
                                            class="form-control mb-1 bg-white border-dark shadow-none rounded-0 @error('telefone') is-invalid @enderror"
                                            type="text" style="font-size: 13px" value="{{ old('telefone') }}"
                                            name="telefone" placeholder="Telefone" required>
                                        @error('telefone')
                                            <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-12 col-lg-6">
                                        <input
                                            class="form-control mb-1 bg-white border-dark shadow-none rounded-0 @error('cod_convite') is-invalid @enderror"
                                            type="text" style="font-size: 13px" name="cod_convite"
                                            placeholder="Código do Convite" value="{{ old('cod_convite') }}"
                                            maxlength="20" required>
                                        @error('cod_convite')
                                            <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-12 col-lg-6">
                                        <select
                                            class="form-select bg-white border-dark shadow-none rounded-0 @error('presenca') is-invalid @enderror"
                                            name="presenca" id="" style="font-size: 13px" required>
                                            <option selected value="" class="text-muted">Estará presente no Evento?
                                            </option>
                                            <option value="sim" class="fw-bold">Sim</option>
                                            <option value="talvez" class="fw-bold">Talvez</option>
                                            <option value="nao" class="fw-bold">Não</option>
                                        </select>
                                        @error('presenca')
                                            <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <span class="bg-white rounded-1 d-inline-block mt-3">
                                    <button type="submit"
                                        class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4">
                                        <div class="px-2 small">Seguir</div>
                                    </button>
                                </span>
                                <span class="bg-white rounded-1 d-inline-block mt-3">
                                    <button type="button"
                                        class="text-uppercase btn-sm py-2 btn btn-outline-danger rounded-1 px-3"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <div class="px-2 small">Cancelar</div>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal colaborar com pix -->
    <div class="modal fade" id="modal-colaborar-com-pix" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class=" text-center py-3 ">
                        <!-- Formulário -->
                        <form action="{{ route('landing-page.colaborar-pix', $evento->id) }}" method="post">
                            @csrf

                            <div class="fs-5 text-uppercase ">
                                Colaborarar com PIX
                            </div>
                            @isset($evento->user->pixUsuario->valor)
                                <p class="small text-muted text-uppercase">Valor mínimo R$
                                    {{ number_format($evento->user->pixUsuario->valor, 2, ',', '.') }}</p>
                            @endisset
                            <div class="mt-3">
                                <div class="">
                                    @isset($evento->user->pixUsuario->qrcode)
                                        <img src="{{ asset($evento->user->pixUsuario->qrcode) }}" class="w-100"
                                            style="max-width: 200px" alt="QrCode">
                                        <div class="mt-2 small">
                                            Chave ({{ $evento->user->pixUsuario->tipo_chave }}):
                                            {{ $evento->user->pixUsuario->chave }}
                                        </div>
                                    @endisset
                                </div>
                                <div class="">
                                    <div class="row gx-2 justify-content-center pt-4">
                                        <div class="mb-3 col-12 col-lg-5">
                                            <input
                                                class="form-control mb-1 bg-white border-dark shadow-none rounded-0 @error('nome_pix') is-invalid @enderror"
                                                type="text" style="font-size: 13px" name="nome_pix"
                                                value="{{ old('nome_pix') }}" placeholder="Seu nome que está do PIX"
                                                required>
                                            @error('nome_pix')
                                                <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-12 col-lg-3">
                                            <input id="valor-pix"
                                                class="form-control mb-1 bg-white border-dark shadow-none rounded-0 @error('valor') is-invalid @enderror"
                                                type="text" style="font-size: 13px" name="valor"
                                                value="{{ old('valor') }}" placeholder="Valor" required>
                                            @error('valor')
                                                <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <span class="bg-white rounded-1 d-inline-block mt-3 text-uppercase ">
                                        <button type="submit"
                                            class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4">
                                            <div class="px-2 small">Seguir</div>
                                        </button>
                                    </span>
                                    <span class="bg-white rounded-1 d-inline-block mt-3">
                                        <button type="button"
                                            class="text-uppercase btn-sm py-2 btn btn-outline-danger rounded-1 px-3"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            <div class="px-2 small">Cancelar</div>
                                        </button>
                                    </span>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Abrir moda se tiver erro em enviar convite --}}
    @if ($errors->has('nome') ||
        $errors->has('telefone') ||
        $errors->has('cod_convite') ||
        $errors->has('presenca') ||
        $errors->has('qtd_presente') ||
        $errors->has('presente_id'))
        <script>
            window.onload = function() {
                let modalConfir = new bootstrap.Modal(document.getElementById('modal-confirm-presenca-presente'))
                modalConfir.show()
            }
        </script>
    @endif

    {{-- Abrir moda se tiver erro em enviar dados pix --}}
    @if ($errors->has('nome_pix') || $errors->has('valor'))
        <script>
            window.onload = function() {
                let modalColab = new bootstrap.Modal(document.getElementById('modal-colaborar-com-pix'))
                modalColab.show()
            }
        </script>
    @endif


@stop

@section('js')
    <!-- script -->
    <script>
        /* Itens de presentes */
        function subtrairTotalItem(id, max) {
            let total = document.querySelector('#input-total-item-' + id).value;
            let valor = total / 1 - 1;
            document.querySelector('#input-total-item-' + id).value = valor < 0 ? 0 : valor

            valor = document.querySelector('#input-total-item-' + id).value
            if (valor == 0) {
                document.querySelector('#btn-presente-' + id).classList.add('disabled')
            } else {
                document.querySelector('#btn-presente-' + id).classList.remove('disabled')
            }
        }

        /* Itens de presentes */
        function somarTotalItem(id, max) {
            let total = document.querySelector('#input-total-item-' + id).value;
            let valor = total / 1 + 1;
            if (valor > max) {
                valor--;
            }

            if (valor == 0) {
                document.querySelector('#btn-presente-' + id).classList.add('disabled')
            } else {
                document.querySelector('#btn-presente-' + id).classList.remove('disabled')
            }

            document.querySelector('#input-total-item-' + id).value = valor
        }

        /* Ou clicar no botão 'vou presentear' */
        function vouPresentear(idPresente, qtdPresente) {
            document.querySelector('#confirm-presenca-presente-id').value = idPresente
            document.querySelector('#confirm-presenca-qtd-presente').value = qtdPresente
        }
    </script>

    <!-- Mascara de input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
    <script>
        var telefoneP = IMask(document.getElementById('telefone-presente'), {
            mask: "(00) 00000-0000"
        });

        var valorPix = IMask(
            document.getElementById('valor-pix'), {
                mask: [{
                        mask: ''
                    },
                    {
                        mask: 'R$ num',
                        lazy: false,
                        blocks: {
                            num: {
                                mask: Number,
                                scale: 2,
                                thousandsSeparator: '.',
                                padFractionalZeros: true,
                                radix: ',',
                                mapToRadix: ['.'],
                            }
                        }
                    }
                ]
            }
        );
    </script>

    <!-- Modal sucesso -->
    <x-modal-com-msg-sucesso />
@endsection
