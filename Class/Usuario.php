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
			$this->setDados($result[0]);
		}

	}/*   fim metodo loadById  */


/*   metodo para  trazer todos  os dados da tabela  */
	public static function getList(){//um método estático tem a vantagem de poder realizar uma consulta direta, sem instanciar o objeto

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");
	}/*   fim metodo loadById  */

/*   metodo para  fazer uma consulta específica */
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
			$this->setDados($result[0]);
			
		} else {
			throw new Exception('Login e/ou senha inválidos.');
		}
	}
	public function setDados($dados){
			$this->setIdusuario($dados['idusuario']);
			$this->setDeslogin($dados['deslogin']);
			$this->setDessenha($dados['dessenha']);
			$this->setDtcadastro(new DateTime($dados['dtcadastro']));
	}

	/*Método para inserção de dados no banco*/
	public function insert(){
		$sql = new Sql();
		//para inserir dados no banco, estamos usando uma storade procedure, iniciando-a com a palavra 	CALL . No SQL Server, a palavra usada é EXECUTE
		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
		));

		if (count($result) > 0) {
			$this->setDados($result[0]);
		}
	}/*fim do método insert*/

	public function update($login,$password){
		$this->setDeslogin($login);
		$this->setDessenha($password);
		
		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN , dessenha = :PASSWORD WHERE idusuario = :ID", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha(),
			":ID"=>$this->getIdusuario()
		));
	}

	/*método para excluir linha de uma tabela*/
	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));
	/*as instruções abiaxo servem para limpar os dados da memória do objeto*/
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}/*fim do método delete*/

	/*método mágico construct para atribuir valores aos atributos assim que instanciarmos a classe Usuario. Requer que sejam informadas essas variáveis na parametrização da classe*/
	public function __construct($login = "", $password = ""){
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}

	public function __toString(){//método de conversão do objeto para string e json_encode
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d-m-Y H:i:s")
		));
	}	

}



?>