<?php
session_start();

if(isset($_GET['k'])) {
    $idKeyRelance=$_GET['k'];
} else {
   header("Location: https://histologe.beta.gouv.fr");  
   exit;
}




$_SESSION['user'] = session_id();
//ini_set('display_errors',1);




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
<!doctype html>
<html lang="fr" data-rf-reset>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/datep.css">
    <title>Histologe : un service de lutte contre le mal logement.</title>
  </head>
  <body>
   
      <!-- entete -->
        <header class="rf-header">
            <div class="rf-container">
                <div class="rf-header__body">
                    <div class="rf-header__brand">
                        <a class="rf-logo" href="#" title="République française">
                             <span class="rf-logo__title">République
                            <br>
                             française</span>
                        </a>
                    </div>
                    <div class="rf-header__operator">
                        <img src="images/capbp_logo_145.png" alt="HISTOLOGE" style="width:9.0625rem; height:auto;">
                    </div>
                
                    <div class="rf-header__navbar">
                        <div class="rf-service">
                            <a class="rf-service__title" href="Home" title="Histologe">
                                HISTOLOGE
                            </a>
                            <p class="rf-service__tagline"></p>
                        </div>
                    </div>
                    <div class="rf-header__tools">
                        <div class="rf-shortcuts">
                            <ul class="rf-shortcuts__list">
                       
                            <li class="rf-shortcuts__item">
                                    <a href="Home" class="rf-link rf-fi-arrow-left-s-line" target="_self">Accueil</a>
                                </li>
                                <li class="rf-shortcuts__item">
                                    <a href="Qui" class="rf-link rf-fi-user-line" target="_self">Qui sommes-nous ?</a>
                                </li>
                                <li class="rf-shortcuts__item">
                                    <a href="Contact" class="rf-link rf-fi-mail-line" target="_self">Contact</a>
                                </li>
                                <li class="rf-shortcuts__item">
                                    <a href="Aide" class="rf-link rf-fi-question-line" target="_self">Aide</a> &nbsp;
                                </li>
                            </ul>
                        </div>
                    
                    </div>
                </div>
            </div>
        </header>
        <!-- fin entete -->

        <div class="rf-container-fluid">
            <div class="rf-grid-row rf-grid-row--gutters rf-grid-row--center">
              <div class="rf-col-12">
                <!-- start -->
           
   <H2>Merci de prendre quelques minutes pour compléter votre signalement</h2>
   <input type="hidden" id="sign" value="<?php echo $tab[0]->idSignalement;?>">
   Point rouge = obligatoire, Point jaune = facultatif
            <?php
            if(isset($_GET['p'])) echo '<H2>Photos bien enregistrées ! Merci.</H2><br>';
            ?>

