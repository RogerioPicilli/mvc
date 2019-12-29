<?php 

require 'config.php';

if(isset($_GET['id']) && empty($_GET['id']) == false) {
	$id = addslashes($_GET['id']);

	$sql = "DELETE FROM usuarios WHERE id = '$id' ";
	$pdo->query($sql);

	header("Location: index.php");   //volta para a página principal.	
} else {
	header("Location: index.php");   //volta para a página principal.	
}

?>
