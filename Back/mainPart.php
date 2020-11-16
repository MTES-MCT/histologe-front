<?php
 session_start();
 //echo "-".$_SESSION['admin'];
 //var_dump($_SESSION);
 //ini_set('display_errors',1);
 if($_SESSION['admin']!='ok') {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
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
 } else {
//forcer les signalements du partenaire connecté
 $_SESSION['part'] = $_SESSION['idPartenaire'];
 $partenaire=$_SESSION['part'];
 $p=1;
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
  $etatPart=$_SESSION['etat'];
  $e=1;
 }
 if($e==0) $etatPart='%';

 $tri='0'; $affTri=''; $affDate='Date <img src="images/tri.png" width=10 heigth=15>'; $affDateE=$affDate;
 $link='&t=v';
 if(isset($_GET['t'])) {
   if($_GET['t']=='v') {
     $tri='ville';
     $affTri='<img src="images/tri.png" width=10 heigth=15>';
     $affDate='<a href="#" id="triD">Date'.$affTriD.'</a>';
     $affDateE='<a href="#" id="triDE">Date'.$affTriD.'</a>';
     $link='';
   }
 }

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
  unset($_SESSION['ville']);

  }

  

  if($etatPart!='%') {
  
   if($etatPart==2) $filtre=$filtre.' + Signalements pris en charge.';
   if($etatPart==3) $filtre=$filtre.' + Signalements a revoir.';
   

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

$new = count($infosForm->getNewSignPart($partenaire)); 

$tabCompteur = $infosForm->getSignPart($partenaire, $villeSelect, $tri, $search, $etatPart); 
$c=0;$attente=0;$aRevoir=0;
foreach($tabCompteur as $key) {
  if($tabCompteur[$c]->EP == 3) $attente++;
  if($tabCompteur[$c]->etatPart == 3) $aRevoir++;
  if($tabCompteur[$c]->EP == 4 || $tabCompteur[$c]->EP == 5) $ferme++;
  $c++;
}

//$attente = count($infosForm->getSignPartByEtatPart_($partenaire, 2)); 
//$aRevoir = count($infosForm->getSignPartByEtatPart_($partenaire, 3)); 
//A reprendre : fermé pour le partenaire connecté ! 
//$ferme = count($infosForm->getSignByEtatSignPart($partenaire, 4)); 

$totSign=($new+$attente+$aRevoir+$ferme);


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
    $suppr = '<a href="mainPart.php?r=1"><img src="images/suppr_f.png" width=20 heigth=20></a>';
  } else {
    $suppr = '/';
  }
  $selectVilles=$selectVilles.'<br>Filtres activés : '.$filtre.' '.$suppr;
?>


