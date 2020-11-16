<?php
 session_start();
 //echo "-".$_SESSION['admin'];
 //var_dump($_SESSION);
 ini_set('display_errors',1);
 if($_SESSION['admin']!='ok') {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
  exit;
 }
 if($_SESSION['idPartenaire']!='10') {
  header("Location: mainPart.php");
  exit;
 }

 date_default_timezone_set('Europe/Paris');
$s=0; $p=0;$e=0;
$filtre='';

if(isset($_SESSION['part'])) {
  $partenaire = $_SESSION['part'];
  $p=1;
 } 
if(isset($_GET['p'])) {
  if($_GET['p']=='n') {
      unset($_SESSION['part']);
      $p=0;
      } else {
        $_SESSION['part'] = $_SESSION['idPartenaire'];
        $partenaire=$_SESSION['part'];
        $p=1;
        }
 }


 if($p==0) $partenaire='%';
 if($p==1) $filtre='Vos signalements';

 if(isset($_SESSION['ville'])) {
  $villeSelect = $_SESSION['ville'];
  $s=1;
 } 
 if(isset($_GET['s'])) {
  $_SESSION['ville'] = $_GET['s'];
  $villeSelect=$_SESSION['ville'];
  $s=1;
 }
 if($s==0) $villeSelect='%';
 if($villeSelect!='%') $filtre=$filtre.' + Ville';
 
 if(isset($_SESSION['etat'])) {
  $etat = $_SESSION['etat'];
  $e=1;
 } 
 if(isset($_GET['e'])) {
  $_SESSION['etat'] = $_GET['e'];
  $etat=$_SESSION['etat'];
  $e=1;
 }
 if($e==0) $etat='%';

 $search='';
 if(isset($_GET['search'])) {
  $search = $_GET['search'];
  $filtre=$filtre.' + '.$search;
 }
 

 if(isset($_GET['r'])) {
  $etat='%';
  $villeSelect='%';
  $partenaire='%';
  $filtre='';
  unset($_SESSION['part']);
  unset($_SESSION['etat']);
  unset($_SESSION['situation']);

  }

  

  if($etat!='%') {
   if($etat==0) $filtre=$filtre.' + Signalements en attente.';
   if($etat==1) $filtre=$filtre.' + Nouveaux signalements.';
   if($etat==2) $filtre=$filtre.' + Signalements à transmettre (pour Histologe).';
   if($etat==3) $filtre=$filtre.' + Signalements transmis à un ou plusieurs partenaires.';
   if($etat==4) $filtre=$filtre.' + Signalements cloturés.';

 }

 

require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
$infosForm->traceUser($_SESSION['user'], 'Page Main');


