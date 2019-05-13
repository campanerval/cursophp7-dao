<?php 

class Usuario{

/* inicio criação atributos */
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
/* fim criaçao atributos */

/*   inicio criação getters e setters     */
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
/*   fim criação getters e setters     */

/*   metodo para  trazer os dados atraves do parametro Id  */
	public function loadById($id){

		$sql = new Sql();//instancio a classe Sql

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(
			":ID"=>$id
		));//filtragem de dados

		if (count($result) > 0 ){
			$row = $result[0];
			
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}/*   fim metodo loadById  */


/*   metodo para  trazer todos  os dados da tabela  */
	public static function getList(){//um método estático tem a vantagem de poder realizar uma consulta direta, sem instanciar o objeto

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");
	}/*   fim metodo loadById  */

/*   metodo para  trazer fazer uma consulta específica */
	public static function search($login){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
				':SEARCH'=>"%".$login."%"
		));
	}/*   fim método consulta  search*/

	public function login($login, $password){
		$sql = new Sql();//instancio a classe Sql

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));//filtragem de dados

		if (count($result) > 0 ){
			$row = $result[0];
			
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}else {
			throw new Exception('Login e/ou senha inválidos.');
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d-m-Y H:i:s")
		));
	}

	

}



?>