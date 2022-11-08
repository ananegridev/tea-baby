@extends('layouts.admin')
@section('title', 'Configurações')
@section('content')


    <div class="row">

        <div class="row">

            <h2 class="text-left">Configurações</h2>

        </div>

    </div>
    <div class="row">
        <div class="col-md-10">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 contador-index ">
                <li class="nav-item">
                    <p><i class="fa fa-cogs"></i> Manutenção</p>
                </li>
                <li class="nav-item">

                    <!-- Formulário -->
                    <form action="{{ route('configuracoes.alterar-status') }}" method="post" id="form">
                        @csrf

                        @php
                            $config = \App\Models\Configuracao::first();
                        @endphp
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" role="switch"
                                id="flexSwitchCheckDefault" @if ($config && $config->status_manutencao == 'on') checked @endif>
                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                        </div>
                    </form>

                </li>
            </ul>
            <div class="">
                Apenas o painel do usuário e as landing pages exibirá uma mensagem de que o sistema está em manutenção!
            </div>
            <hr>
        </div>
        <div class="content-config"></div>

        <script>
            document.getElementById('status').onchange = function() {
                document.getElementById('form').submit();
            }
        </script>

        <!-- Msg sucesso -->
        <x-modal-com-msg-sucesso />

    @stop