$showNews = '';
$news=$infosForm->getNewsUser($_SESSION['userId']);
if( $news[0]->showNews == 0) {
            $showNews = '<script>
            function termsUse() {

              if (localStorage.getItem( \'infoNews_\' ) === \'true\' ) {
                  //el.style.display = \'none\';
              } else {

              var el = document.getElementById( \'infoNews\' );
              var cmd = el.querySelectorAll( \'button\' )[0];
              $(\'#infoNews\').modal(\'show\');
              cmd.onclick = function(){
                  localStorage.setItem( \'infoNews_\', \'true\' );
                  $(\'#infoNews\').modal(\'hide\');
                    var datastring = \'userId='.$_SESSION['userId'].'&action=view\';
                    $.ajax({
                                    type: "POST",
                                    url:"updateUser.php",
                                    data:datastring,
                            });
                };
              }

            }
            termsUse();
            </script>
            ';
          }


$stBy = count($infosForm->getSignBySituations('%', '%', 0)); 
$new = count($infosForm->getSignBySituations('%', '%', 1)); 
$attente = count($infosForm->getSignBySituations('%', '%', 2)); 
$transmis = count($infosForm->getSignBySituations('%', '%', 3)); 
$ferme = count($infosForm->getSignBySituations('%', '%', 8)); 
$totSign=($stBy+$new+$attente+$transmis+$ferme);


$tab2=$infosForm->getlistVilles();
$x=0; $coche='';
if($partenaire!='%') $coche='checked';
$selectVilles='<div class="form-group text-right">
<input type="checkbox" id="selectPart" '.$coche.' > Voir uniquement mes signalements || 
<label for="selectSit">Filtrer par Ville : </label>
<select class="form-control-sm" id="selectSit" onChange="changeSit();"><option value="%" disabled selected>Choisir...</option>';
foreach($tab2 as $key){
  $selected='';
  if($villeSelect==$tab2[$x]->ville) $selected='selected';
  $selectVilles=$selectVilles.'<option value="'.$tab2[$x]->ville.'" '.$selected.'>'.$tab2[$x]->ville.'</option>';
  $x++;
  }
  $selectVilles=$selectVilles.'<option value="%">Toutes</option></select></div>';
  if($filtre!='') {
    $suppr = '<a href="main.php?r=1"><img src="images/suppr_f.png" width=20 heigth=20></a>';
  } else {
    $suppr = '/';
  }
  $selectVilles=$selectVilles.'<br>Filtres activés : '.$filtre.' '.$suppr;
?>


<!doctype html>
<html lang="fr"><head> 
<title>Back-Office Histologe, un service public pour les locataires et les propriétaires</title>
<link href="css/styleAdm.css" rel="stylesheet" media="all">	
<meta charset="utf-8">
</head>

<body>

<div id="infoNews" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center">
    <br><b>&nbsp;&nbsp;Dernières corrections et nouveautés du Back Office.</b><br>
    </div>
    <div class="modal-content">
      <ul>
        <li><font size=2>10/2020 : Filtre par Ville disponible</font></li>
        <li><font size=2>10/2020 : Tri par Ville disponible</font></li>
        <li><font size=2>10/2020 : Activation du champ de recherche</font></li>
        <li><font size=2>10/2020 : Correction des compteurs</font></li>
        <li><font size=2>10/2020 : Ajout colonne Affecté à</font></li>
        <li><font size=2>10/2020 : Ajout du test signalement accepté ou refusé avant ajout de suivi</font></li>
        <li><font size=2>10/2020 : Chaque partenaire peut cloturer le signalement indépendamment</font></li>
        <li><font size=2>10/2020 : Ajout d'une rubrique statistiques (menu de gauche)</font></li>
    </ul>
    <button class="button width" style="background-color:red;"><font size=2 color="white"><b>Vu ! (cliquez ici pour ne plus voir ce message)</b></font></button>
    </div>
  </div>
</div>   




<div class="preview"><header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">HISTOLOGE Dashboard</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Accueil
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <?php 
        if($_SESSION['idPartenaire']== 10) {
          echo '
        <li class="nav-item">
          <a class="nav-link" href="#">Paramétrages</a>
        </li>
      
       <li class="nav-item">
          <a class="nav-link" href="usersOn.php">Utilisateurs</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="sessions.php">Sessions</a></li>';
          }
          ?>
          <li class="nav-item active">
          <a class="nav-link" id="infC" href="#">News</a>
        </li>
        
      </ul>
      <form class="form-inline mt-2 mt-md-0" action="_search.php" method="POST">
        <?php echo '<span class="text-white">'.$_SESSION['user'].' &nbsp;&nbsp;<a href="deconnect.php"><img src="images/deconnect.png" title="Se déconnecter" width="20" heigth="30"></a> &nbsp;</span>'; ?>
        <input class="form-control mr-sm-2" value="<?php echo $search;?>" id="searchTerms" name="searchTermsMain"type="text" placeholder="Rechercher" aria-label="Rechercher">
        <button class="btn btn-outline-success my-2 my-sm-0" id="searchB" type="button">Recherche</button>
      </form>
    </div>
  </nav> 
</header>

<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">Vue générale
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="histoCarto.php">Cartographie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="stats/statsSign.php">Statistiques</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Export</a>
        </li>
      </ul>

     
    </nav>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
      <h1>Dashboard</h1>

      <section class="row text-center placeholders">
      <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>
			<a href="main.php?e=0">
        <div class="myCircle new"><?php echo $stBy; ?></div></a>
        </td><td>
        <div><h4>En attente</h4></div>
        <div class="text-muted"><?php echo $stBy; ?> en attente de compléments demandeur.</div>
        </td></tr></table>
        
        
      </div>

        <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>  
        <a href="main.php?e=1"><div class="myCircle new"><?php echo $new; ?></div></a>
        </td><td>
          	<h4>Nouveaux</h4>
          	<div class="text-muted"><?php echo $new; ?> dossiers à traiter</div>
        </td></tr></table> 
        </div>
       

        <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>  
        <a href="main.php?e=2"><div class="myCircle wait"><?php echo $attente; ?></div></a>
        </td><td>
          <h4>A transmettre</h4>
          <span class="text-muted"><?php echo $attente; ?> dossiers à transmettre</span>
          </td></tr></table> 
        </div>

        <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>  
        <a href="main.php?e=3"><div class="myCircle trans"><?php echo $transmis; ?></div></a>
        </td><td>
          <h4>Transmis</h4>
          <span class="text-muted"><?php echo $transmis; ?> signalements à suivre</span>
          </td></tr></table> 
        </div>

        <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>  
        <a href="main.php?e=4"><div class="myCircle closed"><?php echo $ferme; ?></div></a>
        </td><td>
          <h4>Fermés</h4>
          <span class="text-muted"><?php echo $ferme; ?> signalements fermés</span>
          </td></tr></table> 
        </div>
      </section>
          <?php 
            $tab = $infosForm->getSignBySituations($villeSelect, $partenaire, $etat, $search); 
            $tabNew = $infosForm->getSignBySituations($villeSelect, $partenaire, 1,$search); 
            ?>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th>
           <h2>Liste des signalements </h2>
           <?php
           if($filtre==''): echo '['.$totSign.']';
        else: echo '['.count($tab).']';
      endif;
           ?>
          </th>
          <th><?php echo $selectVilles; ?></th>
          </tr></thead></table>
<!-- start new -->

<?php
//Affichage nouveaux signalements
    if(isset($tabNew) && !empty($tabNew)) {
        echo '<div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th bgcolor="#FF7F00" style="opacity: 80%;">
           <h3>Nouveaux signalements </h3>
          </th>
          <th> </th>
          </tr></thead></table>
    </div>
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr> 
          <th>&nbsp;</th>
          <th>#Ref.</th>
          <th>Date</th>
          <th>Situations</th>
          <th>IA</th>
          <th>Action</th>
          <th>Desc.</th>
          <th>Ville</th>
          <th>Etat</th>
         </tr>
      </thead>
      <tbody>';
          
     $x=0; 
    $aff='';
    foreach($tabNew as $key){
        $av='iconMapB'; $alt="A traiter"; $geo='';
        if($tabNew[$x]->Notation==4) {$av='iconMapR'; $alt="Urgence";}
        if($tabNew[$x]->Notation==3) {$av='iconMapO'; $alt="Action partenaires";}
        if($tabNew[$x]->Notation==2) {$av='iconMapJ'; $alt="Action propriétaire ou partenaires";}
        if($tabNew[$x]->Notation==1) {$av='iconMapV'; $alt="Action locataire ou propriétaire";}

        if($tabNew[$x]->etat==0) $et='En attente de compléments';
        if($tabNew[$x]->etat==1) $et='A traiter';
        if($tabNew[$x]->etat==2) $et='A transmettre';
        if($tabNew[$x]->etat==3) $et='Transmis - Suivi à faire';
        if($tabNew[$x]->etat==4) $et='Fermé';
        
  
  $cotationC='<img src="images/p_gris.png" width="10" heigth="10" title="">';
  if($tabNew[$x]->cotationCorrigee >= 0.2 || $tabNew[$x]->cotationAuto >= 0.2  || $tabNew[$x]->cotationSituations >= 0.2 || $tabNew[$x]->danger==1 ) $cotationC='<img src="images/att_2.png" width="20" heigth="20" title="Ce signalement nécessite une attention particulière">';

    $imgSituations='';
  $sits=$infosForm->getSituationsBySign($tabNew[$x]->idSignalement);
  $y=0;
  foreach($sits as $key){
    $imgSituations=$imgSituations.'<img src="images/p_'.$sits[$y]->idSituation_pb.'.PNG" title="'.$sits[$y]->libMenu.'">&nbsp;';
    $y++;
  }
  $desc_ct = substr($tabNew[$x]->description,0,45);
  $desc_ct = str_replace('\r\n',' ',$desc_ct);
  $desc_ct = str_replace('\t',' ',$desc_ct);

  $aff = $aff.'<tr><td>'.$x.'</td><td><a href=detailsSign.php?id='.$tabNew[$x]->idSignalement.'>#'.substr($tabNew[$x]->codepostal,0,2).'-'.$tabNew[$x]->refSign.' Détails</a></td>
  <td>'.$tabNew[$x]->dateFr.'</td><td>'.$imgSituations.'</td><td align="center">'.$cotationC.'</td>
        <td><img src="images/'.$av.'.png" width=20 height=30 title="'.$alt.'"></td><td>'.$desc_ct.'...</td>
        <td>'.strtoupper($tabNew[$x]->ville).'<br><span style="font-size:80%;">['.$tabNew[$x]->numeroRue.' '.$tab[$x]->nomRue.']</span></td>
        <td>'.$et.'</td>'.$comp1.'</tr>';
        $x++;
    } 
    echo $aff;
   echo '        
      </tbody>
    </table>
  </div>';





    } //fin !empty   
?>


<!-- end new -->
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th bgcolor="#1560BD" style="opacity: 80%;">
           <h3>Tous les signalements</h3>
          </th>
          <th> </th>
          </tr></thead></table>
    </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr> 
              <th>&nbsp;</th>
              <th>#Ref.</th>
              <th>Date</th>
              <th>Situations</th>
              <th>IA</th>
              <th>Action</th>
			  <th>Desc.</th>
        <th>Ville</th>
        <th>Affecté à</th>
        <th>Etat</th>
        <th>Géoloc.</th>
       
        <?php
           $comp1='';
            if($_SESSION['user']=='Sestiaa Alban') echo '<th>Suppr.</th>';
          
            ?>
             
            </tr>
          </thead>
          <tbody>
			  
		<?php
		
	
		$x=0; 
		$aff='';$cpt=0;
		foreach($tab as $key){

    if($tab[$x]->etat==2 || $tab[$x]->etat==3 || $tab[$x]->etat==4) {
      $cpt++;
      if($_SESSION['user']=='Sestiaa Alban') $comp1='<td><a href="javascript:suppr(\''.$tab[$x]->idSignalement.'\');">Suppr.</a></td>';

			$av='iconMapB'; $alt="A traiter"; $geo='';
			if($tab[$x]->Notation==4) {$av='iconMapR'; $alt="Urgence";}
			if($tab[$x]->Notation==3) {$av='iconMapO'; $alt="Action partenaires";}
			if($tab[$x]->Notation==2) {$av='iconMapJ'; $alt="Action propriétaire ou partenaires";}
			if($tab[$x]->Notation==1) {$av='iconMapV'; $alt="Action locataire ou propriétaire";}

      if($tab[$x]->etat==0) $et='En attente de compléments';
			if($tab[$x]->etat==1) $et='A traiter';
			if($tab[$x]->etat==2) $et='A transmettre';
      if($tab[$x]->etat==3) $et='Transmis -';
      if($tab[$x]->etat==4) $et='Transmis -';
     

      if($tab[$x]->etatPart==1) $etP='En attente Partenaire(s)';
      
      // A REPRENDRE POUR ETAT PAR PARTENAIRE !!!
     
      if($tab[$x]->etatPart==2) $etP='Réponse(s) partenaire(s) dispo.';
      if($tab[$x]->etatPart==3) $etP='<b><font color="orange">Partenaire a relancer</font></b>';
      if($tab[$x]->etatPart==4) $etP='<b><font color="red">1 Partenaire a cloturé</font></b>';
      if($tab[$x]->etatPart==5) $etP='<b><font color="red">1 Partenaire a refusé</font></b>';
      
      
      $cotationC='<img src="images/p_gris.png" width="10" heigth="10" title="">';
      if($tab[$x]->cotationCorrigee >= 0.2 || $tab[$x]->cotationAuto >= 0.2  || $tab[$x]->cotationSituations >= 0.2 || $tab[$x]->danger==1 ) $cotationC='<img src="images/att_2.png" width="20" heigth="20" title="Ce signalement nécessite une attention particulière">';

			if($tab[$x]->geolocalisation!='') $geo='ok';
      $imgSituations='';
      $sits=$infosForm->getSituationsBySign($tab[$x]->idSignalement);
      $y=0;
      foreach($sits as $key){
        $imgSituations=$imgSituations.'<img src="images/p_'.$sits[$y]->idSituation_pb.'.PNG" title="'.$sits[$y]->libMenu.'">&nbsp;';
        $y++;
      }
      
                 
          $descCourte = substr($tab[$x]->description, 0, 45);
          $descCourte = str_replace('\r\n',' ', $descCourte);
          $descCourte = str_replace('\t',' ',$descCourte);

      $partsAffect = $infosForm->getListPartBySign($tab[$x]->idSignalement);
      $r=0;
      $pAffect = '<ul>';$partName='';$etatAff='';
      foreach($partsAffect as $key){

        if($partsAffect[$r]->libPartenaire != $partsAffect[$r+1]->libPartenaire) {
          if($partsAffect[$r]->etat == 1) $etatAff='<span style="font-size:70%; color:blue;">[Attente]</span>';
          if($partsAffect[$r]->etat == 3) $etatAff='<span style="font-size:70%; color:green;">[Accepté]</span>';
          if($partsAffect[$r]->etat == 4) $etatAff='<span style="font-size:70%; color:black;">[Cloturé]</span>';
          if($partsAffect[$r]->etat == 5) $etatAff='<span style="font-size:70%; color:red;">[Refusé]</span>';

                  $pAffect = $pAffect.'<li>'.$partsAffect[$r]->libPartenaire.'<br>'.$etatAff.'</li>';
        }

        $r++;
      }
      $pAffect = $pAffect.'</ul>';
      
      $aff = $aff.'<tr><td>'.$cpt.'</td><td><a href=detailsSign.php?id='.$tab[$x]->idSignalement.'>#'.substr($tab[$x]->codepostal,0,2).'-'.$tab[$x]->refSign.' Détails</a></td>
      <td>'.$tab[$x]->dateFr.'</td><td>'.$imgSituations.'</td><td align="center">'.$cotationC.'</td>
      <td><img src="images/'.$av.'.png" width=20 height=30 title="'.$alt.'"></td>
      <td>'.$descCourte.'...</td>
      <td>'.strtoupper($tab[$x]->ville).'<br><span style="font-size:80%;">['.$tab[$x]->numeroRue.' '.$tab[$x]->nomRue.']</span></td>
      <td>'.$pAffect.'</td>
      <td>'.$et.'<br>'.$etP.'</td>
      <td>'.$geo.'</td>'.$comp1.'</tr>';
    } // fin if etat
      $x++;
      
		} // fin for
		echo $aff;
		?>
            
          </tbody>
        </table>
      </div>
<!-- start closed -->
<div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th bgcolor="#1560BD" style="opacity: 80%;">
           <h3>Signalements fermés</h3>
          </th>
          <th> </th>
          </tr></thead></table>
    </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr> 
              <th>&nbsp;</th>
              <th>#Ref.</th>
              <th>Date</th>
              <th>Situations</th>
              <th>IA</th>
              <th>Action</th>
			  <th>Desc.</th>
			  <th>Ville</th>
			  <th>Géoloc.</th>
        <th>Etat</th>
     
            </tr>
          </thead>
          <tbody>
			  
		<?php
		
	
		$x=0; 
		$aff=''; $cpt=0;
		foreach($tab as $key){
      if($tab[$x]->etat==8) {
      $cpt++;
			$av='iconMapB'; $alt="A traiter"; $geo='';
			if($tab[$x]->Notation==4) {$av='iconMapR'; $alt="Urgence";}
			if($tab[$x]->Notation==3) {$av='iconMapO'; $alt="Action partenaires";}
			if($tab[$x]->Notation==2) {$av='iconMapJ'; $alt="Action propriétaire ou partenaires";}
			if($tab[$x]->Notation==1) {$av='iconMapV'; $alt="Action locataire ou propriétaire";}


      if($tab[$x]->etat==8) $et='Fermé';

      if($tab[$x]->etatPart==4) $etP='Fermé (au moins 1 partenaire)';
      
      
     
      if($tab[$x]->etatPart==2) $etP='Réponse(s) partenaire(s) dispo.';
      if($tab[$x]->etatPart==3) $etP='<b><font color="orange">Partenaire a relancer</font></b>';
      if($tab[$x]->etatPart==5) $etP='<b><font color="red">1 Partenaire a refusé</font></b>';
      if($tab[$x]->etatPart==8) $etP='<font color="black">Cloturé par tous les partenaires</font>';
      
      
      $cotationC='<img src="images/p_gris.png" width="10" heigth="10" title="">';
      if($tab[$x]->cotationCorrigee >= 0.2 || $tab[$x]->cotationAuto >= 0.2  || $tab[$x]->cotationSituations >= 0.2 || $tab[$x]->danger==1 ) $cotationC='<img src="images/att_2.png" width="20" heigth="20" title="Ce signalement nécessite une attention particulière">';

			if($tab[$x]->geolocalisation!='') $geo='ok';
      $imgSituations='';
      $sits=$infosForm->getSituationsBySign($tab[$x]->idSignalement);
      $y=0;
      foreach($sits as $key){
        $imgSituations=$imgSituations.'<img src="images/p_'.$sits[$y]->idSituation_pb.'.PNG" title="'.$sits[$y]->libMenu.'">&nbsp;';
        $y++;
      }
      
                 
          $descCourte = substr($tab[$x]->description, 0, 45);
          $descCourte = str_replace('\r\n',' ', $descCourte);
      
      $aff = $aff.'<tr><td>'.$cpt.'</td><td><a href=detailsSign.php?id='.$tab[$x]->idSignalement.'>#'.substr($tab[$x]->codepostal,0,2).'-'.$tab[$x]->refSign.' Détails</a></td>
      <td>'.$tab[$x]->dateFr.'</td><td>'.$imgSituations.'</td><td align="center">'.$cotationC.'</td>
      <td><img src="images/'.$av.'.png" width=20 height=30 title="'.$alt.'"></td>
      <td>'.$descCourte.'...</td>
      <td>'.strtoupper($tab[$x]->ville).'<br><span style="font-size:80%;">['.$tab[$x]->numeroRue.' '.$tab[$x]->nomRue.']</span></td><td>'.$geo.'</td>
      <td>'.$et.'<br>'.$etP.'</td>'.$comp1.'</tr>';
    } //fin if($tab[$x]->etat==4)
			$x++;
		} 
		echo $aff;
		?>
            
          </tbody>
        </table>
      </div>

<!-- en closed --> 



    </main>
    
  </div>
</div></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script><script>window.WebFont.load({google: {families: ["Roboto"]}})</script>
<script>

function suppr (idSign) {
    var datastring = 'signid='+idSign+'&action=suppr';
	//alert (upn+" - "+$(datep).val());
	 $.ajax({
                        type: "POST",
                        url:"updateSign.php",
                        data:datastring,
                        success: function(msg){
                        	 $('.info').css({position: 'fixed', bottom: '15px', left: '50%', 'background-color': '#007fc3', 
                        	padding: '12px 24px', color: 'white', 'font-family': 'verdana', 'font-size': '2em', 'border-radius': '3px', 'margin-left': '-178px'});
                           $('.info').fadeToggle();
                        
                        },
                        error: function(msg){
                            alert('houpps : '+msg);
                        }
                    });
  }
  function changeSit() {
  if(document.getElementById('selectPart').checked == true){
     window.location = 'main.php?p=o&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'main.php?p=n&s='+document.getElementById('selectSit').value;
  }
}


$("#selectPart").bind("click", (function () {
  if(document.getElementById('selectPart').checked == true){
  window.location = 'main.php?p=o&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'main.php?p=n&s='+document.getElementById('selectSit').value;
  }
}
));

$("#searchB").bind("click", (function () {
  var searchT = document.getElementById('searchTerms').value;

  if(document.getElementById('selectPart').checked == true){
  window.location = 'main.php?p=o<?php echo $link; ?>&s='+document.getElementById('selectSit').value+'&search='+searchT;
  } else {
    window.location = 'main.php?p=n<?php echo $link; ?>&s='+document.getElementById('selectSit').value+'&search='+searchT;;
  }
}
));


$("#infC").bind("click", (function () {
  $('#infoNews').modal('show');
}));
</script>
<?php
echo $showNews;
?>

</body></html>