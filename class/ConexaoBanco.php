<?php
//Classe de conexão com o Banco
//Classe PDO já é nativa do PHP
//Atributos e Métodos Públicos da PDO
class ConexaoBanco extends PDO {

	private $conn;
	//Método Construtor
	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
	
	}

	//Setar vários parâmetros
	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value){
			$statment->bindParam($key, $value);
		}

	}

	//Setar um parâmetro
	private function setParam($statment, $key, $value){

		$statment->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array()){
		//Prepare a QUERY
		$stmt = $this->conn->prepare($rawQuery);

		//Setando os parâmetros
		$this->setParams($stmt, $params);

		//Execução no BD
		$stmt->execute();

		return $stmt;

	}

	//Faz o select
	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}



?>