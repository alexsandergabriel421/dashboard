<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Frutas e Funcionários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>

  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    h1 {
      color: #2c3e50;
      margin-bottom: 20px;
    }
    .chart {
      width: 600px;
      height: 400px;
      margin: 20px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 20px;
    }
  </style>
</head>
<body>

  <div class="container text-center py-4">
    <h1>📊 Dashboard - Frutas & Funcionários</h1>
    <p class="text-muted">Visualização de dados e exportação CSV</p>

    <div class="mb-3">
      <a href="{{ route('csv.funcionarios') }}" class="btn btn-primary m-2">Baixar Funcionários</a>
      <a href="{{ route('csv.produtos') }}" class="btn btn-success m-2">Baixar Produtos</a>
      <a href="{{ route('csv.vendas') }}" class="btn btn-warning m-2">Baixar Vendas</a>
    </div>

    <div id="grafico1" class="chart"></div>
    <div id="grafico2" class="chart"></div>
  </div>

  <script>
    // Gráfico de Pizza - Vendas de Frutas
    var grafico1 = echarts.init(document.getElementById('grafico1'));
    var option1 = {
      title: { text: 'Participação nas Vendas de Frutas', left: 'center' },
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
        emphasis: {
          itemStyle: { shadowBlur: 10, shadowOffsetX: 0, shadowColor: 'rgba(0, 0, 0, 0.5)' }
        }
      }]
    };
    grafico1.setOption(option1);

    // Gráfico de Barras - Quantidade de Funcionários Cadastrados
    var grafico2 = echarts.init(document.getElementById('grafico2'));
    var option2 = {
      title: { text: 'Funcionários por Mês', left: 'center' },
      xAxis: { type: 'category', data: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'] },
      yAxis: { type: 'value' },
      series: [{
        data: [3, 5, 2, 6, 4, 7],
        type: 'bar',
        colorBy: 'data',
      }]
    };
    grafico2.setOption(option2);
  </script>

</body>
</html>
