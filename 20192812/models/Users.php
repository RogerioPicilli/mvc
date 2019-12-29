<?php 	

class Users extends model {

	public function isLogado() {
		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
			return true;
		} else {
			return false;
		}
	}

	public function doLogin($email, $senha){
		
		echo "Passei aqui... Users.php"; die;
		
		$sql = $this->db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
		$sql->bindValue(":email", $email);
		$sql->bindValue(":password", md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0){
			$data = $sql->fetch();
			$_SESSION['ccUser'] = $data['id'];
			return true;
		} else {
			return false;
		}
	}

}

?>