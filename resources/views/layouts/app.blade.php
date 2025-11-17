<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>

        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('funcionarios.index') }}">Funcionários</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('produtos.index') }}">Produtos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('vendas.index') }}">Vendas</a>
            </li>

        </ul>
    </div>
</nav>

<div class="container">
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
