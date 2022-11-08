@extends('layouts.main')
@section('title', 'Selecionar Evento')
@section('content')

    <div class="" style="min-height: 70vh">
        <div class="container py-5 mt-5">
            <div class="col-12 col-lg-10 mx-auto">
                <h1 class="pt-5 text-center h3">Selecione um Evento</h1>

                <!-- Eventos -->
                <div class="text-center mt-4">
                    @if ($eventos->count() > 0)
                        @foreach ($eventos as $evento)
                            <a href="{{ route('editar-evento', $evento->id) }}"
                                class="btn btn-primary m-2 px-4">{{ $evento->titulo }}</a>
                        @endforeach
                    @else
                        <div class="">Sem eventos cadastrados</div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
