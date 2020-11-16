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



<div class="h-50 d-flex align-items-center bg-info">
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <div class="container">
    <div class="row">
      <div class="mx-auto text-center col-md-12" style="">

        <p class="lead text-primary">
  <h1>Mentions légales et Conditions Générales d'Utilisation</h1>
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
      <h2><strong>Conditions d&rsquo;utilisation du site Histologe</strong></h2>
      <p>Les pr&eacute;sentes conditions g&eacute;n&eacute;rales d&rsquo;utilisation (dites &laquo;&nbsp;CGU&nbsp;&raquo;) fixent le cadre juridique du site &ldquo;Histologe&rdquo; et d&eacute;finissent les conditions d&rsquo;acc&egrave;s et d&rsquo;utilisation des services par l&rsquo;Utilisateur.</p>
      <p><strong>1 - Champ d&rsquo;application</strong></p>
      <p>Le site est d&rsquo;acc&egrave;s et d&rsquo;utilisation libre, facultatif et gratuit &agrave; tout Utilisateur. La demande d&rsquo;inscription aux services du site suppose l&rsquo;acceptation par tout Utilisateur des pr&eacute;sentes conditions g&eacute;n&eacute;rales d&rsquo;utilisation.</p>
      <p><strong>2 - Objet</strong></p>
      <p>Histologe a pour objectif de permettre aux habitants de logements de rep&eacute;rer et de signaler les probl&egrave;mes d&rsquo;habitats, mais &eacute;galement d&rsquo;acc&eacute;lerer l&rsquo;apport de solutions &agrave; ces probl&egrave;mes.</p>
      <p>Il vise notamment &agrave; mesurer la criticit&eacute; d&rsquo;un signalement concernant son logement. La mesure de cette criticit&eacute;, &eacute;tablie comme une classe d&rsquo;&eacute;tiquette &eacute;nergie, permettra d&rsquo;identifier facilement les actions &agrave; mettre en &oelig;uvre ainsi que leur degr&eacute; de criticit&eacute;.</p>
      <p><strong>3 &ndash; D&eacute;finitions</strong></p>
      <p class="part" data-startline="18" data-endline="22" data-position="986" data-size="0"><em data-position="986" data-size="0"><strong data-position="986" data-size="0"><span data-position="989" data-size="17">&laquo;&nbsp;L&rsquo;Utilisateur&nbsp;&raquo;</span></strong></em><span data-position="1009" data-size="96">&nbsp;est la personne habitant un logement priv&eacute; ou public qui signale un probl&egrave;me li&eacute; &agrave; son habitat.</span><br /><em data-position="1106" data-size="0"><strong data-position="1106" data-size="0"><span data-position="1109" data-size="11">&laquo; L&rsquo;agent&nbsp;&raquo;</span></strong></em><span data-position="1123" data-size="117">&nbsp;est la personne travaillant &agrave; la mairie, habilit&eacute;e &agrave; hi&eacute;rarchiser les signalements et les transf&eacute;rer aux partenaires</span><br /><em data-position="1241" data-size="0"><strong data-position="1241" data-size="0"><span data-position="1244" data-size="19">&laquo; Les partenaires&nbsp;&raquo;</span></strong></em><span data-position="1266" data-size="141">&nbsp;sont les entreprises et services d&rsquo;Etat auxquelles sont transmis les signalement et qui pourront intervenir dans leurs champs de comp&eacute;tence.</span><br /><em data-position="1408" data-size="0"><strong data-position="1408" data-size="0"><span data-position="1411" data-size="16">&laquo; Les&nbsp;services&nbsp;&raquo;</span></strong></em><span data-position="1430" data-size="82">&nbsp;sont les moyens offerts par Histologe pour r&eacute;pondre &agrave; son objet et ses finalit&eacute;s.</span><br /><em data-position="1513" data-size="0"><strong data-position="1513" data-size="0"><span data-position="1516" data-size="32">&laquo;&nbsp;Le responsable de traitement&nbsp;&raquo;</span></strong></em><span data-position="1551" data-size="360">&nbsp;est la personne qui, au sens de l&rsquo;article 4 du r&egrave;glement UE) n&deg;2016/679 du Parlement europ&eacute;en et du Conseil du 27 avril 2016 relatif &agrave; la protection des personnes physiques &agrave; l&rsquo;&eacute;gard du traitement des donn&eacute;es &agrave; caract&egrave;re personnel et &agrave; la libre circulation de ces donn&eacute;es d&eacute;termine les finalit&eacute;s et les moyens des traitements de donn&eacute;es &agrave; caract&egrave;re personnel.</span></p>
      <p><strong>4- Fonctionnalit&eacute;s</strong></p>
      <p>4.1 Signalement des probl&egrave;mes li&eacute;s &agrave; son habitat</p>
      <p>Chaque utilisateur peut signaler un probl&egrave;me li&eacute; &agrave; son habitat d&eacute;grad&eacute;.<br/>Il devra :</p>
      <ul>
        <li>S&eacute;lectionner un type de probl&egrave;me<br/>Le site propose une liste de types de probl&egrave;mes (ex : plomberie, humidit&eacute;, &eacute;lectricit&eacute; etc.) et chaque utilisateur devra en s&eacute;lectionner un.</li>
        <li>D&eacute;crire avec pr&eacute;cision le probl&egrave;me et sa gravit&eacute;<br/>Une fois la s&eacute;lection r&eacute;alis&eacute;e, l&rsquo;utilisateur va d&eacute;crire avec pr&eacute;cision le probl&egrave;me et pr&eacute;ciser la gravit&eacute; selon des crit&egrave;res (moyennement grave, grave, tr&egrave;s grave).</li>
        <li>Remplir le questionnaire d&rsquo;information du logement<br/>L&rsquo;Utilisateur devra remplir un questionnaire permettant de mesurer la criticit&eacute; du signalement. Il devra y adjoindre des photos qui serviront au calcul.</li>
      </ul>
      <p>4.2 Calcul de la criticit&eacute; et transfert du signalement aux partenaires concern&eacute;s</p>
      <p>L&rsquo;agent d&eacute;termine la criticit&eacute; du signalement en fonction des informations fournies par l&rsquo;Utilisateur et notamment :</p>
      <ul>
        <li>la dangerosit&eacute; du signalement</li>
        <li>la situation familiale</li>
        <li>la taille du logement</li>
        <li>la date de l&rsquo;immeuble</li>
      </ul>
      <p>Une fois la criticit&eacute; d&eacute;termin&eacute;e, l&rsquo;agent d&eacute;termine le partenaire ou service comp&eacute;tent. Il transfert par mail au partenaire ou service comp&eacute;tent :</p>
      <ul>
        <li>l&rsquo;ensemble du signalement r&eacute;alis&eacute; par l&rsquo;Utilisateur,</li>
        <li>l&rsquo;&eacute;valuation de la criticit&eacute; du signalement.</li>
      </ul>
      <p>L&rsquo;Utilisateur est inform&eacute; par mail de cet envoi.</p>
      <p><em>4.3 Cr&eacute;ation du compte de suivi des probl&egrave;mes li&eacute;s &agrave; son habitat</em></p>
      <p>Chaque Utilisateur peut cr&eacute;er un compte relatif &agrave; l&rsquo;outil de signalement Histologe pour suivre plus pr&eacute;cis&eacute;ment et dans le temps la prise en charge de son probl&egrave;me de logement. D&egrave;s lors, il pourra :</p>
      <ul>
        <li>Modifier son mot de passe et son identifiant&nbsp;;</li>
        <li>Suivre son signalement dans le temps;</li>
        <li>Echanger avec l&rsquo;outil et mettre &agrave; jour le signalement en cas d&rsquo;aggravation&nbsp;de sa situation;</li>
      </ul>
      <p><em>A- Modification de son mot de passe et de son identifiant</em></p>
      <p>Le mot de passe de l&rsquo;Utilisateur peut &ecirc;tre modifi&eacute; en toutes circonstances par ce dernier et doit &ecirc;tre choisi de fa&ccedil;on &agrave; ce qu&rsquo;il ne puisse &ecirc;tre devin&eacute; par un tiers.</p>
      <p>Histologe ne pourra &ecirc;tre tenue pour responsable des dommages caus&eacute;s par l&rsquo;utilisation du mot de passe par une personne non autoris&eacute;e.</p>
      <p><em>B- Suivre les signalements li&eacute;s &agrave; son habitat</em></p>
      <p>L&rsquo;Utilisateur peut suivre les signalements li&eacute;s &agrave; son habitat.</p>
      <p><em>C- Importer des pi&egrave;ces justificatives relativces au signalement</em></p>
      <p>L&rsquo;Utilisateur peut importer des photos permettant de mettre &agrave; jour le signalement lorsqu&rsquo;une aggravation de la situation s&rsquo;est produite.</p>
      <p><em>4.3 Suspension ou Suppression de l&rsquo;espace personnel</em></p>
      <p>L&rsquo;&eacute;diteur se r&eacute;serve la possibilit&eacute; de supprimer ou suspendre pour une p&eacute;riode donn&eacute;e l&rsquo;acc&egrave;s &agrave; la Plateforme pour un utilisateur, en cas de violation des pr&eacute;sentes r&egrave;gles d&rsquo;utilisation ou s&rsquo;il estime que l&rsquo;usage de la Plateforme porte pr&eacute;judice &agrave; son image ou ne correspond pas aux exigences de s&eacute;curit&eacute;.</p>
      <p><strong>5 &ndash; Responsabilit&eacute;s</strong></p>
      <p><em>5.1 L&rsquo;&eacute;diteur du site &laquo;&nbsp;Histologe&nbsp;&raquo;</em></p>
      <p>Les sources des informations diffus&eacute;es sur le site sont r&eacute;put&eacute;es fiables mais le site ne garantit pas qu&rsquo;il soit exempt de d&eacute;fauts, d&rsquo;erreurs ou d&rsquo;omissions.</p>
      <p>L&rsquo;&eacute;diteur s&rsquo;autorise &agrave; suspendre ou r&eacute;voquer un compte et toutes les actions r&eacute;alis&eacute;es par ce biais, s&rsquo;il estime que l&rsquo;usage r&eacute;alis&eacute; du service porte pr&eacute;judice &agrave; son image ou ne correspond pas aux exigences de s&eacute;curit&eacute;.</p>
      <p>L&rsquo;&eacute;diteur fournit les moyens n&eacute;cessaires et raisonnables pour assurer un acc&egrave;s continu, sans contrepartie financi&egrave;re, au site. Il se r&eacute;serve la libert&eacute; de faire &eacute;voluer, de modifier ou de suspendre, sans pr&eacute;avis, la plateforme pour des raisons de maintenance ou pour tout autre motif jug&eacute; n&eacute;cessaire.</p>
      <p><em>5.2 L&rsquo;Utilisateur</em></p>
      <p>L&rsquo;Utilisateur s&rsquo;assure de garder son mot de passe secret. Toute divulgation du mot de passe, quelle que soit sa forme, est interdite. Il assume les risques li&eacute;s &agrave; l&rsquo;utilisation de son identifiant et mot de passe.</p>
      <p>Toute information transmise par l&rsquo;Utilisateur est de sa seule responsabilit&eacute;. Il est rappel&eacute; que toute personne proc&eacute;dant &agrave; une fausse d&eacute;claration pour elle-m&ecirc;me ou pour autrui s&rsquo;expose &agrave; des sanctions.</p>
      <p>L&rsquo;Utilisateur s&rsquo;engage &agrave; ne pas mettre en ligne de contenus ou informations contraires aux dispositions l&eacute;gales et r&eacute;glementaires en vigueur. Toute contenu contraire &agrave; l&rsquo;utilisation du site ou aux dispositions l&eacute;gales et r&eacute;glementaires en vigueur sera supprim&eacute;, sans pr&eacute;avis.</p>
      <p><strong>6 - Protection des donn&eacute;es &agrave; caract&egrave;re personnel</strong></p>
      <p><em>6.1 Responsable de traitement</em></p>
      <p>Le responsable de traitement est le pr&eacute;sident de la Communaut&eacute; d&rsquo;agglom&eacute;ration Pau B&eacute;arn Pyr&eacute;n&eacute;es, Monsieur Fran&ccedil;ois Bayrou.</p>
      <p><em>6.2 Donn&eacute;es personnelles trait&eacute;es</em></p>
      <p>La pr&eacute;sente Plateforme traite les donn&eacute;es personnelles des utilisateurs suivantes&nbsp;:</p>
      <ul>
        <li>Donn&eacute;es relatives au signalement du probl&egrave;me d&rsquo;habitat (nom, pr&eacute;nom, adresse-email, adresse du logement, taille du logement, situation familiale, photos)</li>
        <li>Donn&eacute;es de cr&eacute;ation de compte et relatives au suivi du signalement du probl&egrave;me d&rsquo;habitat (nom, pr&eacute;nom, adresse e-mail, suivi du probl&egrave;me d&rsquo;habitat)</li>
        <li>Donn&eacute;es de connexion (Identifiants de connexion, nature des op&eacute;rations, date et heure de l&rsquo;op&eacute;ration)&nbsp;;</li>
        <li>Cookies</li>
      </ul>
      <p><em>6.3 Finalit&eacute;s des traitements</em></p>
      <p>Le site peut collecter des donn&eacute;es &agrave; caract&egrave;re personnelles pour mesurer la criticit&eacute; d&rsquo;un signalement concernant son logement. La mesure de cette criticit&eacute;, &eacute;tablie comme une classe d&rsquo;&eacute;tiquette &eacute;nergie, permettra d&rsquo;identifier facilement les actions &agrave; mettre en &oelig;uvre ainsi que leur degr&eacute; de criticit&eacute;.</p>
      <p>Ses finalit&eacute;s visent &agrave;&nbsp;:</p>
      <ul>
        <li>signaler et suivre les probl&egrave;mes li&eacute;s &agrave; son habitat</li>
        <li>rep&eacute;rer les habitats et immeubles n&eacute;cessitant des travaux de mani&egrave;re urgente.</li>
        <li>garantir et am&eacute;liorer la coop&eacute;ration avec les services d&rsquo;hygi&egrave;nes et de s&eacute;curit&eacute;</li>
      </ul>
      <p><em>6.4 Bases juridiques des traitements de donn&eacute;es</em></p>
      <p><em>A &ndash; Base juridique du traitement concernant les donn&eacute;es &agrave; caract&egrave;re personnel relatives au signalement du probl&egrave;me d&rsquo;habitat</span></em></p>
      <p>Le traitement de donn&eacute;es &agrave; caract&egrave;re personnel est n&eacute;cessaire &agrave; l&rsquo;ex&eacute;cution d&rsquo;une mission d&rsquo;int&eacute;r&ecirc;t public.</p>
      <p><em>B &ndash; Base juridique du traitement concernant les donn&eacute;es de cr&eacute;ation de compte et relatives au suivi du signalement du probl&egrave;me d&rsquo;habitat</em></p>
      <p>Le traitement de donn&eacute;es &agrave; caract&egrave;re personnel est n&eacute;cessaire &agrave; l&rsquo;ex&eacute;cution d&rsquo;une mission d&rsquo;int&eacute;r&ecirc;t public.</p>
      <p><em>C &ndash; Base juridique du traitement concernant les donn&eacute;es de connexion</em></p>
      <p>Le traitement de donn&eacute;es &agrave; caract&egrave;re personnel est n&eacute;cessaire au respect d&rsquo;une obligation l&eacute;gale &agrave; laquelle le responsable du traitement est soumis.</p>
      <p>Le fondement de cette obligation l&eacute;gale est le d&eacute;cret n&deg;2011-219 du 25 f&eacute;vrier 2011.</p>
      <p><em>6.5 Dur&eacute;e de conservation des traitements de donn&eacute;es</em></p>
      <table>
        <thead>
          <tr>
            <th>Donn&eacute;es</th>
            <th>Dur&eacute;e de conservation</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Donn&eacute;es relatives au signalement du probl&egrave;me d&rsquo;habitat</td>
            <td>5 ans &agrave; compter de la fin de la prise en charge du probl&egrave;me d&rsquo;habitat par le partenaire</td>
          </tr>
          <tr>
            <td>Donn&eacute;es de cr&eacute;ation de compte et relatives au suivi du probl&egrave;me d&rsquo;habitat</td>
            <td>2 ans &agrave; compter de la suppression du compte</td>
          </tr>
          <tr>
            <td>Donn&eacute;es de connexion</td>
            <td>1 an</td>
          </tr>
          <tr>
            <td>Cookies</td>
            <td>13 mois ou jusqu&rsquo;au retrait du consentement de la personne concern&eacute;e</td>
          </tr>
        </tbody>
      </table>
      <p><em>6.6 S&eacute;curit&eacute; et confidentialit&eacute;</em></p>
      <p>Toutes les mesures techniques et organisationnelles de s&eacute;curit&eacute; sont adopt&eacute;es et mises &agrave; jour pour assurer la confidentialit&eacute;, l&rsquo;int&eacute;grit&eacute; et prot&eacute;ger l&rsquo;acc&egrave;s aux donn&eacute;es</p>
      <p><em>6.7 Droits des personnes concern&eacute;es</em></p>
      <p>En vertu de l&rsquo;article 13 du r&egrave;glement (UE) n&deg;2016/679 du Parlement europ&eacute;en et du Conseil du 27 avril 2016 relatif &agrave; la protection des personnes physiques &agrave; l&rsquo;&eacute;gard du traitement des donn&eacute;es &agrave; caract&egrave;re personnel et &agrave; la libre circulation de ces donn&eacute;es, il est rappel&eacute; &agrave; chaque utilisateur dont les donn&eacute;es sont collect&eacute;es dans le cadre de l&rsquo;utilisation ou de la connexion d&rsquo;Histologe, qu&rsquo;il dispose des droits suivants concernant ses donn&eacute;es &agrave; caract&egrave;re personnel :</p>
      <ul>
        <li>Droit d&rsquo;information&nbsp;;</li>
        <li>Droit d&rsquo;acc&egrave;s aux donn&eacute;es&nbsp;;</li>
        <li>Droit de rectification &nbsp;;</li>
        <li>Droit au retrait du consentement en mati&egrave;re de cookies uniquement.</li>
      </ul>
      <p>Vous pouvez exercer ces droits en &eacute;crivant</span></p>
      <p><em>par mail</strong></em>&nbsp;&agrave; Monsieur Matthieu Vitalis-Dumas, DPO de la Communaut&eacute; d&rsquo;agglom&eacute;ration Pau B&eacute;arn Pyr&eacute;n&eacute;es.</p>
      <p>&laquo;&nbsp;<a href="mailto:m.vitalis-dumas@ville-pau.fr" target="_blank" rel="noopener">m.vitalis-dumas@ville-pau.fr</a>&nbsp;&raquo;</p>
      <p>ou&nbsp;<em><strong>par courrier</strong></em></p>
      <p>DPO Monsieur Matthieu Vitalis-Dumas<br/>Communaut&eacute; d&rsquo;agglom&eacute;ration Pau B&eacute;arn Pyr&eacute;n&eacute;es - Ville de Pau<br/>H&ocirc;tel de France - 2 bis place Royale -<br/>BP 547 - 64010 Pau Cedex France</p>
      <p>En raison de l&rsquo;obligation de s&eacute;curit&eacute; et de confidentialit&eacute; dans le traitement des donn&eacute;es &agrave; caract&egrave;re personnel qui incombe au responsable de traitement, votre demande ne sera trait&eacute;e que si vous rapportez la preuve de votre identit&eacute;. Pour vous aider dans votre d&eacute;marche, vous trouverez ici&nbsp;<a href="https://www.cnil.fr/fr/modele/courrier/exercer-son-droit-dacces" target="_blank" rel="noopener">https://www.cnil.fr/fr/modele/courrier/exercer-son-droit-dacces</a>, un mod&egrave;le de courrier &eacute;labor&eacute; par la CNIL.</p>
      <p>Vous avez la possibilit&eacute; de vous opposer &agrave; un traitement de vos donn&eacute;es personnelles. Pour vous aider dans votre d&eacute;marche, vous trouverez ici&nbsp;un mod&egrave;le de courrier &eacute;labor&eacute; par la Cnil.</p>
      <p>D&eacute;lais de r&eacute;ponse :</span><br /><span data-position="10815" data-size="260">La responsable de traitement s&rsquo;engage &agrave; r&eacute;pondre &agrave; votre demande d&rsquo;acc&egrave;s, de rectification ou d&rsquo;opposition ou toute autre demande compl&eacute;mentaire d&rsquo;informations dans un d&eacute;lai raisonnable qui ne saurait d&eacute;passer 1 mois &agrave; compter de la r&eacute;ception de votre demande.</p>
      <p><em>6.8 Destinataires</em></p>
      <p>Les donn&eacute;es collect&eacute;es et les demandes, ou dossiers r&eacute;alis&eacute;s depuis la Plateforme sont trait&eacute;es par les seules personnes juridiquement habilit&eacute;es &agrave; conna&icirc;tre des informations trait&eacute;es.</p>
      <p>Il s&rsquo;agit des agents, salari&eacute;s ou autre personne pouvant repr&eacute;senter la personne morale titulaire d&rsquo;une mission de service public qui utilise le service de la plateforme.</p>
      <p><em>6.9 Sous-traitants</em></p>
      <p>Certaines des donn&eacute;es sont envoy&eacute;es &agrave; des sous-traitants pour r&eacute;aliser certaines missions. Le responsable de traitement s&rsquo;est assur&eacute; de la mise en &oelig;uvre par ses sous-traitants de garanties ad&eacute;quates et du respect de conditions strictes de confidentialit&eacute;, d&rsquo;usage et de protection des donn&eacute;es.</p>
      <table>
        <thead>
          <tr>
            <th>Partenaire</th>
            <th>Traitement r&eacute;alis&eacute;</th>
            <th>Pays destinataire</th>
            <th>Garanties</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>OVH SAS</td>
            <td>H&eacute;bergement</td>
            <td>France</td>
            <td><a href="https://www.ovh.com/fr/support/documents_legaux/Annexe%20Traitement%20de%20donn%C3%A9es%20%C3%A0%20caract%C3%A8re%20personnel.pdf" target="_blank" rel="noopener">https://www.ovh.com/fr/support/documents_legaux/Annexe Traitement de donn&eacute;es &agrave; caract&egrave;re personnel.pdf</a></td>
          </tr>
        </tbody>
      </table>
      <p><em>6.10 Cookies</em></p>
      <p>En tant qu&rsquo;&eacute;diteur de la pr&eacute;sente Plateforme, le responsable de traitement pourra faire usage de cookies. Certains cookies sont dispens&eacute;s du recueil pr&eacute;alable de votre consentement dans la mesure o&ugrave; ils sont strictement n&eacute;cessaires &agrave; la fourniture du service, d&rsquo;autres sont &eacute;galement dispens&eacute;s d&rsquo;un tel recueil lorsqu&rsquo;ils respectent les conditions d&rsquo;exemption du consentement de l&rsquo;internaute d&eacute;finies par la recommandation &laquo; Cookies &raquo; de la Commission nationale informatique et libert&eacute;s (CNIL).</p>
      <p><strong>La mesure d&rsquo;audience (nombre de visites, pages consult&eacute;es) est r&eacute;alis&eacute;e par un outil libre intitul&eacute; Matomo sp&eacute;cifiquement param&eacute;tr&eacute;</strong>, respectant ces conditions</p>
      <p>Ces cookies cookies permettent d&rsquo;&eacute;tablir des mesures statistiques de fr&eacute;quentation et d&rsquo;utilisation du site pouvant &ecirc;tre utilis&eacute;es &agrave; des fins de suivi et d&rsquo;am&eacute;lioration du service :<br/>&bull; Les donn&eacute;es collect&eacute;es ne sont pas recoup&eacute;es avec d&rsquo;autres traitements.<br/>&bull; Le cookie d&eacute;pos&eacute; sert uniquement &agrave; la production de statistiques anonymes.<br/>&bull; Le cookie ne permet pas de suivre la navigation de l&rsquo;internaute sur d&rsquo;autres sites.</p>
      <p>Les traceurs ont vocation &agrave; &ecirc;tre conserv&eacute;s sur le poste informatique de l&rsquo;Internaute pour une dur&eacute;e allant jusqu&rsquo;&agrave; 13 mois.</p>
      <p><strong>7 - Mise &agrave; jour des conditions d&rsquo;utilisation</strong></p>
      <p>Les termes des pr&eacute;sentes conditions d&rsquo;utilisation peuvent &ecirc;tre amend&eacute;s &agrave; tout moment, sans pr&eacute;avis, en fonction des modifications apport&eacute;es &agrave; la plateforme, de l&rsquo;&eacute;volution de la l&eacute;gislation ou pour tout autre motif jug&eacute; n&eacute;cessaire.</p>
      <br><br><br>
      <h2><strong> Mentions l&eacute;gales</strong></h2>
