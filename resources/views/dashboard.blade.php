<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Dashboard - Frutas & Funcionários</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>
body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0; padding: 0;
}
h1 {
    color: #2c3e50;
    text-align: center;
    font-weight: 600;
    margin: 30px 0;
}
.cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-bottom: 40px;
}
.card {
    flex: 1 1 200px;
    max-width: 220px;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    color: #fff;
}
.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.card i {
    font-size: 2.5rem;
    margin-bottom: 10px;
}
.card h3 {
    font-size: 2rem;
    margin-bottom: 5px;
}
.export-buttons {
    text-align: center;
    margin-bottom: 50px;
}
.export-buttons a {
    min-width: 160px;
    margin: 5px;
}
.charts {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    margin-bottom: 50px;
}
.chart {
    width: 100%;
    max-width: 500px;
    height: 400px;
    background:#fff;
    border-radius:12px;
    box-shadow:0 6px 20px rgba(0,0,0,0.1);
    padding:20px;
}
</style>
</head>
<body>

<h1>📊 Dashboard - Frutas & Funcionários</h1>

<!-- CARDS DE AGREGAÇÃO -->
<div class="cards">
    <div class="card bg-primary">
        <i class="fas fa-users"></i>
        <h3>{{ $totalFuncionarios ?? 0 }}</h3>
        <p>Total de Funcionários</p>
    </div>
    <div class="card bg-success">
        <i class="fas fa-boxes-stacked"></i>
        <h3>{{ $totalProdutos ?? 0 }}</h3>
        <p>Total de Produtos</p>
    </div>
    <div class="card bg-warning text-dark">
        <i class="fas fa-shopping-cart"></i>
        <h3>{{ $totalVendas ?? 0 }}</h3>
        <p>Total de Vendas</p>
    </div>
    <div class="card bg-info">
        <i class="fas fa-dollar-sign"></i>
        <h3>R$ {{ number_format($mediaPrecoProdutos ?? 0,2,',','.') }}</h3>
        <p>Média de Preço</p>
    </div>
</div>

<!-- BOTÕES DE EXPORTAÇÃO CSV -->
<div class="export-buttons">
    <a href="{{ route('csv.funcionarios') }}" class="btn btn-primary"><i class="fas fa-file-csv"></i> CSV Funcionários</a>
    <a href="{{ route('csv.produtos') }}" class="btn btn-success"><i class="fas fa-file-csv"></i> CSV Produtos</a>
    <a href="{{ route('csv.vendas') }}" class="btn btn-warning"><i class="fas fa-file-csv"></i> CSV Vendas</a>
</div>

<!-- GRÁFICOS (dados estáticos apenas para visualização) -->
<div class="charts">
    <div id="grafico1" class="chart"></div>
    <div id="grafico2" class="chart"></div>
    <div id="grafico3" class="chart"></div>
    <div id="grafico4" class="chart"></div>
</div>

<script>
function initCharts() {
    // Gráfico 1 - Pizza
    var g1 = echarts.init(document.getElementById('grafico1'));
    g1.setOption({
        title: { text: 'Vendas de Frutas', left: 'center' },
        tooltip: { trigger: 'item' },
        legend: { bottom: '5%' },
        series: [{
            name: 'Vendas',
            type: 'pie',
            radius: '60%',
            data: [
                { value: 40, name: 'Maçã' },
                { value: 30, name: 'Banana' },
                { value: 20, name: 'Laranja' },
                { value: 10, name: 'Uva' }
            ],
            emphasis: { itemStyle: { shadowBlur: 15, shadowOffsetX: 0, shadowColor: 'rgba(0,0,0,0.5)' } }
        }]
    });

    // Gráfico 2 - Barra
    var g2 = echarts.init(document.getElementById('grafico2'));
    g2.setOption({
        title: { text: 'Funcionários por Mês', left: 'center' },
        xAxis: { type: 'category', data: ['Jan','Fev','Mar','Abr','Mai','Jun'] },
        yAxis: { type: 'value' },
        series: [{ data: [3,5,2,6,4,7], type: 'bar', colorBy:'data' }]
    });

    // Gráfico 3 - Linha
    var g3 = echarts.init(document.getElementById('grafico3'));
    g3.setOption({
        title: { text: 'Preço Médio Produtos', left:'center' },
        xAxis: { type:'category', data:['Produto A','Produto B','Produto C','Produto D'] },
        yAxis: { type:'value' },
        series: [{ data:[10,15,8,20], type:'line', smooth:true }]
    });

    // Gráfico 4 - Radar
    var g4 = echarts.init(document.getElementById('grafico4'));
    g4.setOption({
        title: { text:'Distribuição de Vendas', left:'center' },
        radar: {
            indicator: [
                { name: 'Maçã', max:50 },
                { name: 'Banana', max:50 },
                { name: 'Laranja', max:50 },
                { name: 'Uva', max:50 }
            ]
        },
        series: [{ name: 'Vendas', type: 'radar', data:[{ value:[40,30,20,10], name:'Frutas' }] }]
    });
}

initCharts();
window.addEventListener('resize', () => { initCharts(); });
</script>

</body>
</html>