<?php
   if($tab[0]->proprio_info =='n') {
    echo ' 
        <br><br>
        <span id="info1">
        <img src="images/s4.png" width=50 heigth=50> <b>Il reste nécessaire d\'avertir le propriétaire de votre logement.</b> <br><br>
        <span class="rf-fi-information-line"> Besoin d\'aide pour cela ? </span>
        <a href="#" id="avert">Cliquez ici.</a> <br><br>
        </span>
       
        <div class="rf-highlight" id="detAlert" style="display: none; text-align: justify;">
        A la question « avez-vous averti votre propriétaire », vous avez répondu « non ».<br>
        Cependant, pour pouvoir entamer une procédure, le locataire doit impérativement envoyer au propriétaire, à l’agence immobilière ou au bailleur social, 
        un courrier par lettre recommandée avec avis de réception présentant les différentes conditions de logement indécentes et indiquant la nécessité de faire des travaux.<br><br>
        La prise en charge par Histologe est conditionnée par la preuve que le propriétaire a été averti.  <br>
        C’est pourquoi, afin de pouvoir prendre en charge votre dossier, nous vous invitons à transmettre un courrier en recommandé avec accusé de réception indiquant à votre bailleur les difficultés que vous rencontrez dans votre logement et votre demande d’y remédier. 
        <br><br>
        Nous vous avons transmis par courriel un modèle de lettre pour lister à votre bailleur les points de non-décence que vous rencontrez. 
        <br>Vous pouvez l\'imprimer et la transmettre en recommandé avec accusé de réception au propriétaire de votre lorgement.
        <br><br>
        </div>
       
        
        <span class="rf-fi-information-line" style="color: red;"> 
        <a href="#stComp" id="prop">Vous avez réalisé cette action ? Cliquez ici.</a>
        </span>
        <br><br>
        <span id="validProp" style="display: none;" class="rf-highlight">
        <b>Je certifie sur l\'honneur avoir averti le propriétaire du logement des désordres signalés.</b><br>
        Je l\'ai informé par :<br><br>
        <div class="rf-toggle rf-toggle--border-bottom">
            <input type="checkbox" class="rf-toggle__input" id="propOk_AR" name="propOk_AR">
            <label class="rf-toggle__label" for="propOk_AR" data-rf-checked-label="Activé" data-rf-unchecked-label="Désactivé">
            Courrier recommandé avec accusé de réception.</label>
         </div>

        <div class="rf-toggle rf-toggle--border-bottom">
        <input type="checkbox" class="rf-toggle__input" id="propOk_mail" name="propOk_mail">
        <label class="rf-toggle__label" for="propOk_mail" data-rf-checked-label="Activé" data-rf-unchecked-label="Désactivé">
        Courriel.</label>
        </div>

        <div class="rf-toggle rf-toggle--border-bottom">
        <input type="checkbox" class="rf-toggle__input" id="propOk_poste" name="propOk_poste">
        <label class="rf-toggle__label" for="propOk_poste" data-rf-checked-label="Activé" data-rf-unchecked-label="Désactivé">
        Courrier postal.</label>
        </div>
  
        <div class="rf-toggle rf-toggle--border-bottom">
        <input type="checkbox" class="rf-toggle__input" id="propOk_site" name="propOk_site">
        <label class="rf-toggle__label" for="propOk_site" data-rf-checked-label="Activé" data-rf-unchecked-label="Désactivé">
        Site web de l\'agence de location ou du bailleur social.</label>
        </div>

        <div class="rf-toggle rf-toggle--border-bottom">
        <input type="checkbox" class="rf-toggle__input" id="propOk_tel" name="propOk_tel">
        <label class="rf-toggle__label" for="propOk_tel" data-rf-checked-label="Activé" data-rf-unchecked-label="Désactivé">
        Téléphone.</label>
        </div>
  
   
        <div class="date">Date d\'information du propriétaire : 
                <input id="datepicker" data-date-format="dd/mm/yyyy" width="176" class="datepicker" placeholder="jj/mm/yyyy" value=""> 
        </div>
        <br>
        <a href="#" id="valid1" class="rf-btn">Valider</a>
            
        </span>
      <div class="rf-callout rf-fi-information-line" id="errInfoProp" style="color : red; display: none;">
        <h4 class="rf-callout__title"></h4>
        <p class="rf-callout__text">Merci de bien vouloir renseigner la façon dont vous avez informé le propriétaire ainsi que la date.
        </p>
        </div>
      
        <span id="text_certifOK" style="display: none;">Enregistré ! 
        <br>J\'ai certifié sur l\'honneur avoir averti le propriétaire du logement des désordres signalés.
        <br><br>
        <a href="#" id="annul" class="btn btn-primary btn-lg">Annuler</a>
         </span>';

                }
                ?>


    
       <br> <br>
       <?php
   
   if($tab[0]->infoNrj =='' || $tab[0]->infoNrj == '?') {
        echo '
            
       <span id="modeN"><img src="images/s4.png" width=50 heigth=50> <b>Précisez le mode de chauffage du logement</b>  <br><br></span>
       <span id="modeOK" style="display: none;">Enregistré !</span>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <span id="modeAlim">
        <input type="radio" class = "groupcheckbox" name="alim" id="alim1" value="elect"> 
         <b>Electrique</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" class = "groupcheckbox" name="alim" id="alim2" value="gaz"> 
         <b>Gaz</b>
         </span>
        <span id="annulModeN" style="display: none;"> <a href="#" id="annulMode" class="rf-btn">Annuler</a></span>
       
       
       
       <br><br>';
            }
            ?>       

    <form class="form-register" action="morePhotos" enctype="multipart/form-data" method="post" name="addPhotos" id="addPhotos">    
       <input type="hidden" id="signId" name="signId" value="<?php echo $tab[0]->idSignalement;?>">
       <input type="hidden" id="k" name="k" value="<?php echo $idKeyRelance;?>">
        <img src="images/s2.png" width=50 heigth=50> <b>Pouvez-vous ajouter des photos de la situation ?</b> 
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
                <span id="sPh"> <a href="#phA" id="sendPh" class="rf-btn">Envoyer ces photos</a></span>

                <div id="waitPh" style="display: none;">
                    <img src="images/charge.gif" width=30 heigth=30>
                    <button type="button" class="btn btn-primary btn-lg btn-block" disabled="disabled">
                    Documents en cours d'enregistrement, merci de patienter.
                    <br>La durée peut varier en fonction du nombre de photos envoyées.
                    </button>
                </div>


          </fieldset>
		</div>
        </form>
        
                <!-- end -->




               
              </div>
            </div>
          </div>
       <br><br>
        

   

        <!-- Pied de page -->
        <footer class="rf-footer" role="contentinfo" id="footer">
            <div class="rf-container">
                <div class="rf-footer__body">
                    <div class="rf-footer__brand">
                        <a class="rf-logo" href="#" title="république française">
                            <span class="rf-logo__title">république
                                <br>française</span>
                        </a>
                        
                    </div>
                    
                    <div class="rf-footer__content">
                        <p class="rf-footer__content-desc">
                           <img src="images/Logohistologe.png" width="200" height="53" alt="Histologe" title="Histologe" style="float: right;">
                        </p>
                        <ul class="rf-footer__content-list">
                            <li>
                                <a class="rf-footer__content-link" href="http://legifrance.gouv.fr">legifrance.gouv.fr</a>
                            </li>
                            <li >
                                <a class="rf-footer__content-link" href="http://gouvernement.fr">gouvernement.fr</a>
                            </li>
                            <li >
                                <a class="rf-footer__content-link" href="http://service-public.fr">service-public.fr</a>
                            </li>
                            <li >
                                <a class="rf-footer__content-link" href="http://data.gouv.fr">data.gouv.fr</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="rf-footer__bottom">
                    <ul class="rf-footer__bottom-list">
                    <li class="rf-footer__bottom-item">
                            <a class="rf-footer__bottom-link" href="Plan-du-site">Plan du site</a>
                        </li>
                        <li class="rf-footer__bottom-item">
                            <a class="rf-footer__bottom-link" href="CGU">Accessibilité: partiellement</a>
                        </li>
                        <li class="rf-footer__bottom-item">
                            <a class="rf-footer__bottom-link" href="CGU">Mentions légales</a>
                        </li>
                        <li class="rf-footer__bottom-item">
                            <a class="rf-footer__bottom-link" href="CGU">Données personnelles</a>
                        </li>
                        <li class="rf-footer__bottom-item">
                            <a class="rf-footer__bottom-link" href="CGU">Gestion des cookies</a>
                        </li>
                    </ul>
                    <div class="rf-footer__bottom-copy">
                        © République Française 2021
                    </div>
                </div>
            </div>
        </footer>
        <!-- fin de pied de page-->

   

    <script src="js/all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/datep.js"></script>
    <script src="js/cookies.js"></script>
  <script>document.addEventListener('DOMContentLoaded', function(event) { cookieChoices.showCookieConsentBar('Ce site utilise des cookies pour vous offrir le meilleur service. En poursuivant votre navigation, vous acceptez l\’utilisation des cookies.','J\’accepte', 'En savoir plus', 'https://histologe.beta.gouv.fr/cgu.php'); });</script> 

  </body>
</html>