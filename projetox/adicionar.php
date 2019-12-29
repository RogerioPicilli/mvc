<?php 

require 'config.php';

if(isset($_POST['nome']) && empty($_POST['nome']) == false) {
	$nome = addslashes($_POST['nome']);
	$email = addslashes($_POST['email']);
	$pass = md5(addslashes($_POST['pass']));

	$sql = "INSERT INTO usuarios SET
			nome = '$nome', email = '$email', senha = '$pass' ";
	$pdo->query($sql);

	header("Location: index.php");   //volta para a página principal.	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Adicionar Usuário</title>
	<meta charset="utf-8">
</head>
<body>
	<form method="POST">
		Nome:<br>
		<input type="text" name="nome"><br><br>
		E-Mail:<br>
		<input type="text" name="email"><br><br>
		Senha:<br>
		<input type="password" name="pass"><br><br><br>
		<input type="submit" value="Cadastrar" name="">

	</form>
</body>
</html>