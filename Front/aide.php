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
<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="https://agglopau.matomo.cloud/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src='//cdn.matomo.cloud/agglopau.matomo.cloud/matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->

</head>
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
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;</a>
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
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item text-dark">
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,'accueil');" onmouseout="chSitOff(this,'accueil');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,'contact');" onmouseout="chSitOff(this,'contact');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,'aide');" onmouseout="chSitOff(this,'aide');"></a>
                </li>

                </ul>

            </div>
            </div>
          </div>
          <div class="mx-auto text-center col-md-12" id="tit2">
            <br><br><br>
            <div id="id_menub_clos" class="col-md-6 text-right">
            <div id="id_menub" class="col-md-6 text-left">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item text-dark">
                    <a href="Home" class="nav-link active text-white"><img src="img/accueil_off.png" onmouseover="chSitOn(this,'accueil');" onmouseout="chSitOff(this,'accueil');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Qui" class="nav-link active text-white"><img src="img/qui_off.png" onmouseover="chSitOn(this,'qui');" onmouseout="chSitOff(this,'qui');">&nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Contact" class="nav-link active text-white"><img src="img/contact_off.png" onmouseover="chSitOn(this,'contact');" onmouseout="chSitOff(this,'contact');"> &nbsp;&nbsp;&nbsp;</a>
                </li>
                <li class="nav-item">
                  <a href="Aide" class="nav-link active text-white"><img src="img/aide_off.png" onmouseover="chSitOn(this,'aide');" onmouseout="chSitOff(this,'aide');"></a>
                </li>

                </ul>

            </div>
            </div>
          </div>

     </div>
   </div>
 </div>



<div class="h-50 d-flex align-items-center bg-info">
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <div class="container">
    <div class="row">
      <div class="mx-auto text-center col-md-12" style="">

        <p class="lead text-primary">
   <H1>Aide et questions fréquentes du locataire</h1>
        </p>
      </div>
    </div>
  </div>
  <br><br><br>
  <br><br><br>
</div>

<!-- end content -->
 <!--end container -->
<!-- part1 -->
<div class="py-5 bg-primary" style="margin-top:-100px;">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">




<h3>Qu'est-ce qu'un logement décent ? </h3>
Un logement est décent si : <br>
<ul>
<li>la sécurité des locataires est assurée, </li>
<li>la santé des locataires est préservée,
<li>les équipements essentiels  sont fournis : coin cuisine avec évier, eau chaude et  froide, installation permettant un chauffage normal…, </li>
<li>il est protégé contre les infiltrations d’air parasites et permet une aération suffisante,   </li>
<li>il est exempt de nuisibles ou parasites.  </lI>
</ul><bR>
<h3>Les allocations logements sont-elles maintenues en cas de logement non décent ? </h3>
Si le logement est reconnu comme non-décent par la CAF ou la CMSA après la visite du logement par un expert, elles peuvent suspendre le versement des Allocations logement (AL). Le locataire ne verse au bailleur que la part du loyer non couverte par l’AL. Dans ce cas, le la CAF ou la CMSA conserve l’AL pendant un délai de 18 mois (qui peut être prolongé sous certaines conditions). Le montant de l’AL est versé au bailleur s’il effectue les travaux, s’il ne le fait pas, le montant de l’AL est perdu.
<bR><br>

<h3>Comment savoir si son logement est décent ? </h3>
La vérification de la conformité du logement aux caractéristiques de décence peut intervenir à tout moment de la location : lors de l’entrée dans les lieux (signature du bail, état des lieux) ou en cours de bail, alors que vous habitez déjà dans le logement. Vous pouvez procéder à une première évaluation de l’état de son logement par vous-même. Pour obtenir des informations sur cette auto-évaluation, il est possible de vous rapprocher de l’ADIL
<br><br>

