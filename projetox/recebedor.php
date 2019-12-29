<?php 

	$arquivo = $_FILES['arquivo'];

	if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false) {
		//se quizer gravar um arquivo com  um nome aleatorio
		$nomedoarquivo = md5(time().rand(0,99));
		$nomedoarquivo = $nomedoarquivo.'__'.$arquivo['name'];

		//houve um arquivo enviado
		move_uploaded_file($arquivo['tmp_name'], 'arquivos/'.$nomedoarquivo);

		echo 'Arquivo enviado com sucesso!';
	}


 ?>