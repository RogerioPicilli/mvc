<?php 
require 'config.php';

if(isset($_POST['nome']) && !empty($_POST['nome'])) {
	$nome = $_POST['nome'];
	$msg = $_POST['mensagem'];
	$dt = date('Y-m-d H:i:s',time());

	$sql = $pdo->prepare("INSERT INTO mensagens (nome, msg, data_msg) VALUES (:nome, :msg, :data)");
	$sql->bindValue(":nome", $nome);
	$sql->bindValue(":msg", $msg);
	$sql->bindValue(":data", $dt);
	$sql->execute();

	header('Location: comentarios.php');
}


 ?>
 <fieldset>
 	<form method="POST">
 		Nome:<br>
 		<input type="text" name="nome"><br><br>
 		Mensagem:<br>
 		<textarea name="mensagem"></textarea><br><br>
 		<input type="submit" name="Enviar" value="Enviar Mensagem"><br>

 	</form>
 </fieldset>
 <br>

<?php 
	$sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
	$sql = $pdo->query($sql);
	if($sql->rowCount() > 0){
		foreach($sql->fetchAll() as $mensagem):
        ?>
        	 <strong><?php echo $mensagem['nome'].' - Mensagem enviada em:'.$mensagem['data_msg']; ?></strong><br>
 			 <?php echo $mensagem['msg']; ?><hr>	
        <?php  
		endforeach;	
	} else {
		echo "Não há mensagens!";
	}

 ?>

