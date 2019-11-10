<?php 
class Contatos extends model {

	public function getAll() {
		$array = array();

		$sql = 'SELECT * FROM contatos';
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getContato($id) {
		$array = array();
		$sql = "SELECT * FROM contatos WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}
		return $array;
	}


	public function add($nome, $email) {
		if($this->emailExists($email) == false) {
			$sql = "INSERT INTO contatos (nome, email) VALUES (:nome, :email)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->execute();
			return true;
		} else {
			return false;
		}
	}

	public function upd($nome, $email, $id) {
		if($this->emailExistsId($email, $id) == true) { //Certifica que está mudando só o nome no id ja'existente
			$sql = "UPDATE contatos SET nome = :nome, email = :email WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":id", $id);
			$sql->execute();
			return true;
		} else if($this->emailExists($email) == false) {
			$sql = "UPDATE contatos SET nome = :nome, email = :email WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":id", $id);
			$sql->execute();
			return true;
		} else
			return false;
	}

	private function emailExists($email) {
		$sql = "SELECT * FROM contatos WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			//Ja existe o email 
			return true;
		} else {
			return false;
		}

	}

	private function emailExistsId($email, $id) {
		$sql = "SELECT * FROM contatos WHERE email = :email AND id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			//Ja existe o email com este id o que esta tudo certo  
			return true;
		} else {
			return false; //Está tentando modificar o email de um id mas o email já existe em outro id
		}

	}

	public function del($id) {
		$sql = "DELETE FROM contatos WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

}

 ?>
