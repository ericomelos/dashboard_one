<?php

namespace IvansWeb\Libs\Api;
/**
* Classe criada para auxiliar na manipulação do banco de dados.
*/
class Api{


    public $response;

    /**
     * API da DOOCA
     */
    public function envia($url, $verb,  $dados = ''){
        
        $curl = curl_init();
        $data = '';
        //caso seja enviado dados além da autenticação
        if(isset($dados) && $dados != ''){
           
            foreach ($dados as $key => $value) {
                $field[$key] = $value;
            }
            $data = http_build_query($field);
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.dooca.store/{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "{$verb}",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Authorization: '
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    /** 
     * Padrão de consumo da API da TriEasy
     * @return Array 
     */
    public function send($model, $verb, $dados = ''){
        $curl = curl_init();
       
        if(DOMINIO == "www.ivansweb.com.br")
            $url  = "https://www.ivansweb.com.br/api/$model";
        else
            $url  = "http://localhost/ivansweb/api/$model";

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $verb);

        $chave = base64_encode(APIKEY);
        

        if(isset( $dados['pagamento']['meioPagamento'])){
            
            $dados['meioPagamento'] = $dados['pagamento']['meioPagamento'];
            unset($dados['pagamento']);
        }
        // echo "<pre> api dash";
        // print_r($dados);
        // die();
        
        //caso seja enviado dados além da autenticação
        if(isset($dados) && $dados != ''){
           
            foreach ($dados as $key => $value) {
                $field[$key] = $value;
            }
            $data = http_build_query($field);
            // $trash = array("0%5B", "%5D", "1%5B", "%5B5%5B");
            // $data = str_replace($trash, "", $data);

            // echo "<pre> API  (dash)  ";
            // print_r($data);
            // die(); 

            // $data = json_encode($data);
            $params = array(
                "Authorization: Basic $chave",  
                "Content-Type: application/x-www-form-urlencoded"
            );
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $params);
        }else{
            
            $params = array(
                "Authorization: Basic $chave"
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $params);
        }
          
        if(curl_error($curl)) {
            echo "<br>Erro->".curl_error($curl) ."<br>";
            die();
        }else{
            
            return $this->response = curl_exec($curl);
            // echo "<pre>api dash<br>";
            // print_r($this->response);
            // die();
            curl_close($curl);
        }

    }

    /**
     * retorna a resposta da API
     */
    public function getResponse(){
        return $this->response;
    }

    /**
     * codifica ou decodifica os dados em json
     */
    static function json($tipo, $dados){

        if($tipo == 'en'){
            echo json_encode($dados);
        }else {
            if($tipo == 'de'){
                echo  json_decode($dados);
            }else{
                echo json_encode("Erro de Tipo! Escolha DE ou EN.");
            }
        }

    }
}