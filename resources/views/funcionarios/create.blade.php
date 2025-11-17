@extends('layouts.app')

@section('content')
<h1 class="mb-3">Novo Funcionário</h1>

<form action="{{ route('funcionarios.store') }}" method="POST">
    @csrf

    <label>Nome do Funcionário</label>
    <input type="text" name="nomeFuncionario" class="form-control mb-2" required>

    <label>Cargo</label>
    <input type="text" name="cargoFuncionario" class="form-control mb-2" required>

    <label>Salário</label>
    <input type="number" step="0.01" name="salarioFuncionario" class="form-control mb-3" required>

    <button class="btn btn-success">Salvar</button>
</form>
@endsection
