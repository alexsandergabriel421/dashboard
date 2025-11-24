<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>

<body>
<h2>Relatório de Vendas</h2>

<table>
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
            <td>{{ $v->produto->nomeProduto ?? 'Produto removido' }}</td>
            <td>{{ $v->quantidade }}</td>
            <td>R$ {{ number_format($v->valorTotal, 2, ',', '.') }}</td>
            <td>
                @if($v->dataVenda)
                    {{ $v->dataVenda->format('d/m/Y') }}
                @else
                    ---
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
