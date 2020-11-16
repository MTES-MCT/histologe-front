<?php
session_start();
 


ini_set('display_errors',1);
require_once('../include/connexion.class.php');
require_once('../include/etat_formCalc.class.php');
// préparation connexion
$connect = new connection();
$infosForm = new etat_formCalc($connect);
$part=$infosForm->getListPartenaires();

$x=0;  $yPart=''; $cpt=0;
foreach($part as $key) {
    $listByPart=$infosForm->getListSignByEtatForPart($part[$x]->idHPartenaire);
    if(isset($listByPart) && !empty($listByPart)) {
        $y=0;$yPart='';$total=0;
        $encours=0; $enattente=0; $ferme=0; $refus=0;
        foreach($listByPart as $key) {
            $total=($total+$listByPart[$y]->NB);
            if($listByPart[$y]->etat==1) $enattente=$listByPart[$y]->NB; 
            if($listByPart[$y]->etat==3) $encours=$listByPart[$y]->NB; 
            if($listByPart[$y]->etat==4 || $listByPart[$y]->etat==8) $ferme=$listByPart[$y]->NB; 
            if($listByPart[$y]->etat==5) $refus=$listByPart[$y]->NB; 
            $y++;
        }
        $yPart=$total.','.$enattente.','.$encours.','.$ferme.','.$refus;
        
        $tracePart[$cpt]='y: ['.$yPart.'], name: \''.$part[$x]->libPartenaire.'\'';
        $cpt++;
    }
    $x++;
}


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
<?php
$x=0;$trace='';
foreach($tracePart as $key) {
    echo 'var trace'.($x+1).' ={ x: [\'Total\', \'En attente\', \'En cours\', \'Cloturés\', \'Refusés\'], '.$tracePart[$x].',type: \'bar\'};';
    if(($x+1)<count($tracePart)) $trace='trace'.($x+1).','.$trace;
    $x++;
}
$trace=substr($trace,0,strlen($trace)-1);

echo 'var data = ['.$trace.']';
?>

var layout = {barmode: 'group'};

Plotly.newPlot('myDiv', data, layout);


  </script>
</body>
</html>