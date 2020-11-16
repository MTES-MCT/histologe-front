<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');

require '/home/histolc/www/phpmailer/src/PHPMailer.php';
require '/home/histolc/www/phpmailer/src/SMTP.php';
require '/home/histolc/www/phpmailer/src/Exception.php';

function sendSignalement($mailDemandeur, $msg, $sujet, $nom='', $prenom='', $piece='') {
    //Import the PHPMailer class into the global namespace

$t=0;
//Create a new PHPMailer instance
$mailS = new PHPMailer;
//Tell PHPMailer to use SMTP
$mailS->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off 
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mailS->SMTPDebug = SMTP::DEBUG_OFF;

$mailS->Host = 'ns0.ovh.net';
$mailS->Port = 587;
$mailS->SMTPAuth = true;
$mailS->Username = 'contact@histologe.info';
$mailS->Password = 'Testeur64';

$mailS->setFrom('contact@histologe.info', 'Histologe Signalement');
$mailS->addReplyTo('contact@histologe.info', 'Histologe Signalement');
$mailS->CharSet = 'UTF-8';

//Set who the message is to be sent to
//$mailS->addAddress($mailSign);
$mailS->addAddress($mailDemandeur);
//Set the subject line
$mailS->Subject = $sujet;
$msgComp='';
$myMsg = '';
if($piece != '') $mailS->AddAttachment($piece);

$myMsg = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour '.$prenom.' '.$nom.',<br>
'.$msg.'
<br><br>Merci de votre confiance et à très bientôt,<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
<a href="https://histologe.agglo-pau.fr/Contact">Contact</a> : contact@histologe.info [D]';

 

$mailS->msgHTML($myMsg);
//Replace the plain text body with one created manually


 
$mailS->AltBody = '';



//send the message, check for errors
if (!$mailS->send()) {
  // $t = 'Mailer Error: ' . $mailS->ErrorInfo;
  $t=0;
} else {
   $t = 1;
}
return $t;

}