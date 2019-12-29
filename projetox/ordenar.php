<?php 
require 'config.php';

if(isset($_GET['ordem']) && !empty($_GET['ordem'])) {
   	$ordem = addslashes($_GET['ordem']);
   	$sql = "SELECT * FROM ordernar ORDER BY ".$ordem;
    } else {
    $ordem = "";	
   	$sql = "SELECT * FROM ordernar";
    }

 ?>
 <form method="GET">
 	<select name="ordem" onchange="this.form.submit()">
 		<option></option>  
 		<option value="nome" <?php echo ($ordem=="nome")?'selected="selected"':''; ?>>Pelo Nome</option>
 		<option value="idade" <?php echo ($ordem=="idade")?'selected="selected"':''; ?>>Pela Idade</option>
 	</select>
 </form>
 <table border=1 width="400">
 	<tr>
 		<th>Nome</th>
 		<th>Idade</th>
 	</tr>
 	<?php 

// <?php echo ("")?'':''; se a condição entre aspas for verificada faz o primeiro '' caso contrario o segundo
//

		$sql = $pdo->query($sql);
		if($sql->rowCount() > 0) {

			foreach($sql->fetchAll() as $usuario):
	?>
			<tr>
				<td><?php echo $usuario['nome']; ?></td>
				<td><?php echo $usuario['idade']; ?></td>
			</tr>
	
	<?php		
		endforeach;
		}
 	 ?>
 	

 </table>