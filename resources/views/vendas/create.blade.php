@extends('layouts.app')

@section('content')
<h1 class="mb-3">Nova Venda</h1>

<form action="{{ route('vendas.store') }}" method="POST">
    @csrf

    <label>Produto</label>
    <select name="idProduto" class="form-control mb-2" required>
        @foreach($produtos as $p)
            <option value="{{ $p->id }}">{{ $p->nomeProduto }}</option>
        @endforeach
    </select>

    <label>Quantidade</label>
    <input type="number" name="quantidade" class="form-control mb-2" required>

    <label>Valor Total</label>
    <input type="number" step="0.01" name="valorTotal" class="form-control mb-2" required>

    <label>Data da Venda (opcional)</label>
    <input type="date" name="dataVenda" class="form-control mb-3">

    <button class="btn btn-success">Salvar</button>
</form>
@endsection
