@extends('layouts.admin')
@section('title', 'Configurações do Usuário')
@section('content')

    <!--Configuração de usuário-->
    <div class="row">
        <div class="row">

            <h2 class="text-left"> Configurações dos Usuários</h2>

        </div>
        <div class="row detalhesa">

            <div class="col-md-11">
                <div class="btnsUser">

                    <a href="{{ route('usuarios') }}" class="btn btn-primary cadastre">CANCELAR</a>
                </div>
            </div>
            <hr>
        </div>

        <!--dados Usuários-->
        <section class="dados-usuario">
            <div class="col-md-9 dadosu">
                <p>NOME COMPLETO: {{ $user->name }}</p>

                <p>CPF: {{ $user->cpf }}</p>

                <p> DATA DE NASCIMENTO: {{ date('d/m/Y', strtotime($user->dt_nasc)) }}</p>

                <p>EMAIL: {{ $user->email }}</p>

                <p>SENHA: ***Criptografada***


            </div>
        </section>
        <hr>
        <!--Alteração de dados-->
        <section class="alterar-dados mt-4">
            <div class="row">

                <h2 class="text-left"> ALTERAR DADOS</h2>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <!--Form alteração de dados-->
                    <form method="POST" action="{{ route('usuarios.config-usuario-salvar', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Nome-->
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid mb-0 @enderror" name="name"
                                        value="{{ old('name', $user->name) }}" required placeholder="Nome Completo">
                                    @error('name')
                                        <span class="invalid-feedback mb-3 text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <!-- Email-->
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid mb-0 @enderror" name="email"
                                        value="{{ old('email', $user->email) }}" required placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback mb-3 text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <!-- Cpf-->
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <input id="cpf" type="text"
                                        class="form-control @error('cpf') is-invalid mb-0 @enderror" name="cpf"
                                        value="{{ old('cpf', $user->cpf) }}" required placeholder="CPF">
                                    @error('cpf')
                                        <span class="invalid-feedback mb-3 text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <!-- Password-->

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid mb-0 @enderror" name="password"
                                        required placeholder="Senha">
                                    @error('password')
                                        <span class="invalid-feedback mb-3 text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>
                            <!-- Data de nascimento-->
                            <div class="col col-md-3">
                                <div class="form-group">

                                    <input id="dt_nasc"
                                        type="{{ old('dt_nasc', $user->dt_nasc) != null ? 'date' : 'text' }}"
                                        class="form-control mb-1 @error('dt_nasc') is-invalid @enderror" name="dt_nasc"
                                        onfocus="(this.type='date')" value="{{ old('dt_nasc', $user->dt_nasc) }}"
                                        placeholder="Data de Nascimento" required>

                                    @error('dt_nasc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row detalhes">
                                <!--Permmissões-->
                                <strong>Permissão: </strong>
                                <div class="inputsp">
                                    <input type="radio" name="conta" id="admin" value="admin" required
                                        @if (old('conta', $user->conta) == 'admin' || old('conta', $user->conta) == null) checked @endif>
                                    <label for="admin">Administrador</label>

                                    <input type="radio" name="conta" id="func" value="funcionario"
                                        @if (old('conta', $user->conta) == 'funcionario') checked @endif>
                                    <label for="func">Funcionário</label>

                                    <input type="radio" name="conta" id="usua" value="usuario_comum"
                                        @if (old('conta', $user->conta) == 'usuario_comum') checked @endif>
                                    <label for="usua">Usuário</label>
                                </div>

                                <!-- Assinatura -->
                                <strong>Assinatura: </strong>
                                <div class="inputsp">
                                    <input type="radio" name="plano" id="gratuito" value="gratuito" required
                                        @if (old('plano', $user->plano) == 'gratuito' || old('plano', $user->plano) == null) checked @endif>
                                    <label for="gratuito">Gratuito</label>

                                    <input type="radio" name="plano" id="premium" value="premium"
                                        @if (old('plano', $user->plano) == 'premium') checked @endif>
                                    <label for="premium">Premium</label>

                                </div>

                            </div>
                            <div class="col-md-11 mb-4 pb-4">
                                <div class="btnSalvar">
                                    <button type="submit" class="btn btn-primary cadastre">SALVAR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>

    </div>


    <!-- Msg sucesso -->
    <x-modal-com-msg-sucesso />

    <!-- Mascara de input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
    <script>
        var maskCPF = IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });
    </script>





@stop
