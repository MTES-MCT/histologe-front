<?php
 session_start();
 //ini_set('display_errors',1);
 //echo "-".$_SESSION['admin'];
 //var_dump($_SESSION);
 if($_SESSION['admin']!='ok') {
$comp='';
  if(isset($_GET['id'])) {
    $comp = '?sg='.$_GET['id'];
  }  
  header("Location: https://histologe.beta.gouv.fr/_adm/home.php".$comp);
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




// préparation connexion
$connect = new connection();
$infosForm = new etat_formAdm($connect);
$infosForm->traceUser($_SESSION['user'], 'Page SuiviSign['.$idSign.']');
$tab1=$infosForm->getSignAdrById($idSign);
$tab2=$infosForm->getlistSuiviBySign($idSign);
$tab3=$infosForm->getSignByPart($idSign, $_SESSION['userId']);

$part = $infosForm->getPartById($_SESSION['idPartenaire']);


$aff='';
if($tab1[0]->dtPriseEnCharge != '0000-00-00 00:00:00') {
    $aff=' <table class="table">
    <tbody>
     <tr class="text-dark">
         <td width="20%">Auteur :  HISTOLOGE</td><td width="80%" align="right">Date : '.$tab1[0]->dtPriseEnCharge.'</td>
     </tr> 
     <tr>
         <td width="2%" class="dark">&nbsp;</td>
         <td width="80%">Prise en Charge sur Histologe par '.$tab1[0]->suiviPar.'.  </td>
     </tr>
    </tbody>
 </table>';
}



?>


<!doctype html>
<html lang="fr"><head>
<link href="css/styleAdm.css" rel="stylesheet" media="all">	
<style>
label,
textarea {
    font-size: .8rem;
    letter-spacing: 1px;
}
textarea {
    padding: 10px;
    line-height: 1.5;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-shadow: 1px 1px 1px #999;
}

label {
    display: block;
    margin-bottom: 10px;
}
.dark {
    background-color: rgba(0, 0, 0, 0.05);;
}
.text-dark {
    font-weight: bold;
    font-size: 80%;
}
.text-small {
    font-weight: lighter;
    font-size: 70%;
}
.txt-alert {
  color: black;
  text-decoration: red;
  font-weight: bold;
}
</style>
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
          <a class="nav-link" href="home.php">Accueil</a>
        </li>
        
      
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Rechercher" aria-label="Rechercher">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
      </form>
    </div>
  </nav>
</header>

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
 
      
      <h2>|| <a href="detailsSign.php?id=<?php echo $idSign; ?>">Détails du Signalement</a>  || <b>Suivi</b> ||</h2>
      
      <div class="table-responsive">
        <table class="table table-striped">
           <tbody>
            <tr>
                <td><b>SIGNALEMENT Ref#<?php echo substr($tab1[0]->codepostal,0,2).'-'.$tab1[0]->refSign; ?> DE </b><?php echo $tab1[0]->courriel.' ('.$tab1[0]->numeroRue.' '.$tab1[0]->nomRue.' '.$tab1[0]->ville.')' ?>
                </td>
            </tr> 
           </tbody>
        </table>
<?php 
      $aff='  <!-- bloc de saisie -->
        <form id="pubSuivi" name="pubSuivi" action="insSuivi.php" method="post">
            <input type="hidden" name="idSign" value="'.$idSign.'">
            <input type="hidden" name="actionSend" id="actionSend">
        <table class="table table-striped">
           <tbody>
            <tr>
                <td>Ajouter un suivi</td>
                <td><textarea id="story" name="story" rows="5" cols="133"></textarea>
                <br><a href="#" id="publish" class="btn btn-primary btn-lg">Publier</a>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="sendCom"> Suivi visible pour le demandeur.
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;';
        if($tab1[0]->etat != 4 && $tab1[0]->etat != 8) { 
                $aff=$aff.'<a href="#" id="cloture" class="btn btn-primary btn-lg txt-alert">Cloturer pour '.$part[0]->libPartenaire.'</a>';
                } else {
                  //etat = 4 : au moins un partenaire a cloturé le signalement pour lui
                  //recherche des partenaires qui ont cloturé
                  $etatSignPart=$infosForm->getPartSignEtatBySign($_SESSION['idPartenaire'], $idSign );
                  if($etatSignPart[0]->etat == 4 || $etatSignPart[0]->etat == 8)  {
                    $aff = $aff.'<span class="txt-alert">Signalement Cloturé pour '.$part[0]->libPartenaire.'!</span>'; 
                  } else {
                    //Signalement non cloturé pour ce partenaire 
                    if($_SESSION['idPartenaire'] !=10 ) {
                    $aff=$aff.'<a href="#" id="cloture" class="btn btn-primary btn-lg txt-alert">Cloturer pour '.$part[0]->libPartenaire.'</a>';
                    } else {
                      //cas particulier Histologe

                    }
                  }
                } 
          if($_SESSION['idPartenaire'] == 10 && $tab1[0]->etat != 8) {
            //Forcer la cloture pour tous les partenaires par HISTOLOGE
            echo '<a href="#" id="clotureAll" class="btn btn-primary btn-lg txt-alert">Cloturer pour tous les partenaires</a>';
          }
        $aff=$aff.'</td>
            </tr> 
           </tbody>
        </table>
        </form>
        <!-- fin bloc de saisie -->
        ';

        //Affichage du suivi uniquement pour utilisateur affecté au signalement.
        if(!empty($tab3) || ($_SESSION['userId']=='4' || $_SESSION['userId']=='3')) {
          //Vérifier si signalement accepté
          if($tab3[0]->affect != 1) {
            echo $aff; 
          } else {
            echo '<font color="red"><b>Vous devez accepter ou refuser ce signalement avant d\'ajouter un suivi.</b></font> <a href="detailsSign.php?id='.$idSign.'">Retour signalement</a><br>'  ;
          }

        } else {
          echo '<b>Ce signalement ne vous est pas affecté, vous ne pouvez pas ajouter de suivi.</b><br>'  ;
          }


        $aff='';

?>
        <!-- blocs affichage -->
        <table class="table">
           <tbody class="dark">
             <tr>
             
              <td>
                    <?php
                        $x=0; $suiv='';
                        foreach($tab2 as $key){ 
                         $partName = $infosForm->getPartById($tab2[$x]->idPartenaire);
                          $theDesc = str_replace('\r\n', '<br>', $tab2[$x]->descSuivi);
                          $theDesc = str_replace('\t',' ', $theDesc);

                            if($tab2[$x]->avisUser=='on') $comp1='<br><span class="text-small">Demandeur en copie.</span>';
                            $suiv=$suiv.'  <table class="table">
                            <tbody>
                                <tr class="text-dark">
                                <td width="20%">Auteur : '.$tab2[$x]->user.$comp1.'<br>
                                ['.$partName[0]->libPartenaire.']
                                </td> 
                                <td width="80%" align="right">Date : '.$tab2[$x]->dtSuiviF.'<br></td>
                                </tr> 
                                <tr>
                                <td width="20%" class="dark">&nbsp;</td>
                                <td width="80%">'.$theDesc.'</td>
                                </tr>
                            </tbody>
                            </table>';


                         $x++;
                        }
                        echo $suiv;
                    ?>
               


                  
              </td>  
            </tr>

            <tr><td>
                <?php echo $aff;?>
            </td></tr>

            <tr><td>
                <table class="table">
                <tbody>
                <tr class="text-dark">
                    <td width="20%">Auteur :  HISTOLOGE</td>
                    <td width="80%" align="right">Date : <?php echo $tab1[0]->dtCreaSignalement; ?></td>
                </tr> 
                <tr>
                <td width="20%" class="dark">&nbsp;</td>
                <td width="80%">Création du signalement.  </td>
                </tr>
                </tbody>
                </table>
            </td></tr>

           </tbody>
        </table>
   



      
        <!-- fin blocs affichage -->


              
      </div>
    </main>
  </div>
</div></div>

<table align=center><tr><td>&nbsp;</td><td><div class="info">Mise à jour ok</div></td></tr></table>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

$( function() {



$('.info').hide();

});


$("#publish").bind("click", (function () {

    const str3=document.getElementById("story").value;
    t=0;        
    if(str3=="" || str3.length < 2 ) {
				t=1;
				alert('Merci de renseigner le suivi .');
            }
            
    if(t==0) {
         document.getElementById('actionSend').value='suivi';
         document.getElementById('pubSuivi').submit();
    }
}));

$("#cloture").bind("click", (function () {

const str3=document.getElementById("story").value;
t=0;        
if(str3=="" || str3.length < 2 ) {
    t=1;
    alert('Merci de renseigner le suivi .');
        }
        
if(t==0) {
     document.getElementById('actionSend').value='cloture';
     document.getElementById('pubSuivi').submit();
}
   


}));
$("#clotureAll").bind("click", (function () {

const str3=document.getElementById("story").value;
t=0;        
if(str3=="" || str3.length < 2 ) {
    t=1;
    alert('Merci de renseigner le suivi.');
        }
        
if(t==0) {
     document.getElementById('actionSend').value='clotureAll';
     document.getElementById('pubSuivi').submit();
}
   


}));

</script>
