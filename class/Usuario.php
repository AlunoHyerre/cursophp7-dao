<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	//GETTERS AND SETTERS
	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	//Método, id é a chave primária
	public function loadById($id){

		$sql = new ConexaoBanco();
		//Select pelo ID do usuário
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario =  :ID", array(
			":ID"=>$id
		));

		if(count($results) > 0){

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}
	//Diferente do SELECT, o LIST vai trazer todos os usuários
	//Método para listar todos os usuários
	public static function getList(){

		$sql = new ConexaoBanco();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

	}

	//Método para buscar um usuário específico pelo LOGIN
	public static function search($login){

		$sql = new ConexaoBanco();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	//Método para buscar um usuário específico pelo LOGIN e SENHA
	public function login($login, $password){

		$sql = new ConexaoBanco();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if(count($results) > 0){

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}else{
			throw new Exception("Login e/ou senha invalidos.");
		}
	}

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}


?>