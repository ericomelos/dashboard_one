<?php

namespace IvansWeb\Libs\DB;
/**
* Classe criada para auxiliar na manipulação do banco de dados.
*/
class Mysql{


    public $conn;
    public $result;

    public function __construct(){
        
        $server   = 'localhost';
        $user     = 'root';
        $pass     = '';
        $database = 'arttatoo';
        
        $this->conn = new \mysqli( $server, $user, $pass, $database);

        // echo "<pre>";
        // print_r($conn);
        // die();

        if($this->conn->connect_errno){
            printf("Connect failed: %s\n", $this->conn->connect_error);
            exit();
        }else{
           return $this->conn;
        }
    }

    /**
     * Monta a query para trazer os dados (SELECT)
     * 
     */
    public function sqlPersonalizado($sql){

        if (!$this->result = $this->query($sql)) {
            return false;
        } else {
            return $this->result;
        }
    }

    /**
     * Manda a query para o banco
     */
    public function query($query){
        $mysqli = $this->conn;
        // echo "Monta ->".$query."<hr>";
        if($res = $mysqli->query($query)){
            $this->conn = $mysqli;
            return $res;
        }else{
            echo "Algo de errado na sintaxe da query abaixo: <br><br>".$mysqli->error;
            echo "<hr>QUERY ->  ".$query."<hr>";
            echo "<hr><pre>";
            print_r($mysqli);
        }
    }

     //retorna a última Id inserida
    public function getLastInsertID() {
      return $this->conn->insert_id;
    }
  


}