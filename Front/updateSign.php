<?php
 session_start();
 if(isset($_POST['action'])) {
    $action=$_POST['action'];
} else {
    header("Location: https://histologe.beta.gouv.fr");  
    exit;
}
 

    $idSign=$_POST['signId'];
    $modeInfoProprio = $_POST['mode'];
    $dtInfo = $_POST['dt'];
    $modeNrj = $_POST['modeNrj'];
    $dateRdv = $_POST['dt'];
    $heureRdv = $_POST['heure'];
   


   
require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');
require_once('include/func.php');




// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);


if($action=='proprio') {
    $infosForm->updateSignalement('proprio_info', $idSign, 'o', $modeInfoProprio, $dtInfo );
    $infosForm->addSuivi($idSign,'Le demandeur certifie avoir averti son propriétaire.', 'Demandeur', $_SERVER['REMOTE_ADDR'], 'off',0,0 );
}
if($action=='proprioKO') {
    $infosForm->updateSignalement('proprio_info', $idSign, 'n');
    $infosForm->addSuivi($idSign,'Le demandeur annule avoir certifié averti son propriétaire.', 'Demandeur', $_SERVER['REMOTE_ADDR'], 'off',0,0 );
}

if($action=='nrj') {
    $infosForm->updateSignalement('infoNrj',$idSign,$modeNrj);
    $infosForm->addSuivi($idSign,'Le demandeur a renseigné son mode énergie.', 'Demandeur', $_SERVER['REMOTE_ADDR'], 'off',0,0 );
}

if($action=='rdv') {
    $_SESSION['rdv']='ok';
    $infosForm->addRdv($idSign,$dateRdv,$heureRdv);
    $infosForm->updateSignalement('ddeVisitDist', $idSign, 2);
    $infosForm->addSuivi($idSign,'Le demandeur a proposé un créneau pour une visite à distance.', 'Demandeur', $_SERVER['REMOTE_ADDR'], 'off',0,0 );
    $sign=$infosForm->getSignById($idSign);$mail=$infosForm->getUserBoById($sign[0]->idUserBoVisit);
    $msg='Un locataire a répondu à votre proposition de visite à distance.
     <a href="https://histologe.beta.gouv.fr/_adm/home.php?sg='.$idSign.'">Cliquez ici</a> pour voir le créneau demandé et pensez à lui envoyer lui une invitation Teams!';
    sendSignalement($mail[0]->courriel, $msg, 'Histologe : Demande de visite à distance.', $mail[0]->nom_bo, $mail[0]->prenom_bo);

}

if($action=='propVisit') {
    
    $infosForm->updateSignalement('ddeVisitDist', $idSign, 1);
    $infosForm->updateSignalement('dtCreaDdeVisit', $idSign, date("Y-m-d"));
    $infosForm->updateSignalement('idUserBoVisit',  $idSign, $_SESSION['userId']);
    $infosForm->addSuivi($idSign,'Proposition d\'une visite à distance.', $_SESSION['user'], $_SERVER['REMOTE_ADDR'], 'off',0,$_SESSION['idPartenaire'] );
    $tab=$infosForm->getSignById($idSign);

    $msg='Afin d’évaluer au mieux votre signalement, l’équipe Histologe vous propose de réaliser une visite à distance de votre logement.<br>
    
     <b><a href="https://histologe.beta.gouv.fr/_priseRdvVisit.php?k='.$tab[0]->relanceKey.'">Cliquez ici</a> pour choisir un créneau de visite.</b><br><br>
     Cette visite n’est pas obligatoire, elle est avant tout basée sur votre consentement.<br><br>
     La visite à distance intervient en amont d’une éventuelle visite physique et permettra de réaliser les premières constatations.<br>
     <b>Histologe ne conserve aucun enregistrement audio ou vidéo issue de cette visite.</b><br><br>
    La visite à distance va se réaliser via Teams. L’outil est gratuit, sans création de compte utilisateur, il vous suffira de cliquer sur le lien que nos équipes vont vous fournir et d’installer l’application sur votre smartphone ou tablette, rien de plus simple, nous vous guiderons si besoin. <br><br>
    Une question ou besoin de plus d\'informations ? Vous pouvez nous contacter au 06.23.04.33.73.';


    
     sendSignalement($tab[0]->courriel, $msg, 'Histologe : proposition de visite à distance.', $tab[0]->nomSign, $tab[0]->prenomSign);

}


if($action=='invitTeams') {
    
    $infosForm->updateSignalement('ddeVisitDist', $idSign, 3);
    $infosForm->addSuivi($idSign,'Invitation Teams transmise pour visite à distance', $_SESSION['user'], $_SERVER['REMOTE_ADDR'], 'off',0,$_SESSION['idPartenaire'] );
}


if($action=='visitOk') {
    
    $infosForm->updateSignalement('ddeVisitDist', $idSign, 4);
    $infosForm->addSuivi($idSign,'Visite à distance réalisée.', $_SESSION['user'], $_SERVER['REMOTE_ADDR'], 'off',0,$_SESSION['idPartenaire'] );
}