<!doctype html>
<html lang="fr"><head> 
<meta charset="utf-8">
<title>Back-Office Histologe, un service public pour les locataires et les propriétaires</title>
<link href="css/styleAdm.css" rel="stylesheet" media="all">	

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
    <a class="navbar-brand" href="mainPart.php">HISTOLOGE Dashboard</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="main.php">Accueil
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <?php 
        if($_SESSION['userId']=='4' || $_SESSION['userId']=='3' ) {
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
        </li>
      </ul>
      <form class="form-inline mt-2 mt-md-0" action="_search.php" method="POST">
        <?php echo '<span class="text-white">'.$_SESSION['user'].' &nbsp;&nbsp;<a href="deconnect.php"><img src="images/deconnect.png" title="Se déconnecter" width="20" heigth="30"></a> &nbsp;</span>'; ?>
        <input class="form-control mr-sm-2" value="<?php echo $search;?>" id="searchTerms" name="searchTerms"type="text" placeholder="Rechercher" aria-label="Rechercher">
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
        <div class="myCircle new"><?php echo $new; ?></div>
        </td><td>
          	<h4>Nouveaux</h4>
          	<div class="text-muted"><?php echo $new; ?> dossiers à traiter</div>
        </td></tr></table> 
        </div>
       

        <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>  
        <a href="mainPart.php?e=2"><div class="myCircle wait"><?php echo $attente; ?></div></a>
        </td><td>
          <h4>Pris en charge</h4>
          <span class="text-muted"><?php echo $attente; ?> En cours</span>
          </td></tr></table> 
        </div>

        <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>  
        <a href="mainPart.php?e=3"><div class="myCircle trans"><?php echo $aRevoir; ?></div></a>
        </td><td>
          <h4>A revoir</h4>
          <span class="text-muted"><?php echo $transmis; ?> Sans suivi depuis +20js</span>
          </td></tr></table> 
        </div>

        <div class="col-6 col-sm-3 placeholder">
        <table><tr><td>  
       <div class="myCircle closed"><?php echo $ferme; ?></div>
        </td><td>
          <h4>Fermés ou Refusés</h4>
          <span class="text-muted"><?php echo $ferme; ?> fermés ou refusés</span>
          </td></tr></table> 
        </div>
      </section>
          <?php 
          //Récupération des signalements du user/partenaire connecté
            $tab = $infosForm->getSignPart($partenaire, $villeSelect, $tri, $search, $etatPart); 
            $tabNew = $infosForm->getNewSignPart($partenaire, $villeSelect, $tri, $search); 
            ?>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th>
           <h2>Liste des signalements </h2>
           </th>
          <th><?php echo $selectVilles; ?></th>
          </tr></thead></table>
    </div>

<?php
//Affichage nouveaux signalements
    if(isset($tabNew) && !empty($tabNew)) {
        echo '<div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th bgcolor="#FF7F00" style="opacity: 80%;">
           <h3>Nouveaux signalements ['.count($tabNew).']</h3>
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
          <th>'.$affDate.'</th>
          <th>Situations</th>
          <th>IA</th>
          <th>Action</th>
          <th>Desc.</th>
          <th><a href="#" id="triV">Ville '.$affTri.'</a></th>
          <th>Etat</th>
          <th>Affecté à</th>
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

       $et='A prendre en charge';
       
  
  $cotationC='<img src="images/p_gris.png" width="10" heigth="10" title="">';
  if($tabNew[$x]->cotationCorrigee >= 0.2 || $tabNew[$x]->cotationAuto >= 0.2  || $tabNew[$x]->cotationSituations >= 0.2 || $tabNew[$x]->danger==1 ) $cotationC='<img src="images/att_2.png" width="20" heigth="20" title="Ce signalement nécessite une attention particulière">';

    $imgSituations='';
  $sits=$infosForm->getSituationsBySign($tabNew[$x]->idSignalement);
  $y=0;
  foreach($sits as $key){
    $imgSituations=$imgSituations.'<img src="images/p_'.$sits[$y]->idSituation_pb.'.PNG" title="'.$sits[$y]->libMenu.'">&nbsp;';
    $y++;
  }

       
  $descCourte = substr($tabNew[$x]->description,0,45);
  $descCourte = str_replace('\r\n',' ', $descCourte);
  $descCourte = str_replace('\t',' ', $descCourte);


  
  $partsAffect = $infosForm->getListPartBySign($tabNew[$x]->idSignalement);
  $r=0;
  $pAffect = '<ul>';
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

  $aff = $aff.'<tr><td><span style="font-size:80%;">'.($x+1).'</span></td><td><a href=detailsSign.php?id='.$tabNew[$x]->idSignalement.'>#'.substr($tabNew[$x]->codepostal,0,2).'-'.$tabNew[$x]->refSign.' Détails</a></td>
  <td>'.$tabNew[$x]->dateFr.'</td><td>'.$imgSituations.'</td><td align="center">'.$cotationC.'</td>
        <td><img src="images/'.$av.'.png" width=20 height=30 title="'.$alt.'"></td><td>'.$descCourte.'...</td>
        <td>'.strtoupper($tabNew[$x]->ville).'<br><span style="font-size:80%;">['.$tabNew[$x]->numeroRue.' '.$tabNew[$x]->nomRue.']</span></td>
        <td>'.$et.'</td><td>'.$pAffect.'</td></tr>';
        $x++;
        
    } 
    echo $aff;
   echo '        
      </tbody>
    </table>
  </div>';





    } //fin !empty    

    //Affichage de tous les signalements pris en charge ou à revoir