<p>## Editeur de la plateforme</p>
<p>La plateforme est &eacute;dit&eacute;e par :</p>
<p>Communaut&eacute; d'agglom&eacute;ration Pau B&eacute;arn Pyr&eacute;n&eacute;es<br />H&ocirc;tel de France<br />2bis, place Royale<br />64000 Pau</p>
<p>## Directeur de la publication</p>
<p>Monsieur Fran&ccedil;ois Bayrou, pr&eacute;sident de la Communaut&eacute; d'agglom&eacute;ration Pau B&eacute;arn Pyr&eacute;n&eacute;es</p>
<p>## H&eacute;bergement de la plateforme<br />Ce site est h&eacute;berg&eacute; par</p>
<p>OVH SAS<br />2 rue Kellermann <br />59100 Roubaix <br />France</p>
<p>## Accessibilit&eacute;<br />La conformit&eacute; aux normes d&rsquo;accessibilit&eacute; num&eacute;rique est un objectif ult&eacute;rieur mais nous t&acirc;chons de rendre ce site accessible &agrave; toutes et &agrave; tous.</p>
<p>Si vous rencontrez un d&eacute;faut d'accessibilit&eacute; vous emp&ecirc;chant d'acc&eacute;der &agrave; un contenu ou une fonctionnalit&eacute; du site, merci de nous en faire part. Si vous n'obtenez pas de r&eacute;ponse rapide de notre part, vous &ecirc;tes en droit de faire parvenir vos dol&eacute;ances ou une demande de saisine au D&eacute;fenseur des droits. Pour en savoir plus sur la politique d'accessibilit&eacute; num&eacute;rique de l'&Eacute;tat : http://references.modernisation.gouv.fr/accessibilite-numerique</p>
<p>## S&eacute;curit&eacute;<br />Le site est prot&eacute;g&eacute; par un certificat &eacute;lectronique, mat&eacute;rialis&eacute; pour la grande majorit&eacute; des navigateurs par un cadenas. Cette protection participe &agrave; la confidentialit&eacute; des &eacute;changes, mais permet aussi aux usagers de s&rsquo;assurer de l&rsquo;authenticit&eacute; du site. En aucun cas les services associ&eacute;s &agrave; la plateforme ne seront &agrave; l&rsquo;origine d&rsquo;envoi de courriels pour demander la saisie d&rsquo;informations personnelles, en particulier, le mot de passe qui reste sous le contr&ocirc;le exclusif des usagers.</p>
</div>
  <div class="col-md-2">
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
