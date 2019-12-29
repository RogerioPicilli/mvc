<?php
class homeController extends controller {

	public function __construct(){
		// parent::__construct();


		$u = new Users();

		if ($u->isLogado() == false) {
			header("Location: views/login");
			exit;
		}
	}

	public function index() {
		$dados = array();

		$this->loadTemplate('home', $dados);

	}

}