@extends('layouts.app')

@section('content')
<h1 class="mb-3">Funcionários</h1>

<a href="{{ route('funcionarios.create') }}" class="btn btn-primary mb-3">
    + Novo Funcionário
</a>

<div class="mb-3">
    <a href="{{ route('export.funcionarios.csv') }}" class="btn btn-success">Exportar CSV</a>
    <a href="{{ route('export.funcionarios.pdf') }}" class="btn btn-danger">Exportar PDF</a>
</div>

<table class="table table-striped table-bordered">
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
            <td>R$ {{ number_format($f->salarioFuncionario,2,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection