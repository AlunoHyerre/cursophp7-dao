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
//$usuario = new Usuario();
//$usuario->login("user","user123");
//echo $usuario;

//Insere usuário na tabela, criando novo usuário, inserindo o login e a senha
//$aluno = new Usuario();
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("@lun0");
//$aluno->insert();
//echo $aluno;

//Atualiza/modifica os dados de um usuário da tabela, por meio do login e senha
//$usuario = new Usuario();
//$usuario->loadById(5);
//$usuario->update("professor","Pr0f123");
//echo $usuario;

//Excluir um usuário pelo id
//Deletou o registro de ID=3
$usuario = new Usuario();
$usuario->loadById(3);
$usuario->delete();
echo $usuario;

?>