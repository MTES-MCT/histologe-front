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

// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
$infosForm->traceUser($_SESSION['user'], 'Page Carto');
$nbSign = $infosForm->getStatsNbSignActif();
$repartNote = $infosForm->getStatsNotation();
$repartCriteres = $infosForm->getStatsCriteres();
$repartSituations = $infosForm->getStatsSituations();
$repartByVilles = $infosForm->getStatsVilles();


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
          <a class="nav-link" href="main.php">Accueil
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
     
    </div>
  </nav>
</header>

<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="main.php">Vue générale
            
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active">Cartographie</a>
          <span class="sr-only">(current)</span>
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

      <section class="row text-center placeholders">
      
      <div id="cluster" style="width: 100%; height: 900px;"></div>



<script>

    <?php
    $tab = $infosForm->getListNvxSign(); 
    $x=0; 
    $aff='';
    
    foreach($tab as $key){
       // $icon='blueIcon';
        if($tab[$x]->Notation==1 || $tab[$x]->Notation==0) $icon='images/iconMapB.png';
        if($tab[$x]->Notation==2) $icon='images/iconMapJ.png';
        if($tab[$x]->Notation==3) $icon='images/iconMapO.png';
        if($tab[$x]->Notation==4) $icon='images/iconMapR.png';
       // if($tab[$x]->geolocalisation != '') $aff=$aff.'L.marker(['.$tab[$x]->geolocalisation.'], {icon: '.$icon.'}).addTo(mymap)
       // .bindPopup("<b>Infos</b><br><a href=detailsSign.php?id='.$tab[$x]->idSignalement.'>Détails</a>");';
        if($tab[$x]->geolocalisation!='') {
            $getC=$getC.'[\'Ref#'.$tab[$x]->refSign.'\','.$tab[$x]->geolocalisation.',\''.$icon.'\',\''.$tab[$x]->idSignalement.'\'],';
        }
        $x++;
    }
    $getC=substr($getC,0,(strlen($getC)-1));
    echo $aff;
    ?>

//start

function getCities() {
		return [
           	<?php echo $getC; ?>	
        ];
	}


/*      
var HistoIcon = L.Icon.extend({
    options: {
        iconSize:     [30, 40],
        iconAnchor:   [20, 60],
        popupAnchor:  [0, -45]
    }
    });

    var blueIcon = new HistoIcon({iconUrl: 'images/iconMapB.png'});
    var greenIcon = new HistoIcon({iconUrl: 'images/iconMapV.png'});
    var yellowIcon = new HistoIcon({iconUrl: 'images/iconMapJ.png'});
    var orangeIcon = new HistoIcon({iconUrl: 'images/iconMapO.png'});
    var redIcon = new HistoIcon({iconUrl: 'images/iconMapR.png'});
*/

var map = L.map('cluster').setView([43.2964, -0.3734], 13);

var stamenToner = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    id: 'mapbox/streets-v11',
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

	/*	
	mapCustomPlus.addLayer(markersClusterCustomPlus);

	
	mapCustomPlus.on('locationfound', onLocationFound);
	mapCustomPlus.on('locationerror', onLocationError);

    mapCustomPlus.locate({setView: false});
    */
//fin


	

</script>



      </section>

      
      
    </main>
  </div>
</div></div><script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script><script>window.WebFont.load({google: {families: ["Roboto"]}})</script></body></html>