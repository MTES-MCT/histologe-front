<?php
session_start();
if($_SESSION['admin']!='ok') {
    header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
    exit;
   }

//userId=&action=view

$userId = $_POST['userId'];


require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

if($_POST['action']=='view') {
    $infosForm->updateNewsUser($userId);
    exit;
}