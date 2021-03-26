<?php
session_start();

 if($_SESSION['admin']!='ok') {
  header("Location: https://histologe.beta.gouv.fr/");
  exit;
 }

if(isset($_GET['sign']) && $_GET['sign']!=null) {
    $idSign = $_GET['sign'];
} else {
    header("Location: https://histologe.beta.gouv.fr/");  
	exit;
}

	require_once('../include/connexion.class.php');
	require_once('../include/etat_formCalc.class.php');
	require_once('lib/html2pdf.php');
	require_once('../include/etats_formAdm.class.php');
	
// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
$infosForm->traceUser($_SESSION['user'], 'Page PdfSign['.$idSign.']');

$theSign=$infosForm->getSignAdrById($idSign);


$eta='';
if($theSign[0]->etage != 0) $eta=' ('.$tab3[0]->etage.' ° étage ';
if($theSign[0]->numLog != '') $eta=$eta.'- Numéro : '.$tab3[0]->numLog.' ';
if($theSign[0]->etage != 0) $eta=$eta.')';
$adresse =  $theSign[0]->numeroRue.' '.$theSign[0]->nomRue.' '.$theSign[0]->ville.$eta; 

if($theSign[0]->proprio_info=='o') $proprio='OUI';
if($theSign[0]->dtInfoProprio!='') $proprio=$proprio.' ('.$theSign[0]->dtInfoProprio.')';
if($theSign[0]->proprio_info=='n') $proprio='NON';

if($theSign[0]->OccupantsAdultes == 1) $adult = '1 adulte';
if($theSign[0]->OccupantsEnfants == 1) $enfant = '1 enfant';
if($theSign[0]->OccupantsAdultes > 1) $adult = $theSign[0]->OccupantsAdultes.' adultes';
if($theSign[0]->OccupantsEnfants > 1) $enfant = $theSign[0]->OccupantsAdultes.' enfants';

if($theSign[0]->infoNrj=='elect') $nrj="Electrique";
if($theSign[0]->infoNrj=='gaz') $nrj="Gaz";
if($theSign[0]->infoNrj=='') $nrj="N/P";

$tab2=$infosForm->getCritSignById($idSign);
    $x=0; $crits='<ul>';
    foreach($tab2 as $key){ 
        if(!empty($tab2[$x]->idCriticite)) $criti=$infosForm->getCriticiteSignById($idSign, $tab2[$x]->idCriticite); 
        $theImg=0;
        if(!empty($criti)) $theImg=$criti[0]->ordreCriticite;
        $crits = $crits.'<li><img src="../images/s'.$theImg.'.png" width=20 heigth=20> '.$tab2[$x]->libCritere.' ('.$tab2[$x]->libSituation.')</li>';
        $x++;
    }
    $crits=$crits.'</ul>';

$theDesc = str_replace('\r\n', '<br>', $theSign[0]->description);
$theDesc = str_replace('\t',' ', $theDesc);

if($theSign[0]->etatPart >= 1) {
	$affectPart = $infosForm->getUserAffectBySign($idSign);
  }
if((isset($affectPart) && !empty($affectPart)) && $affectPart[0]->dtAffect!='0000-00-00 00:00:00') {
  $x=0;$myAffect='';
  foreach($affectPart as $key) {
	$lib='';$comp='';$clo='';
	//AJOUTER ETAT PARTENAIRE DU SIGNALEMENT !
	if($affectPart[$x]->affect == 1) {$lib = '<font color="red"><b>En attente de </b></font>'; $comp='Demande ';}
	if($affectPart[$x]->affect == 2) $lib = 'Accepté par ';
	if($affectPart[$x]->affect == 3) $lib = 'Refusé par ';
	if($affectPart[$x]->affect == 0) $lib = 'Non répondu par ';
   
	if($affectPart[$x]->etat==4 || $affectPart[$x]->etat==8) $clo='<font color="red"> - <b>Cloturé</b></font>';
	
	$myAffect=$myAffect.$lib.$affectPart[$x]->libPartenaire
	.' ('.$affectPart[$x]->nom_bo.' '.$affectPart[$x]->prenom_bo.'), '.$comp.'le '.$affectPart[$x]->dtAffectF.$clo.'<br>';
	$x++;
  }
 
}

$tab2=$infosForm->getlistSuiviBySign($idSign);
$tab4 = $infosForm->getSignPhotosById($idSign);
if(!isset($tab4)) $nbPhotos = 'Pas de photos disponibles.'; 
	else $nbPhotos = '<a href="https://histologe.beta.gouv.fr/_adm/detailsSign.php?id='.$idSign.'" target="_new">'.count($tab4).' photos disponibles sur la plateforme.</a>';

if($theSign[0]->cotationCorrigee <= 0.05) $imgCotation="0_5"; 
if($theSign[0]->cotationCorrigee > 0.05 && $theSign[0]->cotationCorrigee <= 0.10) $imgCotation="5_10"; 
if($theSign[0]->cotationCorrigee > 0.10 && $theSign[0]->cotationCorrigee <= 0.19) $imgCotation="10_19"; 
if($theSign[0]->cotationCorrigee > 0.19 && $theSign[0]->cotationCorrigee <= 0.25) $imgCotation="20_25";
if($theSign[0]->cotationCorrigee > 0.25 || $theSign[0]->danger==1) $imgCotation="26";  
$libCot=$infosForm->getLibCotation($imgCotation);
$theLibCot=$libCot[0]->libCot;

$jour = date("Y-m-d");



ob_start();
?>

