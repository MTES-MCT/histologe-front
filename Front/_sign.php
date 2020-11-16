<?php
session_start();
$_SESSION['user'] = session_id();
//ini_set('display_errors',1);
require_once('include/connexion.class.php');
require_once('include/etats_form.class.php');

// préparation connexion
$connect = new connection();
$infosForm = new etat_form($connect);

$infosForm->insertUserActivity($_SESSION['user'], 0, 'after', $_SERVER['HTTP_USER_AGENT'] );

$tab = $infosForm->getListSituations();


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
  <link rel="stylesheet" href="css/signal.css">
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
<div id="filtre" style="display:none;"></div>
 <div class="container">
    <div class="row" >
    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top navbar-dark col-md-12 " >

        <a class="logoNav" href="Home"></a>
        <a class="logoNav2" href="Home"></a>
        <a class="logoNav3" href="Home"></a>
        <a class="menub_2" href="#id_menub" id="menu" onclick="agents(this.id)"></a>
        <a class="menubis_2" href="#id_menub_clos" id="menub_bis" style="display:none;" onclick="agents(this.id)"></a>
        <a class="menub" href="#id_menub_2" id="menu_2" onclick="agents_2(this.id)"></a>
        <a class="menubis" href="#id_menub_clos_2" id="menub_bis_2" style="display:none;" onclick="agents_2(this.id)"></a>
        <br>



        <nav class="collapse navbar-collapse text-dark navbarResp" role="navigation" id="navbarResponsive">
            <ul class="nav navbar-nav ml-auto">
            <li class="nav-item text-dark">
                <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,'accueil');" onmouseout="chSitOff(this,'accueil');"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
              <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
              <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,'contact');" onmouseout="chSitOff(this,'contact');"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
              <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,'aide');" onmouseout="chSitOff(this,'aide');"></a>
            </li>

            </ul>

        </nav><span id="t"><br><br></span>
</nav>
    </div>


<form class="form-register" action="Enregistre" enctype="multipart/form-data" method="post" name="signale" id="signale">
<div id="step1" >

    <div class="row fm">
            <!-- situations Web-->
            <div class="fixed1" id="SitWeb"><br><br>
            <?php
            $x=0; $aff='';
            foreach ($tab as $key) {
              $aff=$aff.'<div class="text-center"><a class="text-white" href="#'.$tab[$x]->libSituationJS.'">
              <img id="'.$tab[$x]->libSituationCt.'" src="img/'.$tab[$x]->libSituationCt.'_off.png" onmouseover="chSitOn(this,\''.$tab[$x]->libSituationCt.'\');" onmouseout="chSitOff(this,\''.$tab[$x]->libSituationCt.'\');">
              <br><b>'.$tab[$x]->libMenu.'</b><br></div>
              </a>';
              $x++;
            }
            echo $aff.'<br><a class="" href="#comp1"><img id="next" src="img/next.png"></a>
            <br><br><br><br><br><br><br><br><br><br><br><br>';
            ?>
            </div>
             <!-- fin situations -->

               <!-- situations SM -->
            <div id="SitWebMob">
                <div id="volet_clos">
                <div id="volet"><br><br>
                <?php
                $x=0; $aff='';
                foreach ($tab as $key) {
                $aff=$aff.'<div class="NavSit1">
                <a class="NavSit1 text-white" href="#'.$tab[$x]->libSituationJS.'"><img id="titsitimg'.$x.'" src="img/'.$tab[$x]->libSituationCt.'_on.png"></a>
                </div>
               <div class="text-center"><a id="titsit'.$x.'" class="NavSit1 text-white" href="#'.$tab[$x]->libSituationJS.'">'.$tab[$x]->libMenu.'</a></div>
                ';
                $x++;
                }
                echo $aff.'<a id="titsit10" class="NavSit1" href="#comp1"><img id="next" src="img/next.png"></a>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                ?>

                <a href="#volet" class="ouvrir" aria-hidden="true" id="vol_o">Situtations</a>
                <a href="#volet_clos" class="fermer" aria-hidden="true" id="vol_f">Situations</a>
                </div>
                </div>

            </div>
             <!-- fin situations -->

 </div> <!-- fin row -->

 <div class="ariane"><label>&nbsp;Votre signalement : <b>1. Situation</b> > <a id="step_2" class="point">2. Compléments d'infos</a> > <a id="step_3" class="point">3. Confirmation</a></label></div>
 <div id="titSitMob">
 <div id="id_menub_clos_2" class="col-12 col-md-12 text-right">
 <div id="id_menub_2" class="col-12 col-md-12 text-left">
         <ul class="nav navbar-nav navbarRespCote" style="margin-left:-15px;margin-top:50px;">
       <li class="nav-item">
           <a href="index.html" class="nav-link active">Accueil </a>
       </li>
       <br>
       <li class="nav-item">
         <a href="QuiHistologe" class="nav-link active">Qui sommes-nous ?</a>
       </li>
       <br>
       <li class="nav-item">
         <a href="Contact" class="nav-link active">Contact</a>
       </li>
       <br>
       <li class="nav-item">
         <a href="Aide" class="nav-link active">Aide </a>
       </li>
       <br>
       </ul>
 </div>
 </div>
 </div>
 <div id="titSitMob2">
 <div id="id_menub_clos" class="col-7 col-md-7 text-right">
 <div id="id_menub" class="col-7 col-md-7 text-left">
         <ul class="nav navbar-nav navbarRespCote" style="margin-left:-15px;margin-top:50px;">
       <li class="nav-item">
           <a href="index.html" class="nav-link active">Accueil </a>
       </li>
       <br>
       <li class="nav-item">
         <a href="QuiHistologe" class="nav-link active">Qui sommes-nous ?</a>
       </li>
       <br>
       <li class="nav-item">
         <a href="Contact" class="nav-link active">Contact</a>
       </li>
       <br>
       <li class="nav-item">
         <a href="Aide" class="nav-link active">Aide </a>
       </li>
       <br>
       </ul>
 </div>
 </div>
 </div>
             <!-- Entete situation -->
