<?php
session_start();
//ini_set('display_errors',1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

 if($_SESSION['admin']!='ok') {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
  exit;
 }

    $action=$_POST['action'];
    $geo=$_POST['geol'];
    if(isset($_POST['signid'])) $idSign=$_POST['signid'];
    if(isset($_POST['signId'])) $idSign=$_POST['signId'];
    
    $note=$_POST['note'];
    $user=$_POST['user'];

    $raison=$_POST['r'];


require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');



// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

$p=$infosForm->getPartById($_SESSION['idPartenaire']);

if($action=='geo') $tab1=$infosForm->updategeolocSign($geo, $idSign);
if($action=='note') $tab1=$infosForm->updateNoteSign($note, $idSign);
if($action=='charge') {
    $tab1=$infosForm->updateChargeSign($user, $idSign);
    //message vers demandeur
    $title='Histologe : Suivi de votre signalement.';
    $msg1='Votre signalement a été pris en charge par l\'équipe Histologe. 
    Nous mettons tout en œuvre pour trouver une solution auprès de nos partenaires.<br>
    Vous serez rapidement recontacté(e).
    ';
    $tab=$infosForm->getSignAdrById($idSign);

    sendSignalement($tab[0]->courriel, $tab[0]->nomSign, $tab[0]->prenomSign, $title, $msg1);
}

if($action=='suppr') $tab1=$infosForm->deleteSign($idSign);
echo $tab1;


if($action=='affectOk') {
    //Mise à jour etatPart de HSignalement_
    $infosForm->updateEtatPartSignalement($idSign, 2);

    // vérif si signalement affecté à ce user,
    $tab2=$infosForm->getSignByUserBo($idSign, $user);
    
    if(isset($tab2) && !empty($tab2)) {
        // si oui : update HSign_HPart affect=2=ok, etat=3=suivi ok
        $infosForm->updateAffectPart($idSign, 2, $user, 3);
        

    } else {
        // si non : insert HSign_HPart
        $infosForm->addAffectSignPart($idSign, 2, $user);
        $infosForm->updateAffectPart($idSign, 2, $user, 3);
    }
   
    $infosForm->addSuivi($idSign,'Le partenaire '.$p[0]->libPartenaire.' a accepté de traiter le signalement',$_SESSION['user'],$_SERVER['REMOTE_ADDR'], 'off', $_SESSION['idPartenaire'], 3 );
    
}

if($action=='affectKo') {
    //Mise à jour etatPart de HSignalement_
    $infosForm->updateEtatPartSignalement($idSign, 5);

    // vérif si signalement affecté à ce user,
    $tab2=$infosForm->getSignByUserBo($idSign, $user);
    
    if(isset($tab2) && !empty($tab2)) {
        // si oui : update HSign_HPart
        $infosForm->updateAffectPart($idSign, 3, $user,5);
    } else {
        // si non : insert HSign_HPart et update groupe partenaire
        $infosForm->addAffectSignPart($idSign, 3, $user);
        $infosForm->updateAffectPart($idSign, 3, $user,5);
    }
    $infosForm->addSuivi($idSign,'Le partenaire '.$p[0]->libPartenaire.' ne peut pas traiter le signalement : '.$raison,$_SESSION['user'],$_SERVER['REMOTE_ADDR'], 'off', $_SESSION['idPartenaire'], 5);
    
}


function sendSignalement($mailDestinataire, $nom, $prenom, $title,  $msg) {
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
$mailS->addAddress($mailDestinataire);
$mailS->addBCC('alban.sestiaa@beta.gouv.fr');
//Set the subject line
$mailS->Subject = $title;

$myMsgComp = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour '.$nom.' '.$prenom.',
<br>'.$msg.'<br>
Merci de votre confiance et à très bientôt,<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
<a href="https://histologe.agglo-pau.fr/Contact">Contact</a> : contact@histologe.info [D]';

 

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

?>