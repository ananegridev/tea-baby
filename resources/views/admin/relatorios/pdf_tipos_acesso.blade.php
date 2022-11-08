<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tipos de acesso</title>
    <style>
        h1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px
        }

        table {
            width: 100%;
            border: 1px solid #ccc
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif
        }
    </style>
</head>

<body>

    <div class="" style="margin-bottom: 30px">
        <img src="{{ public_path() }}/img/logo.png" alt="" style="text-align: center">
    </div>

    <h1>
        <center>Tipos de acesso</center>
    </h1>

    <table class="table table-striped mb-0">
        <thead>
            <tr>
                <th scope="col" class="border-dark">Chrome</th>
                <th scope="col" class="border-dark">Firefox</th>
                <th scope="col" class="border-dark">Opera</th>
                <th scope="col" class="border-dark">MSIE</th>
                <th scope="col" class="border-dark">Safari</th>
                <th scope="col" class="border-dark">Outros</th>
            </tr>
        </thead>
        <tbody>
            <tr class="">
                <td class="border-0">{{ $tiposDeAcesso['Chrome'] }}</td>
                <td class="border-0">{{ $tiposDeAcesso['Firefox'] }}</td>
                <td class="border-0">{{ $tiposDeAcesso['Opera'] }}</td>
                <td class="border-0">{{ $tiposDeAcesso['MSIE'] }}</td>
                <td class="border-0">{{ $tiposDeAcesso['Safari'] }}</td>
                <td class="border-0">{{ $tiposDeAcesso['Outros'] }}</td>
            </tr>
        </tbody>
    </table>


</body>

</html>