<div class="fixed2">
<div class="text-center text-blue"><img src="img/illusSign.png"><br><br>
Ici, vous pouvez détailler votre situation et ajouter des photos à votre signalement.
<br><br> Utilisez le menu de gauche pour choisir la ou les situations de votre problème.
              </div>
            <?php
            $x=0; $aff='';
            foreach ($tab as $key) {
                $aff='<div id="detailsSit'.$tab[$x]->idSituation_pb.'">
                <a id="'.$tab[$x]->libSituationJS.'"&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <div class="fond1"> <br><br>';
               //div de la situation : changer fond 1 sur 2

               // if($x>=1) $aff=$aff.'&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>';

                $aff = $aff.'
               <div class="text-center title-sit" id="titSitWeb"> Votre signalement concerne-t-il '.$tab[$x]->libSituation.' ?
                <br><br><img src="img/'.$tab[$x]->libSituationCt.'.png" width=350 heigth=159> <br><br></div>
                <div class="text-center title-sit" id="titSitMob"> Votre signalement concerne-t-il '.$tab[$x]->libSituation.' ?
                <br><br><img src="img/'.$tab[$x]->libSituationCt.'.png" width=150 heigth=68> <br><br></div>

                    ';
                //start criteres
                $y=0; $f=0;
                $tab2 = $infosForm->getCriteres($tab[$x]->idSituation_pb);
                foreach ($tab2 as $key) {
                  $aid='';
                  $tab3 = $infosForm->getCriticites($tab2[$y]->idCritere);
                      if($tab2[$y]->descCritere!='') $aid= '<div class="tooltip2 centreVerticalement">  <img src="img/quest_w.png" width="30" heigth="31" border="0"><span class="tooltiptext2">'.$tab2[$y]->descCritere.'</span></div>';

                      $aff=$aff.'
                      <div class="material-switch col-md-12">
                      '.$aid.'&nbsp;&nbsp;
                      <input id="'.$tab2[$y]->libCritere.'" onclick="chAff(\'smil_c'.$tab2[$y]->idCritere.'\');" name="c_'.$tab2[$y]->idCritere.'" type="checkbox" class = "groupcheckbox" data-toggle="tooltip" data-placement="top" title="'.$tab2[$y]->descCritere.'" />

                      <label for="'.$tab2[$y]->libCritere.'" class="label-primary"></label> &nbsp;<b>'.$tab2[$y]->libCritere.'</b>&nbsp;&nbsp;

                    <div id="smil_c'.$tab2[$y]->idCritere.'" style="display:none" >
                    <input type="hidden" name="criticite'.$tab2[$y]->idCritere.'" value="0">
                    Comment évaluez-vous le problème :
                    <br>
                    <img class="siml1" id="img1_c'.$tab2[$y]->idCritere.'" src="img/s2_off.png" onclick="changeImage(\'img1_c'.$tab2[$y]->idCritere.'\', \'img2_c'.$tab2[$y]->idCritere.'\', \'img3_c'.$tab2[$y]->idCritere.'\', \''.$tab3[0]->idCriticite.'\', \'criticite'.$tab2[$y]->idCritere.'\');" title="MOYEN" width=50 height=50>
                    <div class="tooltip2 centreVerticalement">  Moyen <img class="centreVerticalement" src="img/quest_s.png"><span class="tooltiptext2">'.$tab3[0]->libCriticite.'</span></div>
                    <br>
                    <img class="siml1" id="img2_c'.$tab2[$y]->idCritere.'" src="img/s4_off.png" onclick="changeImage(\'img2_c'.$tab2[$y]->idCritere.'\', \'img1_c'.$tab2[$y]->idCritere.'\', \'img3_c'.$tab2[$y]->idCritere.'\', \''.$tab3[1]->idCriticite.'\', \'criticite'.$tab2[$y]->idCritere.'\');" width=50 height=50 title="GRAVE">
                    <div class="tooltip2 centreVerticalement">  Grave <img class="centreVerticalement" src="img/quest_s.png"><span class="tooltiptext2">'.$tab3[1]->libCriticite.'</span></div>
                    <br>
                    <img class="siml1" id="img3_c'.$tab2[$y]->idCritere.'" src="img/s5_off.png" onclick="changeImage(\'img3_c'.$tab2[$y]->idCritere.'\', \'img1_c'.$tab2[$y]->idCritere.'\', \'img2_c'.$tab2[$y]->idCritere.'\', \''.$tab3[2]->idCriticite.'\', \'criticite'.$tab2[$y]->idCritere.'\');" width=50 height=50 title="TRES GRAVE">
                    <div class="tooltip2 centreVerticalement">  Très Grave <img class="centreVerticalement" src="img/quest_s.png"><span class="tooltiptext2">'.$tab3[2]->libCriticite.'</span></div>
                    <br><br>
                    </div>

                    </div><br>
                    ';

                   $y++;

                  }

                  echo $aff;

                  echo '</div></div><div class="text-blue text-center"> <br> [Pas d\'autres situations ? || <a class="text-blue" href="#comp1">Passer directement à l\'étape suivante >></a>]</div>';
                //end criteres



              $x++;
            }


         ?>

