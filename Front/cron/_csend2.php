<?php 
ini_set('display_errors',1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');

require '/home/histolc/www/phpmailer/src/PHPMailer.php';
require '/home/histolc/www/phpmailer/src/SMTP.php';
require '/home/histolc/www/phpmailer/src/Exception.php';
require_once('/home/histolc/www/dev/V3/include/connexion.class.php');
require_once('/home/histolc/www/dev/V3/include/etats_form.class.php');

$mailDemandeur=''; $msg=''; $nom='';
// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);

//Vérifier infos complémentaires attendues des signalements créées : envoiMail=0
//: proprio = oui, type energie chauffage, photos si nb criteres >=3

//liste des signalements avec envoiMail=0 + proprio=non + nbreRelance<10 et date dernière relance = null ou >7jours (+ photos ?)
$newKO = $infosForm->checkInfosNewSignKO();
// envoi mail pour formulaire complémentaire + mise à jour nbre relance et date relance
$x=0; $aff='';

$x=0;
foreach ($newKO as $key) {
    $msgProprio='Nous avons besoin de quelques informations complémentaires pour pouvoir prendre en charge votre signalement.<br>
                    Merci de <a href="https://histologe.beta.gouv.fr/Complement?k='.$newKO[$x]->relanceKey.'">vous connecter ici</a> pour nous aider à traiter plus rapidement votre demande.<br>';
    sendCompSignalement($newKO[$x]->courriel, $newKO[$x]->nomSign.' '.$newKO[$x]->prenomSign , $msgProprio, 1);
    $infosForm->updateSignAttInfos($newKO[$x]->idSignalement);
    $x++;
}



//Liste des signalements nécessitants de connaitre le mode d'énergie de chauffage (et non déjà relancés)
$newME = $infosForm->checkInfosNewSignME();
// envoi mail pour formulaire complémentaire + mise à jour nbre relance et date relance
$x=0;
foreach ($newME as $key) {
    $msgProprio='Nous avons besoin de quelques informations complémentaires pour pouvoir prendre en charge votre signalement.<br>
                    Merci de <a href="https://histologe.beta.gouv.fr/Complement?k='.$newME[$x]->relanceKey.'">vous connecter ici</a> pour nous aider à traiter plus rapidement votre demande.<br>';
   
    sendCompSignalement($newME[$x]->courriel, $newME[$x]->nomSign.' '.$newME[$x]->prenomSign , $msgProprio, 0);
    $infosForm->updateSignAttInfos($newME[$x]->idSignalement);
    $x++;
}


//Mise à jour nouveau signalements : envoiMail=0 et proprio=oui et mode énergie ok + photos A FAIRE ! 
$infosForm->checkInfosNewSignOK();


//récupération des signalements etat envoiMail=1
$tab = $infosForm->getListMailARToSend();

$x=0; $aff='';
foreach ($tab as $key) {

        $s = sendSignalement($tab[$x]->courriel, $tab[$x]->nomSign.' '.$tab[$x]->prenomSign, $tab[$x]->proprio_info);

        if($s==0) {
            //traiter si erreur
           // echo $aff;
        } else {
            $infosForm->updateARSign($tab[$x]->idSignalement, 2);
        }
        $x++;
    }

if($x>0) sendAlerteSignalements($x);

header("Location:../../_adm/_computeScore.php");


function sendSignalement($mailDemandeur,  $nom, $proprio) {
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
//$mailS->addAddress('alban.sestiaa@beta.gouv.fr');
//Set the subject line
$mailS->Subject = 'Histologe : Accusé de réception de votre signalement.';
$msgComp='';
$myMsg = '';
//Attach document info
if($proprio=='n') {
    $mailS->addAttachment('/home/histolc/www/doc/ModeleCourrier.pdf');
    $msgComp='<br>Vous avez mentionné ne pas encore avoir alerté votre propriétaire. 
    Il est nécessaire de l\'informer de la situtaion. Vous trouverez ci-joint un modèle de courrier pour alerter votre propriétaire.';
}

$myMsg = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour '.$nom.',<br>
Nous accusons réception de votre signalement. L\'équipe Histologe va l\'étudier et reviendra vers vous dans les plus brefs délais.
'.$msgComp.'<br>
Merci de votre confiance et à très bientôt,<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
<a href="https://histologe.agglo-pau.fr/Contact">Contact</a> : contact@histologe.info [D]';

 

$mailS->msgHTML($myMsg);
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


$myMsg = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour,<br>
'.$nbSign.$msgComp.'sur Histologe !<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a> [D]<bR>
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


function sendCompSignalement($mailDemandeur, $nom, $msg, $proprio) {
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
$mailS->Subject = 'Histologe : des compléments nécessaires pour finaliser votre signalement.';
$myMsg = '';
if($proprio==1) $mailS->addAttachment('/home/histolc/www/doc/ModeleCourrier.pdf');

  


$myMsg = '<img src="https://histologe.agglo-pau.fr/img/entetemail_.png"><br><br>Bonjour '.$nom.',<br>
'.$msg.'<br>
Merci de votre confiance et à très bientôt,<br><br>
L\'équipe Histologe.<br>
<a href="https://histologe.agglo-pau.fr">Histologe.agglo-pau.fr</a><bR>
<a href="https://histologe.agglo-pau.fr/Contact">Contact</a> : contact@histologe.info [D]';

 

$mailS->msgHTML($myMsg);
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