<?php
  session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/Acceuil.css">
    <title>Aichoun Travel</title>
    <link rel="shortcut icon" href="../Img/aichoun_logo_2.png" type="image">
  </head>
  <body>
    
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm pt-0 pb-0" id="navbar-color">
      <div class="container-fluid">
        <a class="navbar-brand " href="admin.php"><img src="../Img/aichoun_logo_2.png" alt="" height="80px" width="80px">Aichoun Travel Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item" id="vols">
              <a class="nav-link" aria-current="page" href="ajouter_voyage.php">Ajouter un offres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="liste_clients_admin.php">Liste des clients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="message_admin.php">Messages</a>
              </li>
          </ul>

          <?php if(isset($_SESSION["id_admin"])): ?>
          <div class="d-flex ms-auto"> 
            <div class="btn-group dropstart">
              <button class="btn btn-secondary" type="button" id="navbar-color">
                <p>
                  <?php
                    echo $_SESSION["prenom"] . " " . $_SESSION["nom"];
                    ?>
                </p>
              </button>
              <button type="button" class="btn btn-sm btn-secondary dropdown-toggle"
              id="navbar-color" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Mon compte</a></li>
                <li><a class="dropdown-item" href="../php/deconnexion_admin.php">déconnecter</a></li>
              </ul>
            </div>
          </div>
          <?php else: ?>
          <div class="d-flex ms-auto">
            <div class="dropdown me-2">
              <a href="connexion_admin.html"><button class="btn btn-primary" type="button" id="connexion_button">Connexion</button></a>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </nav>
    

    <main>
        <section>
          <?php if(isset($_SESSION["id_admin"])): ?>
            <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h2 id="bienvenue-admin">Bienvenue <?php echo $_SESSION["prenom"];?></h2>
            </div>
          <?php else: ?>
            <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h2 id="bienvenue-admin">Bienvenue</h2>
            </div>
            <?php endif; ?>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="../Img/voyage_organisé.png" class="card-img-top" alt="">
                            <div class="card-body">
                              <h5 class="card-title">Voyages organisés et offres</h5>
                              <p class="card-text">Ajouter une offre ou un service </p>
                              <a href="ajouter_voyage.php" class="btn btn-primary">Ajouter une offre</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="../Img/liste_clients.png" class="card-img-top" alt="">
                            <div class="card-body">
                              <h5 class="card-title">Clients</h5>
                              <p class="card-text">voir la liste des clients </p>
                              <a href="liste_clients_admin.php" class="btn btn-primary">Voir les clients</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="../Img/message.png" class="card-img-top" alt="">
                            <div class="card-body">
                              <h5 class="card-title"> Messages</h5>
                              <p class="card-text">Messages et réclamations</p>
                              <a href="message_admin.php" class="btn btn-primary">Voir les réclamations</a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </section>
            
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>