<!DOCTYPE html>
<html lang="fr"><head>
  <meta charset="utf-8">
  <meta name="description" content="Signalez un problème d'habitabilité dans votre logement.">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="Histologe">
  <meta property="og:url" content="https://histologe.beta.gouv.fr">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Signalez un problème d'habitabilité dans votre logement.">
  <meta property="og:site_name" content="Histologe">
  <meta name="twitter:title" content="Histologe">
  <meta name="twitter:description" content="Signalez un problème d'habitabilité dans votre logement.">
  <meta name="apple-mobile-web-app-title" content="Histologe">

  <title>Histologe, un service public pour les locataires et les propriétaires</title>

  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" href="boot/css/bootstrap.css">


  <body>
 <div class="container">
    <header class="row">
    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top navbar-dark col-md-12 " >

            <a class="logoNav" href="Home"></a>
            <a class="logoNav2" href="Home"></a>
            <a class="logoNav3" href="Home"></a>
            <a class="menub" href="#id_menub" id="menu" onclick="agents(this.id)"></a>
            <a class="menubis" href="#id_menub_clos" id="menub_bis" style="display:none;" onclick="agents(this.id)"></a>
            <a class="menub_2" href="#id_menub_2" id="menu_2" onclick="agents_2(this.id)"></a>
            <a class="menubis_2" href="#id_menub_clos_2" id="menub_bis_2" style="display:none;" onclick="agents_2(this.id)"></a>
            <br><br><br>



            <nav class="collapse navbar-collapse text-dark navbarResp" role="navigation" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                <li class="nav-item text-dark">
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,'accueil');" onmouseout="chSitOff(this,'accueil');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="QuiHistologe" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,'contact');" onmouseout="chSitOff(this,'contact');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,'aide');" onmouseout="chSitOff(this,'aide');"></a>
                </li>

                </ul>

            </nav>
    </nav>
    </header>

<!-- start content -->

    <div class="row">

      <div class="col-md-12 ft ">
        <div class="mx-auto text-center col-md-12 " id="tit1">
            <br><br><br><br>
            <div id="id_menub_clos_2" class="col-7 col-md-7 text-right">
            <div id="id_menub_2" class="col-7 col-md-7 text-left">
                    <ul class="nav navbar-nav navbarRespCote" style="margin-left:-15px;margin-top:50px;">
                  <li class="nav-item">
                      <a href="index.html" class="nav-link active">Accueil </a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="quiHistologe.php" class="nav-link active">Qui sommes-nous ?</a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="contact.php" class="nav-link active">Contact</a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="aide.php" class="nav-link active">Aide </a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="Aide" class="nav-link active">Inscription </a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="Aide" class="nav-link active">Connexion </a>
                  </litransition>
                  </ul>
            </div>
            </div>
          </div>
          <div class="mx-auto text-center col-md-12" id="tit2">
            <br><br><br>
            <div id="id_menub_clos" class="col-md-6 text-right">
            <div id="id_menub" class="col-md-6 text-left">
                    <ul class="nav navbar-nav navbarRespCote" style="margin-left:-15px;margin-top:50px;">
                  <li class="nav-item">
                      <a href="Home" class="nav-link active">Accueil</a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="QuiHistologe" class="nav-link active">Qui sommes-nous ?</a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="Contact" class="nav-link active">Contact</a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="Aide" class="nav-link active">Aide</a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="Aide" class="nav-link active">Inscription</a>
                  </li>
                  <br>
                  <li class="nav-item">
                    <a href="Aide" class="nav-link active text-white">Connexion</a>
                  </li>
                  </ul>
            </div>
            </div>
          </div>

     </div>
   </div>
     </div>


<!-- end content -->
 <!--end container -->
<!-- part1 -->

<div class="h-50 d-flex align-items-center bg-info">
  <div class="container">
    <div class="row">
      <div class="mx-auto text-center col-md-12" style="">
      <!-- start -->

