<?php
session_start();
$_SESSION['user'] = session_id();
ini_set('display_errors',1);
require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);

$infosForm->insertUserActivity($_SESSION['user'], 0, 'after', $_SERVER['HTTP_USER_AGENT'] );

$tab = $infosForm->getListSituations();

?>

<!doctype html>
<html lang="fr" data-rf-reset>
  <head>
    <meta charset="utf-8">
    <meta property="og:title" content="Histologe">
        <meta property="og:url" content="https://histologe.beta.gouv.fr">
        <meta property="og:type" content="website">
        <meta property="og:description" content="Signalez un problème d'habitabilité dans votre logement.">
        <meta property="og:site_name" content="Histologe">
        <meta name="twitter:title" content="Histologe">
        <meta name="twitter:description" content="Signalez un problème d'habitabilité dans votre logement.">
        <meta name="apple-mobile-web-app-title" content="Histologe">

        <title>Histologe, un service public pour les locataires et les propriétaires</title>

        <link rel="icon" type="image/x-icon" href="images/favicon.ico">

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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/histo.css">
  </head>
  <body> 
  <a id="h">
   
      
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

            <!-- debut grille full -->  
            <div class="rf-col-xs-10 rf-col-sm-10 rf-col-md-10 rf-col-lg-10 rf-col-xl-10" id="step1">

            <!-- ariane -->
            <nav class="rf-breadcrumb" aria-label="vous êtes ici :">
                <button class="rf-breadcrumb__button" hidden>Voir le fil d’Ariane</button>
                <ol class="rf-breadcrumb__list">
                    <li class="rf-breadcrumb__item">
                        <a href="Home">Accueil</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Etape 1 de votre signalement</a>
                    </li>
                
                </ol>
            </nav>
            <!-- fi ariane -->
            
            <!-- start step 1 -->
            <form class="form-register" action="signFinish2.php" enctype="multipart/form-data" method="post" name="signale" id="signale">
            <div class="rf-callout">
              <p class="rf-callout__text">
              <h2 class="rf-text--lg">Signaler un problème dans votre logement</h2> 
               Etape 1 sur 4 : Description de la situation 
                </p>
            </div>

            <!-- start crits -->
            
            <?php
            $x=0; $aff='';
            foreach ($tab as $key) {
              $aff = '
               <div class="rf-col-xs-10 rf-col-sm-10 rf-col-md-10 rf-col-lg-10 rf-col-xl-10"> 
               <h3 class="rf-text--lg"> Votre signalement concerne-t-il '.$tab[$x]->libSituation.' ?</h3>
               </div>';
               
                //start criteres
                $y=0; $f=0;
                $tab2 = $infosForm->getCriteres($tab[$x]->idSituation_pb);
                $aff=$aff.'<table>';
                foreach ($tab2 as $key) {
                  $aid='';
                  $tab3 = $infosForm->getCriticites($tab2[$y]->idCritere);
                      if($tab2[$y]->descCritere!='') $aid= $tab2[$y]->descCritere;

                      $aff=$aff.'<tr><td valign="top">
                      <div class="material-switch">
                       <input id="'.$tab2[$y]->libCritere.'" onclick="chAff(\'smil_c'.$tab2[$y]->idCritere.'\');" name="c_'.$tab2[$y]->idCritere.'" 
                       type="checkbox" class = "groupcheckbox" data-toggle="tooltip" data-placement="top"/>                        
                       <label class="rf-label" for="'.$tab2[$y]->libCritere.'" ></label>
                       </div></td>
                       <td valign="top">&nbsp;'.$tab2[$y]->libCritere.'<br>
                       <div id="smil_c'.$tab2[$y]->idCritere.'" style="display:none" class="lib1">
                       
                        Comment évaluez-vous l\'état de cette partie de votre logement ?<br>
                        Quand tout va bien : '.$aid.'<br>
                        <input type="hidden" name="criticite'.$tab2[$y]->idCritere.'" value="0">
                        <table><tr><td>
                        <img class="siml1" id="img1_c'.$tab2[$y]->idCritere.'" src="images/s2_off.png" onclick="changeImage(\'img1_c'.$tab2[$y]->idCritere.'\', \'img2_c'.$tab2[$y]->idCritere.'\', \'img3_c'.$tab2[$y]->idCritere.'\', \''.$tab3[0]->idCriticite.'\', \'criticite'.$tab2[$y]->idCritere.'\');" title="MOYEN" width=50 height=50>
                        </td><td valign="middle">
                        <b> Etat moyen : </b>'.$tab3[0]->libCriticite.'
                        </td></tr>                        
                        <tr><td>
                        <img class="siml1" id="img2_c'.$tab2[$y]->idCritere.'" src="images/s4_off.png" onclick="changeImage(\'img2_c'.$tab2[$y]->idCritere.'\', \'img1_c'.$tab2[$y]->idCritere.'\', \'img3_c'.$tab2[$y]->idCritere.'\', \''.$tab3[1]->idCriticite.'\', \'criticite'.$tab2[$y]->idCritere.'\');" width=50 height=50 title="GRAVE">
                        </td>
                        <td valign="middle"><b>Mauvais état : </b>'.$tab3[1]->libCriticite.'
                        </td></tr>                        
                        <tr><td>
                        <img class="siml1" id="img3_c'.$tab2[$y]->idCritere.'" src="images/s5_off.png" onclick="changeImage(\'img3_c'.$tab2[$y]->idCritere.'\', \'img1_c'.$tab2[$y]->idCritere.'\', \'img2_c'.$tab2[$y]->idCritere.'\', \''.$tab3[2]->idCriticite.'\', \'criticite'.$tab2[$y]->idCritere.'\');" width=50 height=50 title="TRES GRAVE">
                        <td valign="middle"><b>Très mauvais état : </b>'.$tab3[2]->libCriticite.'
                        </td></tr></table>
                        
                    
                       </div> 
                       <br>
                       </td>
                       </tr> 
                    
                    ';

                   $y++;

                  }

                  echo $aff.'</table><br>';
           

              $x++;
            }


         ?>
        


            <!-- end Crits -->
            
            
       
        
        <a id="e1">
        <div class="rf-col-12">
         <a href="#e1" id="stepnext2" class="rf-btn">Continuer</a>
        </div>
      
        <div class="rf-callout rf-fi-information-line" style="display : none; color : red;" id="errCrits">
                <h4 class="rf-callout__title">Information</h4>
                <p class="rf-callout__text">
                Merci de sélectionner au moins un critére.
                 </p>
               
            </div>


        </div> <!-- fin step1 -->
          <!-- start step 2 --> 
          <div class="rf-col-xs-10 rf-col-sm-10 rf-col-md-10 rf-col-lg-10 rf-col-xl-10" style="display: none;" id="step2">
            <!-- ariane -->
            <nav class="rf-breadcrumb" aria-label="vous êtes ici :">
                <button class="rf-breadcrumb__button" hidden>Voir le fil d’Ariane</button>
                <ol class="rf-breadcrumb__list">
                    <li class="rf-breadcrumb__item">
                        <a href="Home">Accueil</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#" id="s11">Etape 1 de votre signalement</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Etape 2</a>
                    </li>
                
                </ol>
            </nav>
            <!-- fi ariane -->
            <div class="rf-callout">
              <p class="rf-callout__text">
              <h2 class="rf-text--lg">Signaler un problème dans votre logement</h2> 
               Etape 2 sur 4 : Description de la situation suite
                </p>
            </div>
                <br><br>
               <div class="rf-input-group">
                    <label class="rf-label lib2" for="textarea"><b>Décrivez le ou les problèmes rencontrés *</b></label>
                    <textarea class="rf-input" id="desc" name="desc" rows="5"></textarea>
                </div>
			<br><br><b>Téléverser des photos des problèmes</b><br>
				<input type="file" class="form-control-file" id="File1" name="file1" accept="image/*" ><br>
				<input type="file" class="form-control-file" id="File2" name="file2" accept="image/*" ><br>
        <input type="file" class="form-control-file" id="File3" name="file3" accept="image/*" >

        <div id="photo"><br>Ajouter plus de photos ?</div>
        <div>Les photos ne doivent pas contenir de vues de personnes ou d'objets personnels.<br>
            Pour les photos des parties communes, <a href="#compS2" id="restric" class="text-soulign">certaines restrictions sont à respecter</a>.
            <span id="resticView" style="display: none;">Sont interdites les photographies présentant un élément d'identification : 
            <ul><li>d'une personne,</li>
            <li>d'une ou plusieurs boites aux lettres,</li>
            <li>d'élèments extérieurs,</li>
            <li>de numéros d'appartements,</li>
            <li>de noms de propriètaires ou locataires de logements.</li>
            </ul>
            </span>
        </div>
				<div id="morephoto" style="display:none;">
				<input type="file" class="form-control-file" id="File4" name="file4" accept="image/*" ><br>
				<input type="file" class="form-control-file" id="File5" name="file5" accept="image/*" ><br>
				<input type="file" class="form-control-file" id="File6" name="file6" accept="image/*" ><br>
	    		</div>
        
        
        <a id="e2">
        <div class="rf-col-12">
        <a href="#e2" id="stepnext3" class="rf-btn">Continuer</a>
        </div>
        
        <div class="rf-callout rf-fi-information-line" style="display : none; color : red;" id="errDesc">
                <h4 class="rf-callout__title">Information</h4>
                <p class="rf-callout__text">
                Merci de renseigner une rapide description.
                 </p>
         </div>



        </div> <!-- fin step 2 -->


         <!-- start step 3 --> 
         <div class="rf-col-10" style="display: none;" id="step3">
            <!-- ariane -->
            <nav class="rf-breadcrumb" aria-label="vous êtes ici :">
                <button class="rf-breadcrumb__button" hidden>Voir le fil d’Ariane</button>
                <ol class="rf-breadcrumb__list">
                    <li class="rf-breadcrumb__item">
                        <a href="Home">Accueil</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#" id="s12">Etape 1 de votre signalement</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#" id="s21">Etape 2</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Etape 3</a>
                    </li>
                
                </ol>
            </nav>
            <!-- fin ariane -->
            <div class="rf-callout">
              <p class="rf-callout__text">
              <h2 class="rf-text--lg">Signaler un problème dans votre logement</h2> 
               Etape 3 sur 4 : Contexte de votre signalement
                </p>
            </div>
                <br><br>
            <div class="rf-form-group">
                    <fieldset class="rf-fieldset rf-fieldset--inline" id="fieldProp">
                        <legend class="rf-fieldset__legend">Avez-vous informé le propriétaire de ces nuisances ? *</legend>
                        <div class="rf-fieldset__content">
                            <div class="rf-radio-group">
                                <input type="radio" id="infoPr-1" name="infoPr" value='o'>
                                <label class="rf-label" for="infoPr-1">OUI</label>
                            </div>
                            <div class="rf-radio-group">
                                <input type="radio" id="infoPr-2" name="infoPr" value='n'>
                                <label class="rf-label" for="infoPr-2">NON</label>
                            </div>
                           
                        </div>
                    </fieldset>
                </div>


    			<B>Qui habite dans ce logement ?  </b>
				<div><label class="rf-label" for="nbAdults">Nombre d'adultes</label>
											<select class="rf-select" name="nbAdults" id="nbAdults">
											<option value="t" disabled selected>Choisir...</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="+4">+ de 4</option>
                                        </select>
            </div>
            <div>
                     <label class="rf-label" for="nbEnfants">Nombre d'enfants</label>
											<select class="rf-select" name="nbEnfants" id="nbEnfants">
											<option value="0" selected>0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="+4">+ de 4</option>
										</select>
                    
                 </div>
