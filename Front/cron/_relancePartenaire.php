<?php 
ini_set('display_errors',1);
setlocale (LC_TIME, 'fr_FR.utf8','fra');

require_once('/home/histolc/www/dev/V3/include/connexion.class.php');
require_once('/home/histolc/www/dev/_adm/include/etats_formAdm.class.php');
require_once('/home/histolc/www/dev/V3/include/func.php');


// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

//1. lister les signalements affectés à un partenaire dont HSign_HPart.etat = 1
$tab1 = $infosForm->getListPartenairePourRelance(1);
//2. pour chaque 1, vérifier les suivis fait sur ces signalements par le ou les partenaires affectés
$x=0;
$jour = date("Y-m-d");
$test = date('Y-m-d', strtotime($jour. ' - 3 days'));

foreach($tab1 as $key){
    //si dtRelance a plus de trois jour : relance + mise à jour dtRelance = now()
  
  

    if(date("Y-m-d",strtotime($tab1[$x]->dtRelance)) < $test) {
      //envoi mail relance
      //trace envoi
      $infosForm->addTraceMail('relancePartenaire',$tab1[$x]->idUserBO,'HistologeCron','Relance pour suivi de Signalement', $tab1[$x]->idSignalement);
      $infosForm->updateRelance($tab1[$x]->idSignalement, $tab1[$x]->idUserBO);
      $tab2 = $infosForm->getPartNameById($tab1[$x]->idUserBO);  

      $msg='Nous avons remarqué que vous n\'aviez pas encore proposé de suivi pour le signalement Histologe 
      transmis le '.strftime('%d %B %Y',strtotime($tab1[$x]->dtAlert)).'.<br>Merci de bien vouloir s\'il vous plait,
       vous connecter sur Histologe (<a href="https://histologe.beta.gouv.fr/_adm/home.php?sg='.$tab1[$x]->idSignalement.'">en cliquant ici</a>) 
       et nous tenir informé des suites données au signalement de ce locataire en difficulté.';
  

      //echo(sendSignalement($tab2[0]->courriel, $msg, 'Histologe : un signalement vous attend.', $tab2[0]->nom_bo, $tab2[0]->prenom_bo));
        
    }
    $x++;
}

//Si existe un suivi de plus de 15 jours et etat non cloturé (existe un suivi si HSign_HPart.etat = 3 ): relance 
$tab3 = $infosForm->getListPartenairePourRelance(3, 10);
$x=0;
$test2 = date('Y-m-d', strtotime($jour. ' - 10 days'));
echo ('date de référence : '.$test2.'<br><br>');
$aff='<br><br>';
$t=0; $sign;
foreach($tab3 as $key){
    // //vérifier si existe suivi d'un user appartenant au partenaire et si suivi < 15js
    $tab4=$infosForm->getListSuivisBySignPart($tab3[$x]->idSignalement, $tab3[$x]->idUserBO);
    echo ('Signalement : '. $tab3[$x]->idSignalement. ' pour ' . $tab3[$x]->idUserBO.'<br>');
    if(!empty($tab4)){
      echo('Signalement : '.$tab3[$x]->idSignalement.' dernier suivi : '.$tab4[0]->dtSuivi.' par '.$tab4[0]->user.'('.$tab4[0]->idPartenaire.')<bR>');
          if(date("Y-m-d",strtotime($tab4[0]->dtSuivi)) < $test2) {
        //envoi alerte aux users de ce partenaire associé au signalement// mise à jour dtRelance
            // A FAIRE : selection des bons destinataires et tracage
          echo('Signalement A RELANCER ? : '.$tab3[$x]->idSignalement.' dernier suivi : '.$tab4[0]->dtSuivi.' par '.$tab4[0]->user.'('.$tab4[0]->idPartenaire.')<bR>');
          $u=0; $e=0;
          foreach($sign as $key) {
            if($sign[$u]->sign==$tab3[$x]->idSignalement) $e=1;
            $u++;
          }
          if($e==0) {
            echo 'ADD : '.$t;
          $sign[$t]->sign=$tab3[$x]->idSignalement;
            $t++;
          }
         
      }
    } 
  $x++;
} 
//relancer tous les partenaires associés à ce signalement (qui ont HSign_HPart.etat=3 car si =1 déjà relancés)
echo '<br><br>Signalement A RELANCER : <br>';
$x=0; 
foreach($sign as $key) {
  echo $sign[$x]->sign.'/'.$x.'/<br>';
  $users = $infosForm->getSignalementPourRelanceManqueSuivi($sign[$x]->sign);
  $y=0;
  foreach($users as $key) {
    $infosForm->addTraceMail('relancePartenaire',$users[$y]->courriel,'HistologeCron','Relance pour suivi de Signalement 15 jours',$sign[$x]->sign);
    //$infosForm->updateRelance($sign[$x]->sign, $users[$y]->id_userbo);
    
    $msg='Nous avons remarqué que vous n\'aviez pas proposé de suivi depuis un certain temps pour le signalement Histologe 
    référence #'.$users[$y]->refSign.'.<br>Si vous avez connaissance d\'évolutions de ce dossier, merci de bien vouloir s\'il vous plait,
     l\'indiquer en vous connectant sur Histologe (<a href="https://histologe.beta.gouv.fr/_adm/home.php?sg='.$sign[$x]->sign.'">en cliquant ici</a>).
     <bR>Dans le cas contraire, ne tenez pas compte de cette alerte.
     ';


   // echo(sendSignalement('alban.sestiaa@beta.gouv.fr', $msg, 'Histologe : Avez-vous des nouvelles de ce signalement.',$users[$y]->nom_bo, $users[$y]->prenom_bo));
    $y++;
  }
 
  


$x++;
}



