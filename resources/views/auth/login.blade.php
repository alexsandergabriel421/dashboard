@extends('layouts.app') {{-- usa o layout que você mandou --}}

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">

        <div class="card shadow-lg border-0 mt-5">
            <div class="card-body">

                <h3 class="text-center mb-4">Login</h3>

                {{-- Erros de validação --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Mensagem de sucesso --}}
                @if(session('mensagem'))
                    <div class="alert alert-success">{{ session('mensagem') }}</div>
                @endif

                <form action="/login" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control form-control-lg"
                            placeholder="Digite seu e-mail"
                        >
                    </div>

                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Senha</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control form-control-lg"
                            placeholder="Digite sua senha"
                        >
                    </div>

                    <button class="btn btn-dark w-100 btn-lg">Entrar</button>

                </form>

                <p class="text-center mt-3">
                    Não tem conta?
                    <a href="/register">Criar conta</a>
                </p>

            </div>
        </div>

    </div>
</div>

@endsection