?>
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th bgcolor="#1560BD" style="opacity: 80%;">
           <h3>
           <?php if($p==1) echo 'Vos '; else echo 'Les ';?>signalements en cours &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
          </th>
          <th><span id="cSignOtw" class="bSign"><img src="images/masquer.png" width="30" heigth="20" title="Masquer"></span></th>
          </tr></thead></table>
    </div>

      <div class="table-responsive Sign" id="SignOTW">
        <table class="table table-striped" >
          <thead>
            <tr> 
              <th>&nbsp;</th>
              <th>#Ref.</th>
              <th><?php echo $affDateE; ?></th>
              <th>Situations</th>
              <th>IA</th>
              <th>Action</th>
			  <th>Desc.</th>
			  <th><a href="#" id="triVE">Ville <?php echo $affTri; ?></a></th>
			  <th>Etat</th>
        <th>Affecté à</th>
            </tr>
          </thead>
          <tbody>
			  
		<?php
		
	
		$x=0; $cpt=1;
    $aff='';
    //Cas permettant de voir l'ensemble des signalements sauf cloturés
    if(isset($_GET['r']) || $p==0) {
      foreach($tab as $key){
      
       if($tab[$x]->EP != 1 && $tab[$x]->EP != 4 && $tab[$x]->EP != 8) {
 
       $av='iconMapB'; $alt="A traiter"; $geo='';
       if($tab[$x]->Notation==4) {$av='iconMapR'; $alt="Urgence";}
       if($tab[$x]->Notation==3) {$av='iconMapO'; $alt="Action partenaires";}
       if($tab[$x]->Notation==2) {$av='iconMapJ'; $alt="Action propriétaire ou partenaires";}
       if($tab[$x]->Notation==1) {$av='iconMapV'; $alt="Action locataire ou propriétaire";}
   
         
           if($etatAffect[0]->affect==2) $et='Pris en charge';
           if($tab[$x]->etatPart==3) $et='<b><font color="red">A revoir</font></b><img src="images/info.png" width=20 heigth=23 title="Signalement sans suivi depuis 15 jours !"';
         
       
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
           
       $descCourte = substr($tab[$x]->description,0,45);
       $descCourte = str_replace('\r\n',' ', $descCourte);
       $descCourte = str_replace('\t',' ', $descCourte);

       $partsAffect = $infosForm->getListPartBySign($tab[$x]->idSignalement);
        $r=0;
        $pAffect = '<ul>';
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

 
       $aff = $aff.'<tr><td><span style="font-size:80%;">'.$cpt.'</span></td><td><a href=detailsSign.php?id='.$tab[$x]->idSignalement.'>#'.substr($tab[$x]->codepostal,0,2).'-'.$tab[$x]->refSign.' Détails</a></td>
       <td>'.$tab[$x]->dateFr.'</td><td>'.$imgSituations.'</td><td align="center">'.$cotationC.'</td>
       <td><img src="images/'.$av.'.png" width=20 height=30 title="'.$alt.'"></td><td>'.$descCourte.'...</td>
             <td>'.strtoupper($tab[$x]->ville).'<br><span style="font-size:80%;">['.$tab[$x]->numeroRue.' '.$tab[$x]->nomRue.']</span></td>
             <td>'.$et.'</td><td>'.$pAffect.'</td></tr>';
        $cpt++;
       } // fin affect=2
       $x++;
     } // fin if r
   //Afficher uniquement les signalements du partenaire connecté
    } else {
    $cpt=1;
		foreach($tab as $key){
       //Récupérer état du signalement pour partenaire connecté
      $etatAffect = $infosForm->getEtatAffectSignByPart($tab[$x]->idSignalement, $_SESSION['idPartenaire']);
     
      if($etatAffect[0]->affect==2 && $tab[$x]->EP != 4 && $tab[$x]->EP != 8) {

			$av='iconMapB'; $alt="A traiter"; $geo='';
			if($tab[$x]->Notation==4) {$av='iconMapR'; $alt="Urgence";}
			if($tab[$x]->Notation==3) {$av='iconMapO'; $alt="Action partenaires";}
			if($tab[$x]->Notation==2) {$av='iconMapJ'; $alt="Action propriétaire ou partenaires";}
			if($tab[$x]->Notation==1) {$av='iconMapV'; $alt="Action locataire ou propriétaire";}
  
        
		    	if($etatAffect[0]->affect==2) $et='Pris en charge';
          if($tab[$x]->etatPart==3) $et='<b><font color="red">A revoir</font></b><img src="images/info.png" width=20 heigth=23 title="Signalement sans suivi depuis 15 jours !"';
        
      
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
          
      $descCourte = substr($tab[$x]->description,0,45);
      $descCourte = str_replace('\r\n',' ', $descCourte);
      $descCourte = str_replace('\t',' ', $descCourte);

      $partsAffect = $infosForm->getListPartBySign($tab[$x]->idSignalement);
      $r=0;
      $pAffect = '<ul>';
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


      $aff = $aff.'<tr><td><span style="font-size:80%;">'.$cpt.'</span></td><td><a href=detailsSign.php?id='.$tab[$x]->idSignalement.'>#'.substr($tab[$x]->codepostal,0,2).'-'.$tab[$x]->refSign.' Détails</a></td>
      <td>'.$tab[$x]->dateFr.'</td><td>'.$imgSituations.'</td><td align="center">'.$cotationC.'</td>
			<td><img src="images/'.$av.'.png" width=20 height=30 title="'.$alt.'"></td><td>'.$descCourte.'...</td>
            <td>'.strtoupper($tab[$x]->ville).'<br><span style="font-size:80%;">['.$tab[$x]->numeroRue.' '.$tab[$x]->nomRue.']</span></td>
            <td>'.$et.'</td><td>'.$pAffect.'</td></tr>';
      $cpt++;
      } // fin affect=2
			$x++;
    } 
  }//fin else

    echo $aff;
    
		?>
            
          </tbody>
        </table>
      </div>

