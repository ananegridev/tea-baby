@extends('layouts.admin')
@section('title', 'Contatos')
@section('content')

    <!--Usuarios-->
    <div class="row">
        <div class="row">
            <h2 class="text-left mb-4">Contatos</h2>
        </div>

        <!--Tabela Usuários-->
        <section class="tabela-usuarios table-responsive">
            <table class="table table-hover mb-4 ">
                <thead>
                    <tr class="text-start text-truncate">
                        <th scope="col">NOME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">CONTEÚDO</th>
                        <th scope="col">DATA DE ENVIO </th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contatos as $contato)
                        <tr class="text-start">
                            <td class="text-truncate">{{ $contato->nome }}</td>
                            <td>{{ $contato->email }}</td>
                            <td>{{ $contato->conteudo }}</td>
                            <td>{{ $contato->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a class="link-dark text-decoration-none" href="#" title="Excluir"
                                    data-bs-toggle="modal" data-bs-target="#modal-excluir-contato"
                                    onclick="document.querySelector('#escluir-contato-id').value= {{ $contato->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if ($contatos->total() == 0)
                <div class="text-center">
                    Sem contatos
                </div>
            @endif
            <div class="">
                {{ $contatos->links() }}
            </div>
        </section>

    </div>


    <!--Modal Excluir usuário-->
    <div class="modal fade" id="modal-excluir-contato" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-2">
                        <div class="fs-5">
                            Excluir contato
                        </div>
                        <div class="">
                            <!-- Formulário -->
                            <form action="{{ route('contatos.excluir') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="mt-3 col-12">
                                    <input type="hidden" name="contato_id" id="escluir-contato-id">
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
