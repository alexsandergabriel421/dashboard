<h2>Relatório de Vendas</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Produto</th>
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
                <td>{{ $v->idProduto }}</td>
                <td>{{ $v->nomeProduto ?? '—' }}</td>
                <td>{{ $v->quantidade }}</td>
                <td>R$ {{ number_format($v->valorTotal, 2, ',', '.') }}</td>
                <td>{{ $v->dataVenda }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
