@extends('layouts.main')
@section('title', 'Home')
@section('content')


    <div class="row">
        <section class="slide">

            <div class="row">
                <div class="col-md-8">
                    <img src="{{ asset('img/menina.png') }}" alt="Retangulo">
                </div>
                <div class="col-md-4">
                    <div class="texto">
                        <h1>Tea Baby</h1>
                        <p>Estamos ansiosos pela chegada do Baby, mas, enquanto eu não chega, que tal se divertir um
                            pouquinho no meu chá de bebê?</p>
                        <a href="/login" class="btn btn-success login">Confirme sua presença</a>
                    </div>
                </div>
            </div>
        </section>

    </div>








@stop
