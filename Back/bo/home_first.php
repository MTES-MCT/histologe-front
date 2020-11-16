<?php
session_start();

?>
<!doctype html>
<html lang="fr"><head>
<link href="../css/styleAdm.css" rel="stylesheet" media="all">	

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
          <a class="nav-link" href="#">Acceuil
            <span class="sr-only">(current)</span>
          </a>
        </li>
       
      
      </ul>
     
    </div>
  </nav>
</header>

<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
         
    </nav>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
     <br><br>
      <section class="row text-center placeholders">
        <div class="col-6 col-sm-3 placeholder">
                <h4>PREMIERE CONNEXION </h4>
                <?php echo '<b>'. $_SESSION['msg_erreur'].'</b>'; ?>
          <div class="text-muted">Entrer votre adresse courriel :</div>
          <form class="form-inline mt-2 mt-md-0" action="first_ident.php" method="post">
              <input type="hidden" name="act" value="mail">
             <input class="form-control mr-sm-2" type="text" placeholder="Utilisateur" aria-label="Utilisateur" name="user" id="user">
            
             <button class="btn btn-outline-success my-2 my-sm-0" id="but1" type="submit">Envoyer</button>
      </form>
        </div>
     
      </section>

    </main>
    
</div></div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"></script><script>window.WebFont.load({google: {families: ["Roboto"]}})</script></body></html>
