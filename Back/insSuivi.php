<?php
session_start();
ini_set('display_errors',1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
 //echo "-".$_SESSION['admin'];
 //var_dump($_SESSION);
 if($_SESSION['admin']!='ok') {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
  exit;
 }
 $visiUser='off';
if($_POST['idSign']!=null) {
    $idSign = $_POST['idSign'];
    $com = $_POST['story'];
    if(isset($_POST['sendCom'])) $visiUser = $_POST['sendCom'];
    if(isset($_POST['actionSend'])) $action = $_POST['actionSend'];

} else {
    header("Location:  https://histologe.beta.gouv.fr/_adm/home.php");  
    exit;
}

require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');


// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

$part = $infosForm->getPartById($_SESSION['idPartenaire']);
$userMail =  $infosForm->getUserBO($_SESSION['userId']);


if($action=='cloture') {
    $infoC = 'L\'utilisateur '.$userMail[0]->nom_bo.' '.$userMail[0]->prenom_bo.' a cloturé le signalement pour le partenaire '.$part[0]->libPartenaire.' : <br>';
    $infosForm->addSuivi($idSign,$infoC.filtre($com),$_SESSION['user'],$_SERVER['REMOTE_ADDR'], $visiUser, $_SESSION['idPartenaire'] );
    $infosForm->updateEtatSignalement($idSign, 4 );
    $infosForm->updateEtatPartSignalement($idSign, 4 );
    //Mise à jour etat cloturé pour CE partenaire (tous les users du partenaire)
    $infosForm->updateEtatSignPartBySignalement($idSign,  $_SESSION['idPartenaire'], 4);

    $msg='Un <a href="https://histologe.beta.gouv.fr/_adm/suivi.php?id='.$idSign.'">signalement</a> a été cloturé par un partenaire sur le Back-Office !';
    sendSignalement('alban.sestiaa@beta.gouv.fr', 'Sestiaa', 'Alban', 'Cloture Signalement',  $msg);
  //  sendSignalement('vikieache@gmail.com', 'Ache', 'Vikie', 'Cloture Signalement',  $msg);
   // sendSignalement('chouaib.nounes@beta.gouv.fr', 'Nounès', 'Chouaib', 'Cloture Signalement',  $msg);

   //Vérification si tous les autres partenaires ont également cloturé -> si oui, etat=8 !
   $listEtat=$infosForm->checkSignClo($idSign);
   if(!isset($listEtat) || empty($listEtat)) {
    $infosForm->updateEtatSignalement($idSign, 8 );
    $infosForm->updateEtatPartSignalement($idSign, 8 );
    $infosForm->updateEtatSignPartBySignalement($idSign,  $_SESSION['idPartenaire'], 8);
    $msg='Un <a href="https://histologe.beta.gouv.fr/_adm/suivi.php?id='.$idSign.'">signalement</a> a été cloturé par TOUS LES partenaires sur le Back-Office !';
    sendSignalement('alban.sestiaa@beta.gouv.fr', 'Sestiaa', 'Alban', 'Cloture Signalement',  $msg);
    //sendSignalement('vikieache@gmail.com', 'Ache', 'Vikie', 'Cloture Signalement',  $msg);
    // sendSignalement('chouaib.nounes@beta.gouv.fr', 'Nounès', 'Chouaib', 'Cloture Signalement',  $msg);
   }
   

} 

if($action=='clotureAll') {
    $infoC = 'L\'utilisateur '.$userMail[0]->nom_bo.' '.$userMail[0]->prenom_bo.' [HISTOLOGE] a cloturé le signalement pour tous les partenaires : <br>';
    $infosForm->addSuivi($idSign,$infoC.filtre($com),$_SESSION['user'],$_SERVER['REMOTE_ADDR'], $visiUser, $_SESSION['idPartenaire'] );
    $infosForm->updateEtatSignalement($idSign, 8 );
    //Rajouter test sur affect existant pour ne pas écraser  
    $etatAffect = $infosForm->getEtatAffectSignAllPart($idSign);
        $x=0;
        foreach($etatAffect as $key) {
            if($etatAffect[$x]->affect == 1) {
                    $upEtat=0; 
            } else {
                $upEtat=$etatAffect[$x]->affect;
            }
            $infosForm->updateAffectPart($idSign, $upEtat, $etatAffect[$x]->idUserBO , 8);
            $x++;
        }

    

    //cloture pour tous les partenaires 
  //  $infosForm->updateEtatAllPartSignalement($idSign, $_SESSION['userId'], 8);

}


if($action=='suivi') {
    $infosForm->addSuivi($idSign,filtre($com),$_SESSION['user'],$_SERVER['REMOTE_ADDR'], $visiUser, $_SESSION['idPartenaire'] );
    $infosForm->updateEtatPartSignalement($idSign, 2);
    $msg='Un nouveau suivi a été inscrit sur un <a href="https://histologe.beta.gouv.fr/_adm/suivi.php?id='.$idSign.'">signalement</a> !';
    sendSignalement('alban.sestiaa@beta.gouv.fr', 'Sestiaa', 'Alban', 'Nouveau Suivi Signalement',  $msg);
  //  sendSignalement('vikieache@gmail.com', 'Ache', 'Vikie', 'Nouveau Suivi Signalement',  $msg);
   // sendSignalement('chouaib.nounes@beta.gouv.fr', 'Nounès', 'Chouaib', 'Nouveau Suivi Signalement',  $msg);

    
    if($visiUser == 'on') {
        //envoi message au demandeur
       
        $theSign=$infosForm->getSignById($idSign);
        $msg='Concernant votre signalement du '.$theSign[0]->theCreaDate.', une information a été ajouté : <br>'.ucfirst($com);
        sendSignalement($theSign[0]->courriel, $theSign[0]->nomSign, $theSign[0]->prenomSign, 'Information concernant votre signalement Histologe.',  $msg);
    }
} 

header("Location: suivi.php?id=".$idSign);  


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
//Set the subject line
$mailS->Subject = $title;

$myMsgComp = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour '.$nom.' '.$prenom.',
<br>'.$msg.'<br>
Merci de votre confiance,<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
<a href="https://histologe.agglo-pau.fr/Contact">Contact</a> : contact@histologe.info [D] ';

 

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