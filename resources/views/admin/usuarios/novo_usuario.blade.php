@extends('layouts.admin')
@section('title', 'Novo Usuário')
@section('content')

    <!--Configuração de usuário-->
    <div class="row">
        <div class="row">
            <h2 class="text-left"> Novo Usuário</h2>
        </div>

        <!--Alteração de dados-->
        <section class="alterar-dados mt-4">

            <div class="row">
                <div class="col-md-12">
                    <!--Form alteração de dados-->
                    <form method="POST" action="{{ route('usuarios.salvar-novo-usuario') }}">
                        @csrf
                        <div class="row">
                            <!-- Nome-->
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid mb-0 @enderror" name="name"
                                        value="{{ old('name') }}" required placeholder="Nome Completo">
                                    @error('name')
                                        <span class="invalid-feedback mb-3 text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <!-- Email-->
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid mb-0 @enderror" name="email"
                                        value="{{ old('email') }}" required placeholder="Email">
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
                                        value="{{ old('cpf') }}" required placeholder="CPF">
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

                                    <input id="dt_nasc" type="{{ old('dt_nasc') != null ? 'date' : 'text' }}"
                                        class="form-control mb-1 @error('dt_nasc') is-invalid @enderror" name="dt_nasc"
                                        onfocus="(this.type='date')" value="{{ old('dt_nasc') }}"
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
                                        @if (old('conta') == 'admin' || old('conta') == null) checked @endif>
                                    <label for="admin">Administrador</label>

                                    <input type="radio" name="conta" id="func" value="funcionario"
                                        @if (old('conta') == 'funcionario') checked @endif>
                                    <label for="func">Funcionário</label>

                                    <input type="radio" name="conta" id="usua" value="usuario_comum"
                                        @if (old('conta') == 'usuario_comum') checked @endif>
                                    <label for="usua">Usuário</label>
                                </div>

                                <!-- Assinatura -->
                                <strong>Assinatura: </strong>
                                <div class="inputsp">
                                    <input type="radio" name="plano" id="gratuito" value="gratuito" required
                                        @if (old('plano') == 'gratuito' || old('plano') == null) checked @endif>
                                    <label for="gratuito">Gratuito</label>

                                    <input type="radio" name="plano" id="premium" value="premium"
                                        @if (old('plano') == 'premium') checked @endif>
                                    <label for="premium">Premium</label>

                                </div>

                            </div>
                            <div class="col-md-11">
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