<h3>Quelles sont les obligations du propriétaire envers son locataire ? </h3>
Le propriétaire a l'obligation de délivrer un logement décent et ne portant pas atteinte à la sécurité ou à la santé du locataire. Il est tenu de remettre au locataire un certain nombre de documents lors de la signature du contrat de location et en cours de bail.
<br><br>

<h3>Quelles sont les obligations du locataire ? </h3>
Le locataire a l’obligation de :
<ul>
<li>Payer le loyer et les charges </li>
<li>User paisiblement des locaux loués et respecter la destination du local </li>
<li>Assurer l’entretien courant du logement et l’ensemble des réparations locatives </li>
<li>Permettre l’accès aux locaux pour effectuer certains travaux </li>
<li>Ne pas transformer les locaux sans accord écrit du propriétaire </li>
<li>Assurer le logement contre les risques locatifs </li>
<li>Laisser visiter le logement durant le préavis </li>
</ul>
<br>

<h3>Mon propriétaire veut faire des travaux d’amélioration : suis-je obligé d’accepter ? </h3>

Vous ne pouvez pas vous opposer aux travaux :
<ul>
<li>nécessaires au maintien en état ou à l’entretien normal du logement ; </li>
<li>d’amélioration de la performance énergétique du logement ; </li>
<li>qui permettent de rendre le logement décent ; </li>
<li>d’amélioration des parties communes qui nécessitent une intervention dans votre logement. </li>
<li>Cependant, le bailleur doit vous informer de la nature et des modalités d’exécution des travaux par une notification de travaux (remise en main propre ou par lettre recommandée avec demande d’avis de réception). </li>
<li>Si les travaux durent plus de 21 jours, vous pouvez demander une réduction du loyer. Ils ne peuvent pas être réalisés les samedis, dimanches et jours fériés sans votre accord. </li>
</ul>
<br>
<h3>Le locataire doit-il payer certaines réparations ? </h3>
Oui, le locataire doit prendre à sa charge les petites réparations et l’entretien courant du logement. Il doit également prendre à sa charge les réparations liées à des dégradations dues à un usage anormal du logement (moquette brulée, trous dans le mur, dégâts causés par des animaux…).
<br>
Les réparations à la charge du bailleur sont notamment celles liées à :
<ul>
<li>la vétusté, c’est-à-dire l’usure du logement causée par le temps, </li>
<li>un défaut de construction, </li>
<li>un cas de force majeure. </li>
</ul>
<br>
<h3>Mon logement est non décent : puis-je suspendre le paiement du loyer ? </h3>
Le locataire doit toujours régler son loyer. Seul un juge peut autoriser la suspension des paiements. Si le locataire perçoit les AL, et si le logement est reconnu comme non-décent par la CAF ou la CMSA après sa visite par un expert, elles peuvent suspendre le versement des AL. Le locataire ne verse au bailleur que la part du loyer non couverte par l’AL.
<br><br>

<h3>En cours de bail, mon propriétaire peut-il augmenter le loyer comme il veut ? </h3>
Le loyer peut être augmenté une fois par an si une clause du bail le prévoit. Cette clause s'appelle une "clause de révision". Si le bail ne prévoit pas de clause de révision, le loyer reste le même pendant toute la durée de la location.
<br>
La date de révision est celle indiquée dans le bail ou, à défaut, la date anniversaire du bail.
<br>
L'augmentation ne peut être supérieure à la variation de l'indice de référence des loyers publié chaque trimestre par l'INSEE.
<br>
L'indice de référence à prendre en compte est celui du trimestre qui figure dans le bail ou à défaut, le dernier indice publié à la date de signature du bail. Il est à comparer, à la date de la révision du loyer, avec l'indice du même trimestre connu à cette date.
<br>
Depuis le 27 mars 2014, le bailleur dispose d'un délai d'1 an à compter de la date prévue pour la révision, pour en faire la demande. S'il manifeste sa volonté de réviser le loyer dans ce délai, la révision prendra effet au jour de sa demande. Passé ce délai d’un an, la révision du loyer pour l’année écoulée n'est plus possible.  
<br><br>

