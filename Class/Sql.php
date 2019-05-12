<?php 

//criando a classe Sql extendida de PDO
class Sql extends PDO{

	private $conn;//agora a variavel $conn tornou-se um atributo principal da classe

	//qdo eu for instanciar minha classe usando o $conn, o métoco abaixo irá conectar automaticamente ao banco
	
	public function __construct(){//o método __construct irá fornecer todos os dados para conectar ao banco

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","groot",array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            )

	);

	}

	private function setParams($statment, $parameters=array()){//transforma a tabela num array
		
		foreach ($parameters as $key => $value) {
				
				$this->setParam($key,$value);

			}

	}

	private function setParam($statment,$key,$value){

			$statment->bindParam($key,$value);//bindParam trata cada linha e valor da tabela, associando os nomes das coluna a seus valores

	}

	public function query($rawQuery,$params=array()){//

			//prepare é metodo nativo da PDO, mas está sendo acessado pq Sql extende as funcionalidades
			
			$stmt = $this->conn->prepare($rawQuery);	

			$this->setParams($stmt,$params);	

			$stmt->execute();	

			return $stmt;

	}

	public function select($rawQuery, $params=array()):array{

			$stmt=$this->query($rawQuery,$params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}



 ?>