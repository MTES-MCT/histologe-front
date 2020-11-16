<?php 
ini_set('display_errors',1);
setlocale (LC_TIME, 'fr_FR.utf8','fra');

require_once('/home/histolc/www/dev/V3/include/connexion.class.php');
require_once('/home/histolc/www/dev/_adm/include/etats_formAdm.class.php');
require_once('/home/histolc/www/dev/V3/include/func.php');


// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

//Si existe un suivi de plus de 10 jours et etat non cloturé (existe un suivi si HSign_HPart.etat = 3 ): relance 
$tab3 = $infosForm->getListPartenairePourRelance(3, 10);
$x=0;
$test2 = date('Y-m-d', strtotime($jour. ' - 10 days'));
echo ('date de référence : '.$test2.'<br><br>');
$aff='<br><br>';
$t=0; $sign=array();
foreach($tab3 as $key){
    // //vérifier si existe suivi d'un user appartenant au partenaire et si suivi < 15js
    $tab4=$infosForm->getListSuivisBySignPart($tab3[$x]->idSignalement);
    echo ('Signalement : '. $tab3[$x]->idSignalement. ' pour ' . $tab3[$x]->idUserBO.'<br>');
    if(!empty($tab4)){
      echo('Signalement : '.$tab3[$x]->idSignalement.' dernier suivi : '.$tab4[0]->dtSuivi.' par '.$tab4[0]->user.'('.$tab4[0]->idPartenaire.')<bR>');
          if(date("Y-m-d",strtotime($tab4[0]->dtSuivi)) < $test2) {
        //Passage état "A REVOIR" pour tout les partenaires affectés
          echo('Signalement A RELANCER ? : '.$tab3[$x]->idSignalement.' dernier suivi : '.$tab4[0]->dtSuivi.' par '.$tab4[0]->user.'('.$tab4[0]->idPartenaire.')<bR>');
          $u=0; $e=0;
          foreach($sign as $key) {
            if($sign[$u]->sign==$tab3[$x]->idSignalement) $e=1;
            $u++;
          }
          if($e==0) {
            echo 'ADD : '.$t;
            $sign[$t]->sign=$tab3[$x]->idSignalement;
            $sign[$t]->user=$tab3[$x]->idUserBO;
            $t++;
          }
         
      }
    } 
  $x++;
} 
//relancer tous les partenaires associés à ce signalement (qui ont HSign_HPart.etat=3 car si =1 déjà relancés)
echo '<br><br>Signalement A RELANCER : <br>';
$x=0; $destinataires = array();
foreach($sign as $key) {
  $exist=0;$d=0;
  foreach($destinataires as $val) {
    if($destinataires[$d]==$sign[$x]->user) $exist=1;
    $d++;
  }
  if($exist==0) $destinataires[$x] = $sign[$x]->user;


  $users = $infosForm->getSignalementPourRelanceManqueSuivi($sign[$x]->sign);
  
  $y=0;
  foreach($users as $key) {
    $infosForm->addTraceMail('relancePartenaire',$users[$y]->courriel,'HistologeCron','Relance pour suivi de Signalement 15 jours',$sign[$x]->sign);
    //$infosForm->updateRelance($sign[$x]->sign, $users[$y]->id_userbo);
    // echo $sign[$x]->sign.' pour user : '.$sign[$x]->user.'<br>';
    $infosForm->updateEtatPartSignalement($sign[$x]->sign, 3);
     $y++;
  }

 
  


$x++;
}
//Préparation et tri du tableau de destinataires et signalements à relancer 
$y=0;
foreach($sign as $k ){
  $userid[$y] = $sign[$y]->user;
  $signid[$y] = $sign[$y]->sign;
  $y++;
}
array_multisort($userid,SORT_ASC,$signid,SORT_ASC,$sign);
$a=0;
foreach($sign as $key) {
  echo $sign[$a]->user.'<br>';
  $a++;
}

//Traitement et envoi messages 

