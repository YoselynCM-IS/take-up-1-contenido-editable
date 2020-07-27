<?php

/***librerias phpmailer**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';
/**********/

$imagen = $_POST["imagen"];
$tup1_regGP = $_POST["tup1_regGP"];
$tup1_regCA = $_POST["tup1_regCA"];
$tup1_regND = $_POST["tup1_regND"];
$tup1_regCD = $_POST["tup1_regCD"];
$tup1_regNA = $_POST["tup1_regNA"];
/*
echo $imagen;
echo "<br>";
echo $tup1_regGP;
echo "<br>";
echo $tup1_regCA;
echo "<br>";
echo $tup1_regND;
echo "<br>";
echo $tup1_regCD;
echo "<br>";
echo $tup1_regNA;
echo "<br>";
//die("fin");
**/
$imagen = preg_replace('#^data:image/[^;]+;base64,#', '', $imagen); 
$mensaje = '<b>Take Up 1</b><br><b>Student name: </b>'.$tup1_regNA.'<br><b>Group: </b> '.$tup1_regGP.'<br><b>Teacher: </b>'.$tup1_regND;

$para = $tup1_regCD;
$para2 = $tup1_regCA;
$asunto = 'Take Up 1: Activity';				
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
//Agregar la imagen
$decode = base64_decode($imagen);
$mail->addStringAttachment($decode, "Activity.png", "base64", "image/png");
$mensaje .= '<br><img src="https://majesticeducacion.com.mx/nuevo/wp-content/uploads/2018/08/logo-header-majesticeducacion.png">';
 
//Configuracion servidor mail

$mail->From = "ebook@majesticeducationdigital.com"; //remitente
$mail->FromName = "Majestic Education";//nombre remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //seguridad
$mail->Host = "mail.majesticeducationdigital.com"; // servidor smtp
$mail->Port = 465; //puerto
$mail->Username ='ebook@majesticeducationdigital.com'; //nombre usuario
$mail->Password = '[;$&0?H_zuq#'; //contraseña

 
//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para2);
$mail->Subject = $asunto;
$mail->IsHTML(true);
$mail->Body = $mensaje;


 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Sent correctly");
		   window.history.back();
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("Not sent, try again");
        </script>';
}
?>