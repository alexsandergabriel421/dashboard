<h2>Lista de Funcionários</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Cargo</th>
            <th>Salário</th>
        </tr>
    </thead>

    <tbody>
        @foreach($funcionarios as $f)
            <tr>
                <td>{{ $f->id }}</td>
                <td>{{ $f->nome }}</td>
                <td>{{ $f->email }}</td>
                <td>{{ $f->cargo }}</td>
                <td>R$ {{ number_format($f->salario, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
