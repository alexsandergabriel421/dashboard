@extends('layouts.app')

@section('content')
<h1 class="mb-3">Produtos</h1>

<a href="{{ route('produtos.create') }}" class="btn btn-primary mb-3">
    + Novo Produto
</a>

<div class="mb-3">
    <a href="{{ route('export.produtos.csv') }}" class="btn btn-success">Exportar CSV</a>
    <a href="{{ route('export.produtos.pdf') }}" class="btn btn-danger">Exportar PDF</a>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nome }}</td>
            <td>{{ $p->categoria }}</td>
            <td>R$ {{ number_format($p->preco, 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
