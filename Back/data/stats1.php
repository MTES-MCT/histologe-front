<?php 
session_start();
 


ini_set('display_errors',1);
require_once('../include/connexion.class.php');
require_once('../include/etat_formCalc.class.php');
// préparation connexion
$connect = new connection();
$infosForm = new etat_formCalc($connect);
$list = $infosForm->getNbreSignByMonths();
$x=0;$nb=0;
//echo 'Date,Signalements,Clotures<br>';
$fichier = fopen('stats1.csv', 'w+');
fwrite($fichier, 'Date,Signalements,Clotures'.PHP_EOL);

foreach($list as $key) {
    $nb += $list[$x]->nb;
    $clo=$infosForm->getNbreSignClotureForMonth($list[$x]->moisCrea);
    $clot += $clo[0]->nbC;
    //echo $list[$x]->moisCrea.','.$nb.','.$clot.'<br>';
    fwrite($fichier, $list[$x]->moisCrea.','.$nb.','.$clot.PHP_EOL);
    $x++;
}
fclose($fichier);
?>