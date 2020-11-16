<?php
ini_set('display_errors',1);

if(isset($_GET['p']) && $_GET['p']!=null) {
    $idPart = $_GET['p'];
} else {
    header("Location: https://histologe.beta.gouv.fr/");  
	//echo 'houpps';
	exit;
}



	
	require_once('../include/connexion.class.php');
	require_once('../include/etat_formCalc.class.php');
	require_once('lib/html2pdf.php');
	
// préparation connexion
$connect = new connection();
$infosForm = new etat_formCalc($connect);


$listSign = $infosForm->getListSignSuiviXJoursByPart(7, $idPart);

//recherche signalements cloturés sur lesquels le partenaire est affecté
$listSignClotures = $infosForm->getListSignCloturesXJoursForPart(7, $idPart);

$listSignPart = $infosForm->getListSignNcByPart($idPart);
$jour = date("Y-m-d");
$test2 = date('Y-m-d', strtotime($jour. ' - 14 days'));

$pc=$infosForm->getPartById($idPart);


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
		<p>HISTOLOGE - le <?php echo date("d/m/y"); ?></p>
	</page_footer>

	<table style="vertical-align: top;">
		<tr>
			<td class="100p tit">
				<div style="text-align: center;"><img src="../images/entetemail_.png"><br></div>
				<br><br><?php echo $pc[0]->libPartenaire; ?>, Histologe vous propose ici un résumé des dernières actions menées, en lien avec vos signalements, 
				sur la plateforme au cours de la semaine passée du 
				<?php echo date('d-m-Y', strtotime(date("d-m-Y"). ' - 7 days')).' au '.date("d-m-Y");?>. <br><br>
			</td>
		</tr>
	</table>

	
<table style="margin-top: 30px;" class="border">
	<thead>
	<tr><th class="100p late tit txt-center"><br><img src="../images/Illus3.png" width=50 heigth=57> <b>Vos signalements sans suivi depuis plus de 14 jours</b><br>&nbsp;</th></tr>
	</thead>
		<tbody>			
		
<?php

$x=0;$y=0;$aff=0;$existS=0;
if(isset($listSignPart) && !empty($listSignPart)) {
	
foreach($listSignPart as $key) {
	
	$listLastSuivi = $infosForm->getListDerniersSuivisBySign($listSignPart[$x]->idSignalement);

	if(isset($listLastSuivi) && !empty($listLastSuivi)) {
	
	if(date("Y-m-d",strtotime($listLastSuivi[0]->dtSuivi)) < $test2) {
		$existS=1;
		$p=$infosForm->getPartById($listLastSuivi[0]->idPartenaire);
		
		$infosSign=$infosForm->getInfosSign($listSignPart[$x]->idSignalement);
		   
		$adress = $infosSign[0]->numeroRue.' '.$infosSign[0]->nomRue.' '.$infosSign[0]->codePostal.' '.$infosSign[0]->ville;
		$noms = $infosSign[0]->nomSign.' '.$infosSign[0]->prenomSign;
		echo '
		<tr>
		<td class="100p hea">
		<img src="../images/puce_histo.png"> <a href="https://histologe.beta.gouv.fr/dev/_adm/suivi.php?id='.$listSignPart[$x]->idSignalement.'">
		Ref.#64-'.$infosSign[0]->refSign.'</a> | '.$adress.' | Demandeur : '.$noms.' | Créée le : '.$infosSign[0]->dtCreaSignalementF.'</td>
		</tr>
		';
	
			echo '<tr><td class="100p"> Date dernier suivi : '.date("d-m-Y",strtotime($listLastSuivi[0]->dtSuivi)).' par '.$p[0]->libPartenaire.'</td></tr>';
			}	
		//Mise à jour état du signalement 


		} else {
			$aff=1;
		}
		
	$x++;
	} //fin foreach($listSignPart
} else {
	$aff=1;
}
	if($aff == 1 || $existS == 0) echo '<tr><td class="100p hea"><img src="../images/puce_histo.png"> Les suivis de vos signalements sont tous récents.</td></tr>';

	echo '</tbody></table>';
		?>
		
	
		
	<table style="margin-top: 30px;" class="border">
	<thead>
	<tr><th class="100p tit"><br><img src="../images/Illus6.png" width=50 heigth=56> 
	Derniers suivis ajoutés sur vos signalements<br>&nbsp;</th></tr>
	</thead>
		<tbody>			
		
<?php

