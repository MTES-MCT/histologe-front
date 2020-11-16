<?php
session_start();

if(isset($_GET['k'])) {
    $idKeyRelance=$_GET['k'];
} else {
    header("Location: https://histologe.beta.gouv.fr");  
    exit;
}




$_SESSION['user'] = session_id();
ini_set('display_errors',1);




require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);

$infosForm->insertUserActivity($_SESSION['user'], 4, 'before', $_SERVER['HTTP_USER_AGENT'] );

$tab = $infosForm->getSignByKeyRelance($idKeyRelance);
if(empty($tab)) {
    header("Location: https://histologe.beta.gouv.fr");  
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr"><head>
  <meta charset="utf-8">
  <meta name="description" content="Signalez un problème d'habitabilité dans votre logement.">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="Histologe">
  <meta property="og:url" content="https://histologe.beta.gouv.fr">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Signalez un problème d'habitabilité dans votre logement.">
  <meta property="og:site_name" content="Histologe">
  <meta name="twitter:title" content="Histologe">
  <meta name="twitter:description" content="Signalez un problème d'habitabilité dans votre logement.">
  <meta name="apple-mobile-web-app-title" content="Histologe">

  <title>Histologe, un service public pour les locataires et les propriétaires</title>

  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" href="css/comp.css">
  <link rel="stylesheet" href="css/datep.css">
  
  
<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="https://agglopau.matomo.cloud/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src='//cdn.matomo.cloud/agglopau.matomo.cloud/matomo.js'; s.parentNode.insertBefore(g,s);
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
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,'accueil');" onmouseout="chSitOff(this,'accueil');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,'contact');" onmouseout="chSitOff(this,'contact');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,'aide');" onmouseout="chSitOff(this,'aide');"></a>
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
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,'accueil');" onmouseout="chSitOff(this,'accueil');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,'contact');" onmouseout="chSitOff(this,'contact');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,'aide');" onmouseout="chSitOff(this,'aide');"></a>
                </li>

                </ul>

            </div>
            </div>
          </div>
          <div class="mx-auto text-center col-md-12" id="tit2">
            <br><br><br>
            <div id="id_menub_clos" class="col-md-6 text-right">
            <div id="id_menub" class="col-md-6 text-left">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item text-dark">
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,'accueil');" onmouseout="chSitOff(this,'accueil');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,'contact');" onmouseout="chSitOff(this,'contact');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,'aide');" onmouseout="chSitOff(this,'aide');"></a>
                </li>

                </ul>

            </div>
            </div>
          </div>

     </div>
   </div>
 </div>




  
  <div class="container">
    <div class="row">
      <div class="mx-auto text-center col-12">

        <p class="lead text-primary text-white">
        <br><br><br><br><br><br>
   <H1>Merci de prendre quelques minutes pour compléter votre signalement</h1>
   <input type="hidden" id="sign" value="<?php echo $tab[0]->idSignalement;?>">
   Point rouge = obligatoire, Point orange = facultatif
        </p>
<?php
if(isset($_GET['p'])) echo '<H2>Photos bien enregistrées ! Merci.</H2><br>';
?>
    
      </div>
