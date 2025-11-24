@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">Dashboard</h1>

    {{-- CARDS --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Funcionários</h5>
                    <p class="card-text fs-3">{{ $totalFuncionarios }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-text fs-3">{{ $totalProdutos }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">Vendas</h5>
                    <p class="card-text fs-3">{{ $totalVendas }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-danger shadow">
                <div class="card-body">
                    <h5 class="card-title">Preço Médio</h5>
                    <p class="card-text fs-3">R$ {{ number_format($mediaPrecoProdutos, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- GRÁFICO — VENDAS --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="mb-3">Vendas por Produto</h4>
            <canvas id="chartVendas"></canvas>
        </div>
    </div>

    {{-- GRÁFICO — FUNCIONÁRIOS --}}
    <div class="card shadow">
        <div class="card-body">
            <h4 class="mb-3">Funcionários por Cargo</h4>
            <canvas id="chartFuncionarios"></canvas>
        </div>
    </div>

</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const vendasLabels = @json($labelsVendas);
const vendasValues = @json($valuesVendas);

const funcLabels = @json($labelsFuncionarios);
const funcValues = @json($valuesFuncionarios);

new Chart(document.getElementById('chartVendas'), {
    type: 'bar',
    data: {
        labels: vendasLabels,
        datasets: [{
            label: 'Total Vendido',
            data: vendasValues,
            borderWidth: 2
        }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

new Chart(document.getElementById('chartFuncionarios'), {
    type: 'pie',
    data: {
        labels: funcLabels,
        datasets: [{
            label: 'Funcionários',
            data: funcValues,
            borderWidth: 2
        }]
    },
    options: { responsive: true }
});
</script>
@endsection
