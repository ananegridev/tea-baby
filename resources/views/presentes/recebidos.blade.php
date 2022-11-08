@extends('layouts.main')
@section('title', 'Recebidos')
@section('content')

    <!--Pagina Recebidos-->
    <section class="contato">
        <div class="container">
            <h3 class="text-center mb-5">Lista de Presentes</h3>
            <div class="row contadores">
                <div class="col-md-12 border">
                    <!-- Total recebidos-->
                    <ul class="cont p-0 my-4">
                        <li>
                            Evento: {{ $evento->titulo }}
                        </li>
                        <li>
                            Total de Presentes Escolhidos ({{ $totalPresentes }})
                        </li>
                    </ul>
                    <!-- Gerar lista -->
                    <div class="btn-cont p-0 me-4 pb-3">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Gerar Lista
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('lista-presentes.exportar-pdf', $evento->id) }}">PDF</a></li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('lista-presentes.exportar-excel', $evento->id) }}">
                                        Planilha Excel
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Presentes -->
    <section class="tabela-presentes mt-5 pt-3">
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-11 mx-auto">

                    <div class="row gx-5">

                        <!-- Lista de categorias e itens -->
                        @foreach ($categorias as $indexCat => $categoria)
                            <div class="col-md-6 px-5">
                                <form action="{{ route('lista-de-presentes.atualizar') }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <!-- Categoria id -->
                                    <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">

                                    <div class=" px-3 mb-3" style="background: #F2F2F2">
                                        <table class="table presentes mb-5">
                                            <thead>
                                                <th class="text-start p-3 px-4" style="background: #F2F2F2" colspan="2">
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Input categoria -->
                                                        <div class="">
                                                            <input type="text"
                                                                class="bg-transparent border-0 form-control shadow-none text-dark fw-bold mb-0 pt-3 @error('atualizar_categoria')@isset(old('atualizar_categoria')[$indexCat]) is-invalid @endisset @enderror"
                                                                placeholder="Categoria"
                                                                value="{{ old('atualizar_categoria')[$indexCat] ?? $categoria->nome }}"
                                                                name="atualizar_categoria[{{ $indexCat }}]"
                                                                maxlength="255" required>
                                                            @error('atualizar_categoria')
                                                                @isset(old('atualizar_categoria')[$indexCat])
                                                                    <div class="invalid-feedback">
                                                                        <strong>{{ $message }}</strong>
                                                                    </div>
                                                                @endisset
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </th>
                                            </thead>
                                            <tbody class="">
                                                @foreach ($categoria->presentes as $indice => $presente)
                                                    <tr>
                                                        <td class="">
                                                            <!-- Presente id -->
                                                            <input type="hidden"
                                                                name="items_atualizar[{{ $categoria->id }}][{{ $indice }}][presente_id]"
                                                                value="{{ $presente->id }}">

                                                            <!-- input nome do item -->
                                                            <input type="text"
                                                                class="bg-transparent border-0 form-control shadow-none text-dark fw-bold mb-0 pt-3"
                                                                placeholder="Item"
                                                                value="{{ old('items_atualizar')[$categoria->id][$indice]['nome'] ?? $presente->nome }}"
                                                                name="items_atualizar[{{ $categoria->id }}][{{ $indice }}][nome]"
                                                                maxlength="255">
                                                        </td>
                                                        <td class="align-middle">
                                                            <div
                                                                class="d-flex justify-content-center align-items-centser pt-3">
                                                                <i class="fa-solid fa-circle-minus"
                                                                    onclick="subtrairTotalItem(`{{ $presente->id }}-{{ $indice }}`)"></i>
                                                                <!-- Input total -->
                                                                <input type="text"
                                                                    id="input-total-item-{{ $presente->id }}-{{ $indice }}"
                                                                    class=" p-0 small d-flex align-middle fw-bold align-items-center border border-1 border-secondary text-center mx-2 bg-white rounded-circle py-0"
                                                                    value="{{ old('items_atualizar')[$categoria->id][$indice]['total'] ?? $presente->total }}"
                                                                    style="width: 22px; height: 22px; "
                                                                    name="items_atualizar[{{ $categoria->id }}][{{ $indice }}][total]"
                                                                    readonlys>
                                                                <i class="fa-solid fa-circle-plus"
                                                                    onclick="somarTotalItem(`{{ $presente->id }}-{{ $indice }}`)"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center" style="margin-top: -15px">
                                            <button type="submit" class="btn btn-primary mb-3 px-5 py-3">Salvar
                                                Lista</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        @endforeach

                        <!-- Adicionar Categoria e itens -->
                        <div class="col-md-6 px-5">
                            <form action="{{ route('lista-de-presentes.salvar', $evento->id) }}" method="post">
                                @csrf
                                <div class=" px-3 mb-3" style="background: #F2F2F2">
                                    <table class="table presentes mb-5">
                                        <thead>
                                            <th class="text-start p-3 px-4" style="background: #F2F2F2" colspan="2">
                                                <div class="d-flex justify-content-between">
                                                    <!-- Input categoria -->
                                                    <div class="">
                                                        <input type="text"
                                                            class="bg-transparent border-0 form-control shadow-none text-dark fw-bold mb-0 pt-3 @error('adicionar_categoria') is-invalid @enderror"
                                                            placeholder="Categoria"
                                                            value="{{ old('adicionar_categoria') }}"
                                                            name="adicionar_categoria" maxlength="255" required>
                                                        @error('adicionar_categoria')
                                                            <div class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </th>
                                        </thead>
                                        <tbody class="">
                                            @foreach ([3, 3, 3, 3, 3, 3] as $indice => $item)
                                                <tr>
                                                    <td class="">
                                                        <!-- input nome do item -->
                                                        <input type="text"
                                                            class="bg-transparent border-0 form-control shadow-none text-dark fw-bold mb-0 pt-3"
                                                            placeholder="Item"
                                                            name="items_adicionar[{{ $indice }}][nome]"
                                                            maxlength="255">
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="d-flex justify-content-center align-items-centser pt-3">
                                                            <i class="fa-solid fa-circle-minus"
                                                                onclick="subtrairTotalItem(`{{ $indice }}`)"></i>
                                                            <!-- Input total -->
                                                            <input type="text"
                                                                id="input-total-item-{{ $indice }}"
                                                                class=" p-0 small d-flex align-middle fw-bold align-items-center border border-1 border-secondary text-center mx-2 bg-white rounded-circle py-0"
                                                                value="0" style="width: 22px; height: 22px; "
                                                                name="items_adicionar[{{ $indice }}][total]"
                                                                readonlys>
                                                            <i class="fa-solid fa-circle-plus"
                                                                onclick="somarTotalItem(`{{ $indice }}`)"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-center" style="margin-top: -15px">
                                        <button type="submit" class="btn btn-success mb-3 px-5 py-3">Adicionar</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- msg sucesso -->
    <x-modal-com-msg-sucesso />


@stop
@section('js')

    <script>
        function subtrairTotalItem(id) {
            let total = document.querySelector('#input-total-item-' + id).value;
            let valor = total / 1 - 1;
            document.querySelector('#input-total-item-' + id).value = valor < 0 ? 0 : valor
        }

        function somarTotalItem(id) {
            let total = document.querySelector('#input-total-item-' + id).value;
            let valor = total / 1 + 1;
            document.querySelector('#input-total-item-' + id).value = valor
        }
    </script>

    <!-- Tooltip -->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
