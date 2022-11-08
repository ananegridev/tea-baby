<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eventos mais escolhidos</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 40px
        }

        .card {
            width: 24.8%;
            border: 1px solid #ccc;
            padding: 20px;
            display: inline-block;
            margin: 10px 8px
        }

        .h4 {
            font-size: 23px;
            margin-bottom: 5px
        }
    </style>
</head>

<body>

    <div class="" style="margin-bottom: 30px">
        <img src="{{ public_path() }}/img/logo.png" alt="" style="text-align: center">
    </div>

    <h1>
        <center>Eventos mais escolhidos</center>
    </h1>

    <div class="" style="margin: -8px">
        @foreach ($eventosMaisEscolhidos as $item)
            <div class="card p-3 rounded">
                <div class="h4">{{ $item['total_eventos'] }} <span style="font-size: 12px">Eventos</span>
                </div>
                {{ $item['nome'] }}
            </div>
        @endforeach
    </div>

</body>

</html>
