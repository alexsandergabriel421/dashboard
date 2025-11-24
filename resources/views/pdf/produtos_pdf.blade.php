<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>
<h2>Relatório de Produtos</h2>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Categoria</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($produtos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nomeProduto }}</td>
            <td>R$ {{ number_format($p->precoProduto, 2, ',', '.') }}</td>
            <td>{{ $p->categoria }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
