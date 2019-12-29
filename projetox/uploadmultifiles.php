<pre>
<?php 

//print_r($_FILES);

if(isset($_FILES['arquivo']) && empty($_FILES) == false) {

	//No recebimento de um único arquivo pegamos o nome desta forma
	//$nome = $_FILES['arquivo']['name'];  A $nome tem teste.jpg

	//No recebimento de vários arquivo temos
	//$nome = $_FILES['arquivo']['name'];  A $nome tem um ARRAY de nomes

	if(count($_FILES['arquivo']['tmp_name']) > 0 ) {
		//TEM AO MENOS UM ARQUIVO SETADO
		for($q=0; $q<count($_FILES['arquivo']['tmp_name']);$q++) {
			$nomedoarquivo = md5(time().rand(0,999)).'_'.$_FILES['arquivo']['name'][$q];
			move_uploaded_file($_FILES['arquivo']['tmp_name'][$q], 'arquivos/'.$nomedoarquivo);
		}	
	}
	
}

 ?>
 </pre>
 <form method="POST" enctype="multipart/form-data">

 	<h3>Upload de arquivos</h3><br><br>

 	<input type="file" name="arquivo[]" multiple="true"><br><br>

 	<input type="submit" name="Enviar Arquivos">
 	
 </form>