<br><br>
                 <div class="rf-form-group">
                    <fieldset class="rf-fieldset rf-fieldset--inline" id="fieldSoc">
                        <legend class="rf-fieldset__legend">S'agit-il d'un logement social ? *</legend>
                        <div class="rf-fieldset__content">
                            <div class="rf-radio-group">
                                <input type="radio" id="log-1" name="logSoc" value="oui">
                                <label class="rf-label" for="log-1">OUI</label>
                            </div>
                            <div class="rf-radio-group">
                                <input type="radio" id="log-2" name="logSoc" value="non">
                                <label class="rf-label" for="log-2">NON</label>
                            </div>
                           
                        </div>
                    </fieldset>
                </div>



<div class="rf-form-group">
                    <fieldset class="rf-fieldset rf-fieldset--inline" id="departLogBloc">
                        <legend class="rf-fieldset__legend">Avez-vous déposé un préavis de départ pour ce logement ? *</legend>
                        <div class="rf-fieldset__content">
                            <div class="rf-radio-group">
                                <input type="radio" id="Dlog-1" name="departLog" value="oui">
                                <label class="rf-label" for="Dlog-1">OUI</label>
                            </div>
                            <div class="rf-radio-group">
                                <input type="radio" id="Dlog-2" name="departLog" value="non">
                                <label class="rf-label" for="Dlog-2">NON</label>
                            </div>
                           
                        </div>
                    </fieldset>
                </div>

