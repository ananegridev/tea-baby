@extends('layouts.admin')
@section('title', 'Categorias Eventos')
@section('content')

    <div class="row content">
        <div class="row">
            <h2 class="text-left"> Categorias Eventos</h2>
        </div>

        <!-- Links -->
        <div class="row detalhesa">
            <div class="col-md-11">
                <div class="btnsUser">
                    <a href="{{ route('admin.eventos.novo') }}" class="btn btn-primary cadastre">NOVO EVENTO</a>
                </div>
            </div>
            <hr>
        </div>

        @if ($eventos->total() == 0)
            <div class="text-center">
                Sem eventos
            </div>
        @endif

        <!--Eventos-->
        <div class="row eventose">
            <section id="row " class="row gy-3">
                @foreach ($eventos as $evento)
                    <div class="col-12 col-lg-4">
                        <div class="card pt-3" style="cursor: default">
                            <div class="text-center mx-auto d-flex align-items-center" style="width: 150px; height: 150px">
                                <img src="{{ asset($evento->icone) }}" class="w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center m-0 p-0">{{ $evento->nome }}</h5>
                                <p class="card-text"></p>
                                <div class="btnsevente">
                                    <a href="{{ route('admin.eventos.editar-evento', $evento->id) }}"
                                        class="btn btn-primary cadastre">EDITAR</a>
                                    <a href="#" class="btn btn-primary cadastre" data-bs-toggle="modal"
                                        data-bs-target="#modal-excluir-evento"
                                        onclick="document.querySelector('#escluir-evento-id').value= {{ $evento->id }}">EXCLUIR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
            <div class="pt-4">
                <!-- Paginação -->
                {{ $eventos->links() }}
            </div>
        </div>
    </div>

    <!--Modal Excluir usuário-->
    <div class="modal fade" id="modal-excluir-evento" tabindex="-1" data-bs-keyboard="false" role="dialog"
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
                            <form action="{{ route('admin.eventos.excluir') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="mt-3 col-12">
                                    <input type="hidden" name="categoria_evento_id" id="escluir-evento-id">
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


    <!-- Msg sucesso -->
    <x-modal-com-msg-sucesso />


@stop
