<?php 
session_start();
//ini_set('display_errors',1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');


// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

$idSign=$_POST['sign'];
$etat=$_POST['sendStep'];
$part=$_POST['idPart'];




$myMsg = '';

if($etat=='1') {
    $tit='Histologe : un signalement requiert votre attention.';
    $myMsg = 'Un signalement requiert votre attention, merci de vous connecter sur le <a href="https://histologe.beta.gouv.fr/_adm/home.php?sg='.$idSign.'">back-office Histologe</a> pour en prendre connaissance et publier un suivi.';
    $infosForm->updatePartenaire($idSign, $part, $etat);
    $nomPart=$infosForm->getPartNameById($part);
    sendSignalement($nomPart[0]->courriel, $tit, $myMsg);
    //addSuivi dernier param=1 = creation / etat =1 
    $infosForm->addSuivi($idSign,'Transmission du signalement au partenaire : '.filtre($nomPart[0]->descPartenaire.' '.$nomPart[0]->courriel),$_SESSION['user'],$_SERVER['REMOTE_ADDR'], 'off', $_SESSION['idPartenaire'], 1 );
  
    $infosForm->updateEtatSignalement($idSign, 3);
}




exit();


function sendSignalement($mailPartenaire, $title, $myMsg) {
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
$mailS->addAddress($mailPartenaire);
//Set the subject line
$mailS->Subject = $title;
$msgComp='';

//Attach document info


$myMsgComp = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour,<br>'.$myMsg.'<br>
Merci de votre confiance et à très bientôt,<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
<a href="https://histologe.agglo-pau.fr/Contact">Contact</a> : contact@histologe.info';

 

$mailS->msgHTML($myMsgComp);
//Replace the plain text body with one created manually


 
$mailS->AltBody = '';



//send the message, check for errors
if (!$mailS->send()) {
  // $t = 'Mailer Error: ' . $mailS->ErrorInfo;
  $t=1;
} else {
   $t = 1;
}
return $t;

}

function filtre($lib) {
    $val=str_replace('\'', ' ', $lib);
    $val=str_replace('"',' ',$val);
    $val = str_replace(
       array('select', 'insert', 'update'), '*', $val);
    $val = str_replace(
        array( '\\',    "\0",   "'",    "\x8" , "\n",   "\r",   "\t",   "\x1A" ),
         array( '\\\\',  '\\0',  '\\\'', '\\b',          '\\n',  '\\r',  '\\t',  '\\Z' ),
       $val);
   $val = filter_var ( $val, FILTER_SANITIZE_STRING);

   return $val;

}



function sendAlerteSignalements($nbSign) {
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
$mailS->addAddress('alban.sestiaa@beta.gouv.fr');
//Set the subject line
$mailS->Subject = 'Histologe : Alerte signalements.';
$msgComp='';
$myMsg = '';

if($nbSign==1) {$msgComp=' signalement a été nouvellement déposé ';} else 
{$msgComp=' signalements ont été déposés ';}


$myMsg = '<img src="https://histologe.agglo-pau.fr/dev/V3/img/entetemail_.png"><br><br>Bonjour,<br>
'.$nbSign.$msgComp.'sur Histologe !<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
';

 

$mailS->msgHTML($myMsg);
//Replace the plain text body with one created manually


 
$mailS->AltBody = '';



//send the message, check for errors
if (!$mailS->send()) {
   $t = 'Mailer Error: ' . $mailS->ErrorInfo;
} else {
   $t = 1;
}
return $t;

}