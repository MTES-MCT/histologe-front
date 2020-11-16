<?php

 session_start();

 //echo "-".$_SESSION['admin'];

 //var_dump($_SESSION);

 if($_SESSION['admin']!='ok') {

  header("Location: https://www.histologe.info/dev/_adm/home.php");

  exit;

 }



require_once('../include/connexion.class.php');

require_once('../include/etats_formAdm.class.php');



// préparation connexion

$connect = new connection();

$infosForm = new etat_formAdm($connect);







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

          <a class="nav-link active" href="#">Vue générale

            <span class="sr-only">(current)</span>

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





      <h2>Suivi du signalement </h2> 

      <div class="table-responsive">

        <table class="table table-striped table-bordered">

          <thead>

            <tr>

              <th>#</th>

              <th>Date</th>

              <th>Courriel</th>

              <th>Note</th>

			  <th>Desc.</th>

			  <th>Ville</th>

			

            </tr>

          </thead>

          <tbody>

          <tr>

<td>Ligne1</td>

<td>cellule</td>

<td>cellule</td>

<td>cellule</td>

<td>cellule</td>

</tr>

		

            

          </tbody>

        </table>

      </div>

    </main>

  </div>

</div></div><script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script><script>window.WebFont.load({google: {families: ["Roboto"]}})</script></body></html>