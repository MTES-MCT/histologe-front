<?php
session_start();

require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

$infosForm->traceUser($_SESSION['user'], 'Logout');

session_destroy();

header("Location:  https://histologe.beta.gouv.fr/_adm/home.php");  
exit;