<?php
 session_start();
 

    $step=$_POST['step'];
    $etat=$_POST['etat'];


   
require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');



// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);

$infosForm->insertUserActivity($_SESSION['user'], $step, $etat, $_SERVER['HTTP_USER_AGENT'] );


?>