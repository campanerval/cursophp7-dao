<?php 

require_once("config.php");

$user = new Usuario();

$user->loadById(3);

echo $user;
/*$sql = new Sql();//instanciando a classe

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

//var_dump($usuarios);
?>