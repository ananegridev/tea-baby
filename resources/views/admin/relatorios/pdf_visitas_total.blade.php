<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visitas no site total</title>
    <style>
        h1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px
        }
    </style>
</head>

<body>

    <div class="" style="margin-bottom: 30px">
        <img src="{{ public_path() }}/img/logo.png" alt="" style="text-align: center">
    </div>

    <h1>
        <center>Visitas no site total</center>
    </h1>
    <!-- Imagem do gráfico -->
    <img src="{{ request()->post('grafico') }}" alt="" style="width: 100%">

</body>

</html>
