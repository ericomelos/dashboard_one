<?php

namespace App\Models;

use IvansWeb\Libs\DB\Mysql;

class Cargos extends Mysql {
    
    
    public function salvar($dados){
        
        $query = "INSERT INTO cargos 
                  (idCargo, 
                  descricao,
                  dataCadastro) 
                  VALUES
                  (NULL, 
                  '{$dados['descricao']}',
                  NOW());
        ";

        $resultado = $this->query($query);

        if($resultado == true){
            echo "Cargo cadastrado com sucesso!!";
        }else{
            echo "Erro ao cadastrar o Cargo<br><pre>";
            print_r($resultado);

        }
    }

    public function listar(){
        
        // atribuindo à variavel query o script de inserção de dados        
        $query = " SELECT * FROM cargos; ";

        $resultado = $this->query($query);

        if($resultado != true){
            print_r($resultado);
        }else{
            return $resultado;
        }
    }

}

?>
