<?php
session_start();

require_once('../php/base_de_données.php');
$query="SELECT * FROM service";
$result = mysqli_query($mysqli,$query);
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
          <?php if(isset($_SESSION["id_client"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "client"): ?>
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
      <section class="carousel">
        <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExamplewhite" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item cc1 active" data-bs-interval="10000">
              <div class="carousel-caption d-none d-md-block">
                <h5>Vols</h5>
                <p></p>
                <a href="vols.php" target=""><button class="btn btn-primary ">Vols</button></a>
              </div>
            </div>
            <div class="carousel-item cc2" data-bs-interval="2000">
              <div class="carousel-caption d-none d-md-block">
                <h5>Hotels</h5>
                <p></p>
                <a href="Hotels.php" target=""><button class="btn btn-primary ">hotels</button></a>
              </div>
            </div>
            <div class="carousel-item cc3" ata-bs-interval="10000">
              <div class="carousel-caption d-none d-md-block">
                <h5>Vols & hotels</h5>
                <p></p>
                <a href="vols&hotels.php" target=""><button class="btn btn-primary ">vols&hotels</button></a>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>

      <section>
        <br>
        <div style="position: relative; left: 2%;">
          <h2><i class="bi bi-fire" ></i>MEILLEURES OFFRES <br></h2>
        </div>
        <h5 style="position: relative; left: 4%;">Économisez et visitez ces destinations de rêve!</h5>

        <div class="container">
          <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $cardId = $row['code_service']; // Store the ID in a variable
                
                ?>
                <div class="col-md-4 mb-4">
                  <div class="card" data-id="<?php echo $cardId; ?>">
                    <?php
                    $imagePath = $row['image'];
                    echo '<img src="../img/' . $imagePath . '" alt="Image" >'; ?>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['localisation']; ?></h5>
                      <h4><?php echo $row['prix']; ?> DZD</h4>
                      <p class="card-text"><?php echo $row['details']; ?></p>
                      <?php if(isset($_SESSION["id_client"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "client"): ?>
                      
                      <a href="form.php?id=<?php echo $cardId; ?>" class="btn btn-primary">voir les détails</a>
                      <?php else: ?>
                      <a href="Connexion.html" class="btn btn-primary">Réservez</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php
              }
            } else {
              // Display a message if there are no offers available
              echo "<h1>Aucune offre disponible pour le moment.</h1>";
            }
            ?>
          </div>
        </div>

      </section>

        
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
              AICHOUN Travel est une entreprise touristique majeure en Algérie. Elle joue un rôle important dans le développement touristique du pays depuis sa création en 2016.
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