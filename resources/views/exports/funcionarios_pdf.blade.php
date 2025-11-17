<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Funcionários</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Relatório de Funcionários</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Funcionário</th>
                <th>Cargo</th>
                <th>Salário (R$)</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($funcionarios as $f)
                <tr>
                    <td>{{ $f->id }}</td>
                    <td>{{ $f->nomeFuncionario }}</td>
                    <td>{{ $f->cargoFuncionario }}</td>
                    <td>{{ number_format($f->salarioFuncionario, 2, ',', '.') }}</td>
                    <td>{{ $f->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Gerado automaticamente pelo sistema — {{ date('d/m/Y H:i') }}
    </div>

</body>
</html>
