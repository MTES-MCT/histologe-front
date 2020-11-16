<?php
 session_start();
 //ini_set('display_errors',1);
 //echo "-".$_SESSION['admin'];
 //var_dump($_SESSION);
 if($_SESSION['admin']!='ok') {
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php");
  exit;
 }

//if($_GET('id')!=null) {
    $idSign=$_GET['id'];
/*} else {
    header("Location: https://www.histologe.info/dev/_adm/main.php");  
    exit;
}*/
 
require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');
require_once('func/resize.php');



// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
$infosForm->traceUser($_SESSION['user'], 'Page DetailsSign['.$idSign.']');
$tab1=$infosForm->getSignAdrById($idSign);

if($tab1[0]->etatPart >= 1) {
  $affectPart = $infosForm->getUserAffectBySign($idSign);
}

$adult=''; $enfant='';
  if($tab1[0]->etat==0) $etat='En attente compléments demandeur';
	if($tab1[0]->etat==1) $etat='A traiter';
	if($tab1[0]->etat==2) $etat='Pris en charge - A transmettre';
	if($tab1[0]->etat==3) $etat='Transmis - A suivre';
    if($tab1[0]->etat==4) $etat='Fermé';
    if($tab1[0]->proprio_info=='o') $proprio='OUI';
    if($tab1[0]->dtInfoProprio!='') $proprio=$proprio.' ('.$tab1[0]->dtInfoProprio.')';
    if($tab1[0]->proprio_info=='n') $proprio='NON';
    if($tab1[0]->OccupantsAdultes == 1) $adult = '1 adulte';
    if($tab1[0]->OccupantsEnfants == 1) $enfant = '1 enfant';
    if($tab1[0]->OccupantsAdultes > 1) $adult = $tab1[0]->OccupantsAdultes.' adultes';
    if($tab1[0]->OccupantsEnfants > 1) $enfant = $tab1[0]->OccupantsAdultes.' enfants';
    $not=$tab1[0]->Notation;
    if($tab1[0]->infoNrj=='elect') $nrj="Electrique";
    if($tab1[0]->infoNrj=='gaz') $nrj="Gaz";
    if($tab1[0]->infoNrj=='') $nrj="N/P";

   $theDesc = str_replace('\r\n', '<br>', $tab1[0]->description);
   $theDesc = str_replace('\t',' ', $theDesc);

$tab2=$infosForm->getCritSignById($idSign);
    $x=0; $crits='<ul>';
    foreach($tab2 as $key){ 
        if(!empty($tab2[$x]->idCriticite)) $criti=$infosForm->getCriticiteSignById($idSign, $tab2[$x]->idCriticite); 
        $theImg=0;
        if(!empty($criti)) $theImg=$criti[0]->ordreCriticite;
        $crits = $crits.'<li><img src="images/s'.$theImg.'.png" width=20 heigth=20> '.$tab2[$x]->libCritere.' ('.$tab2[$x]->libSituation.')</li>';
        $x++;
    }
    $crits=$crits.'</ul>';

$tab3 = $infosForm->getSignAdrById($idSign);

$tab4 = $infosForm->getSignPhotosById($idSign);

