<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Dashboard - Frutas & Funcionários</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>
body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin:0; padding:0; }
h1 { color:#2c3e50; text-align:center; font-weight:700; margin:30px 0; }
.cards { display:flex; flex-wrap:wrap; justify-content:center; gap:20px; margin-bottom:40px; }
.card { flex:1 1 200px; max-width:220px; padding:20px; border-radius:12px; text-align:center; color:#fff; transition: transform 0.2s, box-shadow 0.2s; cursor:default; }
.card:hover { transform:translateY(-5px); box-shadow:0 8px 20px rgba(0,0,0,0.15); }
.card i { font-size:2.5rem; margin-bottom:10px; }
.card h3 { font-size:2rem; margin-bottom:5px; }
.bg-primary { background-color:#007bff; }
.bg-success { background-color:#28a745; }
.bg-warning { background-color:#ffc107; color:#212529; }
.bg-info { background-color:#17a2b8; }
.export-buttons { text-align:center; margin-bottom:50px; }
.export-buttons a { min-width:160px; margin:5px; transition: transform 0.2s; }
.export-buttons a:hover { transform:translateY(-3px); }
.charts { display:flex; flex-wrap:wrap; justify-content:center; gap:30px; margin-bottom:50px; }
.chart { width:100%; max-width:500px; height:400px; background:#fff; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,0.1); padding:20px; }
</style>
</head>
<body>

<h1>📊 Dashboard - Frutas & Funcionários</h1>

<script>
// ---- DADOS ESTÁTICOS ----
const funcionariosData = [
    ['ID', 'Nome', 'Nascimento'],
    [1, 'João da Silva', '1985-02-10'],
    [2, 'Maria de Souza', '1990-06-15'],
    [3, 'Carlos Pereira', '1988-11-20'],
    [4, 'Ana Cláudia', '1992-01-05'],
    [5, 'Pedro Álvares', '1987-07-12'],
    [6, 'Fernanda Lima', '1991-03-23'],
    [7, 'Rafael Castro', '1989-12-11'],
    [8, 'Patrícia Gomes', '1993-09-30'],
    [9, 'Luiz Henrique', '1986-08-17'],
    [10,'Juliana Santos','1990-05-22']
];

const produtosData = [
    ['ID', 'Produto', 'Categoria', 'Preço (R$)'],
    [1, 'Maçã', 'Fruta', 3.50],
    [2, 'Banana', 'Fruta', 2.30],
    [3, 'Laranja', 'Fruta', 4.10],
    [4, 'Uva', 'Fruta', 5.00],
    [5, 'Abacaxi', 'Fruta', 6.20],
    [6, 'Pera', 'Fruta', 4.80],
    [7, 'Manga', 'Fruta', 7.50]
];

const vendasData = [
    ['ID', 'Produto', 'Quantidade', 'Valor Total (R$)'],
    [1, 'Maçã', 10, 35.00],
    [2, 'Banana', 5, 11.50],
    [3, 'Laranja', 8, 32.80],
    [4, 'Uva', 4, 20.00],
    [5, 'Abacaxi', 2, 12.40],
    [6, 'Pera', 6, 28.80],
    [7, 'Manga', 3, 22.50]
];

// ---- CONSULTAS DE AGREGAÇÃO ----
const totalFuncionarios = funcionariosData.length - 1; // exclui header
const totalProdutos = produtosData.length - 1;
const totalVendas = vendasData.length - 1;
const mediaPrecoProdutos = produtosData.slice(1).reduce((acc, p) => acc + p[3], 0) / totalProdutos;
</script>

<!-- CARDS DE AGREGAÇÃO -->
<div class="cards">
    <div class="card bg-primary">
        <i class="fas fa-users"></i>
        <h3 id="totalFuncionarios">0</h3>
        <p>Total de Funcionários</p>
    </div>
    <div class="card bg-success">
        <i class="fas fa-boxes-stacked"></i>
        <h3 id="totalProdutos">0</h3>
        <p>Total de Produtos</p>
    </div>
    <div class="card bg-warning">
        <i class="fas fa-shopping-cart"></i>
        <h3 id="totalVendas">0</h3>
        <p>Total de Vendas</p>
    </div>
    <div class="card bg-info">
        <i class="fas fa-dollar-sign"></i>
        <h3 id="mediaPrecoProdutos">R$ 0,00</h3>
        <p>Média de Preço</p>
    </div>
</div>

<!-- BOTÕES CSV -->
<div class="export-buttons">
    <a href="{{ route('csv.funcionarios') }}" class="btn btn-primary"><i class="fas fa-file-csv"></i> CSV Funcionários</a>
    <a href="{{ route('csv.produtos') }}" class="btn btn-success"><i class="fas fa-file-csv"></i> CSV Produtos</a>
    <a href="{{ route('csv.vendas') }}" class="btn btn-warning"><i class="fas fa-file-csv"></i> CSV Vendas</a>
</div>


<!-- GRÁFICOS -->
<div class="charts">
    <div id="grafico1" class="chart"></div>
    <div id="grafico2" class="chart"></div>
    <div id="grafico3" class="chart"></div>
    <div id="grafico4" class="chart"></div>
</div>

<script>
// Preencher os cards
document.getElementById('totalFuncionarios').innerText = totalFuncionarios;
document.getElementById('totalProdutos').innerText = totalProdutos;
document.getElementById('totalVendas').innerText = totalVendas;
document.getElementById('mediaPrecoProdutos').innerText = `R$ ${mediaPrecoProdutos.toFixed(2).replace('.',',')}`;

// CSV download
function downloadCSV(filename, rows){
    let csvContent = "\uFEFF";
    rows.forEach(r => { csvContent += r.join(";") + "\n"; });
    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = filename;
    link.click();
}

// Gráficos estáticos
function initCharts() {
    echarts.init(document.getElementById('grafico1')).setOption({
        title:{text:'Vendas de Frutas', left:'center'},
        tooltip:{trigger:'item'},
        legend:{bottom:'5%'},
        series:[{type:'pie', radius:'60%', data:[{value:40,name:'Maçã'},{value:30,name:'Banana'},{value:20,name:'Laranja'},{value:10,name:'Uva'}]}]
    });

    echarts.init(document.getElementById('grafico2')).setOption({
        title:{text:'Funcionários por Mês', left:'center'},
        xAxis:{type:'category', data:['Jan','Fev','Mar','Abr','Mai','Jun']},
        yAxis:{type:'value'},
        series:[{type:'bar', data:[2,3,1,4,3,5], colorBy:'data'}]
    });

    echarts.init(document.getElementById('grafico3')).setOption({
        title:{text:'Preço Médio Produtos', left:'center'},
        xAxis:{type:'category', data:['Produto A','Produto B','Produto C','Produto D']},
        yAxis:{type:'value'},
        series:[{type:'line', data:[45,50,40,60], smooth:true}]
    });

    echarts.init(document.getElementById('grafico4')).setOption({
        title:{text:'Distribuição de Vendas', left:'center'},
        radar:{indicator:[{name:'Maçã', max:50},{name:'Banana', max:50},{name:'Laranja', max:50},{name:'Uva', max:50}]},
        series:[{type:'radar', data:[{value:[40,30,20,10], name:'Frutas'}]}]
    });
}

initCharts();
window.addEventListener('resize', ()=>{ initCharts(); });
</script>

</body>
</html>
