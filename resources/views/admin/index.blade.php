@extends('layouts.admin')
@section('title', 'Inicio')
@section('content')


    <div class="row">

        <div class="row">

            <h2 class="text-left">Painel de Controle Administrativo</h2>

        </div>

    </div>
    <div class="row">
        <div class="col-md-10">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 contador-index ">
                <li class="nav-item">
                    <a href="{{ route('admin.usuarios-online') }}" class="text-dark text-decoration-none">
                        @php
                            // Usuários online
                            $usersOnline = \App\Models\User::select('*')
                                ->whereNotNull('last_seen')
                                ->orderBy('last_seen', 'DESC')
                                ->get();
                            
                            $totalOnline = 0;
                            foreach ($usersOnline as $key => $user) {
                                if (Cache::has('user-is-online-' . $user->id)) {
                                    $totalOnline++;
                                }
                            }
                            
                        @endphp
                        <p><i class="fa-solid fa-circle-check"></i></i> Online ({{ $totalOnline }})</p>
                    </a>
                </li>
                <li class="nav-item">
                    <p> <i class="fa-regular fa-calendar-check"></i> Eventos Criados
                        ({{ \App\Models\CategoriaEvento::count() }})</p>
                </li>
            </ul>
            <hr>
        </div>

        <!--  Visitas-->
        <div class="row">
            <div class="col-md-10">
                <h5><i class="fa-solid fa-chart-column me-2"></i> VISITAS POR DIA</h5>
                <hr>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card card-success p-0" style="cursor: default">
                <!-- Gráfico visitas por dia -->
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


        <!-- Eventos escolhidos-->
        <div class="row">
            <div class="col-md-10">
                <h5><i class="fa-solid fa-chart-column me-2"></i>CATEGORIA DE EVENTOS MAIS ESCOLHIDOS</h5>
                <hr>
            </div>
        </div>
        <div class="col-md-10 mb-5">
            <div class="card card-success p-0" style="cursor: default">

                <div class="card-body">
                    @if (count($eventosMaisEscolhidos) == 0)
                        <div class="">Nenhuma categoria de evento</div>
                    @endif
                    <div class="row gy-3">
                        @foreach ($eventosMaisEscolhidos as $item)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="border p-3 rounded">
                                    <div class="h4">{{ $item['total_eventos'] }} <span
                                            style="font-size: 12px">Eventos</span>
                                    </div>
                                    {{ $item['nome'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>


    </div>

    <!-- Chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"
        integrity="sha512-5u+0INguQJub0j7cBrQYM5g+X8JCvYS2vdl1bRy8LwfwN6Y6tBjG0HhXsWwy+/y5k1kMDQQapFUqDE86ddQ4lQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        /*Gráfico visitas por dia*/
        $(document).ready(function() {
            var dadosVisitasPorDia = JSON.parse(`{!! $dadosVisitasPorDia !!}`);

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
        });
    </script>

@stop