if(isset($tab4)) {
    $x=0; $y=1; $affPhotos='<tr>';
    foreach($tab4 as $key){ 
      $mini = 'tmp../_upload/'.$tab4[$x]->titreFichier.'200200px.jpg';

      if(!file_exists($mini)) {
        $infos_image = getImageSize('../_upload/'.$tab4[$x]->titreFichier);
        $img_max_width = round($infos_image[0]*(200/$infos_image[0]),0);
        $img_max_height = round($infos_image[0]*(200/$infos_image[1]),0);
        $mini = vignette('../_upload/'.$tab4[$x]->titreFichier, $img_max_width, $img_max_height);
      } else {
        $infos_image = getImageSize($mini);
        $img_max_width = $infos_image[0];
        $img_max_height = $infos_image[1];
      }

        $affPhotos = $affPhotos.'<td colspan=2>Photo #'.($x+1).'<a href="../_upload/'.$tab4[$x]->titreFichier.'" target=_new>
        <img src="'.$mini.'" width="'.$img_max_width.'" height="'.$img_max_height.'"></a></td>';
        if($y==3) {
            $affPhotos = $affPhotos.'</tr><tr>';
            $y=1;
        }
        $x++;
        $y++;
    }
    $affPhotos = $affPhotos.'</tr>';

  $tab5 = $infosForm->getListPartenaires();
    $part='<table><tr>'; $x=0;
    foreach($tab5 as $key){ 
      //liste des destinataires possibles par partenaire
     $part=$part.'<td><b>'.$tab5[$x]->libPartenaire.'</b><br>';
      $dest=$infosForm->getDestSignPart($tab5[$x]->idHPartenaire);
      //vérif si part déjà affecté à ce signalement
      $y=0;
      foreach($dest as $key){    
        $p = $infosForm->getSignByUserBo($idSign, $dest[$y]->id_userbo); 
        if(!empty($p)) { 
          $ch='<img src="images/check.png" width="20" heigth="19"> '.$dest[$y]->nom_bo.' '.$dest[$y]->prenom_bo.'<br>';
        } else {
         // if($tab1[0]->etat != '4') {
            //Filtrage pour affectation
            if($_SESSION['idPartenaire'] == 10) {
              $ch='<input type="checkbox" name="part'.$dest[$y]->id_userbo.'" id="part'.$dest[$y]->id_userbo.'">
              <img src="images/check.png" width="20" heigth="19" name="part'.$dest[$y]->id_userbo.'icon" id="part'.$dest[$y]->id_userbo.'icon" style="display: none;">
              '.$dest[$y]->nom_bo.' '.$dest[$y]->prenom_bo.'<br>';
              } else {
                $ch=$dest[$y]->nom_bo.' '.$dest[$y]->prenom_bo.'<br>';
              }
         /*   } else {
              $ch='';
            }
          */

        } // fin else

        $y++;
        $part=$part.$ch;
      }
      $part = $part.'</td>';
      $x++;
    }
    $part=$part.'</tr></table>';

}


?>


<!doctype html>
<html lang="fr"><head>
<title>Back-Office Histologe, un service public pour les locataires et les propriétaires</title>
<link href="css/styleAdm.css" rel="stylesheet" media="all">	

</head>

<body><div class="preview"><header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">HISTOLOGE Dashboard</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Accueil
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <?php 
        if($_SESSION['userId']=='4' || $_SESSION['userId']=='3' ) {
          echo '
        <li class="nav-item">
          <a class="nav-link" href="#">Paramétrages</a>
        </li>
      
       <li class="nav-item">
          <a class="nav-link" href="usersOn.php">Utilisateurs</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="sessions.php">Sessions</a></li>';
          }
          ?>
      
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Rechercher" aria-label="Rechercher">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
      </form>
    </div>
  </nav>
</header>


