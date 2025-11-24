@extends('layouts.app')

@section('content')
<h1 class="mb-3">Vendas</h1>

<a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">
    + Nova Venda
</a>

<div class="mb-3">
    <a href="{{ route('export.vendas.csv') }}" class="btn btn-success">Exportar CSV</a>
    <a href="{{ route('export.vendas.pdf') }}" class="btn btn-danger">Exportar PDF</a>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vendas as $v)
        <tr>
            <td>{{ $v->id }}</td>
            <td>{{ $v->produto->nome ?? 'Produto removido' }}</td>
            <td>{{ $v->quantidade }}</td>
            <td>R$ {{ number_format($v->valorTotal,2,',','.') }}</td>
            <td>
                {{ $v->dataVenda ? $v->dataVenda->format('d/m/Y') : '---' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
