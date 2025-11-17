@extends('layouts.app')

@section('content')

<style>
    /* === FIX FINAL DOS GRÁFICOS === */
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    canvas {
        min-height: 280px !important;
        width: 100% !important;
    }
</style>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard</h2>

        <div>
            <a href="{{ route('export.funcionarios.csv') }}" class="btn btn-sm btn-outline-primary me-1">CSV Funcionários</a>
            <a href="{{ route('export.funcionarios.pdf') }}" class="btn btn-sm btn-outline-danger me-3">PDF Funcionários</a>

            <a href="{{ route('export.produtos.csv') }}" class="btn btn-sm btn-outline-primary me-1">CSV Produtos</a>
            <a href="{{ route('export.produtos.pdf') }}" class="btn btn-sm btn-outline-danger me-3">PDF Produtos</a>

            <a href="{{ route('export.vendas.csv') }}" class="btn btn-sm btn-outline-primary me-1">CSV Vendas</a>
            <a href="{{ route('export.vendas.pdf') }}" class="btn btn-sm btn-outline-danger">PDF Vendas</a>
        </div>
    </div>

    <!-- CARDS -->
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-lg border-0 p-3">
                <h6 class="text-muted">Total Funcionários</h6>
                <h2 class="fw-bold">{{ $totalFuncionarios }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-lg border-0 p-3">
                <h6 class="text-muted">Total Produtos</h6>
                <h2 class="fw-bold">{{ $totalProdutos }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-lg border-0 p-3">
                <h6 class="text-muted">Total Vendas</h6>
                <h2 class="fw-bold">{{ $totalVendas }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-lg border-0 p-3">
                <h6 class="text-muted">Média dos Preços</h6>
                <h2 class="fw-bold">R$ {{ number_format($mediaPrecoProdutos, 2, ',', '.') }}</h2>
            </div>
        </div>

    </div>


    <!-- GRÁFICOS -->
    <div class="row g-4">

        <!-- GRÁFICO DE VENDAS -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0 p-4">
                <h5 class="text-center mb-3">Vendas por Produto</h5>
                <div class="chart-container">
                    <canvas id="chartVendas"></canvas>
                </div>
            </div>
        </div>

        <!-- GRÁFICO DE FUNCIONÁRIOS -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0 p-4">
                <h5 class="text-center mb-3">Funcionários por Cargo</h5>
                <div class="chart-container">
                    <canvas id="chartFuncionarios"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================================
                        DADOS DO BANCO
    ===================================================================== */
    const vendasLabels = @json($labelsVendas);
    const vendasValues = @json($valuesVendas);

    const funcLabels   = @json($labelsFuncionarios);
    const funcValues   = @json($valuesFuncionarios);



    /* =====================================================================
                        GRÁFICO DE VENDAS
    ===================================================================== */
    const vendasCtx = document.getElementById("chartVendas");

    if (vendasCtx) {
        new Chart(vendasCtx, {
            type: "bar",
            data: {
                labels: vendasLabels,
                datasets: [{
                    label: "Quantidade Vendida",
                    data: vendasValues,
                    backgroundColor: "rgba(54, 162, 235, 0.7)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }



    /* =====================================================================
                    GRÁFICO DE FUNCIONÁRIOS POR CARGO
    ===================================================================== */
    const funcCtx = document.getElementById("chartFuncionarios");

    if (funcCtx) {
        new Chart(funcCtx, {
            type: "doughnut",
            data: {
                labels: funcLabels,
                datasets: [{
                    data: funcValues,
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56",
                        "#4BC0C0",
                        "#9966FF",
                        "#FF9F40"
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: "bottom" }
                }
            }
        });
    }

});
</script>
@endsection
