<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre um administrador para o sistema</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css">
    <!-- Style -->
    <style>
        .card {
            background: #f2f2f2 !important;
            border: none;
        }
    </style>
</head>

<body>

    <main>
        <div class="container py-5 my-5">
            <div class="row flex-column">
                <div class="col-12 col-lg-8 mx-auto mb-3">
                    <h1 class="h2 mb-5 text-center fw-normal">Cadastre um administrador para o sistema</h1>
                </div>
                <div class="col-12 col-md-5 col-lg-4 mx-auto">
                    <div class="card">
                        <div class="card-body px-5 py-4">
                            <h2 class="card-title h5 fw-bold mb-3">Seus Dados</h2>
                            <!-- Formulário para cadastro -->
                            <form action="{{ route('auth.cadastro-adm') }}" method="post">
                                @csrf
                                <!-- Nome -->
                                <div class="mb-3">
                                    <label for="nome" class="form-label visually-hidden">Nome</label>
                                    <input type="text"
                                        class="form-control rounded-0 @error('name') is-invalid @enderror"
                                        name="name" id="nome" value="{{ old('name') }}" placeholder="Nome">
                                    @error('name')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                                <!-- E-mail -->
                                <div class="mb-3">
                                    <label for="email" class="form-label visually-hidden">E-mail</label>
                                    <input type="email"
                                        class="form-control rounded-0 @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}" placeholder="E-mail">
                                    @error('email')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                                <!-- Senha -->
                                <div class="mb-3">
                                    <label for="password" class="form-label visually-hidden">Senha</label>
                                    <input type="password"
                                        class="form-control rounded-0 @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Senha">
                                    @error('password')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                                <!-- Confirmação de senha -->
                                <div class="mb-3">
                                    <label for="password-confirmation" class="form-label visually-hidden">
                                        Confirmação de senha
                                    </label>
                                    <input type="password" class="form-control rounded-0" name="password_confirmation"
                                        id="password-confirmation" placeholder="Confirmação de senha">
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-primary rounded-0 px-3">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
