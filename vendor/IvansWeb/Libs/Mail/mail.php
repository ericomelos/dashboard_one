<?php

namespace IvansWeb\Libs\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail{
    
    public function enviaRecuperacaoSenha($dados){

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $mail->IsSMTP(); 
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = "smtp.trieasy.com.br"; 
        $mail->SMTPAuth = true; 
        $mail->Port = 587; 
        $mail->SMTPSecure = false; 
        $mail->SMTPAutoTLS = false; 
        $mail->Username = 'recuperasenha@trieasy.com.br'; 
        $mail->Password = 'IMAP2262'; 

        $mail->Sender = "recuperasenha@trieasy.com.br"; 
        $mail->From = "recuperasenha@trieasy.com.br"; 
        $mail->FromName = "Suporte - IvansWebApp/Trieasy"; 

        $mail->AddAddress($dados['email'], $dados['nomeCliente']); 
        $mail->IsHTML(true); 
        $mail->CharSet = 'utf-8'; 
        
        $mail->Subject = "Recuperação de senha";
        $mail->Body    = "corpo do email";

        if(!$mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
            echo 'Erro: ' . $mail->ErrorInfo;
            return false;
        } else{
            return true;
        }
    }
}