<style type="text/css">
	table {
		width: 100%;
		color: #717375;
		font-family: helvetica;
		line-height: 5mm;
		border-collapse: collapse;
	}
	h2  { margin: 0; padding: 0; }
	p { margin: 5px; }

	.border th {
		border: 1px solid #000;
		color: blue;
		background: #CFD1D2;
		padding: 5px;
		font-weight: normal;
		font-size: 14px;
		text-align: center; }
	.border td {
		border: 1px solid #CFD1D2;
		padding: 5px 10px;
		text-align: left;
	}
	.no-border {
		border-right: 1px solid #CFD1D2;
		border-left: none;
		border-top: none;
		border-bottom: none;
	}
	.hea {
		font-weight: bold;
	}

	.clot {
		color: red;
		background:burlywood;
	}

	.late {
		color:whitesmoke;
		background:darkgreen;
	}
	.space { padding-top: 250px; }

	.tit {
		
		font-weight:bold;
		font-size: 16px;
	}

	.10p { width: 10%; } .15p { width: 15%; }
	.25p { width: 25%; } .50p { width: 50%; }
	.60p { width: 60%; } .75p { width: 75%; }
    .100p { width: 100%; }
</style>

<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">

	<page_footer>
		<hr />
		<p>HISTOLOGE SIGNALEMENT Référence #<?php echo substr($theSign[0]->codepostal,0,2).'-'.$theSign[0]->refSign; ?> - <?php echo date("d/m/y"); ?></p>
	</page_footer>

	<table style="vertical-align: top;">
		<tr>
			<td class="100p tit">
				<div style="text-align: center;"><img src="../images/entetemail_.png"><br></div>
				<br><br>
				SIGNALEMENT Référence #<?php echo substr($theSign[0]->codepostal,0,2).'-'.$theSign[0]->refSign; ?> au <?php echo $adresse; ?>
				<br><br>
			</td>
		</tr>
	</table>

	<table style="vertical-align: top;">
		<tr>
			<td class="100p">
				Créée le <?php echo $theSign[0]->dtCreaSignalementF; ?> par <?php echo strtoupper($theSign[0]->nomSign).' '.strtoupper($theSign[0]->prenomSign); ?><br>
				Contact : <img src="../images/tel2.png" width="20" height="20"> <?php echo $theSign[0]->telephone. ' &nbsp;  <img src="../images/mail.png" width="20" height="20"> ' .$theSign[0]->courriel; ?>
			</td>
		</tr>
	</table>

	<table style="vertical-align: top;">
		<tr>
			<td class="100p">
				<br><b>Logement social</b> : <?php echo $theSign[0]->logSoc; ?> || <b>Propriétaire averti</b> : <?php echo $proprio; ?> || <b>Occupants</b> : <?php echo $adult. ' '.$enfant; ?> || <b>Mode énergie</b> : <?php echo $nrj; ?>
			</td>
		</tr>
	</table>

	<table style="vertical-align: top;">
		<tr>
		<td class="100p"><br><b>Points signalés :</b></td>
		</tr>
		<tr>
         <td><?php echo $crits; ?></td>
		</tr>
	</table>

	
	<table style="vertical-align: top;">
		<tr>
		<td class="100p"><br><b>Description par l'usager :</b></td>
		</tr>
		<tr>
         <td><?php echo $theDesc; ?></td>
		</tr>
	</table>

	<table style="vertical-align: top;">
		<tr>
		<td class="100p"><br><b>Cotation calculée :</b></td>
		</tr>
		<tr>
		 <td><img src="../images/b_<?php echo $imgCotation; ?>.png" width=300 height="34"><br>
		 <?php echo $theLibCot; ?></td>
		</tr>
	</table>
	
	<table style="vertical-align: top;">
		<tr>
		<td class="100p"><br><b>Photos :</b></td>
		</tr>
		<tr>
         <td><?php echo $nbPhotos; ?></td>
		</tr>
	</table>

	<table style="vertical-align: top;">
		<tr>
		<td class="100p"><br><b>Partenaires affectés :</b></td>
		</tr>
		<tr>
         <td><?php echo $myAffect;?></td>
		</tr>
	</table>

	<table style="vertical-align: top;">
		<tr>
		<td class="100p"><br><b>Suivis disponibles :</b></td>
		</tr>
		<tr>
         <td>
			<?php
				$y=0;
				foreach($tab2 as $key){ 
					$partName = $infosForm->getPartById($tab2[$y]->idPartenaire);
					$theDescS = str_replace('\r\n', '<br>', $tab2[$y]->descSuivi);
					$theDescS = str_replace('\t',' ', $theDescS);

					if($tab2[$y]->avisUser=='on') $comp1='<br><span class="text-small">Demandeur en copie.</span>';
					$suiv=$suiv.' <b>Auteur</b> : '.$tab2[$y]->user.$comp1.'['.$partName[0]->libPartenaire.']. Date : '.$tab2[$y]->dtSuiviF.'<br>
					'.$theDescS.'<br><br>';


					$y++;
				}
				echo $suiv;
			?>
		 </td>
		</tr>
	</table>

	



</page>

<?php

	$content = ob_get_clean();
	try {
		$pdf = new HTML2PDF("p","A4","fr");
		$pdf->pdf->SetAuthor('HISTOLOGE 2021');
		$pdf->pdf->SetTitle('Signalement Histologe généré le '.date("d/m/y"));
		$pdf->pdf->SetSubject('Signalement Histologe');
		$pdf->pdf->SetKeywords('Signalement, Histologe');
		$pdf->writeHTML($content);
		$pdf->Output('signPdf/Signalement_Histologe_R'.substr($theSign[0]->codepostal,0,2).'-'.$theSign[0]->refSign.'.pdf');
	//	$pdf->Output('signPdf/Signalement_Histologe_R'.substr($theSign[0]->codepostal,0,2).'-'.$theSign[0]->refSign.'.pdf', 'F');
		
	} catch (HTML2PDF_exception $e) {
		die($e);
	}

?>
