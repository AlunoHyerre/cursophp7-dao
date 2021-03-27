<?php
//Chama o config.php
require_once("config.php");

/*$sql = new ConexaoBanco();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

//Traz somente um usuário por meio do ID (SELECT)
//$root = new Usuario();
//$root->loadById(1);
//echo $root;

//Traz todos os usuários em uma lista (LIST)
//$lista = Usuario::getList();
//echo json_encode($lista);

//Traz uma lista com usuários buscando pelo login
//$search = Usuario::search("JO");
//echo json_encode($search);

//Traz uma lista com usuários buscando pelo login e senha
$usuario = new Usuario();
$usuario->login("user","user123");
echo $usuario;

?>