$x=0; $userCurrent = '';
echo '<br>';
foreach($sign as $key) {
  if($userCurrent != $sign[$x]->user) {
   if($x>0) {
     echo '<br>Envoi mail à '.$mailUser.'['.$idUser.'] pour les signalements : '.$signList.'<br>';
     $s=explode('|',$signList);
      $c=0; $lien='<ul>';
     foreach($s as $key) {
       $detailsSign=$infosForm->getSignById($s[$c]);
       $lien.='<li><a href="https://histologe.beta.gouv.fr/_adm/home.php?sg='.$s[$c].'">Signalement #64-'.$detailsSign[0]->refSign.'</a></li>';
       $c++;
     }
     $lien.='</ul>';
     $msg='Nous avons remarqué que vous n\'aviez pas proposé de suivi depuis 2 semaines les '.count($s).' signalements Histologe suivants :
     '.$lien.'.<br>Si vous avez connaissance d\'évolutions de ce dossier, merci de bien vouloir s\'il vous plait,
     l\'indiquer en cliquant sur le signalement ou en vous connectant sur Histologe 
     (<a href="https://histologe.beta.gouv.fr/_adm/home.php">en cliquant ici</a>).
     <br>
     ';
    if(count($s)==1) {
        $msg='Nous avons remarqué que vous n\'aviez pas proposé de suivi depuis 2 semaines le signalement Histologe suivant :
        '.$lien.'.<br>Si vous avez connaissance d\'évolutions de ce dossier, merci de bien vouloir s\'il vous plait,
        l\'indiquer en cliquant sur le signalement ou en vous connectant sur Histologe 
        (<a href="https://histologe.beta.gouv.fr/_adm/home.php">en cliquant ici</a>).
        <br>
        ';
    }   
  //  sendSignalement($mailUser, $msg, 'Histologe : Signalement(s) en attente.', $nomUser, $prenomUser);
     
   }
    $infosUser=$infosForm->getUserBO($sign[$x]->user);
    $mailUser=$infosUser[0]->courriel;
    $nomUser=$infosUser[0]->nom_bo;
    $prenomUser=$infosUser[0]->prenom_bo;
    $idUser=$sign[$x]->user;
    $signList=$sign[$x]->sign;
    } else {
    $signList=$signList.'|'.$sign[$x]->sign;
  }
  $userCurrent = $sign[$x]->user;
   
  $x++;
}
echo '<br>Envoi mail à '.$mailUser.'['.$idUser.'] pour les signalements : '.$signList.'<br>';

$s=explode('|',$signList);
$c=0; $lien='<ul>';
foreach($s as $key) {
 $detailsSign=$infosForm->getSignById($s[$c]);
 $lien.='<li><a href="https://histologe.beta.gouv.fr/_adm/home.php?sg='.$s[$c].'">Signalement #64-'.$detailsSign[0]->refSign.'</a></li>';
 $c++;
}
$lien.='</ul>';

echo $lien.'<br>';
$msg='Nous avons remarqué que vous n\'aviez pas proposé de suivi depuis 2 semaines les '.count($s).' signalements Histologe suivants :
'.$lien.'.<br>Si vous avez connaissance d\'évolutions de ce dossier, merci de bien vouloir s\'il vous plait,
l\'indiquer en cliquant sur le signalement ou en vous connectant sur Histologe 
(<a href="https://histologe.beta.gouv.fr/_adm/home.php">en cliquant ici</a>).
<br>
';
if(count($s)==1) {
    $msg='Nous avons remarqué que vous n\'aviez pas proposé de suivi depuis 2 semaines le signalement Histologe suivant :
    '.$lien.'.<br>Si vous avez connaissance d\'évolutions de ce dossier, merci de bien vouloir s\'il vous plait,
    l\'indiquer en cliquant sur le signalement ou en vous connectant sur Histologe 
    (<a href="https://histologe.beta.gouv.fr/_adm/home.php">en cliquant ici</a>).
    <br>
    ';
} 
//sendSignalement($mailUser, $msg, 'Histologe : Signalement(s) en attente.', $nomUser, $prenomUser);