</div>
<br><br>
<div class="row">
   <div class="col-2">&nbsp;</div>
   <div class="col-6">
   <?php
   if($tab[0]->proprio_info =='n') {
    echo ' <div class="row">
      <div class="tab2" id="allProp">
        <span id="info1">
        <img src="img/s4.png" width=50 heigth=50> <b>Il reste nécessaire d\'avertir le propriétaire de votre logement.</b> <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;<img src="img/quest_w.png"> Besoin d\'aide pour cela ? 
        <a href="#stComp" id="avert">Cliquez ici.</a> <br><br>
        </span>
        <span id="detAlert" style="display: none;"> <iframe width="100%" height="200" src="infoProprio.html" frameborder="1" scrolling="yes"></iframe></span>
        &nbsp;&nbsp;&nbsp;&nbsp;<a href="#stComp" id="prop"><img src="img/quest_w.png"> Vous avez réalisé cette action ? Cliquez ici.</a><br><br>
        <span id="validProp" style="display: none;" class="material-switch">
        <b>Je certifie sur l\'honneur avoir averti le propriétaire du logement des désordres signalés.</b><br>
        Je l\'ai informé par :<br><br>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="checkbox" class = "groupcheckbox" name="propOk_AR" id="propOk_AR"> 
                 <label for="propOk_AR" class="label-primary"></label> Courrier recommandé avec accusé de réception.<br><br>
                 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="checkbox" class = "groupcheckbox" name="propOk_mail" id="propOk_mail"> 
                <label for="propOk_mail" class="label-primary"></label> Courriel.<br><br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" class = "groupcheckbox" name="propOk_poste" id="propOk_poste"> 
                <label for="propOk_poste" class="label-primary"></label > Courrier postal.<br><br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" class = "groupcheckbox" name="propOk_site" id="propOk_site"> 
                 <label for="propOk_site" class="label-primary"></label> Site web de l\'agence de location ou du bailleur social.<br><br>
                 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" class = "groupcheckbox" name="propOk_tel" id="propOk_tel"> 
                <label for="propOk_tel" class="label-primary"></label> Téléphone.  <br><br>  
                <div class="input-group date"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Date d\'information du propriétaire : 
                    <input id="datepicker" data-date-format="dd/mm/yyyy" width="176" class="datepicker" placeholder="dd/mm/yyyy" value=""> </span>
                </div>
                <span class="text-white">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Je certifie sur l\'honneur avoir averti le propriétaire du logement des désordres signalés.  </span>  
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="#" id="valid1" class="btn btn-primary btn-lg">Valider</a>
            
        </span>
        <span class="text-white" id="text_certifKO" style="display: none;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Je certifie sur l\'honneur avoir averti le propriétaire du logement des désordres signalés.  
        </span>  
        <span id="text_certifOK">Enregistré ! <br><br>J\'ai certifié sur l\'honneur avoir averti le propriétaire du logement des désordres signalés.<br>
        <a href="#" id="annul" class="btn btn-primary btn-lg">Annuler</a>
         </span></div> 

         </div>';

                }
                ?>


    
       <br> <br>
       <?php
   
   if($tab[0]->infoNrj =='' || $tab[0]->infoNrj == '?') {
        echo '
       <div class="row"> 
       <div class="tab2">
      
        <span id="modeN"><img src="img/s4.png" width=50 heigth=50> <b>Précisez le mode de chauffage du logement</b>  <br><br></span>
       <span id="modeOK" style="display: none;">Enregistré !</span>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" class = "groupcheckbox" name="alim" id="alim1" value="elect"> 
         <b>Electrique</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" class = "groupcheckbox" name="alim" id="alim2" value="gaz"> 
         <b>Gaz</b>
        <span id="annulModeN" style="display: none;"> <a href="#" id="annulMode" class="btn btn-primary btn-lg">Annuler</a></span>
        <span class="text-white">avoir avoir averti le propriétaire du logement des désordres signalés.  </span>  
       
       </div>
       </div>
       <br><br>';
            }
            ?>


       <div class="row" id="phA">
       <div class="tab2">
       <form class="form-register" action="morePhotos" enctype="multipart/form-data" method="post" name="addPhotos" id="addPhotos">
       <input type="hidden" id="signId" name="signId" value="<?php echo $tab[0]->idSignalement;?>">
       <input type="hidden" id="k" name="k" value="<?php echo $idKeyRelance;?>">
        <img src="img/s2.png" width=50 heigth=50> <b>Pouvez-vous ajouter des photos de la situation ?</b> 
        <div class="file-path-wrapper">
			<fieldset>
                <br>
				<input type="file" class="form-control-file" id="File1" name="file1" accept="image/*" >
				<input type="file" class="form-control-file" id="File2" name="file2" accept="image/*" >
                <input type="file" class="form-control-file" id="File3" name="file3" accept="image/*" >
            <br>
       
        		<input type="file" class="form-control-file" id="File4" name="file4" accept="image/*" >
				<input type="file" class="form-control-file" id="File5" name="file5" accept="image/*" >
				<input type="file" class="form-control-file" id="File6" name="file6" accept="image/*" >
                <div class="text-blue">Les photos ne doivent pas contenir de vues de personnes ou d'objets personnels.</div>
                <br>
                <span id="sPh"> <a href="#phA" id="sendPh" class="btn btn-primary btn-lg">Envoyer</a></span>

                <div id="waitPh" style="display: none;">
                    <img src="img/charge.gif" width=30 heigth=30>
                    <button type="button" class="btn btn-primary btn-lg btn-block" disabled="disabled">
                    Documents en cours d'enregistrement, merci de patienter.
                    <br>La durée peut varier en fonction du nombre de photos envoyées.
                    </button>
                </div>


          </fieldset>
		</div>
        </form>


        <span class="text-white">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Je certifie sur l'honneur avoir averti le propriétaire du logement des désordres signalés.  </span>  
        </div>
        </div>

<br><br>
    
    </div>  
    <div class="col-4" id="illus4"><img src="img/Illus4.png"></div>

</div>
  </div>

  <br><br><br>
  <br><br><br>


<!-- end content -->
 <!--end container -->
<!-- part1 -->
<div class="py-5 bg-primary" style="margin-top:-100px;">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">






      </div>
      <div class="col-md-2">
      </div>
  </div>
</div>







  </div>


        </div>




<!--end Part1 -->





<!-- footer -->
<div class="row">
    <div class="col-md-12 text-center fo">
        <p class="mb-4">
           <br><br> <br><br><a href="CGU">Mentions légales</a> -
          <a href="https://www.agglo-pau.fr" target="_new">Communauté d'agglomération Pau-Béarn Pyrénées</a> -
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
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
 <script src="js/datep.js"></script>
  <script src="js/checkNew.js"></script>
  
</html>
