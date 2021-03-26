<?php
session_start();

if ($_SESSION['sign_valid'] != 'ok') {
  header("Location:Home");
}
?>
<!doctype html>
<html lang="fr" data-rf-reset>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/all.min.css">
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
              <div class="rf-col-10" style="text-align: center;">
               
              <div class="rf-callout rf-fi-information-line">
                <h4 class="rf-callout__title">Signalement enregistré !</h4>
                <p class="rf-callout__text">
                Merci de votre signalement. Un courriel de confirmation va vous être transmis. <br>
          L'équipe Histologe vous recontactera très rapidement.
                </p>
            </div> 

              </div>
            </div>
          </div>
     

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
                        <img src="images/Logohistologe.png" width="200" height="53" alt="Histologe" title="Histologe"> &nbsp;
                           <a href="https://agence-cohesion-territoires.gouv.fr/" target="_new"><img src="images/logo_ANCT_header.svg"></a>
                        
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
    <script src="js/nav.js"></script>
    <script src="js/cookies.js"></script>
  <script>document.addEventListener('DOMContentLoaded', function(event) { cookieChoices.showCookieConsentBar('Ce site utilise des cookies pour vous offrir le meilleur service. En poursuivant votre navigation, vous acceptez l\’utilisation des cookies.','J\’accepte', 'En savoir plus', 'https://histologe.beta.gouv.fr/cgu.php'); });</script> 

  </body>
</html>

<?php
session_destroy();
?>
