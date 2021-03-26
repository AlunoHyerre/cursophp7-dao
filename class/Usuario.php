<?php

class Usuario {

	private $idusuario;
	private $desslogin;
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
		return $this->desslogin;
	}

	public function setDeslogin($value){
		$this->desslogin = $value;
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
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE = :ID", array(
			":ID"=>$id
		));

		if(count($results) > 0){

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['desslogin']);
			$this->setDessenha($row['dessenha']);
			//$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			//"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}



?>