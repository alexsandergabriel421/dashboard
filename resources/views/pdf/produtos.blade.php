<h2>Relatório de Produtos</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
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
                <td>R$ {{ number_format($p->precoProduto, 2, ',', '.') }}</td>
                <td>{{ $p->categoria }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
