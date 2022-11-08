@extends('layouts.main')
@section('title', 'Painel Pix')
@section('content')

    <!--Pagina Pix-->
    <section class="contato">
        <h3 class="text-center">Pix</h3>
        <div class="container">
            <div class="row contadores">
                <div class="col-md-12 p-0 pe-2">
                    <!--seção contadores-->
                    <div class="border p-4 pt-2 pb-3">
                        <form method="POST" action="{{ route('salvar-pix-usuario') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row gy-3">
                                <div class="col-12 col-lg-2">
                                    <!--Select chave pix-->
                                    <select id="tipo-chave"
                                        class="m-0 w-100 form-control mb-1 @error('tipo_chave') is-invalid @enderror"
                                        name="tipo_chave" placeholder="Tipo Chave" required>
                                        <option value="" selected>Tipo da Chave</option>
                                        <option value="E-mail" {{ old('tipo_chave') == 'E-mail' ? 'selected' : '' }}>
                                            E-mail
                                        </option>
                                        <option value="Celular" {{ old('tipo_chave') == 'Celular' ? 'selected' : '' }}>
                                            Celular
                                        </option>
                                        <option value="CPF" {{ old('tipo_chave') == 'CPF' ? 'selected' : '' }}>
                                            CPF
                                        </option>
                                        <option value="Aleatória" {{ old('tipo_chave') == 'Aleatória' ? 'selected' : '' }}>
                                            Aleatória
                                        </option>
                                    </select>
                                    @error('tipo_chave')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-lg-2">
                                    <!--input chave pix-->
                                    <input id="chave" type="text"
                                        class="form-control mb-1 @error('chave') is-invalid @enderror" name="chave"
                                        value="{{ old('chave') }}" required placeholder="Chave Pix">
                                    @error('chave')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-lg-2">
                                    <!--input valor-->
                                    <input id="valor" type="text"
                                        class="form-control mb-1 @error('valor') is-invalid @enderror" name="valor"
                                        value="{{ old('valor') }}" required placeholder="Valor">
                                    @error('valor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-lg-2">
                                    <!--input QRcode-->
                                    <input id="nome-arquivo-qrcode" type="text"
                                        class="form-control mb-1 bg-white @error('qrcode') is-invalid @enderror" required
                                        placeholder="QRCODE" readonly onclick="document.querySelector('#qrcode').click()">

                                    <input type="file" id="qrcode" name="qrcode" class="visually-hidden"
                                        accept="image/*" onchange="qrCodeSelecionado(this)" required>
                                    @error('qrcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-lg-4 text-end ms-auto">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary px-5">Salvar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-4">
            <a class="btn btn-primary" href="{{ route('painel-pix.colaboradores') }}">Colaboradores</a>
        </div>

    </section>
    <!-- Dados Pix-->
    <section class="dados_pix">

        <div class="container">
            <div class="row">
                <div class="col-md-12 ps-0">
                    <div class="p-4 border overflow-hidden">
                        <h4 class="mb-4">Dados Do Pix</h4>
                        <p>
                            Tipo da Chave:
                            @if (Auth::user()->pixUsuario)
                                {{ Auth::user()->pixUsuario->tipo_chave }}
                            @endif
                        </p>
                        <p>Chave: @if (Auth::user()->pixUsuario)
                                {{ Auth::user()->pixUsuario->chave }}
                            @endif
                        </p>
                        <p>Valor: @if (Auth::user()->pixUsuario)
                                R$ {{ number_format(Auth::user()->pixUsuario->valor, 2, ',', '.') }}
                            @endif
                        </p>
                        <div class="imgqr me-0 ">

                            <div class="">
                                @if (Auth::user()->pixUsuario)
                                    <img src="{{ asset(Auth::user()->pixUsuario->qrcode) }}" alt="">
                                    <p>QR CODE</p>
                                @else
                                    <div
                                        class="rounded-3 p-5 bg-secondary text-white d-flex justify-content-center align-items-center">
                                        QR CODE
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    @if (session('success'))
        <!-- Modal mensagem de sucesso -->
        <div class="modal fade" id="modal-sucesso" tabindex="-1" data-bs-keyboard="false" role="dialog"
            aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content border-0" style="background: #c4c4c4">
                    <div class="modal-body py-3">
                        <div class="text-uppercase text-center py-3 px-4">
                            <div class="fs-5">
                                {{ session('success') }}
                            </div>
                            <div class="">
                                <span class="bg-white rounded-1 d-inline-block mt-3">
                                    <button type="button"
                                        class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <div class="px-2 small">Fechar</div>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.onload = function() {
                let myModal = new bootstrap.Modal(document.getElementById('modal-sucesso'))
                myModal.show()
            }
        </script>
    @endif

    <script>
        /* Obter nome do arquivo selecionado e add no input apenas para visualizar */
        function qrCodeSelecionado(input) {
            if (input.files.length > 0) {
                nome = input.files[0].name;
                document.querySelector('#nome-arquivo-qrcode').value = nome
            }
        }
    </script>
    <!-- Mascara de input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
    <script>
        var valor = IMask(
            document.getElementById('valor'), {
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

@stop
