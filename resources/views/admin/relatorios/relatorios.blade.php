@extends('layouts.admin')
@section('title', 'Relatórios')
@section('content')


    <!-- Relatórios -->
    <div class="row ">
        <div class="row">
            <h2 class="text-left">Relatórios</h2>
        </div>
    </div>

    <div class="row relat mb-5 pb-5">

        <!-- Visitas no site total -->
        <div class="row">
            <div class="col-md-10">
                <h5><i class="fa-solid fa-chart-column"></i> VISITAS NO SITE TOTAL</h5>

                <!-- Exportar -->
                <form action="{{ route('relatorios.pdf-visitas-total') }}" method="post" class="p-0 m-0">
                    @csrf
                    <textarea name="grafico" id="textarea-visitas-total" cols="30" rows="10" class="visually-hidden"></textarea>
                    <div class="btnsUser">

                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle cadastre" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                EXPORTAR
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" type="submit">PDF</button>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('relatorios.exportar-visitas-total') }}">Planilha
                                        Excel</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>

                <hr>
            </div>
        </div>
        <!-- Gráfico Visitas total-->
        <div class="col-md-10">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title text-center">Visitas TOTAL</h3>
                </div>

                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="visitas-total" width="381" height="100"></canvas>
                    </div>
                </div>

            </div>
        </div>

        <!-- visitas por mes-->
        <div class="row mt-4">
            <div class="col-md-10 secao">
                <h5><i class="fa-solid fa-chart-column"></i> VISITAS POR MÊS</h5>

                <form action="{{ route('relatorios.pdf-visitas-por-mes') }}" method="post" class="p-0 m-0">
                    @csrf
                    <textarea name="grafico" id="textarea-visitas-por-mes" cols="30" rows="10" class="visually-hidden"></textarea>
                    <div class="btnsUser">

                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle cadastre" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                EXPORTAR
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="submit">PDF</button></li>
                                <li><a class="dropdown-item" href="{{ route('relatorios.exportar-visitas-mes') }}">Planilha
                                        Excel</a></li>

                            </ul>
                        </div>
                    </div>
                </form>

                <hr>
            </div>
        </div>
        <!-- Gráfico Visitas por mês-->
        <div class="col-md-10">
            <div class="card card-success">

                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="visitas-por-mes" width="381" height="100"></canvas>
                    </div>
                </div>

            </div>
        </div>

        <!-- visitas por dia-->
        <div class="row mt-4">
            <div class="col-md-10 secao">
                <h5><i class="fa-solid fa-chart-column"></i> VISITAS POR DIA</h5>

                <form action="{{ route('relatorios.pdf-visitas-por-dia') }}" method="post" class="p-0 m-0">
                    @csrf
                    <textarea name="grafico" id="textarea-visitas-por-dia" cols="30" rows="10" class="visually-hidden"></textarea>
                    <div class="btnsUser">

                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle cadastre" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                EXPORTAR
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="submit">PDF</button></li>
                                <li><a class="dropdown-item" href="{{ route('relatorios.exportar-visitas-dia') }}">Planilha
                                        Excel</a></li>

                            </ul>
                        </div>
                    </div>
                </form>

                <hr>
            </div>
        </div>
        <!-- Gráfico Visitas por dia-->
        <div class="col-md-10">
            <div class="card card-success">

                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="visitas-por-dia" width="381" height="100"></canvas>
                    </div>
                </div>

            </div>
        </div>

        <!-- Tipos de acesso-->
        <div class="row mt-4">
            <div class="col-md-10 secao">
                <h5><i class="fa-solid fa-chart-column"></i> TIPOS DE ACESSO</h5>

                <div class="btnsUser">

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle cadastre" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            EXPORTAR
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('relatorios.pdf-tipos-de-acesso') }}">PDF</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('relatorios.exportar-tipos-de-acesso') }}">
                                    Planilha Excel
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <hr>
            </div>
        </div>
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="border-dark">Chrome</th>
                            <th scope="col" class="border-dark">Firefox</th>
                            <th scope="col" class="border-dark">Opera</th>
                            <th scope="col" class="border-dark">MSIE</th>
                            <th scope="col" class="border-dark">Safari</th>
                            <th scope="col" class="border-dark">Outros</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="border-0">{{ $tiposDeAcesso['Chrome'] }}</td>
                            <td class="border-0">{{ $tiposDeAcesso['Firefox'] }}</td>
                            <td class="border-0">{{ $tiposDeAcesso['Opera'] }}</td>
                            <td class="border-0">{{ $tiposDeAcesso['MSIE'] }}</td>
                            <td class="border-0">{{ $tiposDeAcesso['Safari'] }}</td>
                            <td class="border-0">{{ $tiposDeAcesso['Outros'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Eventos mais escolhidos-->
        <div class="row mt-4">
            <div class="col-md-10 secao">
                <h5><i class="fa-solid fa-chart-column"></i> EVENTOS MAIS ESCOLHIDOS</h5>

                <div class="btnsUser">

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle cadastre" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            EXPORTAR
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="{{ route('relatorios.pdf-eventos-mais-escolhidos') }}">PDF</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('relatorios.exportar-eventos-escolhidos') }}">
                                    Planilha Excel
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <hr>
            </div>
        </div>
        <div class="col-md-10 p-0">
            @if (count($eventosMaisEscolhidos) == 0)
                <div class="text-center">Nenhuma categoria de evento</div>
            @endif
            <div class="row gy-3">
                @foreach ($eventosMaisEscolhidos as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="border p-3 rounded">
                            <div class="h4">{{ $item['total_eventos'] }} <span style="font-size: 12px">Eventos</span>
                            </div>
                            {{ $item['nome'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
    <script>
        /*chart1*/
        $(document).ready(function() {

            var dadosVisitasTotal = JSON.parse(`{!! $dadosVisitasTotal !!}`);
            var dadosVisitasPorMes = JSON.parse(`{!! $dadosVisitasPorMes !!}`);
            var dadosVisitasPorDia = JSON.parse(`{!! $dadosVisitasPorDia !!}`);

            const visitasTotal = new Chart(document.getElementById('visitas-total').getContext('2d'), {
                type: 'line',
                data: {
                    labels: dadosVisitasTotal.ano,
                    datasets: [{
                        label: 'Visitas',
                        data: dadosVisitasTotal.visitas,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const visitasPorMes = new Chart(document.getElementById('visitas-por-mes').getContext('2d'), {
                type: 'line',
                data: {
                    labels: dadosVisitasPorMes.mes,
                    datasets: [{
                        label: 'Visitas',
                        data: dadosVisitasPorMes.visitas,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const visitasPorDia = new Chart(document.getElementById('visitas-por-dia').getContext('2d'), {
                type: 'line',
                data: {
                    labels: dadosVisitasPorDia.dia,
                    datasets: [{
                        label: 'Visitas',
                        data: dadosVisitasPorDia.visitas,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            /* Converter gráficos em img base64 para exportar em PDF */
            setTimeout(() => {
                let imgVisitasTotal = visitasTotal.toBase64Image();
                document.querySelector('#textarea-visitas-total').value = imgVisitasTotal

                let imgVisitasPorMes = visitasPorMes.toBase64Image();
                document.querySelector('#textarea-visitas-por-mes').value = imgVisitasPorMes

                let imgVisitasPorDia = visitasPorDia.toBase64Image();
                document.querySelector('#textarea-visitas-por-dia').value = imgVisitasPorDia

            }, 1000);

        });
    </script>

@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"
    integrity="sha512-5u+0INguQJub0j7cBrQYM5g+X8JCvYS2vdl1bRy8LwfwN6Y6tBjG0HhXsWwy+/y5k1kMDQQapFUqDE86ddQ4lQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
