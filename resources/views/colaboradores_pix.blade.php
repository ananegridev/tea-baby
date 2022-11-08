@extends('layouts.main')
@section('title', 'Lista de Colaboradores')
@section('content')
    <!--Pagina Convidados-->
    <section class="contato">
        <h3 class="text-center">Lista de Colaboradores</h3>
        <div class="row contadores">
            <div class="col-md-12">
                <!--seção contadores-->
                <ul class="cont">
                    <li>Pendentes ({{ $colaboradores->where('status', 'pendente')->count() }})</li>
                    <li>Aprovados ({{ $colaboradores->where('status', 'aprovado')->count() }})</li>
                    <li>Negados ({{ $colaboradores->where('status', 'negado')->count() }})</li>
                    <li>Valor Total
                        (R$ {{ number_format($colaboradores->where('status', 'aprovado')->sum('valor'), 2, ',', '.') }})
                    </li>
                </ul>

            </div>
        </div>


    </section>
    <!--Tabela clientes-->
    <section class="tabela-clientes mb-5">
        <div class="table-responsive">
            <table class="table mb-4 table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data de envio</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colaboradores as $colaborador)
                        <tr
                            class="@if ($colaborador->status == 'pendente') alert alert-warning @endif @if ($colaborador->status == 'negado') alert alert-danger @endif">
                            <td>{{ $colaborador->nome_pix }}</td>
                            <td>R$ {{ number_format($colaborador->valor, 2, ',', '.') }}</td>
                            <td>{{ ucfirst($colaborador->status) }}</td>
                            <td>{{ $colaborador->created_at->format('d/m/Y') }}</td>
                            <td>
                                <!-- Ações -->
                                <div class="d-flex justify-content-center">
                                    <div class="dropdown">
                                        @if ($colaborador->status == 'pendente')
                                            <button class="btn link-dark border-0 p-0 m-1" type="button" id="triggerId"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-gear"> </i>
                                            </button>
                                            <div class="dropdown-menu shadow" aria-labelledby="triggerId">
                                                @if ($colaborador->status != 'aprovado')
                                                    <a class="dropdown-item text-success"
                                                        href="{{ route('painel-pix.colaboradores.aprovar', $colaborador->id) }}"><i
                                                            class="fa-solid fa-check me-1" style="font-size: 14px"></i>
                                                        Aprovar
                                                    </a>
                                                @endif
                                                <a class="dropdown-item text-danger"
                                                    href="{{ route('painel-pix.colaboradores.negar', $colaborador->id) }}">
                                                    <i class="fa-solid fa-ban me-1" style="font-size: 14px"></i> Negar
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Remover -->
                                    <a href="#" title="Remover" class="link-dark text-decoration-none m-1"
                                        data-bs-toggle="modal" data-bs-target="#modal-remover"
                                        onclick="document.querySelector('#confirm-remover-convidado').value= {{ $colaborador->id }}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        @if ($colaboradores->total() == 0)
            <div class="text-center">Sem colaboradores</div>
        @endif

        <div class="d-flex justify-content-center">
            {{ $colaboradores->links() }}
        </div>
    </section>

    <!-- Modal Remover -->
    <div class="modal fade" id="modal-remover" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-3">
                        <!-- Formulário -->
                        <form action="{{ route('painel-pix.colaboradores.deletar') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="colaborador_id" id="confirm-remover-convidado" required>
                            <div class="fs-5">
                                REMOVER COLABORADOR
                            </div>
                            <div class="mt-3">

                            </div>
                            <div class="">
                                <span class="bg-white rounded-1 d-inline-block mt-3">
                                    <button type="submit"
                                        class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4">
                                        <div class="px-2 small">Sim</div>
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

    <!-- Modal sucesso -->
    <x-modal-com-msg-sucesso />


@stop
