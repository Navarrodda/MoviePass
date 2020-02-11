<?php

namespace Model;

use \phpmailer\phpmailer\PHPMailer;
use \phpmailer\phpmailer\Exception;
use \phpmailer\phpmailer\SMTP;


require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';

class Mail
{


        public function __construct(){
        }



    public function sendMail($email){
      


        $mail = new PHPMailer(true);

            try {
                //Server settings
           //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                            // Enable SMTP authentication
                $mail->Username   = EMAIL;                     // SMTP username
                $mail->Password   = EMAILPASS;                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
             //   $mail->Debugoutput = 'html';
                //Recipients
                $mail->setFrom(EMAIL, 'Movie Pass');
                $mail->addAddress($email);            // Name is optional
              /*  $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');*/
            
                // Attachments
             //   $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment(dirname(__DIR__) . '\qrcode.pdf', 'Codigo qr entradas');    // Optional name
            
                // Content
               // $id = $this->buyoutDAO->GetId($buy->getDate());
                //$cinema = $this->cinemaDAO->GetById($buy->getCinema());
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Confirmacion de compra de entradas';
                $mail->Body    = "Se adjunta la informacion de la compra con un codigo qr que debera presentar al momento de entrar a la funcion" ;/*
                                "<br><br>Cantidad: " . $buy->getQuan() . "<br>Total: " . $buy->getTotal() .
                                "<br>Fecha de compra: " . $buy->getDate() . "<br>Id compra: " . $id . 
                                "<br>Cine: " . $cinema->getName(). "<br>Direccion: ". $cinema->getAdress();*/
                                
              $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
             //   echo 'Message has been sent';
            } catch (Exception $e) {
                
                    echo  $e->getMessage();
            }
        
    }
}