<!-- criteres -->


          <!-- start comp p1 -->

          <div id="compS1"  class="row"><a id="comp1"><br><br>
         	<div py-5 col-md-12>

					<legend><br><br><b>Décrivez le ou les problèmes rencontrés</b></legend>
					<textarea class="form-control" id="desc" name="desc" rows="10" placeholder="Description" required></textarea>

            </div>
        </div>
        <div id="compS2"  class="row">

			<div class="file-path-wrapper">
			<fieldset>
			<legend><br><br><b>Téléverser des photos des problèmes</b></legend>
				<input type="file" class="form-control-file" id="File1" name="file1" accept="image/*" >
				<input type="file" class="form-control-file" id="File2" name="file2" accept="image/*" >
        <input type="file" class="form-control-file" id="File3" name="file3" accept="image/*" >

        <div id="photo" class="text-soulign"><br>Ajouter plus de photos ?</div>
        <div class="text-blue">Les photos ne doivent pas contenir de vues de personnes ou d'objets personnels.<br>
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
				<input type="file" class="form-control-file" id="File4" name="file4" accept="image/*" >
				<input type="file" class="form-control-file" id="File5" name="file5" accept="image/*" >
				<input type="file" class="form-control-file" id="File6" name="file6" accept="image/*" >
	    		</div>
          </fieldset>
			</div>
        </div>

 <div class="py-5 col-md-12">

            <a href="#s2" class="btn btn-primary btn-lg btn-block" id="stepnext2"><b>ETAPE SUIVANTE : compléments</b></a>
            <a href="#s2" class="btn btn-primary btn-lg btn-block" id="stepnext2sm"><b>ETAPE SUIVANTE</b></a>
          </div>
          <br><br><br><br><br><br><br><br>
  </div> <!-- imp -->

          <!-- fin comp p1 -->
 </div> <!-- fin step1 -->


