<?php

class DbAdmin{

	//tipo: ira receber o tipo de linguagem que iremos utilizar no DB.
	private $tipo;
	//conn: irá receber o endereço da conexao ativa.
	private $conn;
	
	public function __construct($tipo){
	
		$this->tipo = $tipo;
	}
	
	public function connect($host,$user,$sen,$base){
		
		switch($this->tipo){			
			
			case 'mysql':
			
			$this->conn = new PDO("mysql:dbname=$base; host=$host", $user, $sen,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));		
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			break;
			
			case 'pgsql':
			
				//codigo da classe refente a conexao com o banco em pgsql
			
			break;
			
			case 'mssql':
				
				//codigo da classe refente a conexao com o banco em mssql
				
			break;
			
			case 'firebird':
			
				//codigo da classe refente a conexao com o banco em firebird
				$this->conn = ibase_connect($host,$user,$sen) or die("Erro ao conectar ao sql");
			break;
		
		}
		
	}
	public function query($sql){
		
		switch($this->tipo){			
			
			case 'mysql':
			
				/*$res = mysqli_query($this->conn,$sql) 
								  or die(mysqli_error());	*/	
				$res = $this->conn->prepare($sql);				  
				
			break;
			
			case 'pgsql':
			
				//codigo da classe refente a conexao com o banco em pgsql
			
			break;
			
			case 'mssql':
				
				//codigo da classe refente a conexao com o banco em mssql
				
			break;
			
			case 'firebird':
			
				//codigo da classe refente a conexao com o banco em firebird
				$res = ibase_query($this->conn,$sql) or die(ibase_errmsg());
			break;
		
		}	
		return $res;
	}
	public function rows($res){
	
		switch($this->tipo){			
			
			case 'mysql':
			
				$num = 0;//mysqli_num_rows($res);
				//$this->conn->rowCount();
			break;
			
			case 'pgsql':
			
				//codigo da classe refente a conexao com o banco em pgsql
			
			break;
			
			case 'mssql':
				
				//codigo da classe refente a conexao com o banco em mssql
				
			break;
			
			case 'firebird':
			
				//codigo da classe refente a conexao com o banco em firebird
				$num = ibase_num_fields($res);
			break;
		
		}	
		return $num;
	}
	public function result($res, $lin,$col){
		
		switch($this->tipo){			
			
			case 'mysql':
			
			$val = $this->mysqliresult($res, $lin,$col);
				
			break;
			
			case 'pgsql':
			
				//codigo da classe refente a conexao com o banco em pgsql
			
			break;
			
			case 'mssql':
				
				//codigo da classe refente a conexao com o banco em mssql
				
			break;
			
			case 'firebird':
			
				//codigo da classe refente a conexao com o banco em firebird
				$val = ibase_field_info($res, $lin);
			break;
		
		}	
		return $val;	
	}
	
	public function mysqliresult($result, $number, $field) {
    	mysqli_data_seek($result, $number);
    	$row = mysqli_fetch_assoc($result);
    	return $row[$field];
	}
}	
?>