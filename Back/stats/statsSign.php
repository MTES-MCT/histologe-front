<?php
 session_start();
 
 if($_SESSION['admin'] !='ok') {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
  exit;
 }

 ini_set('display_errors',1);
require_once('../include/connexion.class.php');
require_once('../include/etat_formCalc.class.php');
// préparation connexion
$connect = new connection();
$infosForm2 = new etat_formCalc($connect);
$infosForm2->traceUser($_SESSION['user'], 'Statistiques');
$tab=$infosForm2->getConnectedUser();
$tab2=$infosForm2->getRelancesSurAffectation();

$x=0; 
$aff='';

    $y=0;$user='';$action='';$dt='';
    foreach($tab as $key){
        $user = $tab[$y]->user.'<br>';
        $action = $action.$tab[$y]->actionUser.'<br>';
        $dt=$dt.$tab[$y]->dtAction.'<br>';
        if($tab[($y+1)]->user != $tab[$y]->user) {
          $aff=$aff.'<tr><td>'.$user.'</td><td>'.$action.'</td><td>'.$dt.'</td></tr>
          <tr><td colspan=3>&nbsp;</td></tr>'; 
          $user='';$action='';$dt='';
        }
     $y++;
    }

    $y=0; 
    $aff2='';$user='';$action='';$dt='';
    foreach($tab2 as $key){

      $user = $tab2[$y]->courriel.'<br>';
      $action = $action.'<a href=detailsSign.php?id='.$tab2[$y]->idValue.'>Signalement</a><br>';
      $dt=$dt.$tab2[$y]->dateEnvoiF.'<br>';
      if($tab2[($y+1)]->courriel != $tab2[$y]->courriel) {
          $aff2=$aff2.'<tr><td>'.$user.'</td><td>'.$dt.'</td><td>'.$action.'</td></tr>
          <tr><td colspan=3>&nbsp;</td></tr>'; 
          $user='';$action='';$dt='';
        }
        $y++;
    }
   

?>


<!doctype html>
<html lang="fr"><head> 
<title>Back-Office Histologe, un service public pour les locataires et les propriétaires</title>
<link href="../css/styleAdm.css" rel="stylesheet" media="all">	
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
       
        
    </ul>
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
          <a class="nav-link" href="../main.php">Accueil
           
          </a>
        </li>
        <?php 
        if($_SESSION['userId']=='4' || $_SESSION['userId']=='3' ) {
          echo '
        <li class="nav-item">
          <a class="nav-link" href="#">Paramétrages</a>
        </li>
      
       <li class="nav-item">
          <a class="nav-link" href="../usersOn.php">Utilisateurs</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sessions.php">Sessions</a></li>';
          }
          ?>
          <li class="nav-item active">
          <a class="nav-link" id="infC" href="#">News</a>
        </li>
        
      </ul>
     
        <?php echo '<span class="text-white">'.$_SESSION['user'].' &nbsp;&nbsp;<a href="../deconnect.php"><img src="../images/deconnect.png" title="Se déconnecter" width="20" heigth="30"></a> &nbsp;</span>'; ?>
      
    </div>
  </nav> 
</header>
        </div>
<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link " href="../main.php">Vue générale
            
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../histoCarto.php">Cartographie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Statistiques</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#">Export</a>
        </li>
      </ul>
        </div>
     
    </nav>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
        <br><br><h4>
       | <a href="#clo">Signalements en cours et cloturés</a> | <a href="#sit">Répartition par situations</a> | 
       <a href="#crit">Répartition par critères</a> | <a href="#villes">Répartition par villes</a> | 
       <a href="#part">Répartition par partenaires</a> | 
        </h4>
    </main>


    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <a name="clo"> <h2><br>Signalements enregistrés et cloturés [global]</h2>
<!--Stats -->
<div class="text-center">
  <br>
  <iframe id="stats"
  title="Signalement"
  width="800"
  height="400"
  src="initStats.php"
  scrolling="no"
  frameborder="0">
  </iframe>
</div>
   </main>

  <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
  <br><a name="sit">  <h2>Répartition par situations</h2>
      <div class="text-center">
   <iframe id="stats"
  title="Situations"
  width="800"
  height="400"
  src="situaStats.php"
  scrolling="no"
  frameborder="0">
  </iframe>
</div>
   </main>

   <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <a name="crit"> <h2><br>Répartition par critères</h2>
      <div class="text-center">
   <iframe id="stats"
  title="Situations"
  width="800"
  height="400"
  src="critStats.php"
  scrolling="no"
  frameborder="0">
  </iframe>
</div>
   </main>

   <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <a name="villes"> <h2><br>Répartition par villes</h2>
   <div class="text-center">
   <iframe id="stats"
  title="Situations"
  width="800"
  height="500"
  src="villeStats.php"
  scrolling="no"
  frameborder="0">
  </iframe>
</div>
   </main>
   <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <a name="part"> <h2><br>Répartition par état (et partenaires)</h2>
   <div class="text-center">
   <iframe id="stats"
  title="Situations"
  width="800"
  height="500"
  src="partStats.php"
  scrolling="no"
  frameborder="0">
  </iframe>
</div>
   </main>

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <a name="part"> <h2><br>Répartition par partenaire (et états))</h2>
   <div class="text-center">
   <iframe id="stats"
  title="Situations"
  width="800"
  height="500"
  src="etatspartStats.php"
  scrolling="no"
  frameborder="0">
  </iframe>
</div>
   </main>
   
</div>

<div class="info">Mise à jour ok</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script><script>window.WebFont.load({google: {families: ["Roboto"]}})</script>



</body></html>