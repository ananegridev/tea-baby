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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">


    <script src="{{ asset('/js/script.js') }}"></script>



</head>

<body onload="msg()" class="container">

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">


            <div class="navbar-brand offset-1"><a href="{{ route('index-home') }}"><img
                        src="{{ asset('/img/logo.png') }}"></a></div>
            @guest<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">


                        <li class="nav-item"><a href="/" class="nav-link"> Home</a></li>
                        <li class="nav-item"><a href="{{ route('sobre') }}" class="nav-link">
                                Sobre</a></li>

                        <li class="nav-item"><a href="{{ route('contato') }}" class="nav-link">
                                Contato</a></li>

                        <div class="btns">
                            <a href="/login" class="btn btn-success login">Login</a>
                            <a href="/register" class="btn btn-primary cadastre">Cadastre-se</a>
                        </div>
                    @endguest

                </ul>
                @auth
                    <div class="dropdown menuauth">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Menu

                        </a>

                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="/" class="nav-link"> Home</a></li>
                            <li class="nav-item"><a href="{{ route('sobre') }}" class="nav-link">
                                    Sobre</a></li>

                            <li class="nav-item"><a href="{{ route('contato') }}" class="nav-link">
                                    Contato</a></li>
                            <li><a class="nav-link" href="{{ route('painel-evento') }}">Cadastrar Evento</a></li>
                            <li><a class="nav-link" href="{{ route('painel-de-controle') }}">Painel de Controle</a></li>


                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                            this.closest('form').submit();"
                                        class="nav-link"> Sair</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
                </ul>
            </div>

        </nav>
    </div>


    </nav>
    <main>
        <div class="container">
            <div class="row">
                @yield('slide')
            </div>
            <div class="row">
                @if (session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield('content')

                <!-- Button trigger modal -->

                <!-- login -->
                <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginm"
                    data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img src="{{ asset('/img/logo.png') }}"><br>
                                <h5 class="modal-title" id="loginm"></h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <h4 class="text-center">Login</h4>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('danger'))
                                <div class="alert alert-danger">
                                    {{ session('danger') }}
                                </div>
                            @endif


                            <div class="modal-body">

                                <form method="POST" action="/entrar">
                                    @csrf


                                    <div class="mb-3">
                                        <label for="loginmail" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="loginmail" name="email"
                                            aria-describedby="emailHelp">

                                    </div>
                                    <div class="mb-3">
                                        <label for="passmail" class="form-label">Senha: </label>
                                        <input type="password" class="form-control" id="passmail" name="password">
                                    </div>

                                    <button type="submit" class="btn entrar">Entrar</button>

                            </div>
                            <div class="modal-footer">

                                <p class="text-center">Ainda não é cadastrado na plataforma?</p>
                                <p class="text-center"><a href="#" data-bs-toggle="modal"
                                        data-bs-target="#mcadastro">Clique aqui para fazer o Cadastro</a></p>


                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--cadastro-->

            </div>
        </div>
    </main>


    <footer class="container pt-3">
        <hr>
        <div class="py-3">
            <p class="ps-3 ps-lg-0">Tea Baby, Inc. 2022</p>
            <span class="rsocial">
                <a href="#" title="Facebook" class="text-decoration-none">
                    <img src="{{ asset('/img/facebook.png') }}" class="m-0" width="35">
                </a>
                <a href="#" title="Instagram" class="text-decoration-none">
                    <img src="{{ asset('/img/instagram.png') }}" class="ms-1me-3" width="35">
                </a>
            </span>
        </div>
    </footer>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
</script>

<!-- js extra -->
@yield('js')


<!-- Visitas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
<script>
    axios.post("{{ route('inserir-visita') }}", {
        "_token": "{{ csrf_token() }}"
    }).then(response => {
        console.log(response.data)
    })
</script>

</html>
