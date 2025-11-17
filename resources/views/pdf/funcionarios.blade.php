<h2>Relatório de Funcionários</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cargo</th>
            <th>Salário</th>
        </tr>
    </thead>
    <tbody>
        @foreach($funcionarios as $f)
            <tr>
                <td>{{ $f->id }}</td>
                <td>{{ $f->nomeFuncionario }}</td>
                <td>{{ $f->cargoFuncionario }}</td>
                <td>R$ {{ number_format($f->salarioFuncionario, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