<div id="infoCalc" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <b>A. Cotation automatique (Situations sélectionnées) =  </b><br>
      <ul><li>Pour chaque Situation : somme(poids des critères sélectionnés par l’utilisateur*coef de criticité (ordre de criticité du critère)) /  somme(poids des critères de la situation*coef de criticité maximum de chaque critère) *100</li></ul> <br>
    <b>B. Cotation automatique générale =  </b><br>
    <ul><li>Pour chaque Situation : somme(poids des critères sélectionnés par l’utilisateur*coef de criticité (ordre de criticité du critère)) /  somme(poids des critères de toutes les situations * coef de criticité maximum de chaque critère ) *100</li></ul><br> 
    <b>C. Cotation automatique corrigée = </b><br>
    <ul><li>B * 1.1 si présence d’enfants dans le logement </li></ul>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="main.php">Vue générale
            <span class="sr-only"></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="histoCarto.php">Cartographie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="stats/statsSign.php">Statistiques</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Export</a>
        </li>
      </ul>

     
    </nav>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
      <h1>Dashboard</h1>
 
      
      [<a href="javascript:history.back()"><< RETOUR</a>]<h2>|| Détails du Signalement  || <a href="suivi.php?id=<?php echo $idSign; ?>">Suivi</a> ||</h2>
      
      <div class="table-responsive">
        <table class="table table-striped">
           <tbody>
            <tr>
                <td colspan=2><b>SIGNALEMENT Ref#<?php echo  substr($tab1[0]->codepostal,0,2).'-'.$tab1[0]->refSign; ?> de </b><?php echo $tab1[0]->courriel
                .'<br>'.$tab1[0]->nomSign.' '.$tab1[0]->prenomSign.' '.$tab1[0]->telephone;?><br>
                <?php 
                  $eta='';
                  if($tab3[0]->etage != 0) $eta=' ('.$tab3[0]->etage.' ° étage ';
                  if($tab3[0]->numLog != '') $eta=$eta.'- Numéro : '.$tab3[0]->numLog.' ';
                  if($tab3[0]->etage != 0) $eta=$eta.')';

                  echo $tab3[0]->numeroRue.' '.$tab3[0]->nomRue.' '.$tab3[0]->ville.$eta; 
                  ?> 
              
              </td>
                <td>
                  <?php
                  if($_SESSION['idPartenaire']==10) echo'<b>Etat Histologe : </b><font color=orange><div id="etat">'.$etat.'</div></font>';
                  ?>
              
                
                
                </td>
                <td>
               <?php  
               if($tab1[0]->geolocalisation != '') {
                $carte='<iframe id="carto"
                title="Localisation signalement"
                width="400"
                height="200"
                src="carteZoom.php?idS='.$idSign.'"
                scrolling="no"
                frameborder="0">
                </iframe>';
               } else{
                $carte = 'Géolocalisation : <input type="text" size=30 value="'.$tab1[0]->geolocalisation.'" name="geoloc" id="geoloc">';
               }
               echo $carte;
               ?>   
                
              
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan=2>
              <?php
                    if($tab1[0]->etat==1 && $_SESSION['idPartenaire']==10 ) echo '<br><div id="charge"><input class="form-check-input" type="checkbox" value="" id="onCharge"> [HISTOLOGE] Je prends en charge</div>';
                  
                    //Vérif si partenaire-userBO peut valider affectation 
                    // : n'importe quel membre d'un partenaire peut choisir de s'affecter le suivi
                    // mais si 1 du même groupe a déjà validé, ne pas afficher
                  $usersSign = $infosForm->getSignByPart($idSign,$_SESSION['userId']);
                  if(!empty($usersSign)) {
                    //test a rajouter ici
                    $e=0; $affok=0;
                    foreach($usersSign as $key) {
                        if($usersSign[$e]->affect == 2) $affok=1;
                       $e++; 
                    }
              
                    if($affok == 0) {
                    if(isset($affectPart) && !empty($affectPart)) {
                   
                      $p=0;
                      echo '<table><tr>';
                      $a=0;
                      foreach($affectPart as $key) {                     
                       
                        if($affectPart[$p]->idHPartenaire==$_SESSION['idPartenaire'] && $affectPart[$p]->affect==1 && $a==0) {
                          echo '<td><b>'.$affectPart[$p]->libPartenaire.'</b><br>
                          <div id="chargePartOK">&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="" id="chargePartOK"> Nous prenons en charge.</div>
                          <div id="chargePartKO">&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="" id="chargePartKO"> Ne nous concerne pas.</div>
                          <form name="explPart" id="explPart">
                            <div id="wyNot" style="display:none;" class="form-group">
                            <label for="raison1">Merci de préciser la raison </label>
                                <textarea class="form-control" id="raison1" rows="3"></textarea>
                                <a href="#" id="valid1" class="btn btn-primary btn-lg">Valider</a>
                            </div>
                          </form>
                          </td>';
                          $a=1;
                          }
                        
                      $p++;
                      }
                      echo '</tr></table>';
                     }
                    }// fin affok
                  }

                 ?>
              </td>
                  </tr>
            <tr>
                <td colspan=2>
                <?php
                if($tab1[0]->ddeVisitDist==0) echo '<img src="images/visit_dist.png" width=30 heigth=20><a href="#" id="visitOn">Proposer une visite à distance.</a>';
                if($tab1[0]->ddeVisitDist==1) echo 'Proposition de visite à distance en attente de réponse.';
                if($tab1[0]->ddeVisitDist==2) {
                  $visit=$infosForm->getVisitBySign($tab1[0]->idSignalement);
                  echo '<b><font color=red>Le demandeur vous propose une visite à distance le '.$visit[0]->dateVisit
                  .' à '.$visit[0]->heureVisit.'h.</font></b><br>
                  [<a href="#" id="invitOn">Invitation Teams envoyée</a>] 
                  - [<a href="#" id="visitOk">Visite réalisée</a>]';
                }
                if($tab1[0]->ddeVisitDist==3) {
                  $visit=$infosForm->getVisitBySign($tab1[0]->idSignalement);
                  echo '<b>Visite à distance planifiée le '.$visit[0]->dateVisit
                  .' à '.$visit[0]->heureVisit.'h.</b><br>
                  [<a href="#" id="visitOk">Visite réalisée</a>]';
                }
                if($tab1[0]->ddeVisitDist==4) {
                  $visit=$infosForm->getVisitBySign($tab1[0]->idSignalement);
                  echo 'Visite à distance réalisée le '.$visit[0]->dateVisit
                  .' à '.$visit[0]->heureVisit.'h.';
                }
                ?>
                <br><br>
                Demander s'il existe un suivi et le nom de l'assitant social 
              </td>
              <td colspan=2>
              <?php
                $d='Non';
                if($tab1[0]->danger==1) $d='Oui';
                 echo '<font size="2"><b>% Criticité calculée : <a href="#" id="infC"><img src="images/quest_s.png" width=15 heigth=15></a></b><ul>
                 <li>Cotation automatique (Situations sélectionnées) : '.($tab1[0]->cotationSituations*100).'%.</li>
                 <li>Cotation automatique générale : '.($tab1[0]->cotationAuto*100).'%.</li>
                 <li>Cotation automatique corrigée (occupants, année construction, ...) : '.($tab1[0]->cotationAuto*100).'%.</li>
                 <li>Critère "danger" sélectionné : '.$d.'</li></ul></font>';
                 ?>
              </td>

              
            </tr>


            <tr>
                <td colspan=2>Logement social : <?php echo $tab1[0]->logSoc; ?></td>
                <td colspan=2>
                <b>NOTATION :</b>
                <select title="cotation" class="selectpicker" name="cotation" id="cotation">
                        <option <?php if($not==0) echo 'selected'; ?>>Choisir...</option>
                        <option <?php if($not==1) echo 'selected'; ?> value="1" style="Background-color:green">Inconfort pouvant/devant être traité par le demandeur</option>
                        <option <?php if($not==2) echo 'selected'; ?> value="2" style="Background-color:yellow">Inconfort pouvant/devant être traité par le propriétaire</option>
                        <option <?php if($not==3) echo 'selected'; ?> value="3" style="Background-color:orange">Signalement nécessitant l'intervention d'un partenaire</option>
                        <option <?php if($not==4) echo 'selected'; ?> value="4" style="Background-color:red">Signalement nécessitant une alerte</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><b>Points signalés :</b></td>
                <td>
                <?php 
                   echo $crits;               
                ?>
                
                </td>
                <td><b>Propriétaire averti :<br><br>Occupants :<br><br>Mode énergie :</b></td>
                <td><?php echo $proprio; ?><br><br><?php echo $adult.' / '.$enfant;?><br><br><?php echo $nrj;?></td>
            </tr>

            <tr>
                <td><b>Description usager :</b></td>
                <td colspan=3> <?php echo $theDesc;?></td>
               
            </tr>
        </tbody>
        </table>

        <table class="table table-striped">
            <tbody>
            <tr>
                <td><b>Date de création :</b></td>
                <td><?php echo $tab1[0]->dtCreaSignalementF; ?> </td>
                <td><b>Date de prise en charge Histologe :</b> </td>
                <td colspan=3>
                  <div id="dtCharge"><?php  if($tab1[0]->dtPriseEnCharge!='0000-00-00 00:00:00') echo $tab1[0]->dtPriseEnChargeF.' par '.$tab1[0]->suiviPar; ?>
                  </div>
                </td>
            </tr>   
            <tr>
              <td colspan=2>&nbsp;</td>
              <td colspan=5>
              <div>
                    <?php
                    if((isset($affectPart) && !empty($affectPart)) && $affectPart[0]->dtAffect!='0000-00-00 00:00:00') {
                      $x=0;$myAffect='';
                      foreach($affectPart as $key) {
                        $lib='';$comp='';$clo='';
                        //AJOUTER ETAT PARTENAIRE DU SIGNALEMENT !
                        if($affectPart[$x]->affect == 1) {$lib = '<font color="red"><b>En attente de </b></font>'; $comp='Demande ';}
                        if($affectPart[$x]->affect == 2) $lib = '<b>Accepté par </b>';
                        if($affectPart[$x]->affect == 3) $lib = '<b>Refusé par </b>';
                        if($affectPart[$x]->affect == 0) $lib = '<b>Non répondu par </b>';
                       
                        if($affectPart[$x]->etat==4 || $affectPart[$x]->etat==8) $clo='<font color="red"> - <b>Cloturé</b></font>';
                        
                        $myAffect=$myAffect.$lib.$affectPart[$x]->libPartenaire
                        .' ('.$affectPart[$x]->nom_bo.' '.$affectPart[$x]->prenom_bo.'), '.$comp.'le '.$affectPart[$x]->dtAffectF.$clo.'<br>';
                        $x++;
                      }
                      echo $myAffect;
                    }
                    ?>
                  
                  </div>
              </td>
            </tr>
            <tr>
                <?php
                $etaAff=0;
                if($tab1[0]->etat==0) {
                  echo '<td><b>Ce signalement est en attente de compléments du demandeur. Il ne peut être transmis aux partenaires.</b></td>
                  <td colspan=5>&nbsp;</td>';
                  $etaAff=1;
                }
                ?>
            <?php
                if($tab1[0]->etat==1) {
                  echo '<td><b>Ce signalement n\'est pas encore pris en charge. Il ne peut être transmis aux partenaires.</b></td>
                  <td colspan=5>&nbsp;</td>';
                  $etaAff=1;
                } 
                
               if($etaAff==0) {
                  echo '<td><b>Transmis à :</b></td>
                  <td colspan=5>'.$part.'</td>';
                }
                ?>  
               
            </tr>
           
             
            
          
          
          </tbody>
        </table>
        <table class="table table-striped">
            <tbody>
           

            <?php echo $affPhotos; ?>

                   
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div></div>

