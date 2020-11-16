<?php
 session_start();
 
 if($_SESSION['admin'] !='ok' || !($_SESSION['userId'] =='4' xor $_SESSION['userId'] =='3') ) {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
  exit;
 }

 ini_set('display_errors',1);
require_once('include/connexion.class.php');
require_once('include/etat_formCalc.class.php');
// préparation connexion
$connect = new connection();

$infosForm2 = new etat_formCalc($connect);
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
          <a class="nav-link" href="#">Accueil
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
        
      </ul>
     
        <?php echo '<span class="text-white">'.$_SESSION['user'].' &nbsp;&nbsp;<a href="deconnect.php"><img src="images/deconnect.png" title="Se déconnecter" width="20" heigth="30"></a> &nbsp;</span>'; ?>
      
    </div>
  </nav> 
</header>
        </div>
<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="main.php">Vue générale
            
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="histoCarto.php">Cartographie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Export</a>
        </li>
      </ul>
        </div>
     
    </nav>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
      <h1><br>Utilisateurs connectés </h1>
     <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr> 
          <th>Utilisateur</th>
          <th>Action</th>
          <th>Date</th>
         </tr>
      </thead>
      <tbody>
    <?php echo $aff; ?>
      </tbody>
    </table>
    </div>
   </main>

   <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
      <h1><br>Dernières relances sur affectation</h1>
     <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr> 
          <th>Utilisateur</th>
          <th>Date</th>
          <th>Signalement</th>
         </tr>
      </thead>
      <tbody>
    <?php echo $aff2; ?>
      </tbody>
    </table>
    </div>
   </main>

   
</div>

<div class="info">Mise à jour ok</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script><script>window.WebFont.load({google: {families: ["Roboto"]}})</script>



</body></html>