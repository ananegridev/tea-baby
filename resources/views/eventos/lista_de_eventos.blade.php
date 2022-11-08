@extends('layouts.main')
@section('title', 'Lista de Eventos')
@section('content')
    <!--Pagina Convidados-->
    <section class="contato">
        <h3 class="text-center">Lista de Eventos</h3>
        <div class="row contadores">
            <div class="col-md-12">
                <!--seção contadores-->
                <ul class="cont">
                    <li>Eventos ({{ $eventos->total() }})</li>
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
                        <th scope="col">Título do evento</th>
                        <th scope="col">Landing Page 1</th>
                        <th scope="col">Landing Page 2</th>
                        <th scope="col">Landing Page 3</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
                            <td>{{ $evento->titulo }}</td>
                            <!-- Link -->
                            <td class="">
                                <input type="text" class="visually-hidden"
                                    value="{{ route('landing-page-one', $evento->link_pagina) }}"
                                    id="lp1-link-ev-{{ $evento->id }}">
                                <div class=" d-inline-block text-truncate" style="max-width: 200px">
                                    <a href="{{ route('landing-page-one', $evento->link_pagina) }}" class=""
                                        target="_blank">{{ route('landing-page-one', $evento->link_pagina) }}</a>
                                </div>
                                <button onclick="copiar(`lp1-link-ev-{{ $evento->id }}`, this)" type="button"
                                    class="btn btn-warning px-1 py-0" title="Copiar"><i class="fa-regular fa-copy"
                                        style="font-size: 15px"></i></button>
                            </td>
                            <!-- Link -->
                            <td class="">
                                <input type="text" class="visually-hidden"
                                    value="{{ route('landing-page-two', $evento->link_pagina) }}"
                                    id="lp2-link-ev-{{ $evento->id }}">
                                <div class=" d-inline-block text-truncate" style="max-width: 200px">
                                    <a href="{{ route('landing-page-two', $evento->link_pagina) }}" class=""
                                        target="_blank">{{ route('landing-page-two', $evento->link_pagina) }}</a>
                                </div>
                                <button onclick="copiar(`lp2-link-ev-{{ $evento->id }}`, this)" type="button"
                                    class="btn btn-warning px-1 py-0" title="Copiar"><i class="fa-regular fa-copy"
                                        style="font-size: 15px"></i></button>
                            </td>
                            <!-- Link -->
                            <td class="">
                                <input type="text" class="visually-hidden"
                                    value="{{ route('landing-page-three', $evento->link_pagina) }}"
                                    id="lp3-link-ev-{{ $evento->id }}">
                                <div class=" d-inline-block text-truncate" style="max-width: 200px">
                                    <a href="{{ route('landing-page-three', $evento->link_pagina) }}" class=""
                                        target="_blank">{{ route('landing-page-three', $evento->link_pagina) }}</a>
                                </div>
                                <button onclick="copiar(`lp3-link-ev-{{ $evento->id }}`, this)" type="button"
                                    class="btn btn-warning px-1 py-0" title="Copiar"><i class="fa-regular fa-copy"
                                        style="font-size: 15px"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        @if ($eventos->total() == 0)
            <div class="text-center">Sem eventos cadastrados</div>
        @endif

        <div class="d-flex justify-content-center">
            {{ $eventos->links() }}
        </div>
    </section>

    <!-- Scripts -->
    <script>
        // Copiar link
        function copiar(id, target) {
            document.getElementById(id).select()
            document.execCommand('copy');
            target.style.background = '#549543';
            setTimeout(() => {
                target.style.background = '#ffc107';
            }, 1000);
        }
    </script>

@stop
