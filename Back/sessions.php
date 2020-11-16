<?php
ini_set('display_errors',1);
 session_start();
 //echo "-".$_SESSION['admin'];
 //var_dump($_SESSION);
 if($_SESSION['admin']!='ok') {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
  exit;
 }

require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
//Corriger avec sm !
$tab0 = $infosForm->getEtatByStep('after', 0);
$tab1_b = $infosForm->getEtatByStep('before', 1);
$tab1_a = $infosForm->getEtatByStep('after', 1);
$tab2_b = $infosForm->getEtatByStep('before', 2);
$tab2_a = $infosForm->getEtatByStep('after', 2);
$tab3_b = $infosForm->getEtatByStep('before', 3);
$tab3_a = $infosForm->getEtatByStep('after', 3);

$reste_b_1 = ($tab1_b[0]->nb)-($tab1_a[0]->nb);
$reste_b_2 = ($tab2_b[0]->nb-$tab2_a[0]->nb);
$reste_b_3 = ($tab3_b[0]->nb-$tab3_a[0]->nb);


?>
<!doctype html>
<html lang="fr"><head>
<link href="css/styleAdm.css" rel="stylesheet" media="all">	

</head>

<body><div class="preview"><header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">HISTOLOGE Dashboard</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Acceuil
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Paramétrages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Utilisateurs</a>
        </li>
      
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Rechercher" aria-label="Rechercher">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
      </form>
    </div>
  </nav>
</header>

<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="main.php">Vue générale
            <span class="sr-only"></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="histoCarto.php">Cartographie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Export</a>
        </li>
      </ul>

     
    </nav>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
      <h1>Dashboard</h1>
 
      
      <h2>Suivi des sessions </h2>
      
      <div class="table-responsive">
      <table class="table table-striped">
           <tbody>
            <th><td>Historique des sessions</td></th>
            <tr><td>Depuis Home</td><td>Etape 1(before/after)</td><td>Etape 2(before/after)</td><td>Enregistrement (before/after)</td></tr>
            <?php
           
               echo '<tr><td>'.$tab0[0]->nb.'</td><td>Before : '.$tab1_b[0]->nb.'<br><b>After : '.$tab1_a[0]->nb.'</b></td><td></td><td></td></tr>';
               echo '<tr><td></td><td></td><td>Before : '.$tab2_b[0]->nb.'<br><b>After : '.$tab2_a[0]->nb.'</b></td><td></td></tr>';
               echo '<tr><td></td><td></td><td></td><td>Before : '.$tab3_b[0]->nb.'<br><b>After : '.$tab3_a[0]->nb.'</b></td></tr>';
              
             
            
            ?>
           </tbody>
        </table>


        <table class="table table-striped">
           <tbody>
            <th><td>Historique des sessions</td></th>
            <tr><td>Depuis Home</td><td>Etape 1(before/after)</td><td>Etape 2(before/after)</td><td>Enregistrement (before/after)</td></tr>
            <?php
           
               echo '<tr><td>'.$tab0[0]->nb.'</td><td colspan=3></td></tr>';
               echo '<tr><td>Non continués : '.(($tab0[0]->nb)-($tab1_b[0]->nb)).' </td><td>Présents : '.($tab0[0]->nb - (($tab0[0]->nb)-($tab1_b[0]->nb))).'</td><td colspan=2>&nbsp;</td></tr>';
               echo '<tr><td>&nbsp;</td><td><b>Etape validée : '.$tab1_a[0]->nb.'</b></td><td></td><td></td></tr>';
               echo '<tr><td>&nbsp;</td><td>Etape non validée : '.$reste_b_1.'</td><td></td><td></td></tr>';
               echo '<tr><td>&nbsp;</td><td>Non continués : '.(($tab0[0]->nb - (($tab0[0]->nb)-($tab1_b[0]->nb))) - $tab1_a[0]->nb) .'</td><td>Présents  : '.$tab1_a[0]->nb.'</td><td></td></tr>' ;
               echo '<tr><td></td><td></td><td><b>Etape validée : '.$tab2_a[0]->nb.'</b></td><td></td></tr>';
               echo '<tr><td></td><td></td><td>Etape non validée : '.$reste_b_2.'</td><td></td></tr>';
               echo '<tr><td></td><td></td><td>Non continués : '.($tab1_a[0]->nb - $tab2_a[0]->nb) .'</td><td>Présents :'.$tab2_a[0]->nb.'</td></tr>';
               echo '<tr><td></td><td></td><td></td><td><b>Etape validée : '.$tab3_a[0]->nb.'</b></td></tr>';
               echo '<tr><td></td><td></td><td></td><td>Etape non validée : '.$reste_b_3.'</td></tr>';
               echo '<tr><td></td><td></td><td></td><td>Non continués : '.($tab2_a[0]->nb-$tab3_a[0]->nb).'</td></tr>';

            
            ?>
           </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
</div>
</body>
</html>
