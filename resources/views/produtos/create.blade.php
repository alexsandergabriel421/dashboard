@extends('layouts.app')

@section('content')
<h1 class="mb-3">Cadastrar Produto</h1>

<form action="{{ route('produtos.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nome do Produto</label>
        <input type="text" name="nomeProduto" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" name="precoProduto" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Categoria</label>
        <input type="text" name="categoria" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
