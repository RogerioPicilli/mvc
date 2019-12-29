<?php 
require 'config.php';

session_start();   //starta uma sessao no pc do cliente

//vamos verificar se o usuário está logado
if(isset($_SESSION['id']) && empty($_SESSION['id']) == false) {
	echo 'Área restrita';
} else {
	header("Location: login.php");
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Usuários</title>
	<meta charset="utf-8">
	<h3>Cadastro de Usuários</h3>
</head>
<body>
	<a href="adicionar.php">Incluir Novo Usuário</a><br><br>
	<table border="1px" width="100%">
		<tr>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Ações</th>
		</tr>
		<?php 
			$sql = "SELECT * FROM usuarios";
			$sql = $pdo->query($sql);
			if($sql->rowCount() > 0){
				foreach($sql->fetchAll() as $usuario) {
					echo '<tr>';
					echo '<td>'.$usuario['nome'].'</td>';
					echo '<td>'.$usuario['email'].'</td>';
					echo '<td><a href="editar.php?id='.$usuario['id'].'">Editar</a> | <a href="excluir.php?id='.$usuario['id'].'">Excluir</a></td>';
					echo '<tr>';
				}
			} else {

			}
		 ?>


	</table>

</body>
</html>