<table align=center><tr><td>&nbsp;</td><td><div class="info">Mise à jour ok</div></td></tr></table>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" style=""></script>
<script type="text/javascript">

$( function() {



$('.info').hide();

$("#geoloc").bind("focusout", (function () {

	var datastring = 'geol='+$(geoloc).val()+'&signid=<?php echo $tab1[0]->idSignalement; ?>&action=geo';
	//alert (upn+" - "+$(datep).val());
	 $.ajax({
                        type: "POST",
                        url:"updateSign.php",
                        data:datastring,
                        success: function(msg){
                        	 $('.info').css({position: 'fixed', bottom: '15px', left: '50%', 'background-color': '#007fc3', 
                        	padding: '12px 24px', color: 'white', 'font-family': 'verdana', 'font-size': '2em', 'border-radius': '3px', 'margin-left': '-178px'});
                           $('.info').fadeToggle();
                        	$('.info').fadeToggle();
                        },
                        error: function(msg){
                            alert('houpps : '+msg);
                        }
                    });
}));

$("#cotation").bind("change", (function () {

var datastring = 'note='+$(cotation).val()+'&signid=<?php echo $tab1[0]->idSignalement; ?>&action=note';
//alert (datastring);
 $.ajax({
                    type: "POST",
                    url:"updateSign.php",
                    data:datastring,
                    success: function(msg){
                         $('.info').css({position: 'fixed', bottom: '15px', left: '50%', 'background-color': '#007fc3', 
                        padding: '12px 24px', color: 'white', 'font-family': 'verdana', 'font-size': '2em', 'border-radius': '3px', 'margin-left': '-178px'});
                       $('.info').fadeToggle();
                        $('.info').fadeToggle();
                    },
                    error: function(msg){
                        alert('houpps : '+msg);
                    }
                });
}));

$("#onCharge").bind("change", (function () {

var datastring = 'signid=<?php echo $tab1[0]->idSignalement.'&user='.$_SESSION['user'] ?>&action=charge';
//alert (datastring);
 $.ajax({
                    type: "POST",
                    url:"updateSign.php",
                    data:datastring,
                    success: function(msg){
                         $('.info').css({position: 'fixed', bottom: '15px', left: '50%', 'background-color': '#007fc3', 
                        padding: '12px 24px', color: 'white', 'font-family': 'verdana', 'font-size': '2em', 'border-radius': '3px', 'margin-left': '-178px'});
                       $('.info').fadeToggle();
                       $('.info').fadeToggle();
                       document.getElementById("charge").style.display = "none";
                       $("#dtCharge").html(msg);
                       $("#etat").html('Pris en charge - A transmettre');
                       window.location.href="detailsSign.php?id=<?php echo $tab1[0]->idSignalement; ?>";
                    },
                    error: function(msg){
                        alert('houpps : '+msg);
                    }
                });
}));


});

