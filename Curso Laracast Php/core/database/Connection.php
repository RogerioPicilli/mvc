<?php 

class Connection {

	// Sem o arquivo de configuracao
	// public static function make() {
	// 	try {
	// 	    return new PDO('mysql:host=127.0.0.1;dbname=mytodo', 'root', '');
	// 	} catch (PDOException $e) {
	// 		die($e->getMessage());
	// 	}
	// }

	//Pegando os dados no arquivo de configuracao
	public static function make($config) {
		try {
		    // return new PDO('mysql:host=127.0.0.1;dbname=mytodo', 'root', '');
		    return new PDO(
		    		$config['connection'].';dbname='. 
		    		$config['name'], $config['username'],
		    		$config['password']);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}


}
