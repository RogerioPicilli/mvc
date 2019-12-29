<?php 
session_start();

require("config.php");

if(isset($_POST['email']) && empty($_POST['email']) == false) {
	$email = addslashes($_POST['email']);
	$nome = addslashes($_POST['nome']);
	$pass = md5(addslashes($_POST['pass']));

	$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$pass'";
	$sql = $pdo->query($sql);

	if($sql->rowCount() > 0){
		//salvar o id na session;
		$dado = $sql->fetch();
		$_SESSION['id'] = $dado['id'];
		header("Location: index.php");
	} else {
		echo "Registro não encontrado";
	}
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

		E-Mail:<br>
		<input type="text" name="email"><br><br>
		Senha:<br>
		<input type="password" name="pass"><br><br><br>
		<input type="submit" value="Cadastrar" name="">

	</form>
</body>
</html>