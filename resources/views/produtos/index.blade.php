@extends('layouts.app')

@section('content')
<h1 class="mb-3">Produtos</h1>

<a href="{{ route('produtos.create') }}" class="btn btn-primary mb-3">
    + Novo Produto
</a>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Categoria</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nomeProduto }}</td>
            <td>R$ {{ number_format($p->precoProduto,2,',','.') }}</td>
            <td>{{ $p->categoria }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
