<?php
session_start();
ini_set('display_errors',1);

    
    $mail=$_POST['user'];
    $action=$_POST['act'];
    $pws=$_POST['pws'];
   

require_once('../include/connexion.class.php');
require_once('../include/etats_formAdm.class.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';
// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
$t=0;
echo $action;
if($action=='mail') {
    $tab=$infosForm->checkMail4BO($mail);
    if($tab[0]->courriel==$mail) {
        $_SESSION['mail_user']=$mail;
        $t=1;
        header("Location: home_first2.php");
    } else {
        $_SESSION['msg_erreur']='Cette adresse n\'est pas reconnue ou déjà utilisée.';
        $t=1;
        sendSignalement($mail);
        header("Location: home_first.php");
    }
}

if($action=='pws') {
        $user = $infosForm->setPwsUserBO($_SESSION['mail_user'], $pws);
        $t=1;
        $_SESSION['user'] = $user[0]->nom_bo.' '.$user[0]->prenom_bo;
        $_SESSION['admin']='ok';
        sendSignalement2($_SESSION['mail_user']);
        header("Location: ../main.php");
}

//if($t==0)  header("Location: https://histologe.beta.gouv.fr");



function sendSignalement($mailIn) {
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
$mailS->addReplyTo('NE PAS REPONDRE PAR COURRIEL', 'Histologe Signalement');
$mailS->CharSet = 'UTF-8';

//Set who the message is to be sent to
//$mailDestinataire
$mailS->addAddress('alban.sestiaa@beta.gouv.fr');
//Set the subject line
$mailS->Subject = 'HISTOLOGE : erreur first identification';

$myMsgComp = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour,
<br>l\'adresse :'.$mailIn.' a essayé de se connecter pour la première fois sans succès.<br>
<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
<a href="https://histologe.agglo-pau.fr/Contact">Contact</a> : contact@histologe.info [DEV] ';

 

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

function sendSignalement2($mailDest) {
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
$mailS->addReplyTo('NE PAS REPONDRE PAR COURRIEL', 'Histologe Signalement');
$mailS->CharSet = 'UTF-8';

//Set who the message is to be sent to
//$mailDestinataire
$mailS->addAddress($mailDest);
//Set the subject line
$mailS->Subject = 'HISTOLOGE : Activation de votre compte de Back-Office.';

$myMsgComp = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour,
<br>Merci d\'avoir activé votre compte Histologe.<br>
Vous pouvez maintenant utliser le back-office à tout moment en vous connectant ici : <a href="https://histologe.beta.gouv.fr/_adm/home.php">https://histologe.beta.gouv.fr/_adm/home.php</a>.
<br><br>
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

    