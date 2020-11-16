<?php
session_start();
 


ini_set('display_errors',1);
require_once('../include/connexion.class.php');
require_once('../include/etat_formCalc.class.php');
// préparation connexion
$connect = new connection();
$infosForm = new etat_formCalc($connect);
$part=$infosForm->getListPartenaires();
$x=0;
foreach($part as $key){
    $etat=$infosForm->getListSignByPartAndEtatpart($part[$x]->idHPartenaire);
    $listPart='\''.$part[$x]->libPartenaire.'\','.$listPart;
    $listEtat=$etat[0]->NB.','.$listEtat;
  $x++;  
}
$listPart=substr($listPart,0,strlen($listPart)-1);
$listEtat=substr($listEtat,0,strlen($listEtat)-1);

$x=0;
foreach($part as $key){
    $etat=$infosForm->getListSignByPartAndEtatpart($part[$x]->idHPartenaire,1);
    $listPart1='\''.$part[$x]->libPartenaire.'\','.$listPart1;
    $listEtat1=$etat[0]->NB.','.$listEtat1;
  $x++;  
}
$listPart1=substr($listPart1,0,strlen($listPart1)-1);
$listEtat1=substr($listEtat1,0,strlen($listEtat1)-1);


$x=0;
foreach($part as $key){
    $etat=$infosForm->getListSignByPartAndEtatpart($part[$x]->idHPartenaire,3);
    $listPart3='\''.$part[$x]->libPartenaire.'\','.$listPart3;
    $listEtat3=$etat[0]->NB.','.$listEtat3;
  $x++;  
}
$listPart3=substr($listPart3,0,strlen($listPart3)-1);
$listEtat3=substr($listEtat3,0,strlen($listEtat3)-1);

$x=0;
foreach($part as $key){
    $etat=$infosForm->getListSignByPartAndEtatpart($part[$x]->idHPartenaire,4);
    $listPart4='\''.$part[$x]->libPartenaire.'\','.$listPart4;
    $listEtat4=$etat[0]->NB.','.$listEtat4;
  $x++;  
}
$listPart4=substr($listPart4,0,strlen($listPart4)-1);
$listEtat4=substr($listEtat4,0,strlen($listEtat4)-1);

$x=0;
foreach($part as $key){
    $etat=$infosForm->getListSignByPartAndEtatpart($part[$x]->idHPartenaire,5);
    $listPart5='\''.$part[$x]->libPartenaire.'\','.$listPart5;
    $listEtat5=$etat[0]->NB.','.$listEtat5;
  $x++;  
}
$listPart5=substr($listPart5,0,strlen($listPart5)-1);
$listEtat5=substr($listEtat5,0,strlen($listEtat5)-1);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Plotly.js -->
  <script src="../include/plotly-latest.min.js"></script>
</head>
<body>
<!-- Plotly chart will be drawn inside this DIV -->
<div id="myDiv"></div>
  <script>
var trace1 = {
  x: [<?php echo $listPart;?>],
  y: [<?php echo $listEtat;?>],
  name: 'Total',
  type: 'bar'
};
var trace2 = {
  x: [<?php echo $listPart1;?>],
  y: [<?php echo $listEtat1;?>],
  name: 'En attente',
  type: 'bar'
};
var trace3 = {
  x: [<?php echo $listPart3;?>],
  y: [<?php echo $listEtat3;?>],
  name: 'En cours',
  type: 'bar'
};
var trace4 = {
  x: [<?php echo $listPart4;?>],
  y: [<?php echo $listEtat4;?>],
  name: 'Fermés',
  type: 'bar'
};
var trace5 = {
  x: [<?php echo $listPart5;?>],
  y: [<?php echo $listEtat5;?>],
  name: 'Refusés',
  type: 'bar'
};

var data = [trace1, trace2, trace3, trace4, trace5];

var layout = {barmode: 'group'};

Plotly.newPlot('myDiv', data, layout);


  </script>
</body>
</html>