<div id="step2">
  <a id="s2"><br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
<div class="ariane"><label>Votre signalement : <a id="step_12" class="point">1. Situation</a> > <b>2. Compléments d'infos</b> > <a id="step_32" class="point">3. Confirmation</a></label></div>
<div class="py-5" >
    <div class="container">
      <div class="row mb-3">
      <div class="p-md-4 col-lg-12" >
          <h2 class="text-black">Informations Complémentaires </h2>
          <!--start -->
          <div class="form-row">
              <div class="form-holder form-holder-2 text-left"><legend>Avez-vous informé le propriétaire de ces nuisances ? *</legend></div></div>
								<div class="form-row">

									<div class="form-holder">

										<fieldset>

											<input type="radio" class="radio" name="infoPr" id="plan-1" value="oui">
											<label class="plan-icon plan-1-label" for="plan-1">
											</label>OUI
										</fieldset>
									</div>
									<div class="form-holder">
										<fieldset>
											&nbsp;&nbsp;<input type="radio" class="radio" name="infoPr" id="plan-2" value="non">
											<label class="plan-icon plan-2-label" for="plan-2">
											</label>NON
										</fieldset>
									</div>
                                </div>
                                <br><br>

        <!-- end -->
        <!--start -->
        <div class="form-row">
						<div class="form-holder form-holder-2"><legend>Qui habite dans ce logement ?</legend></div>
					</div>
							<div class="form-row">
									<div class="form-holder">

									<fieldset>
										<br>Nombre d'adultes :
											<select name="nbAdults" id="nbAdults">
											<option value="t" disabled selected>Choisir...</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="+4">+ de 4</option>
										</select>
									</fieldset>
									</div>
									<div class="form-holder">
									<fieldset>
										<br>&nbsp;&nbsp;Nombre d'enfants :
											<select name="nbEnfants" id="nbEnfants">
											<option value="0" selected>0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="+4">+ de 4</option>
										</select>
									</fieldset>
									</div>

								</div>
                                <br><br>


                  <div class="form-row">
									<div class="form-holder">

									<fieldset>
                  <div class="form-holder form-holder-2"><legend>S'agit-il d'un logement social ? *</legend></div>
                    <input type="radio" class="radio" name="logSoc" id="log1" value="oui">
											<label class="plan-icon plan-1-label" for="log1">
											</label>OUI
												&nbsp;&nbsp;<input type="radio" class="radio" name="logSoc" id="log2" value="non">
											<label class="plan-icon plan-2-label" for="log2">
											</label>NON
										</fieldset>
									</fieldset> 
									</div>

								</div>
								<br><br>


								<div class="form-row">
									<div class="form-holder form-holder-2"><legend>Votre nom et prénom *</legend></div>
									</div>
							<div class="form-row">
									<div class="form-holder">
										<fieldset>
										<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom">

									</fieldset>
									</div>
									<div class="form-holder">
									<fieldset>
										<input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom">

									</fieldset>
									</div>

								</div>



								<div class="form-row">
									<div class="form-holder form-holder-2">
									<legend>Votre adresse courriel *</legend>
										<fieldset>
											<input type="text" name="mail" id="mail" class="form-control" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="exemple@courriel.fr" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
									<legend>Téléphone portable</legend>
										<fieldset>

											<input type="text" class="form-control" id="phone" name="phone" placeholder="0606060606">
										</fieldset>
									</div>
								</div>


								<div class="form-row">

									<div class="form-holder form-holder-2">
									<legend>Adresse du logement *</legend>
										<fieldset>

											<input type="text" class="form-control input-border" id="num" name="numero" placeholder="Numéro">
                                            <input type="text" class="form-control input-border" id="libAd" name="libAd" placeholder="Rue, Chemin, Place, ...">
                                            <input type="text" class="form-control input-border" id="etage" name="etage" placeholder="Etage">
                                            <input type="text" class="form-control input-border" id="numApt" name="numApt" placeholder="Numéro appartement">
											<input type="text" class="form-control input-border" id="cp" name="cp" placeholder="Code postal">
											<input type="text" class="form-control input-border" id="ville" name="ville" placeholder="Ville">
											<br>
										</fieldset>
									</div>


								</div>

							</div>
        <!-- end -->
        </div>
      </div>

      <div class="py-5 col-md-12" id="nextstep3" >


            <a href="#" class="btn btn-primary btn-lg btn-block" id="stepnext3"><b>ETAPE SUIVANTE : Signalement</b></a>
            <a href="#" class="btn btn-primary btn-lg btn-block" id="stepnext3sm"><b>ETAPE SUIVANTE</b></a>

  </div>

