@extends('layouts.main')
@section('title', 'Pagamento Premium')
@section('content')
    <!-- Página de Pagamento-->
    <section class="pagamentop">
        <div class="row" style="margin-top: -100px">
            <h4 class="mb-3 fw-bold h5">
                Realize o pagamento da assinatura premium de
                <mark>R$ @if ($dadosPix)
                        {{ number_format($dadosPix->valor, 2, ',', '.') }}
                    @endif </mark>
            </h4>
            <!--QrCode-->
            <div class="qrcode">

                @if ($dadosPix)
                    <img src="{{ asset($dadosPix->qrcode) }}" alt="QR Code" class="mb-0">
                    <div class="pt-2 small fw-bold">
                        Chave PIX: {{ $dadosPix->chave }}
                    </div>
                @else
                    <div class="rounded-3 p-5 bg-secondary text-white d-flex justify-content-center align-items-center">
                        QR Code não disponível.
                    </div>
                @endif

                <!--Botão Pagamento-->
                <a href="{{ route('pagamento-premium-concluido') }}" class="btn btn-success fs-6 fw-bold px-4 mt-4">
                    Pagamento Concluído
                </a>
            </div>
        </div>
    </section>
@stop
