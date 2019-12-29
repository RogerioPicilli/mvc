<?php 
$dsn = "mysql:dbname=blog;host=localhost";
$dbuser = "root";
$dbpass = "";

try {
	$pdo = new PDO($dsn, $dbuser, $dbpass);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Obriga o pdo a mostrar os erros mais elaborados.

} catch (PDOException $e) {
	echo "Falha na conexão";
}


 ?>