<div class="container contact-form">
  <br><br><br><br><br><br><br><br><br><br>

          <form method="post" action="Message" name="contact" id="contact">
              <h3>Une question, une précision ? N’hésitez pas à nous envoyer un message !</h3>
              <br><br><br><br>
             <div class="row">
               <div class="col-md-2">
               </div>
                  <div class="col-md-3">
                    <h2> Message </h2>
                    <br><br>
                      <div class="form-group">
                          <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Votre nom *"/>

                      </div>
                      <div class="form-group">
                          <input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="Votre courriel *"/>
                      </div>
                      <div class="form-group">
                          <textarea name="txtMsg" id="txtMsg" class="form-control" placeholder="Votre message *" style="width: 100%; height: 150px;"></textarea>
                      </div>
                      <div class="form-group">
                          <a href="#" class="btn btn-primary" id="contactSend">Envoyer</a>
                      </div>
                  </div>
                  <div class="col-md-1">
                  <div class="separation">
                  </div>
                  </div>
                  <div class="col-md-3">
                    <h2> Téléphone </h2>
                    <br><br><br><br>
                    <div id="petitTel">
                    <img src="img/telGrand.png">
                  </div>
                  <!-- <div id="grandTel">
                  <img src="img/telMini.png">
                </div> -->
                  </div>
                  <div class="col-md-2">
                  </div>
              </div>
          </form>
          <br><br><br><br><br><br><br><br><br>
</div>


<!-- end -->
      </div>
    </div>
  </div>
</div>

<!--end Part1 -->





<!-- footer -->
    <div class="col-md-12 text-center fo">
        <p class="mb-4">
           <br><br> <br><br><a href="cgu.php">Mentions légales</a> -
          <a href="https://www.agglo-pau.fr" target="_new">Communauté d'agglomération Pau-Béarn Pyrénées</a> -
          <a href="https://https://www.cohesion-territoires.gouv.fr/lagence-nationale-de-la-cohesion-des-territoires"  target="_new"> Agence Nationale de la Cohésion des Territoires</a> -
          <a href="https://beta.gouv.fr"  target="_new">Beta Gouv</a> -
          <a href="contact.php">Contact</a></p>
            <div class="col-md-12 col-3 text-center">
            <a href="https://www.agglo-pau.fr"  target="_new"><img src="img/agglo.png" heigth=83 width=156></a> &nbsp;&nbsp;&nbsp;
            <a href="https://https://www.cohesion-territoires.gouv.fr/lagence-nationale-de-la-cohesion-des-territoires"  target="_new">
            <img src="img/anct.png" heigth=82 width=143> &nbsp;&nbsp;&nbsp;
            <a href="https://beta.gouv.fr"  target="_new"><img src="img/betagouv.png" heigth=82 width=154>
            </div>
        </p>

    </div>

<!--end footer -->
</div>

<script>

function agents(id){
    if(document.getElementById("menub_bis").style.display ==""){
      document.getElementById("menub_bis").style.display ="none";
      document.getElementById("menu").style.display ="";
    }
    else if(document.getElementById("menu").style.display ==""){
      document.getElementById("menub_bis").style.display ="";
      document.getElementById("menu").style.display ="none";

    }
}

function agents_2(id){
    if(document.getElementById("menub_bis_2").style.display ==""){
      document.getElementById("menub_bis_2").style.display ="none";
      document.getElementById("menu_2").style.display ="";
    }
    else if(document.getElementById("menu_2").style.display ==""){
      document.getElementById("menub_bis_2").style.display ="";
      document.getElementById("menu_2").style.display ="none";

    }
}

</script>


  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/check.js"></script>
 <script>
  function chSitOn(element, img) {
    element.setAttribute('src', 'img/'+img+'_on.png');
}
function chSitOff(element, img) {
    element.setAttribute('src', 'img/'+img+'_off.png');
}
</script>

</html>
