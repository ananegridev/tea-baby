@extends('layouts.main')
@section('title', 'Contato')
@section('content')

    <div class="row">

        <!--Pagina de Contato-->
        <section class="contato">

            <div class="container">

                <div class="row content align-items-center gx-md-5 gy-4">
                    <div class="col-md-6 mb-3">
                        <img src="{{ asset('img/contato-34.svg') }}" alt="Contato">
                    </div>
                    <div class="col-md-5">
                        <h1 class="signin-text mb-3 h5 fw-semibold text-center">Estamos dispostos a te ouvir!</h1>

                        <!-- Formulário -->
                        <form action="{{ route('contato') }}" method="post">
                            @csrf
                            <!-- Nome -->
                            <div class="form-group">
                                <input type="text" name="nome"
                                    class="form-control mb-1 @error('nome') is-invalid @enderror"
                                    value="{{ old('nome') }}" placeholder="Nome Completo" required>
                                @error('nome')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                            <!-- E-mail -->
                            <div class="form-group">
                                <input type="email" name="email"
                                    class="form-control mb-1 mt-3 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                            <!-- Conteúdo -->
                            <div class="form-group mb-3">
                                <textarea name="conteudo" class="form-control mb-1 mt-3 @error('conteudo') is-invalid @enderror"
                                    placeholder="Como podemos te ajudar?" maxlength="1000" required>{{ old('conteudo') }}</textarea>
                                @error('conteudo')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary px-4">
                                <div class="px-2">Enviar</div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Modal mensagem de sucesso -->
    <div class="modal fade" id="modal-sucesso" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-4">
                        <div class="fs-5">
                            Mensagem enviada com sucesso
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

    @if (session('success'))
        <script>
            window.onload = function() {
                let myModal = new bootstrap.Modal(document.getElementById('modal-sucesso'))
                myModal.show()
            }
        </script>
    @endif

@stop
