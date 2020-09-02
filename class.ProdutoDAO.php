<?php
require_once('inc.autoload.php');
require_once('inc.connect.php');
class ProdutoDAO{

    private $dba;

    public function  __construct(){

        $dba = new DbAdmin('mysql');
		$dba->connect(HOST,USER,SENHA,BD);
		$this->dba = $dba;

    }


    public function Lista(){

        $dba = $this->dba;
		
		$vet = array();
		
		$sql = 'SELECT * FROM produto';
		
		$res = $dba->query($sql);
		
		$res->execute();

		for($i=0; $row = $res->fetch(); $i++){
		
			$id    = $row['id'];
            $nome  = $row['nome'];
            $preco = $row['preco'];
			
			$prod = new Produto();
			
			$prod->setId($id);
            $prod->setNome($nome);
            $prod->setPreco($preco);

			$vet[$i] = $prod;
			
			
		}
		
		return $vet;

    }

   /* public function inserir($prod){
        $dba   = $this->dba;	
        
        $nome  = $prod->getNome();
        $preco = $prod->getPreco();

        $sql = "INSERT INTO `produto`
                (`nome`,
                `preco`)
                VALUES
                ('".$nome."',
                ".$preco.")";
        //echo $sql;
        $res = $dba->query($sql);
        
		$res->execute();
    }*/
  public function inserir($prod){
        $dba   = $this->dba;	
        
        $nome  = $prod->getNome();
        $preco = $prod->getPreco();

        $sql = "INSERT INTO `produto`
                (`nome`,
                `preco`)
                VALUES
                (':nome',
                 ':preco')";
        //echo $sql;
        $res = $dba->query($sql);

        $res->bindParam(':nome', $nome);
        $res->bindParam(':preco', $preco);
    
		$res->execute();
    }
    public function Update($prod){
        $dba   = $this->dba;	
        
        $id    = $prod->getId();
        $nome  = $prod->getNome();
        $preco = $prod->getPreco();

        $sql = "UPDATE `produto`
        SET
        `nome`  = ':nome',
        `preco` = ':preco'
        WHERE `id` = ':id' ";

        $res = $dba->query($sql);
        $res->bindParam(':nome', $nome);
        $res->bindParam(':preco', $preco);
        $res->bindParam(':id', $id);

		$res->execute();
    }


    public function deletar($prod){
        $dba   = $this->dba;	
        
        $id    = $prod->getId();

        $sql = " DELETE FROM produto where id = ':id' ";

        $res = $dba->query($sql);
        $res->bindParam(':id', $id);

		$res->execute();
    }
    
}

?>