<!--start closed and refused -->
<div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr><th bgcolor="#156051" style="opacity: 80%;">
           <h3><?php if($p==1) echo 'Vos '; else echo 'Les ';?>signalements fermés ou refusés</h3>
          </th>
          <th><span id="cSignOtwF" class="bSign"><img src="images/voir.png" width="30" heigth="20" title="Voir"></span> </th>
          </tr></thead></table>
    </div>

      <div class="table-responsive SignOff" id="SignfOTW">
        <table class="table table-striped">
          <thead>
            <tr> 
              <th>#Ref.</th>
              <th>Date</th>
              <th>Situations</th>
              <th>IA</th>
              <th>Action</th>
			  <th>Desc.</th>
			  <th>Ville</th>
			  <th>Etat</th>
        <?php
           $comp1='';
              
            ?>
            </tr>
          </thead>
          <tbody>
			  
		<?php
		
	
		$x=0; 
		$aff='';
		foreach($tab as $key){
      $etatAffect = $infosForm->getEtatAffectSignByPart($tab[$x]->idSignalement, $_SESSION['idPartenaire']);
     if($etatAffect[0]->affect == 0  || $etatAffect[0]->affect == 3  || $tab[$x]->EP == 4 || $tab[$x]->EP == 8) {
 
			$av='iconMapB'; $alt="A traiter"; $geo='';
			if($tab[$x]->Notation==4) {$av='iconMapR'; $alt="Urgence";}
			if($tab[$x]->Notation==3) {$av='iconMapO'; $alt="Action partenaires";}
			if($tab[$x]->Notation==2) {$av='iconMapJ'; $alt="Action propriétaire ou partenaires";}
			if($tab[$x]->Notation==1) {$av='iconMapV'; $alt="Action locataire ou propriétaire";}

      if($tab[$x]->etatPart==1) $et='A prendre en charge';
			if($tab[$x]->etatPart==2) $et='Pris en charge';
			if($tab[$x]->etatPart==3) $et='A revoir';
      if($tab[$x]->etatPart==4) $et='Fermé'; 
      if($tab[$x]->etatPart==8) $et='Fermé';
      if($etatAffect[0]->affect==3) $et='Refusé';
      
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

      $aff = $aff.'<tr><td><a href=detailsSign.php?id='.$tab[$x]->idSignalement.'>#'.substr($tab[$x]->codepostal,0,2).'-'.$tab[$x]->refSign.' Détails</a></td>
      <td>'.$tab[$x]->dateFr.'</td><td>'.$imgSituations.'</td><td align="center">'.$cotationC.'</td>
			<td><img src="images/'.$av.'.png" width=20 height=30 title="'.$alt.'"></td><td>'.substr($tab[$x]->description,0,45).'...</td>
            <td>'.strtoupper($tab[$x]->ville).'<br><span style="font-size:80%;">['.$tab[$x]->numeroRue.' '.$tab[$x]->nomRue.']</span></td>
            <td>'.$et.'</td>'.$comp1.'</tr>';
     } //if etat 2 ou 3
			$x++;
		} 
		echo $aff;
		?>
            
          </tbody>
        </table>
      </div>

