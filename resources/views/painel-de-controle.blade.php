@extends('layouts.main')
@section('title', 'Painel de Controle')
@section('content')


    <!--Pagina Painel de Controle-->
    <section class="contato">
        <h3 class="text-center">Painel de Controle</h3>
        <div class="row">

            <!--seção Convidados-->
            <section class="convidados">

                <ul class="convidados p-0 m-0 pt-4 ps-lg-3">
                    <span class="titulocontrole">Convidados</span>
                    <li><i class="far fa-smile"></i> CONFIRMADOS ({{ $convidadosConfirmados }})</li>
                    <li><i class="far fa-meh"></i> TALVEZ ({{ $convidadosTalvez }})</li>
                    <li><i class="far fa-frown"></i> NÃO COMPARECERAM ({{ $convidadosNaoCompareceram }})</li>
                </ul>

                <div class="pt-4 me-lg-3">
                    <a href="{{ route('convidados.selecionar-evento') }}" class="btn btn-primary">Gerenciar Convidados</a>
                </div>
            </section>
            <!--Seção Recebidos-->
            <section class="recebidos">

                <ul class="convidados m-0 p-0 pt-4 ps-lg-3  ">
                    <span class="titulocontrole">Recebidos</span>
                    <li><i class="fa fa-gift"></i> Presentes Escolhidos ({{ $totalPresentes }})</li>
                    <li>
                        <i class="fa fa-sack-dollar"></i> R$ {{ number_format($valoresRecebidos, 2, ',', '.') }}
                        Valores recebidos
                    </li>
                    <li>
                        <i class="fa fa-sack-dollar"></i> R$ {{ number_format($valoresParaReceber, 2, ',', '.') }}
                        Valores a receber
                    </li>

                </ul>
                <div class="btn-recebidos pt-3 me-lg-3">
                    <a href="{{ route('painel-pix') }}" class="btn btn-primary">Gerenciar Pix</a>
                    <a href="{{ route('lista-de-presentes.selecionar-evento') }}" class="btn btn-primary">Gerenciar
                        Presentes</a>
                </div>
            </section>

            <div class="row eventos-cad">
                <div class="col col-md-6">
                    <!--Seção Eventos-->
                    <section class="evento">


                        <ul class="eventos py-1">
                            <span class="titulocontrole pt-3">Evento</span>
                            <div class="btn-eventos pb-3">
                                <a href="{{ route('lista-de-eventos') }}" class="btn btn-primary">Eventos</a>
                                <a href="{{ route('editar-evento-selecionar') }}" class="btn btn-primary">Editar Evento</a>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#excluir_evento">Excluir Evento</a>
                            </div>
                        </ul>

                    </section>
                </div>
                <div class="col col-md-6">
                    <!--Seção Cadastros-->
                    <section class="cadastro pb-3">

                        <ul class="cadastros py-1">
                            <span class="titulocontrole">Cadastro</span>
                            <div class="btn-cadastros">
                                <a href="{{ route('editar_cadastro') }}" class="btn btn-primary">Editar Cadastro</a>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#excluir_cadastro">Excluir Cadastro</a>
                                <a href="{{ route('editar_cadastro') }}" class="btn btn-primary">Cancelar Premium</a>
                            </div>
                        </ul>

                    </section>
                </div>

            </div>
        </div>





    </section>
    <!--Modal Excluir evento-->
    <div class="modal fade" id="excluir_evento" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-2">
                        <div class="fs-5">
                            Excluir evento
                        </div>
                        <div class="">
                            <!-- Formulário -->
                            <form action="{{ route('deletar-evento') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="mt-3 col-12">
                                    <select class="form-select bg-white border-dark shadow-none rounded-0" name="evento_id"
                                        id="" required>
                                        <option selected value="" class="text-muted">
                                            Escolha um evento
                                        </option>
                                        @foreach ($eventos as $evento)
                                            <option value="{{ $evento->id }}" class="fw-bold">{{ $evento->titulo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <span class="d-flex gap-2 rounded-1 d-inline-block mt-3">
                                    <span class="bg-white rounded-1 d-inline-block mt-3">
                                        <button type="submit"
                                            class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4">
                                            <div class="px-2 small">Excluir</div>
                                        </button>
                                    </span>
                                    <span class="bg-white rounded-1 d-inline-block mt-3">
                                        <button type="button"
                                            class="text-uppercase btn-sm py-2 btn btn-outline-danger rounded-1 px-3"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            <div class="px-2 small">Cancelar</div>
                                        </button>
                                    </span>
                                </span>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Excluir cadastro-->
    <div class="modal fade" id="excluir_cadastro" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-4">
                        <div class="fs-5">
                            Confirma exclusão do cadastro?
                        </div>
                        <div class="">
                            <!-- Formulário -->
                            <form action="{{ route('excluir-cadastro') }}" method="post">
                                @csrf
                                @method('DELETE')

                                <span class="d-flex gap-2 rounded-1 d-inline-block mt-3">
                                    <span class="bg-white rounded-1 d-inline-block mt-3">
                                        <button type="submit"
                                            class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4">
                                            <div class="px-2 small">Excluir</div>
                                        </button>
                                    </span>
                                    <span class="bg-white rounded-1 d-inline-block mt-3">
                                        <button type="button"
                                            class="text-uppercase btn-sm py-2 btn btn-outline-danger rounded-1 px-3"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            <div class="px-2 small">Cancelar</div>
                                        </button>
                                    </span>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal cancelar premium-->
    <div class="modal fade" id="cancela_premium" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-4">
                        <div class="fs-5">
                            Confirma cancelamento?
                        </div>
                        <div class="">
                            <span class="rounded-1 d-inline-block mt-3">
                                <button type="button"
                                    class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4 bg-white "
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <div class="px-2 small">Fechar</div>
                                </button>
                                <button type="button"
                                    class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4 btn-danger">Confirmar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('evento_criado'))
        <!-- Modal mensagem de sucesso em criar evento -->
        <div class="modal fade" id="modal-sucesso-2" tabindex="-1" data-bs-keyboard="false" role="dialog"
            aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content border-0" style="background: #c4c4c4">
                    <div class="modal-body py-3">
                        <div class="text-uppercase text-center py-3 px-4">
                            <div class="fs-5">
                                Evento criado com sucesso.
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
                let myModal = new bootstrap.Modal(document.getElementById('modal-sucesso-2'))
                myModal.show()
            }
        </script>
    @endif


    @if (session('pagamento_premium'))
        <!-- Modal info pagamento premium -->
        <div class="modal fade" id="modal-pagamento-premium-info-2" tabindex="-1" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content border-0" style="background: #c4c4c4">
                    <div class="modal-body py-3">
                        <div class="text-uppercase text-center py-3 px-4">
                            <div class="fs-5 fw-bold">
                                Sua solicitação foi enviada com sucesso, em breve o administrador irá ativar sua conta
                                premium.
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
                let myModal = new bootstrap.Modal(document.getElementById('modal-pagamento-premium-info-2'))
                myModal.show()
            }
        </script>
    @endif



@stop


@section('js')
    <!-- Msg sucesso -->
    <x-modal-com-msg-sucesso />
@endsection
