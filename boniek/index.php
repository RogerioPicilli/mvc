<?php 	
try {
	$pdo = new PDO("mysql:dbname=projetok;host=localhost","root","");
} catch (PODException $e) {
	echo "Erro: " . $e->getMessage();
	exit;
}

$ip = $_SERVER['REMOTE_ADDR'];
$hora = date('H:i:s');

$sql = $pdo->prepare("INSERT INTO acessos (ip, hora) VALUES (:ip, :hora)");
$sql->bindValue(":ip", $ip);
$sql->bindValue(":hora", $hora);
$sql->execute();

//Apaga tudo com mais do que o tempo usado na quety que é 5 minutos
$sql = $pdo->prepare("DELETE FROM acessos WHERE hora < :hora");
$sql->bindValue(":hora", date('H:i:s', strtotime("-2 minutes")));
$sql->execute();

//contar quantos usuarios tem online
$sql = "SELECT * FROM acessos WHERE hora > :hora GROUP BY ip";
$sql = $pdo->prepare($sql);
$sql->bindValue(":hora", date('H:i:s', strtotime("-2 minutes")));
$sql->execute();
$qtde =  $sql->rowCount();

echo "Existem " . $qtde . " usuários online";

