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
<h2>Relatório de Funcionários</h2>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Salário</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($funcionarios as $f)
        <tr>
            <td>{{ $f->id }}</td>
            <td>{{ $f->nomeFuncionario }}</td>
            <td>{{ $f->cargoFuncionario }}</td>
            <td>R$ {{ number_format($f->salarioFuncionario, 2, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
