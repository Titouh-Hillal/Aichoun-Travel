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
        <a class="navbar-brand " href="Acceuil.php"><img src="../Img/aichoun_logo_2.png" alt="" height="80px" width="80px">Aichoun Travel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item" id="vols">
              <a class="nav-link" aria-current="page" href="vols.php">Vols</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Hotels.php">Hotels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vols&hotels.php" tabindex="-1" aria-disabled="true">Vols & Hotels</a>
            </li>
          </ul>
          <?php if(isset($_SESSION["id_client"])): ?>
          <div class="d-flex ms-auto"> 
            <div class="btn-group dropstart">
              <button class="btn btn-secondary" type="button" id="navbar-color">
                <p id="user_name">
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
                    <li><a class="dropdown-item" href="#">mes reservation</a></li>
                    <li><a class="dropdown-item" href="../php/deconnexion.php">déconnecter</a></li>
              </ul>
            </div>
          </div>
          <?php else:?>
          <div class="d-flex ms-auto">
            <div class="dropdown me-2">
              <a href="Connexion.html"><button class="btn btn-primary" type="button" id="connexion_button">Connexion</button></a>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </nav>
    

    <main>
      <?php if(isset($_SESSION["id_client"])): ?>
        <section>
          <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
              <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Réservez maintenant</h1>
              </div>
              <div class="modal-body p-5 pt-0">
                <form action="../php/reservation_vo.php" method="post">
                  <!-- Add a hidden input field for the card ID -->
                  <input type="hidden" name="cardId" value="<?php echo $_GET['id']; ?>">
                  <input type="hidden" name="id_client" value="<?php echo $_SESSION['id_client']; ?>">
                  <div class="row">
                    <div class="col">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                        <label for="floatingInput">Nom</label>
                      </div>
                    </div> 
                    <div class="col">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                        <label for="floatingInput">Prénom</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-floating mb-3">
                        <input type="tel" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" name="tel"  value="<?php echo $_SESSION['tel']; ?>">
                        <label for="floatingInput">Numéro telephone</label>
                      </div>
                    </div> 
                    <div class="col">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" name="email"  value="<?php echo $_SESSION['email']; ?>">
                        <label for="floatingInput">Email</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" name="num_passport" value="<?php echo $_SESSION['num_passport']; ?>">
                        <label for="floatingInput">Numéro Passeport</label>
                      </div>
                    </div>
                  </div>
                  <!--<div class="row">
                    <div class="col">
                      <div class="form-floating mb-3">
                        <input type="date" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">date d'expédition du passeport</label>
                        </div>
                      </div>  
                  </div>-->
                    
                  <div class="row">
                    <div class="col">
                      <button type="submit" class="btn btn-primary 1">Soumettre</button>
                      <button type="reset" class="btn btn-primary 2">Réinitialiser</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      <?php else: ?>
        <section>
          <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
              <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Réservez maintenant</h1>
              </div>
              <div class="modal-body p-5 pt-0">
                <form action="" method="post">
                  <!-- Add a hidden input field for the card ID -->
                  <input type="hidden" name="cardId" value="<?php echo $_GET['id']; ?>">
                  <div class="row">
                    <!-- Rest of your form fields -->
                  </div>
                  <div class="row">
                    <div class="col">
                      <button type="submit" class="btn btn-primary 1">Soumettre</button>
                      <button type="reset" class="btn btn-primary 2">Réinitialiser</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>
    </main>


    <footer class="scroll-bottom text-white pt-5 pb-4 " id="footer-color">

      <div class="container text-center text-md-left">

        <div class="row text-center text-md-left">
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <img class="d-inline-block align-center" src="../Img/aichoun_logo_2.png" width="300" height="280">  
          </div>

          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">
              Aichoun Travel
            </h5>
            <p>
              AICHOUN Tourism and Travel Agency est l'une des plus importantes entreprises touristiques en Algérie Avec plusieurs activités qui contribuent à la dynamisation du développement touristique en Algérie. Aichoun Tourism and Travel Agency, une société par actions, créée en 2016 avec un capital social initial fixé à100 000 000 DZD. Le nombre de ses employés a atteint 12, répartis entre ses différentes branches et directions.
            </p>

          </div>
          <div class="col-md-2 col-lg-2 col-xl-3 mx-auto mt-3">
          
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">
              Services
            </h5>
            <p>
              <a href="" target="" class="text-white" style="text-decoration: none;">
                BILLETTERIE
              </a>
            </p>
            <p>
              <a href="" target="" class="text-white" style="text-decoration: none;"  target="_blank">
              OMRA ET HADJ
              </a>
            </p>
            <p>
              <a href="" target="" class="text-white" style="text-decoration: none;">
              VOYAGE ORGANISE
              </a>
            </p>
            <p>
              <a href="" target="" class="text-white" style="text-decoration: none;">
                VOYAGE D'AFFAIRE
              </a>
            </p>
            <p>
              <a href="" target="" class="text-white" style="text-decoration: none;">
                RESERVATION D'HOTEL
              </a>
            </p>
            <p>
              <a href="" target="" class="text-white" style="text-decoration: none;">
                  VISAS
              </a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">

            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">
              Contact <br>
              
            </h5>
            <p>
              <a href="https://www.google.com/maps/place/AICHOUN+TRAVEL/@36.3759179,3.8814627,17z/data=!4m6!3m5!1s0x128c2f097226624d:0x9d4187881da3bd42!8m2!3d36.3754255!4d3.8823854!16s%2Fg%2F11gtc4dscl"
                 target="_blank" class="text-white" style="text-decoration: none;">
                <i class="bi bi-geo-alt-fill"></i>
                Résidence ELYASMINE-Condor Immo(Route de Ain Bessem) Bouira
              </a>
            </p>
            <p>
              <i class="bi bi-envelope-fill"></i>
              aichountours@gmail.com
            </p>
            <p>
              <h6 class="text-uppercase mb-4 font-weight-bold text-warning">
                OMRA <br>
              </h6>
              <i class="bi bi-telephone-fill"></i>
              +213 26 73 40 61 <br>
              <i class="bi bi-phone-fill"></i>
              +213 560 085 998
             </p>
            <p> <h6 class="text-uppercase mb-4 font-weight-bold text-warning">
              Commercial 
            </h6>
            <i class="bi bi-telephone-fill"></i>
              +213 26 73 41 10 <br>
              <i class="bi bi-phone-fill"></i>
              +213 560 085 049 <br>
            </p>

          </div>
          <hr class="mb-4">
          <div class="col-md-7 col-lg-8">
            <p><i class="bi bi-c-circle"></i> Copyright 2023 All rights reserved</p>

          </div>

          <div class="col-md-5 col-lg-4">
            <div class="text-center text-md-right">
              <ul class="list-unstyled list-inline">
                <li class="list-inline-item">
                  <a href="https://web.facebook.com/Aichountravel.agency" target="_blank" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                    <i class="bi bi-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" target="_blank" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                    <i class="bi bi-instagram"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" target="_blank" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                   <i class="bi bi-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" target="_blank" class="btn-floating btn-sm text-white" style="font-size: 23px;">
                    <i class="bi bi-linkedin"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>

        </div>

      </div>

    </footer>
    <script src="../javascript/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>