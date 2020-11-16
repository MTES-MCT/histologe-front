<?php 
session_start();
//ini_set('display_errors',1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

date_default_timezone_set('Europe/Paris');

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);
$infosForm->addHoney();

$mailDemandeur=''; $msg=''; $nom=''; $r=0;

if(isset($_POST['txtName'])) {
  $nom=filtre($_POST['txtName']);
  if(strlen($nom)<=3) $r=1; 
}
if(isset($_POST['txtEmail'])) {
  $r = checkMail(filtre($_POST['txtEmail']));
  }
if(isset($_POST['txtMsg']))  {
  $msg=filtre($_POST['txtMsg']);
  if(strlen($msg)<=5) $r=1;
}

if($r==1) {
  $infosForm->addHoney();
  header("Location: https://histologe.beta.gouv.fr/");
  exit;
 }


$aff='
<!DOCTYPE html>
<html lang="fr"><head>
  <meta charset="utf-8">
  <meta name="description" content="Signalez un problème d\'habitabilité dans votre logement.">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="Histologe">
  <meta property="og:url" content="https://histologe.beta.gouv.fr">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Signalez un problème d\'habitabilité dans votre logement.">
  <meta property="og:site_name" content="Histologe">
  <meta name="twitter:title" content="Histologe">
  <meta name="twitter:description" content="Signalez un problème d\'habitabilité dans votre logement.">
  <meta name="apple-mobile-web-app-title" content="Histologe">

  <title>Histologe, un service public pour les locataires et les propriétaires</title>

  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" href="boot/css/bootstrap.css">
  <!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push([\'trackPageView\']);
  _paq.push([\'enableLinkTracking\']);
  (function() {
    var u="https://agglopau.matomo.cloud/";
    _paq.push([\'setTrackerUrl\', u+\'matomo.php\']);
    _paq.push([\'setSiteId\', \'1\']);
    var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];
    g.type=\'text/javascript\'; g.async=true; g.defer=true; g.src=\'//cdn.matomo.cloud/agglopau.matomo.cloud/matomo.js\'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->


  </head>

  <body>
 <div class="container">
    <header class="row">
    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top navbar-dark col-md-12 " >

            <a class="logoNav" href="Home"></a>
            <a class="logoNav2" href="Home"></a>
            <a class="logoNav3" href="Home"></a>
            <a class="menub" href="#id_menub" id="menu" onclick="agents(this.id)"></a>
            <a class="menubis" href="#id_menub_clos" id="menub_bis" style="display:none;" onclick="agents(this.id)"></a>
            <a class="menub_2" href="#id_menub_2" id="menu_2" onclick="agents_2(this.id)"></a>
            <a class="menubis_2" href="#id_menub_clos_2" id="menub_bis_2" style="display:none;" onclick="agents_2(this.id)"></a>
            <br><br><br>



            <nav class="collapse navbar-collapse text-dark navbarResp" role="navigation" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                <li class="nav-item text-dark">
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,\'accueil\');" onmouseout="chSitOff(this,\'accueil\');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,\'qui\');" onmouseout="chSitOff(this,\'qui\');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,\'contact\');" onmouseout="chSitOff(this,\'\');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,\'aide\');" onmouseout="chSitOff(this,\'aide\');"></a>
                </li>

                </ul>

            </nav>
    </nav>
    </header>

<!-- start content -->

    <div class="row">

      <div class="col-md-12 ft ">
        <div class="mx-auto text-center col-md-12 " id="tit1">
            <br><br><br><br>
            <div id="id_menub_clos_2" class="col-7 col-md-7 text-right">
            <div id="id_menub_2" class="col-7 col-md-7 text-left">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item text-dark">
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,\'accueil\');" onmouseout="chSitOff(this,\'accueil\');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,\'qui\');" onmouseout="chSitOff(this,\'qui\');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,\'contact\');" onmouseout="chSitOff(this,\'contact\');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,\'aide\');" onmouseout="chSitOff(this,\'aide\');"></a>
                </li>

                </ul>
            </div>
            </div>
            <h1 class="text-white w-100 display-6"><br><br>Merci de votre message.</h1><br><br>
            <p class="lead">L\'équipe Histologe vous contactera très rapidement. </p>
            <br><br><br>
          </div>
          <div class="mx-auto text-center col-md-12" id="tit2">
            <br><br><br>
            <div id="id_menub_clos" class="col-md-6 text-right">
            <div id="id_menub" class="col-md-6 text-left">
            <ul class="nav navbar-nav ml-auto">
            <li class="nav-item text-dark">
                <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,\'accueil\');" onmouseout="chSitOff(this,\'accueil\');"> &nbsp;&nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
              <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,\'qui\');" onmouseout="chSitOff(this,\'qui\');">&nbsp;&nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
              <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,\'contact\');" onmouseout="chSitOff(this,\'contact\');"> &nbsp;&nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
              <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,\'aide\');" onmouseout="chSitOff(this,\'aide\');"></a>
            </li>

            </ul>
            </div>
            </div>
            <h1 class="text-dark w-100 display-6"><br><br>Merci de votre message.</h1><br><br>
            <p class="lead text-dark">L\'équipe Histologe vous contactera très rapidement. </p>

          </div>
          <div class="mx-auto text-center col-md-12" id="tit3">
           <br><br><br><br>
           <h1 class="text-white w-100 display-6"><br><br>Merci de votre message.</h1><br><br>
           <p class="lead">L\'équipe Histologe vous contactera très rapidement. </p>
            <br>
            <br>

          </div>

     </div>
   </div>
   <!-- footer -->
<div class="row">
    <div class="col-md-12 text-center fo">
        <p class="mb-4">
           <br><br> <br><br><a href="cgu.php">Mentions légales</a> -
          <a href="https://www.agglo-pau.fr" target="_new">Communauté d\'agglomération Pau-Béarn Pyrénées</a> -
          <a href="https://https://www.cohesion-territoires.gouv.fr/lagence-nationale-de-la-cohesion-des-territoires"  target="_new"> Agence Nationale de la Cohésion des Territoires</a> -
          <a href="https://beta.gouv.fr"  target="_new">Beta Gouv</a> -
          <a href="contact.php">Contact</a></p>
            <div class="col-md-12 col-3 text-center">
            <a href="https://www.agglo-pau.fr"  target="_new"><img src="img/agglo.png" heigth=83 width=156></a> &nbsp;&nbsp;&nbsp;
            <a href="https://https://www.cohesion-territoires.gouv.fr/lagence-nationale-de-la-cohesion-des-territoires"  target="_new">
            <img src="img/anct.png" heigth=82 width=143> &nbsp;&nbsp;&nbsp;
            <a href="https://beta.gouv.fr"  target="_new"><img src="img/betagouv.png" heigth=82 width=154>
            </div>
        </p>

    </div>

  </div>
<!--end footer -->
</div>

<script>

function agents(id){
    if(document.getElementById("menub_bis").style.display ==""){
      document.getElementById("menub_bis").style.display ="none";
      document.getElementById("menu").style.display ="";
    }
    else if(document.getElementById("menu").style.display ==""){
      document.getElementById("menub_bis").style.display ="";
      document.getElementById("menu").style.display ="none";

    }
}

function agents_2(id){
    if(document.getElementById("menub_bis_2").style.display ==""){
      document.getElementById("menub_bis_2").style.display ="none";
      document.getElementById("menu_2").style.display ="";
    }
    else if(document.getElementById("menu_2").style.display ==""){
      document.getElementById("menub_bis_2").style.display ="";
      document.getElementById("menu_2").style.display ="none";

    }
}

</script>


  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/cookies.js"></script>
  


</html>

';
//fin $aff

$s = sendSignalement($mailDemandeur, $msg, $nom);

if($s==0) {
    //traiter si erreur
    echo $aff;
}

function checkMail($mail) {
  $t=0;
    $mail = htmlspecialchars($mail);
 
      if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $mail))
        {
          $t=0;
        }
      else
        {
          $t=1;;
        }
      return $t;
 
}




function sendSignalement($mailDemandeur, $msg, $nom) {
    //Import the PHPMailer class into the global namespace


//Create a new PHPMailer instance
$mailS = new PHPMailer;
//Tell PHPMailer to use SMTP
$mailS->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off 
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mailS->SMTPDebug = SMTP::DEBUG_OFF;

$mailS->Host = 'ns0.ovh.net';
$mailS->Port = 587;
$mailS->SMTPAuth = true;
$mailS->Username = 'contact@histologe.info';
$mailS->Password = 'Testeur64';

$mailS->setFrom('contact@histologe.info', 'Histologe Message');
$mailS->addReplyTo('contact@histologe.info', 'Histologe Message');
$mailS->CharSet = 'UTF-8';

//Set who the message is to be sent to
//$mailS->addAddress($mailSign);
$mailS->addAddress('alban.sestiaa@beta.gouv.fr', 'alban');
//Set the subject line
$mailS->Subject = 'Histologe : Message du formulaire';


$myMsg = 'Bonjour,<br>
    Vous avez reçu un nouveau message depuis le site :<br>
    Expéditeur : '.$nom.', '.$mailDemandeur.'<br><br>'.$msg;



$mailS->msgHTML($myMsg);
//Replace the plain text body with one created manually



$mailS->AltBody = '';


//send the message, check for errors
if (!$mailS->send()) {
   $t = 'Mailer Error: ' . $mailS->ErrorInfo;
} else {
   $t = 0;
}
return $t;

}

function filtre($lib) {
    $val=str_replace('\'', ' ', $lib);
    $val=str_replace('"',' ',$val);
    $val = str_replace(
       array('select', 'insert', 'update'), '*', $val);
    $val = str_replace(
        array( '\\',    "\0",   "'",    "\x8" , "\n",   "\r",   "\t",   "\x1A" ),
         array( '\\\\',  '\\0',  '\\\'', '\\b',          '\\n',  '\\r',  '\\t',  '\\Z' ),
       $val);
   $val = filter_var ( $val, FILTER_SANITIZE_STRING);

   return $val;

}