<br><br>
                
				<label class="rf-label" for="nom"><b>Votre nom et prénom *</b></label>
                <input class="rf-input" type="text" name="nom" id="nom" placeholder="Nom">    
				<input class="rf-input" type="text" name="prenom" id="prenom" placeholder="Prénom">
<br>
                <label class="rf-label" for="mail"><b>Votre adresse courriel *</b></label>
                <input class="rf-input" type="text" name="mail" id="mail" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="exemple@courriel.fr">    
<br>          
                <label class="rf-label" for="phone"><b>Téléphone </b></label>
                <input class="rf-input" type="text" name="phone" id="phone"> 
<br>               
                <label class="rf-label" for="num"><b>Adresse du logement * </b></label>
                <input type="text" class="rf-input" id="num" name="numero" placeholder="Numéro">
                <input type="text" class="rf-input" id="libAd" name="libAd" placeholder="Rue, Chemin, Place, ...">
                <input type="text" class="rf-input" id="etage" name="etage" placeholder="Etage">
                <input type="text" class="rf-input" id="numApt" name="numApt" placeholder="Numéro appartement">
				<input type="text" class="rf-input" id="cp" name="cp" placeholder="Code postal">
				<input type="text" class="rf-input" id="ville" name="ville" placeholder="Ville">
