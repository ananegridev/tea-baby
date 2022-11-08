<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tea Baby - @yield('title')</title>

    <!-- Fonts -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link href="{{ asset('/css/sidebars.css') }}" rel="stylesheet">

    <script src="{{ asset('/js/script.js') }}"></script>

    <!-- Styles -->

</head>

<body onload="msg()">

    <div class="container">
        <nav class="navbar">


            <div class="navbar-brand offset-1"><a href="{{ route('index-home') }}"><img
                        src="{{ asset('/img/logo.png') }}"></a></div>

        </nav>
    </div>

    <aside class="show navbar-collapse" id="navbarNavDarkDropdown">

        <div class="sidebar">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">

                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin') }}"
                            class="nav-link  @if (Route::is('admin')) active @else link-dark @endif"
                            aria-current="page">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usuarios') }}"
                            class="nav-link @if (Route::is('usuarios')) active @else link-dark @endif ">
                            Usuários
                        </a>
                    </li>
                    @can('admin')
                        <li>
                            <a href="{{ route('admin.usuarios-premium') }}"
                                class="nav-link @if (Route::is('admin.usuarios-premium')) active @else link-dark @endif ">
                                Usuários Primium
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="{{ route('contatos') }}"
                            class="nav-link @if (Route::is('contatos')) active @else link-dark @endif">
                            Contatos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.eventos') }}"
                            class="nav-link @if (Route::is('admin.eventos')) active @else link-dark @endif">
                            Categorias Eventos
                        </a>
                    </li>
                    @can('admin')
                        <li>
                            <a href="{{ route('relatorios') }}"
                                class="nav-link @if (Route::is('relatorios')) active @else link-dark @endif">
                                Relatórios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('configuracoes') }}"
                                class="nav-link @if (Route::is('configuracoes')) active @else link-dark @endif">

                                Configurações
                            </a>
                        </li>
                    @endcan
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="nav-link link-dark"> Sair</a>
                        </form>
                    </li>
                </ul>


            </div>

    </aside>
    <main>

        <div class="container adminc">
            <div class="row">
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        </div>
        </div>
    </main>


</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
</script>

<!-- js extra -->
@yield('js')

</html>
