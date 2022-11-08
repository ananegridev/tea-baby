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

    <!-- Mascara de input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
    <script>
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
