<?php
ini_set('display_errors',1);
session_start();


require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');




// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);

$i=0;

//echo $_SESSION['redirect'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user']) && isset($_POST['passw']) ) {
       $user=$infosForm->checkUserBO($_POST['user'], $_POST['passw']);
       if(isset($user) && $user[0]->courriel==$_POST['user']) {
           
            $_SESSION['user'] = $user[0]->nom_bo.' '.$user[0]->prenom_bo;
            $_SESSION['userId'] = $user[0]->id_userbo;
            $_SESSION['idPartenaire'] = $user[0]->idPartenaire;
            //affectation des droits
            $drt = $infosForm->getDroitsUser($user[0]->id_userbo);
            $x=0; 
            foreach($drt as $key){
               $_SESSION[$drt[$x]->libDroit] = $drt[$x]->accesDroit;
               $x++;
            }
            $infosForm->traceUser($_SESSION['user'], 'Login');
            $i=1;
            if(isset($_SESSION['redirect'])){
              header("Location: ".$_SESSION['redirect']);
            } else {
            header("Location: main.php");
            }
       } else {
            $_SESSION['msg_erreur']='Erreur : Cette adresse n\'est pas reconnue ou mot de passe invalide.';
            header("Location: home.php");
            $i=1;
       }
        

    }
    
    
    if($i==0) {
        header("Location: https://histologe.beta.gouv.fr");
        exit();
    }