<?php
$x=0; $sc='';$y=0;
//alert(\'Un message sera envoyé à ce partenaire '.$tab5[$x]->idHPartenaire.'\');
foreach($tab5 as $key){ 
  $y=0;
  $dest=$infosForm->getDestSignPart($tab5[$x]->idHPartenaire);
  foreach($dest as $key){ 
  $sc=$sc.'$("#part'.$dest[$y]->id_userbo.'").bind("change", (function () {
    if($("#part'.$dest[$y]->id_userbo.'").prop("checked") == true ) {
      document.getElementById("part'.$dest[$y]->id_userbo.'").style.display = "none";
      document.getElementById("part'.$dest[$y]->id_userbo.'icon").style.display = "block";
      var datastring = \'sendStep=1&sign='.$tab1[0]->idSignalement.'&idPart='.$dest[$y]->id_userbo.'\';
      
      $.ajax({
        type: "POST",
        url:"sendPartenaire.php",
        data:datastring      
        });
      }   
    }));';
  $y++;
  }
  $x++;
  }
echo $sc;
?>

$("#visitOn").bind("click", (function () {

var datastring = 'signId=<?php echo $tab1[0]->idSignalement; ?>&action=propVisit';
alert ('En validant cette demande, un message va être transmis automatiquement au locataire afin de vous proposer une date de visite.');
 $.ajax({
                    type: "POST",
                    url:"../updateSign.php",
                    data:datastring,
                    success: function(msg){
                      window.location.href="detailsSign.php?id=<?php echo $tab1[0]->idSignalement; ?>";
                    },
                    error: function(msg){
                        alert('Une erreur s\'est produite. Merci de réessayer ultérieurement : '+msg);
                    }
                });
}));



