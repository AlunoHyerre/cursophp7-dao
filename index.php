<?php
//Chama o config.php
require_once("config.php");

$sql = new ConexaoBanco();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);

?>