<?php 
include 'conexao/conexao.php';

$sql = "SELECT * FROM lucros";
$sql = mysqli_query($conexao, $sql);

// Preparacao para os graficos  js

$mes = '';
$ano_2018 = '';
$ano_2019 = '';


//Se mudar _array para _assoc não dá para usar $dados[0] tem que user somente $dados['campo']. No array dá para usar os dois
while ($dados = mysqli_fetch_array($sql)) {
	
	// $data1 = $data1 . '"' . $row['ano_1028'] . '",';

	// $mes = $dados['mes'];
	// $ano_2018 = $dados['ano_2018'];	
	$mes = $mes . '"' . $dados['mes'] . '",';
	$ano_2018 = $ano_2018 . '"' . $dados['ano_2018'] . '",';
	$ano_2019 = $ano_2019 . '"' . $dados['ano_2019'] . '",';

	$mes = trim($mes);
	$ano_2018 = trim($ano_2018);
	$ano_2019 = trim($ano_2019);

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gráfico Linha do Chart.js</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.bundle.min.js"></script>
</head>
<body>

<div class="container" style="background-color: #250352;">	
	<canvas id="myChart">
		
	</canvas>	
</div>


<!-- O script que vem lá do site entre dentro o script abaixo -->
<!-- type of chart:   line, bar -->
<script type="text/javascript">
	var ctx = document.getElementById('myChart').getContext('2d');
	var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: 
    {
    	labels:[<?php echo $mes; ?>],
    	datasets:
    	[
    	{
    		label: 'Meta 2018',
    		data: [120,300,99,155,547],
			borderColor: 'rgba(255,255,0)',
			borderWidth: 3,
			type: 'line'
    	},
    	{
    		label: 'Meta 2019',
    		data: [190,240,280,300,450],
			borderColor: 'rgba(255,0,255)',
			borderWidth: 3,
			type: 'line'
    	},
    	{
    		label: '2018',
    		data: [<?php echo $ano_2018 ?>],
			backgroundColor: 'rgba(255,99,132, 0.5)',      /*'transparent',*/                   
			borderColor: 'rgba(255,99,132)',
			borderWidth: 3
		},
		{
    		label: '2019',
    		data: [<?php echo $ano_2019 ?>],
			backgroundColor: 'rgba(0,255,255, 0.5)',    // 'transparent',
			borderColor: 'rgba(0,255,255)',
			borderWidth: 3
    	}]
    },
    options: 
    {
    	legend: {
    		labels: {
    			fontColor: "white",
    			fontSize: 18
    		}
    	},
    	scales: {
    		xAxes: [{
    			display: true,
    			scaleLabel: {
    				display: true,
    				labelString: 'Meses',
    				fontColor: '#FFF',
    				fontSize: 10
    			},
    			ticks: {
    				fontColor: 'white',
    				fontSize: 14
    			}
    		}],
    		yAxes: [{
    			display: true,
    			scaleLabel: {
    				display: true,
    				labelString: 'Valores',
    				fontColor: '#ffffff',
    				fontSize: 10
    			},
    			ticks: {
    				fontColor: 'white',
    				fontSize: 14
    			}
    		}]
    	}
    }		
	});

</script>
<!-- Lugar para pegar os valores das corres  -->
<!-- https://expanssiva.com.br/pg/tabela-de-cores-html-hexadecimal-e-rgb -->
</body>
</html>