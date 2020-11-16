<?php

 session_start();

 if($_SESSION['admin']!='ok') {

  header("Location: https://www.histologe.info/dev/_adm/home.php");

  exit;

 }



    $geo=$_POST['geol'];

    $idSign=$_POST['signid'];



require_once('../include/connexion.class.php');

require_once('../include/etats_formAdm.class.php');







// préparation connexion

$connect = new connection();

$infosForm = new etat_formAdm($connect);



$tab1=$infosForm->updategeolocSign($geo, $idSign);



?>