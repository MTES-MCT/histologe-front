<?php
session_start();
 


ini_set('display_errors',1);
require_once('../include/connexion.class.php');
require_once('../include/etat_formCalc.class.php');
// préparation connexion
$connect = new connection();
$infosForm = new etat_formCalc($connect);
$list = $infosForm->getNbreSignByMonths();
$x=0;$nb=0;
//echo 'Date,Signalements,Clotures<br>';
$fichier = fopen('data/stats1.csv', 'w+');
fwrite($fichier, 'Date,Signalements,Clotures'.PHP_EOL);

foreach($list as $key) {
    $nb += $list[$x]->nb;
    $clo=$infosForm->getNbreSignClotureForMonth($list[$x]->moisCrea);
    $clot += $clo[0]->nbC;
    //echo $list[$x]->moisCrea.','.$nb.','.$clot.'<br>';
    fwrite($fichier, $list[$x]->moisCrea.','.$nb.','.$clot.PHP_EOL);
    $x++;
}
fclose($fichier);

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
 Plotly.d3.csv("data/stats1.csv", function(err, rows){

function unpack(rows, key) {
return rows.map(function(row) { return row[key]; });
}

var frames = []
var x = unpack(rows, 'Date')
var y = unpack(rows, 'Signalements')
var x2 = unpack(rows, 'Date')
var y2 = unpack(rows, 'Clotures')

var n = 100;
for (var i = 0; i < n; i++) { 
  frames[i] = {data: [{x: [], y: []}, {x: [], y: []}]}
  frames[i].data[1].x = x.slice(0, i+1);
  frames[i].data[1].y = y.slice(0, i+1);
  frames[i].data[0].x = x2.slice(0, i+1);
  frames[i].data[0].y = y2.slice(0, i+1);
}

var trace2 = {
  type: "scatter",
  mode: "lines",
  name: 'Signalements',
  fill: 'tonexty',
  x: frames[12].data[1].x,
  y: frames[12].data[1].y,
  line: {color: 'orange'}
}

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Clotures',
  x: frames[5].data[0].x,
  y: frames[5].data[0].y,
  line: {color: 'green'}
}

var data = [trace1,trace2]; 
  
var layout = {
  title: 'Histologe - Signalements',
    displayModeBar: false,
  xaxis: {
    range: [frames[3].data[0].x[0], frames[3].data[0].x[99]],
    showgrid: false
  },
  yaxis: {
    range: [0, 140],
    showgrid: false
  },
  legend: {
    orientation: 'h',
    x: 0.5,
    y: 1.2,
    xanchor: 'center'
  },
  updatemenus: [{
    x: 0.5,
    y: 0,
    yanchor: "top",
    xanchor: "center",
    showactive: false,
    direction: "left",
    type: "buttons",
    pad: {"t": 10, "r": 10}
  }]
};

Plotly.newPlot('myDiv', data, layout).then(function() {
  Plotly.addFrames('myDiv', frames);
});
})


  </script>
</body>
</html>