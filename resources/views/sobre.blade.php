@extends('layouts.main')
@section('title', 'Home')
@section('content')

    <!--Página Sobre-->
    <div class="row head">
        <div class="col-md-12 titulo">

            <h4 class="titlesection">A plataforma perfeita para gestao de sua nova etapa de vida </h4>
        </div>

        <!--imagem header-->
        <img src="{{ asset('/img/hederbaby.png') }}">
    </div>
    <!--Seção Sobre-->
    <section class="sobre">
        <div class="col-md-12">

            <h4 class="titlesection">Fácil e descomplicado, faça gestão do seu evento em uma única plataforma. </h4>
        </div>

        <!--Cards-->
        <div class="row textos">
            <div class="col col-md-5">
                <div class="card-body">
                    <h5 class="card-title">ESCOLHA SEU EVENTO </h5>
                    <p class="card-text">Chá de Bebê? Chá de Revelação?
                        Chá de Fraldas? Independente da
                        festa escolhida nos ajudamos naa
                        organização!
                    </p>

                </div>
            </div>

            <div class="col-md-5">
                <div class="card-body">
                    <h5 class="card-title">PERSONALIZE SUA LISTA DE PRESENTE </h5>
                    <p class="card-text">Escolha os itens que deseja
                        receber selecionando em uma lista
                        contendo tudo que é necessário
                        pra compor um enxoval!
                    </p>

                </div>
            </div>
            <div class="col col-md-5">
                <div class="card-body">
                    <h5 class="card-title">PREPARE OS CONVITES</h5>
                    <p class="card-text">Chega de convite de papel, envie
                        diretamente via whatsapp e
                        aguarde a confirmação pelo sistema!
                    </p>

                </div>
            </div>

            <div class="col-md-5">
                <div class="card-body">
                    <h5 class="card-title">ENDEREÇO PERSONALIZADO </h5>
                    <p class="card-text">Para você que deseja algo a mais,
                        disponibilizamos um endereço
                        personalizavel para seus convidados
                        acessarem pelo navegador.
                    </p>

                </div>
            </div>
        </div>
        </div>
        </div>

    </section>

    <!--destaque-->
    <section class="destaque">
        <div class="row">
            <div class="col-md-8">
                <img src="{{ asset('img/boy.png') }}" alt="Retangulo">
            </div>
            <div class="col-md-2">
                <div class="texto">
                    <h1>As facilidades do tea baby são imensas, tanto para os pais quanto para amigos e familiares. </h1>

                </div>
            </div>
        </div>

    </section>

    <section class="destaque2">
        <div class="row dest2">
            <div class="col-md-12">

                <h4 class="titlesection text-center">Opções para atender o seu momento tão especial</h4>

            </div>

        </div>
    </section>
    <!--Planos-->
    <section id="cards-container">

        <div class="card" style="width: 18rem;">
            <img src="{{ asset('/img/crown.png') }}" class="card-img-top" alt="...">

            <div class="card-body">
                <h5 class="card-title">GRATUITO</h5>
                <p class="card-text">LISTA DE ITENS<BR>
                    CONVIDADOS LIMITADOS<BR>
                    ÚNICO EVENTO DISPONIVEL</p>
                </p>

            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('/img/crown.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">PREMIUM</h5>
                <p class="card-text">LISTA DE ITENS<BR>
                    CONVIDADOS ILIMITADOS<BR>
                    TODOS EVENTOS DISPONIVEIS<BR>
                    CADSTRO DE PIX</p>

            </div>
        </div>
    </section>

    <section class="chamda">
        <div class="row">
            <div class="col-md-9">
                <p>Você quer criar seu grande evento?</p>

            </div>
            <div class="col-md-3 chamadabtn">
                <a href="#" class="btn btn-primary">SIM EU QUERO</a>
            </div>
        </div>
    </section>

@stop
