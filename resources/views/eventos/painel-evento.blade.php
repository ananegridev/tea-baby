@extends('layouts.main')
@section('title', 'Painel de Evento')
@section('content')


    <div class="row">
        <section class="slide">
            <!--Página Home Eventos-->
            <div class="row welcome text-center">
                <h2>Bem Vindo(a)</h2>
            </div>

            <div class="row organiza text-center">
                <h3>Vamos Organizar seu Evento?</h3>
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    </p>
                </div>
                <!--Botão Criar Evento-->
                <a href="{{ route('cadastro-evento') }}" class="btn btn-primary">Crie Seu Evento</a>

            </div>

            <div class="row">
            </div>
        </section>

    </div>








@stop
