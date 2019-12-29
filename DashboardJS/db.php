<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

$conexao = mysqli_connect($servername, $username, $password, $dbname);

// Criar o banco de dados caso não exista
$sql = "CREATE DATABASE IF NOT EXISTS vendas";

if (mysqli_query($conexao, $sql)){
	echo "Banco de dados criado com sucesso!";
} else {
	echo "Erro: " . mysqli_error($conexao) . "<br>";
	die;
}

mysqli_close($conexao);

$dbname = 'vendas';
$conexao = mysqli_connect($servername, $username, $password, $dbname);

mysqli_select_db($conexao, $dbname);

if (!$conexao) {
	die("O Select falhou: " . mysqli_connect_error());
}

//Criar a tabela
$sql = "CREATE TABLE IF NOT EXISTS lucros (
		id INT NOT NULL AUTO_INCREMENT,
		ano_2018 VARCHAR(50) NOT NULL,
		ano_2019 VARCHAR(50) NOT NULL,
		mes VARCHAR(50) NOT NULL,
		PRIMARY KEY (id)	
)";

if(mysqli_query($conexao, $sql)){
	echo "Tabela criada com sucesso!";
} else {
	echo "Erro: " . mysqli_error($conexao) . "<br>";
	die;
}

$sql = "INSERT INTO lucros (mes, ano_2018, ano_2019) VALUES 
		('Janeiro', '120.16', '210.15'), 
		('Fevereiro', '420.40', '225.80'), 
		('Março', '310.00', '55.90'), 
		('Abril', '650.33', '308.10'), 
		('Maio', '200', '416.65')";

$conexao->query($sql);
mysqli_close($conexao);

?>