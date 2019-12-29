<?php 
if(!empty($_FILES['foto']['tmp_name'])) {
	 // print_r($_FILES['foto']); 
	//sempre GERAR UM NOME NOVO DE ARQUIVO NOVO ASSIM O USUARIO NUNCA SABERA O NOME DO ARQUIVO
	$nome = md5(rand(0,9999).time());
	$ext = explode('.', $_FILES['foto']['name']);
	$ext = end($ext);

	$nome = $nome.".".$ext;

	if($ext == 'pdf') {
		echo "Beleza é um arquivo pdf.";
	}

	move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/'.$nome);

	echo "Foto carregada com sucesso!";
}


