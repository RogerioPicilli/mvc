<?php 
require 'header.php';
 
if(!empty($_GET['p'])){
	require 'fotos/paginas/'.$_GET['p'].'php';
} else {
	require 'fotos/paginas/home.php';
}
// $p = 'home';
// if(!empty($_GET['p'])) {
// 	$pagina = $_GET['p'];
// 	if(strpos($pagina, '.') === false ){
// 		if(file_exists("paginas/".$pagina.'.php')) {
// 			$p = $pagina;
// 		}
// 	}
// }

// require 'fotos/paginas/'.$p.'.php';


require 'footer.php';