<br><br>
        <a id="e3">
        <div class="rf-col-10">
        <a href="#e3" id="stepnext4" class="rf-btn">Continuer</a>
        </div>
        
        <div class="rf-callout rf-fi-information-line" style="display : none; color : red;" id="errInfos">
                <h4 class="rf-callout__title">Information</h4>
                <p class="rf-callout__text" id="errInfosDesc"></p>
         </div>
		   <!-- fin step 3 -->
            </div>

        <!-- step 4 -->
        <div id="step4" class="rf-col-10" style="display: none;" >
            <!-- ariane -->
            <nav class="rf-breadcrumb" aria-label="vous êtes ici :">
                <button class="rf-breadcrumb__button" hidden>Voir le fil d’Ariane</button>
                <ol class="rf-breadcrumb__list">
                    <li class="rf-breadcrumb__item">
                        <a href="Home">Accueil</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#" id="s13">Etape 1 de votre signalement</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#" id="s22">Etape 2</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#" id="s31">Etape 3</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Enregistrement</a>
                    </li>
                
                </ol>
            </nav>
            <!-- fin ariane -->

            <div class="rf-callout">
              <p class="rf-callout__text">
              <h2 class="rf-text--lg">Signaler un problème dans votre logement</h2> 
               Etape 4 sur 4 : Validation et enregistrement.
                </p>
            </div>
          <div id="recap"></div>
          <div id="upload_on" style="display:block;">

          <div class="rf-toggle rf-toggle--border-bottom">
                <input type="checkbox" class="rf-toggle__input" id="CGU" name="CGU">
                <label class="rf-toggle__label" for="CGU" data-rf-checked-label="Activé" data-rf-unchecked-label="Désactivé"><b>J'ai bien pris connaissance des <a href="cgu.php" target="_new">CGU</a>.</b></label>
                
        </div>

        
             <div>
               <br>
             <iframe name="ifCGU" width="100%" height="200" src="include/cgu_f.html" frameborder="1" scrolling="yes"></iframe>
             </div>
        <a id="e4">
        <div class="rf-col-12">
        <a href="#e4" id="stepnext5" class="rf-btn">Enregistrer</a>
        </div>
        <div class="rf-callout rf-fi-information-line" style="display : none; color : red;" id="errCgu">
                <h4 class="rf-callout__title">Information</h4>
                <p class="rf-callout__text">
                Merci de lire et d'accepter les conditions générales d'utilisation.
                 </p>
               
            </div>


            </div>
   <br><br>

        
               


            </div><!-- fin step 4 -->

<!-- step 5 -->
    <div id="step5" class="rf-col-10" style="display: none;" >
            <!-- ariane -->
            <nav class="rf-breadcrumb" aria-label="vous êtes ici :">
                <button class="rf-breadcrumb__button" hidden>Voir le fil d’Ariane</button>
                <ol class="rf-breadcrumb__list">
                    <li class="rf-breadcrumb__item">
                        <a href="#">Accueil</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Etape 1 de votre signalement</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Etape 2</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Etape 3</a>
                    </li>
                    <li class="rf-breadcrumb__item">
                        <a href="#">Enregistrement en cours</a>
                    </li>
                
                </ol>
            </nav>
            <!-- fin ariane -->

            <div class="rf-callout rf-fi-information-line">
                <h4 class="rf-callout__title">Transmission de votre signalement</h4>
                <p class="rf-callout__text">
                <img src="images/charge.gif" width=30 heigth=30>  <br>
                Signalement en cours d'enregistrement, merci de patienter.
                 La durée peut varier en fonction du nombre de photos envoyées.
                </p>
            </div>  
            </div><!-- fin step 5 -->

             <!-- fin grille full -->  
            </div>
          </div>
          </form>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/cookies.js"></script>
  <script>document.addEventListener('DOMContentLoaded', function(event) { cookieChoices.showCookieConsentBar('Ce site utilise des cookies pour vous offrir le meilleur service. En poursuivant votre navigation, vous acceptez l\’utilisation des cookies.','J\’accepte', 'En savoir plus', 'https://histologe.beta.gouv.fr/cgu.php'); });</script> 


  </body>
</html>