if(isset($listSign) && !empty($listSign)) {
		$x=0;$y=0;$lign=0;

		foreach($listSign as $key) {
			$infosSign=$infosForm->getInfosSign($listSign[$x]->idSignalement);
			$adress = $infosSign[0]->numeroRue.' '.$infosSign[0]->nomRue.' '.$infosSign[0]->codePostal.' '.$infosSign[0]->ville;
			$noms = $infosSign[0]->nomSign.' '.$infosSign[0]->prenomSign;
			echo '
			
			<tr>
			<td class="100p hea">
			<img src="../images/puce_histo.png"> 
			<a href="https://histologe.beta.gouv.fr/_adm/suivi.php?id='.$listSign[$x]->idSignalement.'">
			Ref.#64-'.$infosSign[0]->refSign.'</a> | '.$adress.' | Demandeur : '.$noms.' | Date de création : '.$infosSign[0]->dtCreaSignalementF.'</td>
			</tr>
			';

			//Recup suivi à afficher 
			$listSuivi = $infosForm->getListSuiviBySignXJours(7, $listSign[$x]->idSignalement);
			//tester si $listSuivi vide !

				$y=0; $desc =''; 
			// foreach($listSuivi as $key2) {
					$desc = 'Suivi du ' .$listSuivi[$y]->dtSuiviF.' par '.$listSuivi[$y]->user.' ('.$listSuivi[$y]->libPartenaire.') : '.$listSuivi[$y]->descSuivi;
					echo '<tr><td class="100p">'.$desc.'</td></tr>';
					
				//    $y++;
			// } //fin foreaxh listsuivi
				echo '<tr><td class="100p">&nbsp;</td></tr>';
				
			$x++;
	} //fin foreach($listSign
} else {
	echo '<tr><td class="100p">Pas de nouveaux suivis.</td></tr>';
}
	echo '</tbody></table>';
		?>

<table style="margin-top: 30px;" class="border">
	<thead>
	<tr><th class="100p clot tit"><br><img src="../images/Illus3.png" width=50 heigth=41> <b>Derniers signalements cloturés</b><br>&nbsp;</th></tr>
	</thead>
		<tbody>			
		
<?php

$x=0;$y=0;
if(isset($listSignClotures) && !empty($listSignClotures)) {
		foreach($listSignClotures as $key) {
			$infosSign=$infosForm->getInfosSign($listSignClotures[$x]->idSignalement);
			$adress = $infosSign[0]->numeroRue.' '.$infosSign[0]->nomRue.' '.$infosSign[0]->codePostal.' '.$infosSign[0]->ville;
			$noms = $infosSign[0]->nomSign.' '.$infosSign[0]->prenomSign;
			echo '
			<tr>
			<td class="100p hea"><img src="../images/puce_histo.png"> <a href="https://histologe.beta.gouv.fr/_adm/suivi.php?id='.$listSignClotures[$x]->idSignalement.'">Ref.#64-'.$infosSign[0]->refSign.'</a> | '.$adress.' | '.$noms.' | '.$infosSign[0]->dtCreaSignalementF.'</td>
			</tr>
			';
		
			//Recup suivi à afficher 
			$listSuivi = $infosForm->getListSuiviBySignXJours(7, $listSignClotures[$x]->idSignalement);
			$desc = 'Suivi du ' .$listSuivi[0]->dtSuiviF.' par '.$listSuivi[0]->user.' ('.$listSuivi[0]->libPartenaire.') : '.$listSuivi[0]->descSuivi;
				
			echo '<tr><td class="100p">'.$desc.'</td></tr>';
				
				
				
			$x++;
			} //fin foreach($listSignClotures
}	else {
	echo '<tr><td class="100p">Pas de nouveaux signalements clôturés.</td></tr>';
}
	echo '</tbody></table>';
		?>





</page>

<?php

	$content = ob_get_clean();
	try {
		$pdf = new HTML2PDF("p","A4","fr");
		$pdf->pdf->SetAuthor('HISTOLOGE 2020');
		$pdf->pdf->SetTitle('Rapport Histologe du '.date("d/m/y"));
		$pdf->pdf->SetSubject('Rapport Histologe');
		$pdf->pdf->SetKeywords('Rapport, Histologe');
		$pdf->writeHTML($content);
	//	$pdf->Output('rapports/Rapport_hebdo_Histologe_P'.$idPart.'.pdf');
		$pdf->Output('rapports/Rapport_hebdo_Histologe_P'.$pc[0]->libPartenaire.'.pdf', 'F');
		
	} catch (HTML2PDF_exception $e) {
		die($e);
	}

?>
