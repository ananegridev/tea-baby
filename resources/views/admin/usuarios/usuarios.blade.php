@extends('layouts.admin')
@section('title', 'Usuarios')
@section('content')

    <!--Usuarios-->
    <div class="row">
        <div class="row">

            <h2 class="text-left">Usuários</h2>

        </div>
        <div class="row detalhesa mb-5">
            <!-- Pesquisar -->
            <div class="col-12 col-md-4">
                <form class="" action="{{ route('usuarios') }}" method="get">
                    <div class="input-group">
                        <input value="{{ request()->get('p') }}" type="text" name="p"
                            class="form-control border border-end-0 shadow-none" placeholder="Pesquisar"
                            style="height: 40px">
                        <button class="btn btn-light bg-white border border-start-0" type="submit" title="Pesquiar"
                            style="height: 40px">
                            <img src="{{ asset('img/icon-pesquisar.svg') }}" alt="" width="20">
                        </button>
                    </div>
                </form>
            </div>

            <!-- Links -->
            <div class="col-md-3 btnsu">
                <div class="">
                    <a href="{{ route('usuarios.exportar-excel') }}" class="btn btn-success login">EXPORTAR</a>
                    <a href="{{ route('usuarios.novo') }}" class="btn btn-primary cadastre">NOVO USUÁRIO</a>
                </div>
            </div>

        </div>
        <!--Tabela Usuários-->
        <section class="tabela-usuarios table-responsive">
            <table class="table text-start mb-4 table-hover">
                <thead>
                    <tr class="text-start">
                        <th scope="col">ID</th>
                        <th scope="col">NOME</th>
                        <th scope="col">E-MAIL</th>
                        <th scope="col">PERMISSÕES</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr class="text-start">
                            <td>#{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @switch($usuario->conta)
                                    @case('super_admin')
                                        Super Admin
                                    @break

                                    @case('funcionario')
                                        Funcionário
                                    @break

                                    @case('usuario_comum')
                                        Usuário Comum
                                    @break

                                    @case('admin')
                                        Admin
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                @if ($usuario->conta != 'super_admin')
                                    <a class="link-dark text-decoration-none"
                                        href="{{ route('usuarios.config-usuario', $usuario->id) }}" title="Configuração">
                                        <i class="fa fa-gear"></i>
                                    </a>
                                    <a class="link-dark text-decoration-none" href="#" title="Excluir"
                                        data-bs-toggle="modal" data-bs-target="#modal-excluir-usuario"
                                        onclick="document.querySelector('#escluir-usuario-id').value= {{ $usuario->id }}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if ($usuarios->total() == 0)
                <div class="text-center">
                    Sem cadastros
                </div>
            @endif
            <div class="">
                {{ $usuarios->links() }}
            </div>
        </section>

    </div>


    <!--Modal Excluir usuário-->
    <div class="modal fade" id="modal-excluir-usuario" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-2">
                        <div class="fs-5">
                            Excluir usuário
                        </div>
                        <div class="">
                            <!-- Formulário -->
                            <form action="{{ route('usuarios.excluir-usuario') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="mt-3 col-12">
                                    <input type="hidden" name="user_id" id="escluir-usuario-id">
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
