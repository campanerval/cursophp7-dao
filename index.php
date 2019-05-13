<?php 

require_once("config.php");

//1ª - Retorna a consulta de apenas uma linha da tabela
/*$user = new Usuario();
$user->loadById(3);
echo $user;*/

//2ª - Retorna todos os cadastros da tabela
/*$lista = Usuario::getList();//sem necessidade de instanciar, chamando a classe Usuario :: e seu método getList
echo json_encode($lista);*/

//3ª - Retorna uma consulta específica
/*$busca = Usuario::search("u");
echo json_encode($busca);*/

//4ª - Retorna login e senha
/*$acesso = new Usuario();
$acesso->login("user","12345");
echo $acesso;*/

//4ª - Inserção de dados no banco
/*$cadastro = new Usuario("cidadão","@cidadao");
$cadastro->insert();//método criado na classe Usuário para inserçao de dados!
echo $cadastro;*/

//5ª - Atualizaçao de dados no banco
/*$upd_cadastro = new Usuario();
$upd_cadastro->loadById(12);
$upd_cadastro->update("colaborador","semam123");
echo $upd_cadastro;*/

//6ª - Deleção de dados no banco
$del = new Usuario();
$del->loadById(7);
$del->delete();
echo $del;


/*$sql = new Sql();//instanciando a classe

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

//var_dump($usuarios);
?>