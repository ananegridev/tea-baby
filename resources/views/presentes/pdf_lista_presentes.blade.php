<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Presentes</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }

        h1 {
            font-size: 20px;
        }

        .container {
            background: #f2f2f2;
            width: 315px;
            margin-right: 10px;
            margin-bottom: 30px;
            float: left;
            padding: 25px 15px
        }

        .text-categoria {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 8px
        }

        .item {
            padding: 5px 0;
            border-bottom: 1px solid #aaa
        }

        .item-head {
            color: #444;
            font-size: 14px;
            border-bottom: 1px solid #666
        }
    </style>
</head>

<body>

    <div class="" style="margin-bottom: 30px">
        <img src="{{ public_path() }}/img/logo.png" alt="" style="text-align: center">
    </div>

    <h1>
        <center>Lista de Presentes</center>
    </h1>
    @foreach ($categorias as $key => $categoria)
        <div class="container">
            <div class="text-categoria">{{ $categoria->nome }}</div>
            <div class="item item-head">
                <span class="" style="">Item</span>
                <span class="" style="float:right">Qtd.</span>
            </div>
            @php
                $totalItens = 4 - (4 - $categoria->presentes->count());
            @endphp
            @foreach ($categoria->presentes as $indiceFilho => $presente)
                <div class="item">
                    <span class="" style="">{{ $presente->nome ?? '----' }}</span>
                    <span class="" style="float:right">{{ $presente->total }}</span>
                </div>
            @endforeach

            @for ($i = $totalItens; $i < 4; $i++)
                <div class="item">
                    <span class="" style="">----</span>
                    <span class="" style="float:right">0</span>
                </div>
            @endfor


        </div>
        @if ($key == 1)
            <div class="" style="clear:both"></div>
        @endif
    @endforeach


</body>

</html>