$("#invitOn").bind("click", (function () {

var datastring = 'signId=<?php echo $tab1[0]->idSignalement; ?>&action=invitTeams';
alert ('Attention, n\'oubliez pas d\'envoyer directement l\'invitation Teams au demandeur !');
 $.ajax({
                    type: "POST",
                    url:"../updateSign.php",
                    data:datastring,
                    success: function(msg){
                      window.location.href="detailsSign.php?id=<?php echo $tab1[0]->idSignalement; ?>";
                    },
                    error: function(msg){
                        alert('Une erreur s\'est produite. Merci de réessayer ultérieurement : '+msg);
                    }
                });
}));



$("#visitOk").bind("click", (function () {

var datastring = 'signId=<?php echo $tab1[0]->idSignalement; ?>&action=visitOk';

 $.ajax({
                    type: "POST",
                    url:"../updateSign.php",
                    data:datastring,
                    success: function(msg){
                      window.location.href="detailsSign.php?id=<?php echo $tab1[0]->idSignalement; ?>";
                    },
                    error: function(msg){
                        alert('Une erreur s\'est produite. Merci de réessayer ultérieurement : '+msg);
                    }
                });
}));


$("#chargePartOK").bind("click", (function () {

var datastring = 'signId=<?php echo $tab1[0]->idSignalement; ?>&action=affectOk&user=<?php echo $_SESSION['userId']; ?>';
//alert (datastring);
 $.ajax({
                    type: "POST",
                    url:"updateSign.php",
                    data:datastring,
                    success: function(msg){
                      window.location.href="detailsSign.php?id=<?php echo $tab1[0]->idSignalement; ?>";
                    },
                    error: function(msg){
                        alert('Une erreur s\'est produite. Merci de réessayer ultérieurement : '+msg);
                    }
                });
}));

$("#chargePartKO").bind("click", (function () {

var datastring = 'signId=<?php echo $tab1[0]->idSignalement; ?>&action=affectKo&user=<?php echo $_SESSION['userId']; ?>';
//alert (datastring);
document.getElementById("wyNot").style.display = "block";
/*
 $.ajax({
                    type: "POST",
                    url:"updateSign.php",
                    data:datastring,
                    success: function(msg){
                      window.location.href="detailsSign.php?id=<?php echo $tab1[0]->idSignalement; ?>";
                    },
                    error: function(msg){
                        alert('Une erreur s\'est produite. Merci de réessayer ultérieurement : '+msg);
                    }
                });
                */
}));


$("#infC").bind("click", (function () {
  $('#infoCalc').modal('show');
}));


$("#valid1").bind("click", (function () {
var raison = document.forms["explPart"].elements.namedItem("raison1").value;

if(raison =="" || raison.length < 2) {
alert("Merci de renseigner la raison de votre refus.");
} else {
var datastring = 'signId=<?php echo $tab1[0]->idSignalement; ?>&action=affectKo&user=<?php echo $_SESSION['userId'] ?>&r='+raison;

 $.ajax({
                    type: "POST",
                    url:"updateSign.php",
                    data:datastring,
                    success: function(msg){
                      window.location.href="detailsSign.php?id=<?php echo $tab1[0]->idSignalement; ?>";
                    },
                    error: function(msg){
                        alert('Une erreur s\'est produite. Merci de réessayer ultérieurement : '+msg);
                    }
                });
   }
                
}));


$("#infC").bind("click", (function () {
  $('#infoCalc').modal('show');
}));



</script>
