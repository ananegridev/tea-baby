@extends('layouts.main')
@section('title', 'Convidados')
@section('content')
    <!--Pagina Convidados-->
    <section class="contato">
        <h3 class="text-center">Lista de Convidados</h3>
        <div class="row contadores">
            <div class="col-md-12">
                <!--seção contadores-->
                <ul class="cont">
                    <li>Pendentes ({{ $evento->convidados()->where('status', 'pendente')->count() }})</li>
                    <li>Convidados ({{ $evento->convidados()->where('status', 'aceito')->count() }})</li>
                    <li>Enviados
                        ({{ $evento->convidados()->where('status', 'aceito')->where('tipo_convite', 'enviado')->count() }})
                    </li>
                    <li>Confirmados
                        ({{ $evento->convidados()->where('status', 'aceito')->where('presenca', 'sim')->count() }})</li>
                    <li>Talvez
                        ({{ $evento->convidados()->where('status', 'aceito')->where('presenca', 'talvez')->count() }})</li>
                    <li>Não Compareceram
                        ({{ $evento->convidados()->where('status', 'aceito')->where('presenca', 'nao')->count() }})</li>
                </ul>
                <div class="btn-cont">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-adicionar-convidado">Adicionar Convidado</a>
                    <div class="dropdown geralista">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Gerar Lista
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('convidados.exportar-pdf', $evento->id) }}">PDF</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('convidados.exportar-excel', $evento->id) }}">Planilha Excel</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!--Tabela clientes-->
    <section class="tabela-clientes mb-5">
        <div class="table-responsive">
            <table class="table mb-4 table-hover">
                <thead>
                    <tr>
                        <th scope="col">Convidado</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Código</th>
                        <th scope="col">Presente</th>
                        <th scope="col">Presença</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($convidados as $convidado)
                        <tr
                            class="@if ($convidado->status == 'pendente') alert alert-warning @endif @if ($convidado->status == 'negado') alert alert-danger @endif">
                            <td>{{ $convidado->nome }}</td>
                            <td>{{ $convidado->telefone }}</td>
                            <td>{{ $convidado->cod_convite }}</td>
                            <td>({{ $convidado->qtd_presente }}) {{ $convidado->presente->nome }}</td>
                            <td>
                                @switch($convidado->presenca)
                                    @case('sim')
                                        Sim
                                    @break

                                    @case('nao')
                                        Não
                                    @break

                                    @default
                                        Talvez
                                @endswitch
                            </td>
                            <td>{{ ucfirst($convidado->status) }}</td>
                            <td>
                                <!-- Ações -->
                                <div class="d-flex justify-content-center">
                                    <div class="dropdown">
                                        <button
                                            class="btn link-dark border-0 p-0 m-1 {{ $convidado->status == 'negado' ? 'disabled' : '' }}"
                                            type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-gear"> </i>
                                        </button>
                                        <div class="dropdown-menu shadow" aria-labelledby="triggerId">
                                            @if ($convidado->status != 'aceito')
                                                <a class="dropdown-item text-success"
                                                    href="{{ route('convidados.aceitar-convite', $convidado->id) }}"><i
                                                        class="fa-solid fa-check me-1" style="font-size: 14px"></i> Aceitar
                                                    Pedido</a>
                                            @endif
                                            <a class="dropdown-item text-danger"
                                                href="{{ route('convidados.negar-convite', $convidado->id) }}"><i
                                                    class="fa-solid fa-ban me-1" style="font-size: 14px"></i> Negar
                                                Pedido</a>
                                        </div>
                                    </div>
                                    <!-- Remover -->
                                    <a href="#" title="Remover" class="link-dark text-decoration-none m-1"
                                        data-bs-toggle="modal" data-bs-target="#modal-remover"
                                        onclick="document.querySelector('#confirm-remover-convidado').value= {{ $convidado->id }}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                    <!-- Whatsapp -->
                                    <a href="https://web.whatsapp.com/send?phone=55{{ str_replace(['(', ')', ' ', '-'], [''], $convidado->telefone) }}"
                                        target="_blank" title="WhatsApp" class="link-dark text-decoration-none m-1">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        @if ($convidados->total() == 0)
            <div class="text-center">Sem convidados</div>
        @endif

        <div class="d-flex justify-content-center">
            {{ $convidados->links() }}
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
                        <form action="{{ route('convidados.remover-convidado') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="convidado_id" id="confirm-remover-convidado" required>
                            <div class="fs-5">
                                REMOVER CONVITE
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


    <!-- Modal Adicionar Convidado -->
    <div class="modal fade" id="modal-adicionar-convidado" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-3">
                        <!-- Formulário -->
                        <form action="{{ route('convidados.adicionar-convidado', $evento->id) }}" method="post">
                            @csrf
                            <div class="fs-5 text-uppercase">
                                Adicionar convidado
                            </div>
                            <div class="mt-3">
                                <div class="row gx-2">
                                    <div class="mb-3 col-12 col-lg-6">
                                        <input
                                            class="form-control mb-1 bg-white border-dark shadow-none rounded-0 @error('nome') is-invalid @enderror"
                                            type="text" style="font-size: 13px" name="nome"
                                            value="{{ old('nome') }}" placeholder="Nome" required>
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
                                    <!-- Estará presente -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <select
                                            class="form-select bg-white border-dark shadow-none rounded-0 @error('presenca') is-invalid @enderror"
                                            name="presenca" id="" style="font-size: 13px" required>
                                            <option selected value="" class="text-muted">Estará presente no Evento?
                                            </option>
                                            <option value="sim" class="fw-bold"
                                                @if (old('presenca') == 'sim') selected @endif>Sim</option>
                                            <option value="talvez" class="fw-bold"
                                                @if (old('presenca') == 'talvez') selected @endif>Talvez</option>
                                            <option value="nao" class="fw-bold"
                                                @if (old('presenca') == 'nao') selected @endif>Não</option>
                                        </select>
                                        @error('presenca')
                                            <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Selecionar presente -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <select
                                            class="form-select bg-white border-dark shadow-none rounded-0 @error('presente_id') is-invalid @enderror"
                                            name="presente_id" id="id-presente-selecionado" style="font-size: 13px"
                                            required>
                                            <option selected value="" class="text-muted">Selecionar presente
                                            </option>
                                            @foreach ($categorias as $categoria)
                                                @foreach ($categoria->presentes as $presente)
                                                    @if ($presente->total > 0)
                                                        <option value="{{ $presente->id }}"
                                                            data-total="{{ $presente->total }}" class="fw-bold"
                                                            @if (old('presente_id') == $presente->id) selected @endif>
                                                            {{ $presente->nome }} ({{ $presente->total }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('presente_id')
                                            <div class="invalid-feedback text-start small fw-bold text-lowercase">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Qtd. presentes -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <input
                                            class="form-control mb-1 bg-white border-dark shadow-none rounded-0 @error('qtd_presente') is-invalid @enderror"
                                            type="number" style="font-size: 13px" name="qtd_presente" id="qtd-presente"
                                            placeholder="Qtd. Presentes" value="{{ old('qtd_presente') }}" required>
                                        @error('qtd_presente')
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
                                        <div class="px-2 small" id="adicionar-convidado">Adicionar</div>
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

    @if ($errors->any())
        <script>
            window.onload = function() {
                let myModal = new bootstrap.Modal(document.getElementById('modal-adicionar-convidado'))
                myModal.show()
            }
        </script>
    @endif

    <!-- Modal sucesso -->
    <x-modal-com-msg-sucesso />


    <!-- Scripts -->
    <script>
        /* Limitar a quantidade de presentes do formulário */
        /* A quantidade de presentes não pode ser maior que o total disponível */
        document.querySelector('#qtd-presente').onfocus = function() {
            let e = document.getElementById("id-presente-selecionado");
            let value = e.value;
            let max = e.options[e.selectedIndex].dataset.total;

            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
            if (v > max) this.value = max;
        }

        document.getElementById("qtd-presente").addEventListener("change", function() {
            let e = document.getElementById("id-presente-selecionado");
            let value = e.value;
            let max = e.options[e.selectedIndex].dataset.total;

            let v = parseInt(this.value);
            if (v < 1) this.value = 1;
            if (v > max) this.value = max;
        });
        document.getElementById("id-presente-selecionado").addEventListener("change", function() {
            let e = document.getElementById("id-presente-selecionado");
            let value = e.value;
            let max = e.options[e.selectedIndex].dataset.total;

            let v = parseInt(document.querySelector('#qtd-presente').value);
            if (v < 1) document.querySelector('#qtd-presente').value = 1;
            if (v > max) document.querySelector('#qtd-presente').value = max;
        });
        document.getElementById("adicionar-convidado").addEventListener("click", function() {
            let e = document.getElementById("id-presente-selecionado");
            let value = e.value;
            let max = e.options[e.selectedIndex].dataset.total;

            let v = parseInt(document.querySelector('#qtd-presente').value);
            if (v < 1) document.querySelector('#qtd-presente').value = 1;
            if (v > max) document.querySelector('#qtd-presente').value = max;
        });
    </script>

    <!-- Mascara de input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
    <script>
        var telefoneP = IMask(document.getElementById('telefone-presente'), {
            mask: "(00) 00000-0000"
        });
    </script>

@stop
