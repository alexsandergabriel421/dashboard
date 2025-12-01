@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">

        <div class="card shadow-lg border-0 mt-5">
            <div class="card-body">

                <h3 class="text-center mb-4">Criar Conta</h3>

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

                <form action="/register" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="form-label">Nome</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control form-control-lg"
                            placeholder="Digite seu nome"
                        >
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">E-mail</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control form-control-lg"
                            placeholder="Digite seu e-mail"
                        >
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Senha</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control form-control-lg"
                            placeholder="Digite uma senha"
                        >
                    </div>

                    <button class="btn btn-dark w-100 btn-lg">Cadastrar</button>

                </form>

                <p class="text-center mt-3">
                    Já tem conta?
                    <a href="/login">Fazer login</a>
                </p>

            </div>
        </div>

    </div>
</div>

@endsection
