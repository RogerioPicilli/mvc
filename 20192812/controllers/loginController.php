<?php 	

class loginController extends controller {

	public function index() {

		echo "Passei aqui"; die;

		$data = array();
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);

			$u = new Users();

			if($u->doLogin($email, $senha)){
				header("Location: home");
				exit;
			} else {

				$data['error']= "Credenciais invalidas!";
			}
		}
		$this->loadView('login', $data);
	}
}