<!-- end refused and closed -->



    </main>
    
  </div>
</div></div>
<div class="info">Mise à jour ok</div>
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
     window.location = 'mainPart.php?p=o&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'mainPart.php?p=n&s='+document.getElementById('selectSit').value;
  }
}

$("#triV").bind("click", (function () {
  if(document.getElementById('selectPart').checked == true){
  window.location = 'mainPart.php?p=o<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'mainPart.php?p=n<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  }
}
));

$("#triVE").bind("click", (function () {
  if(document.getElementById('selectPart').checked == true){
  window.location = 'mainPart.php?p=o<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'mainPart.php?p=n<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  }
}
));


$("#triD").bind("click", (function () {
  if(document.getElementById('selectPart').checked == true){
  window.location = 'mainPart.php?p=o<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'mainPart.php?p=n<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  }
}
));

$("#triDE").bind("click", (function () {
  if(document.getElementById('selectPart').checked == true){
  window.location = 'mainPart.php?p=o<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'mainPart.php?p=n<?php echo $link; ?>&s='+document.getElementById('selectSit').value;
  }
}
));


$("#selectPart").bind("click", (function () {
  if(document.getElementById('selectPart').checked == true){
  window.location = 'mainPart.php?p=o&s='+document.getElementById('selectSit').value;
  } else {
    window.location = 'mainPart.php?p=n&s='+document.getElementById('selectSit').value;
  }
}
));


$("#searchB").bind("click", (function () {
  var searchT = document.getElementById('searchTerms').value;

  if(document.getElementById('selectPart').checked == true){
  window.location = 'mainPart.php?p=o<?php echo $link; ?>&s='+document.getElementById('selectSit').value+'&search='+searchT;
  } else {
    window.location = 'mainPart.php?p=n<?php echo $link; ?>&s='+document.getElementById('selectSit').value+'&search='+searchT;;
  }
}
));



$("#cSignOtw").bind("click", (function () {
  var x = document.getElementById("SignOTW");
  if (x.style.display === "none") {
    document.getElementById('cSignOtw').innerHTML="<img src=\"images/masquer.png\" width=\"30\" heigth=\"20\" title=\"Masquer\">";
    x.style.display = "block";
  } else {
    document.getElementById('cSignOtw').innerHTML="<img src=\"images/voir.png\" width=\"30\" heigth=\"20\" title=\"Voir\">";
    x.style.display = "none";
  }
 }
));
$("#cSignOtwF").bind("click", (function () {
  var x = document.getElementById("SignfOTW");
  if (x.style.display === "none") {
    document.getElementById('cSignOtwF').innerHTML="<img src=\"images/masquer.png\" width=\"30\" heigth=\"20\" title=\"Masquer\">";
    x.style.display = "block";
  } else {
    document.getElementById('cSignOtwF').innerHTML="<img src=\"images/voir.png\" width=\"30\" heigth=\"20\" title=\"Voir\">";
    x.style.display = "none";
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