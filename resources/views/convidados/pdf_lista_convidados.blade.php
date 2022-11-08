<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de convidados</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            font-size: 14px;
        }

        .text-truncate {
            white-space: nowrap;
        }

        .alert-warning {
            background: #fff3cd;
        }

        .alert-danger {
            background: #f8d7da;
        }

        h1 {
            font-size: 20px
        }
    </style>
</head>

<body>

    <div class="" style="margin-bottom: 30px">
        <img src="{{ public_path() }}/img/logo.png" alt="" style="text-align: center">
    </div>

    <h1>
        <center>Lista de Convidados</center>
    </h1>

    <table class="table mb-4 table-hover" border="1">
        <thead>
            <tr>
                <th scope="col">Convidado</th>
                <th scope="col">Telefone</th>
                <th scope="col">Código</th>
                <th scope="col">Presente</th>
                <th scope="col">Presença</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($convidados as $convidado)
                <tr
                    class="@if ($convidado->status == 'pendente') alert-warning @endif @if ($convidado->status == 'negado') alert-danger @endif">
                    <td>{{ $convidado->nome }}</td>
                    <td class="text-truncate">{{ $convidado->telefone }}</td>
                    <td>{{ $convidado->cod_convite }}</td>
                    <td class="text-truncate">({{ $convidado->qtd_presente }}) {{ $convidado->presente->nome }}</td>
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

                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