</div>

</div> <!--fin step2 -->



<div id="step3">
<a id="s3"><br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
<div class="ariane">
  <label>Votre signalement : <a id="step_13" class="point">1. Situation</a> > <a id="step_23" class="point">2. Compléments d'infos</a> > <b>3. Confirmation</b></label>
</div>
<div class="py-5" >
    <div class="container">
      <div class="row mb-3">
      <div class="p-md-4 col-lg-12" >
          <h2 class="text-black">Signalement</h2>
          <div id="recap"></div>
          <div id="upload_on" style="display:block;">
            <div class="material-switch ">
                <input id="CGU" name="CGU" type="checkbox"/>
                <label for="CGU" class="label-primary"></label>  &nbsp;J'ai bien pris connaissance des <a href="cgu.php" target="_new">CGU</a>.
             </div>
             <div>
               <br>
             <iframe name="moniframe" width="100%" height="200" src="include/cgu_f.html" frameborder="1" scrolling="yes">
            </iframe>
             </div>
          </div>
   <br><br>


   <div class="col-md-12" id="nextstep3" >
        <a href="#" class="btn btn-primary btn-lg btn-block" id="stepnext4">Enregistrer votre signalement</a>
        <a href="#" class="btn btn-primary btn-lg btn-block" id="stepnext4sm">Enregistrer</a>
        </div>

        <div class="col-md-12 text-center" id="wait">
        <img src="img/charge.gif" width=30 heigth=30>
        <button type="button" class="btn btn-primary btn-lg btn-block" disabled="disabled">
          Signalement en cours d'enregistrement, merci de patienter.
          <br>La durée peut varier en fonction du nombre de photos envoyées.
        </button>
        </div>

        <div class="col-md-12 text-center text-small" id="waitsm">
        <img src="img/charge.gif" width=30 heigth=30>
        <button type="button" class="btn btn-primary btn-lg btn-block" disabled="disabled">
          Enregistrement<br>en cours,<br>merci de patienter.
          <br>La durée peut<br>varier en<br>fonction du nombre<br>de photos envoyées.
        </button>
        </div>

    	</div>
      </div>
    </div>



</div>

</div> <!--fin step3 -->




 <!-- footer -->
 <div class="row">

  <div class="col-md-12 text-center fm">

      <p class="mb-4 text-white">
      <a href="CGU">Mentions légales</a> -
        <a href="https://www.agglo-pau.fr" target="_new">Communauté d'agglomération Pau-Béarn Pyrénées</a> -
        <a href="https://https://www.cohesion-territoires.gouv.fr/lagence-nationale-de-la-cohesion-des-territoires"  target="_new"> Agence Nationale de la Cohésion des Territoires</a> -
        <a href="https://beta.gouv.fr"  target="_new">Beta Gouv</a> -
        <a href="contact.php">Contact</a></p>

      </p>

  </div>

</div>
<!--end footer -->

          </div>

</form>
 </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
  <script src="js/check.js"></script>
  <script src="js/nav.js"></script>



  </html>
