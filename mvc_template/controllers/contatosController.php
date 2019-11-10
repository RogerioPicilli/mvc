<?php 

class contatosController extends controller {

	public function index() {

	}

	public function addContato () {
		$dados = array(
			'error' => ''
		);

		if(!empty($_GET['error'])) {
			$dados['error'] = $_GET['error'];
		}

		$this->loadTemplate('addContato', $dados);
	}

	public function addContatoSave () {
		// echo "<pre>";
		// print_r($_POST); //so pra visualizar o que chegou até aqui

		if(!empty($_POST['email'])) {
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);

			$contatos = new Contatos();
			if($contatos->add($nome, $email)) {
				header("Location: ".BASE_URL);
			} else {
				//não adicionou
				header("Location: ".BASE_URL.'contatos/addContato?error=exist');
			}
		} else {
			//o campo email está vazio
			header("Location: ".BASE_URL.'contatos/addContato');
		}


	}

	public function updContato($id) {
		$localId = addslashes($id);
		$dados = array(
			'contatos' => '',
			'error' => ''
		);

		if(!empty($_GET['error'])) {
			$dados['error'] = $_GET['error'];
		}

		//pega os dados do contato no banco de dados
		$contatos = new Contatos();
		$dados['contato'] = $contatos->getContato($localId);

		$this->loadTemplate("updContato", $dados);

	}

	public function updContatoSave() {
		// echo "<pre>";
		// print_r($_POST); //so pra visualizar o que chegou até aqui
		if(!empty($_POST['email'])) {
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$id = addslashes($_POST['id']);
			$contatos = new Contatos();
			if($contatos->upd($nome, $email, $id)) {
				header("Location: ".BASE_URL);
			} else {
				//não atualizou porque está tendo colocar um email que já existe
				header("Location: ".BASE_URL.'contatos/updContato/'.$id.'>?error=exist');
			}
		} else {
			header("Location: ".BASE_URL);
		}
	}

	public function delContato($id) {
		$localId = addslashes($id);

		if($localId > 0) {
			$contatos = new Contatos();
			$contatos->del($localId);
		} 
		header("Location: ".BASE_URL);
	}

}


 ?>