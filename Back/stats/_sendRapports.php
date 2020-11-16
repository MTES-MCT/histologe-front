<html>

<?php
ini_set('display_errors',1);
require_once('../include/connexion.class.php');
require_once('../include/etat_formCalc.class.php');
require_once('/home/histolc/www/dev/V3/include/func.php');
	
// préparation connexion
$connect = new connection();
$infosForm = new etat_formCalc($connect);

$listPart=$infosForm->getListPartenaires();

$x=0; 
foreach($listPart as $key) {
   // echo '_rapportPDF_.php?p='.$listPart[$x]->idHPartenaire.'<br>';
     echo $x.'.<iframe width="1" height="1" src="_rapportPDF_.php?p='.$listPart[$x]->idHPartenaire.'"></iframe><br>';
   $x++;
}

//Récupérer les emails valables pour envoi, grouper par partenaire
$x=0; 
foreach($listPart as $key) {
    $mails = $infosForm->getUsersForRapport($listPart[$x]->idHPartenaire);
    $pieceJointe = '/home/histolc/www/dev/_adm/stats/rapports/Rapport_hebdo_Histologe_P'.$listPart[$x]->libPartenaire.'.pdf';
    $msg = 'Veuillez trouver ci-joint une synthèse des dernières activités sur la plateforme Histologe en relation avec les signalements que vous avez accepté de suivre.';
   // echo $pieceJointe.'<br>';
   $y=0;
   foreach($mails as $key) {
        sendSignalement($mails[$y]->courriel, $msg, 'Histologe : votre rapport hebdomadaire.', $mails[$y]->nom_bo, $mails[$y]->prenom_bo, $pieceJointe);
        $y++;
   }
    $x++;
}
//Envois 

?>
</html>