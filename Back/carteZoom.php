<?php
 session_start();
 //echo "-".$_SESSION['admin'];
 //var_dump($_SESSION);
 if($_SESSION['admin']!='ok') {
  header("Location: https://www.histologe.info/_adm/home.php");
  exit;
 }

require_once('include/connexion.class.php');
require_once('include/etats_formAdm.class.php');

$idSign=$_GET['idS'];

// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);


?>


<!doctype html>
<html lang="fr"><head>
<link href="css/styleAdm.css" rel="stylesheet" media="all">	
<link href="css/styleStats.css" rel="stylesheet" media="all">	
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />

</head>

<body><div class="preview">

      <div id="cluster" style="width: 100%; height: 200px;"></div>



<script>

    <?php
    $tab = $infosForm->getSignById($idSign); 
    $x=0; 
    $aff='';
    if($tab[0]->Notation==1 || $tab[0]->Notation==0) $icon='images/iconMapB.png';
    if($tab[0]->Notation==2) $icon='images/iconMapJ.png';
    if($tab[0]->Notation==3) $icon='images/iconMapO.png';
    if($tab[0]->Notation==4) $icon='images/iconMapR.png';
    if($tab[0]->geolocalisation!='') {
        $getC=$getC.'[\'Ref#'.$tab[0]->refSign.'\','.$tab[0]->geolocalisation.',\''.$icon.'\',\''.$tab[0]->idSignalement.'\']';
    }

    ?>

//start

function getCities() {
		return [
           	<?php echo $getC; ?>	
        ];
	}



var map = L.map('cluster').setView([<?php echo $tab[0]->geolocalisation; ?>], 18);

var stamenToner = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    
		tileSize: 512,
		zoomOffset: -1,
    minZoom: 0,
    maxZoom: 20,
    ext: 'png'
});

map.addLayer(stamenToner);

var markersClusterCustomPlus = new L.MarkerClusterGroup();

var cities = getCities();
for (var i = 0; i < cities.length; i++) {
    var latLng = new L.LatLng(cities[i][1], cities[i][2]);
    var marker = new L.Marker(latLng,{title: cities[i][0], icon: L.icon({iconUrl: cities[i][3], iconSize: [30, 40]})  }).bindPopup("<b>Infos</b><br><a href=detailsSign.php?id="+cities[i][4]+">Détails</a>");
    markersClusterCustomPlus.addLayer(marker);
}

map.addLayer(markersClusterCustomPlus);


var markersClusterCustomPlus = new L.MarkerClusterGroup({
    iconCreateFunction: function(cluster) {
        var digits = (cluster.getChildCount()+'').length;
        return L.divIcon({ 
            html: cluster.getChildCount(), 
            className: 'cluster digits-'+digits,
            iconSize: null,

        });
    }
});

//fin
</script>
      </section>
    </main>
  </div>
</div></div><script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script><script>window.WebFont.load({google: {families: ["Roboto"]}})</script></body></html>