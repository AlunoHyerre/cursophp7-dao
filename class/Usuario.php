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

	//Método para carregar o banco, id é a chave primária (SELECT)
	public function loadById($id){

		$sql = new ConexaoBanco();
		//Select pelo ID do usuário
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario =  :ID", array(
			":ID"=>$id
		));

		if(count($results) > 0){

			$this->setDados($results[0]);
		}

	}

	//Diferente do SELECT, o LIST vai trazer todos os usuários
	//Método para listar todos os usuários
	public static function getList(){

		$sql = new ConexaoBanco();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

	}

	//Método para buscar um usuário específico pelo LOGIN (LIST)
	public static function search($login){

		$sql = new ConexaoBanco();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	//Método para buscar um usuário específico pelo LOGIN e SENHA (LIST)
	public function login($login, $password){

		$sql = new ConexaoBanco();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if(count($results) > 0){

			$this->setDados($results[0]);

		}else{
			throw new Exception("Login e/ou senha invalidos.");
		}
	}

	//Método criado para mostrar os dados
	public function setDados($dados){

		$this->setIdusuario($dados['idusuario']);
		$this->setDeslogin($dados['deslogin']);
		$this->setDessenha($dados['dessenha']);
		$this->setDtcadastro(new DateTime($dados['dtcadastro']));

	}
	//Inserir usuários ao banco através do stored procedures (INSERT)
	//Inseriu login e senha, id e data são automáticos
	public function insert(){

		$sql = new ConexaoBanco();
		//Ao invés da query, usou-se a procedure (preicsou inserir no BANCO SQL)
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if(count($results) > 0){
			$this->setDados($results[0]);
		}

	}

	//Atualizar usuários do banco colocando login e senha novas
	public function update($login, $password){//Os parâmetros servem pra dizer sobre 'o que eu quero alterar'...

		//Definindo as variáveis dos parâmetros
		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new ConexaoBanco();
		//Agora é um query, não uma procedure
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha= :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));

	}

	//Exclui usuários do banco por meio do id
	public function delete(){

		$sql = new ConexaoBanco();
		//Faz pela query tbm
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	//FAZ PARTE DO SELECT
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