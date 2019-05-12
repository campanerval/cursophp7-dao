<?php 

require_once("config.php");

$sql = new Sql();//instanciando a classe

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

/*$usuarios = array_map('encode_all_strings', $usuarios);

function encode_all_strings($usuarios) {
    foreach($usuarios as $key => $value) {
        $usuarios[$key] = utf8_encode($value);
    }
    return $usuarios;
}*/

echo json_encode($usuarios);

//var_dump($usuarios);
?>