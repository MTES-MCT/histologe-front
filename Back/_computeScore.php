<?php
 session_start();
 ini_set('display_errors',1);
 require_once('/home/histolc/www/_adm/include/connexion.class.php');
 require_once('/home/histolc/www/_adm/include/etat_formCalc.class.php');

 $idSign=$_GET['s'];


$connect = new connection();
$infosForm = new etat_formCalc($connect);
/*
Pour un signalement :
- calcul par situation d'un score / max score de la situation
- calcul total ou max des situations 
- pondération par occupants

- Danger O/N

- Enregistrement des résultats dans colonnes dédiées pour  Signalement -> script en cron journalier

*/

// 1. récupérer score max par situation
$tabScoresMax = $infosForm->getScoreMaxBySituation();
$tabNbreCritMax = $infosForm->getNbreMaxCritBySituation();
$tab = $infosForm->getSignBySituations();
$a=0;
foreach($tab as $key){

//Calcul pour savoir s'il y a des enfants ou non
$tabEnfant = $infosForm->getNombreEnfant($tab[$a]->idSignalement);
$tabDanger = $infosForm->getDanger($tab[$a]->idSignalement);


// 2. calcul du score pour chaque catégorie du signalement
$tabScoresSign = $infosForm->getScoreBySituationPourSign($tab[$a]->idSignalement);
$tabNbreCritSign = $infosForm->getNbreCritBySituationPourSign($tab[$a]->idSignalement);
// $tabOrdreCrit = $infosForm->getOrdreCriticite($idSign);
//print_r($tabScoresSign);
// echo 'valeur critique : '.$tabOrdreCrit[0]->ordreCriticite;

$x=0; $scoreMax = 0; $scoreSignalement=0; $scoreTotalSitSelected=0;
foreach($tabScoresMax as $key){
    $y=0;
    foreach($tabScoresSign as $key){
        if($tabScoresSign[$y]->idSituation_pb ==$tabScoresMax[$x]->idSituation_pb) {
            echo 'Signalement : '.$tab[$a]->idSignalement . ' -> somme : '.$tabScoresSign[$y]->ScoreSitSign . '/' . $tabScoresMax[$x]->scoreMaxSit
            .' pour '.$tabScoresMax[$x]->libSituation.'<br>';
            $scoreSignalement = $scoreSignalement+$tabScoresSign[$y]->ScoreSitSign;
            $scoreTotalSitSelected = $scoreTotalSitSelected+$tabScoresMax[$x]->scoreMaxSit;
            //Intégrer dans ce calcul la pondération en fonction du smiley sélectionné [par défaut=1]
        }
    $y++;
}
$scoreMax = $scoreMax + $tabScoresMax[$x]->scoreMaxSit;
$x++;
}


$x=0; $nbreMax = 0; $nbreCritSign=0; $nbreTotalCritSit=0; $sitSelect=0;
foreach($tabNbreCritMax as $key){
    $y=0;
    foreach($tabNbreCritSign as $key){
      if($tabNbreCritSign[$y]->idSituation_pb ==$tabNbreCritMax[$x]->idSituation_pb) {
         echo  'Signalement : '.$tab[$a]->idSignalement . ' -> Nbre Crit selectionnés '. $tabNbreCritSign[$y]->nbreCritSign .' / '. $tabNbreCritMax[$x]->nbreMaxCritBySit.
          ' sur '. $tabNbreCritMax[$x]->libSituation.'<br>';
        $totalCritSign = $totalCritSign + $tabNbreCritSign[$y]->nbreCritSign;
        $totalCritSituations = $totalCritSituations + $tabNbreCritMax[$x]->nbreMaxCritBySit;
        $sitSelect++;
        }
    $y++;
}

$nbreMax = $nbreMax + $tabNbreCritMax[$x]->nbreMaxCritBySit;
$x++;
}


echo '<b>Score Signalement sur Situations concernées : '. $scoreSignalement .'/' . $scoreTotalSitSelected . '=' . round(($scoreSignalement/$scoreTotalSitSelected),2);
echo'</b><br>';

echo 'Total score possible = ' . $scoreMax;
echo '<br><b>Score sur toutes situations possibles : ' . $scoreSignalement .'/' .$scoreMax. '=' . round(($scoreSignalement/$scoreMax),2).'</b>';

//Faut-il tenir compte du nombre de critères sélectionnés ?
echo '<br><br>';
echo 'Nbre de critères sélectionnés : ' . $totalCritSign . ' sur '.$totalCritSituations. ' possibles (dans '.$sitSelect.' Situations) et '.$nbreMax.' au maximum.';

echo '<br><br>';
$t=0;
  foreach($tabEnfant as $element){
    if($tabEnfant[$t]->OccupantsEnfants!=0){
    $ChangementDanger = $infosForm->updateDanger($tab[$a]->idSignalement,round(($scoreSignalement/$scoreMax),2),round(($scoreSignalement/$scoreTotalSitSelected),2),round(($scoreSignalement/$scoreMax),2)*1.1);
    $td = '<b>Il y a au moins 1 enfant dans le logement</b>';
  }
  else{
    $ChangementDanger = $infosForm->updateDanger($tab[$a]->idSignalement,round(($scoreSignalement/$scoreMax),2),round(($scoreSignalement/$scoreTotalSitSelected),2),round(($scoreSignalement/$scoreMax),2));
    $td = 'Pas d\'enfant dans le logement';
  }
  $t++;
}
$m=0;

foreach($tabDanger as $keyy){
  if($tabDanger[$m]->danger!=0){
    $danger = '<b>Il y a un critère dangereux</b>';
    $ChangementDangerSignalement = $infosForm->updateDangerSignalement($tab[$a]->idSignalement);
  }
  else{
    $danger = 'Pas de critère dangereux';
  }
$m++;
}
print_r($td);
echo '<br>';
print_r($danger);
//Enregistrer les notes dans _HSignalement_ (pour affichage dans main.php)
/*
Si score >0.6 sur situations concernées : ALERTE
Si score >0.6 sur score max possible : ALERTE

*/
$a++;
echo '<br><br><br>';
}
