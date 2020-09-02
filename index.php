<?php

    require_once('inc.autoload.php');

    /* inserindo */

    $prod =  new Produto();
    $prod->setNome("produto".rand()."");
    $prod->setPreco(23.00);

    $dao = new ProdutoDAO();
    $dao->inserir($prod);

    /* fim da insersão */

    /* Listando */
    $dao = new ProdutoDAO();
    $vet = $dao->Lista();
    $num = count($vet);

    for ($i=0; $i < $num; $i++) { 

        $produto =  $vet[$i];

        $id    = $produto->getId(); 
        $nome  = $produto->getNome();
        $preco = $produto->getPreco();
        echo " id: {$id} - nome: {$nome} - preço: {$preco}\n";
    }

    /* fim da listagem */
    
/*
    if(isset($_REQUEST['id']) and !empty($_REQUEST['id'])){
        if(isset($_REQUEST['act']) and !empty($_REQUEST['act'])){
            $act = $_REQUEST['act'];

            if($act == 'remover'){
                $id    = $_REQUEST['id'];
                $prod  =  new Produto();

                $prod->setId($id);
                $dao = new ProdutoDAO();
                $dao->deletar($prod);

            }else if($act == 'update'){

                $prod =  new Produto();

                $prod->setId($id);
                $prod->setNome("produto".rand()."");
                $prod->setPreco(23.50);
            
                $dao = new ProdutoDAO();
                $dao->Update($prod);

            }
        }

    }
*/
?>