<h3>Le contrat de location peut-il être verbal ? </h3>
Malgré l’exigence formelle d’établir un écrit, le bail verbal n’est pas nul. Chaque partie peut exiger de l’autre partie, à tout moment, l’établissement d’un contrat écrit. 
<br><br>

<h3>Mon propriétaire veut récupérer son logement. Peut-il me forcer à partir ? </h3>

Le bailleur ne peut pas vous donner congé en cours de bail si vous respectez vos obligations (payer le loyer et les charges, ne pas causer de troubles de voisinage…). En revanche, en fin de bail, il peut vous demander de quitter les lieux s’il souhaite vendre le logement ou le reprendre pour l’habiter lui-même ou y loger un membre de sa famille (ses ascendants ou descendants, son conjoint, son partenaire de PACS, son concubin connu depuis au moins un an).
<br>
Il peut aussi vous donner congé pour un motif légitime et sérieux comme des retards systématiques dans le paiement des loyers.  <br>
Dans tous les cas, il doit vous adresser une lettre de congé avec un préavis de 6 mois avant l’échéance du bail en précisant le motif du congé. 
<br><br>

<h3>Le propriétaire est-il obligé de faire les travaux que je lui demande ? </h3>

Le locataire ne peut exiger de son bailleur la réalisation de tous types de travaux. En effet, le propriétaire bailleur est tenu de fournir un logement décent au locataire. Il est également en charge des réparations nécessaires à l’entretien et au maintien en l’état du logement loué. Il doit par conséquent réaliser certains travaux de mise en décence du logement. S’il refuse de les effectuer, vous avez la possibilité d’entamer une conciliation ou de saisir le tribunal d’instance. Le juge tranchera sur la nécessité d’effectuer ces travaux.
<br><br>

<h3>A quel moment et comment établir un état des lieux ? </h3>

L’état des lieux est à réaliser lors de l’entrée dans le logement du locataire puis à sa sortie. Il peut être établi directement entre le bailleur et le locataire ou avec l’aide d’un professionnel (agent immobilier, notaire, huissier de justice...).
<br>L’état des lieux d’entrée et de sortie ont pour but d’être comparés. Ils doivent donc prendre la forme :
<ul>
<li>soit d’un document unique distinguant l’état des éléments à l’entrée et à la sortie, </li>
<li>soit de deux documents distincts ayant une présentation similaire.  </li>
</ul>
Le bailleur peut refuser d’établir un état des lieux d’entrée. Dans ce cas, s’il souhaite facturer des dégradations au locataire à la fin du bail, il devra apporter la preuve qu’il a fourni un logement en bon état. 
<br>
Si le locataire s'oppose à l'établissement de l'état des lieux lors de son entrée dans le logement, il sera présumé l'avoir reçu en bon état. 
<br>
Si par négligence du bailleur et du locataire, aucun état des lieux n'est dressé au début de la location, le locataire sera également présumé avoir reçu le logement en bon état.
<br><br>

<H3>D’autres questions concernant votre situation, n'hésitez pas à contacter : </h3>
l’ADIL des Pyrénées-Atlantiques
<br>
7 rue Camy <br>
64000 Pau  <br>
Tél : 05 59 02 26 26  <br>
Site : https://www.adil64.org<br>




      </div>
      <div class="col-md-2">
      </div>
  </div>
</div>







  </div>


        </div>




<!--end Part1 -->





<!-- footer -->
<div class="row">
    <div class="col-md-12 text-center fo">
        <p class="mb-4">
           <br><br> <br><br><a href="CGU">Mentions légales</a> -
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

  </div>
<!--end footer -->

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
 <script>
  function chSitOn(element, img) {
    element.setAttribute('src', 'img/'+img+'_on.png');
}
function chSitOff(element, img) {
    element.setAttribute('src', 'img/'+img+'_off.png');
}
</script>

</html>
