<?php
session_start();
 


ini_set('display_errors',1);
require_once('../include/connexion.class.php');
require_once('../include/etats_formAdm.class.php');
// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
$sit=$infosForm->getStatsCriteres();
$x=0;$r='';
while($x <= 12){
    $r=$sit[$x]->NB.','.$r;
    $lib='\''.str_replace('\'', ' ',$sit[$x]->libCritere).'\','.$lib;
    $x++;
}
$r=substr($r,0,strlen($r)-1);
$lib=substr($lib,0,strlen($lib)-1);

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
 data = [{
  type: 'scatterpolar',
  r: [<?php echo $r;?>],
  theta: [<?php echo $lib;?>],
  fill: 'toself'
}]

layout = {
  polar: {
    radialaxis: {
      visible: true,
      range: [0, 50]
    }
  },
  showlegend: false
}

Plotly.newPlot("myDiv", data, layout)



  </script>
</body>
</html>