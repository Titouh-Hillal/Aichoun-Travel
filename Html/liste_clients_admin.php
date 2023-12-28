<?php

    session_start();

    require_once('../php/base_de_données.php');
    
    mysqli_set_charset($mysqli, 'utf8');

    $query = "SELECT client.id_client, client.nom, client.prenom, client.date_naissance, client.num_passport, client.email, client.tel, réservation.id_reservation, réservation.code_service
              FROM client
              INNER JOIN réservation ON client.id_client = réservation.id_client ";
    $query1="SELECT * FROM client";
    
    $result = mysqli_query($mysqli, $query);
    $result1= mysqli_query($mysqli, $query1);

    if (!$result) {
      die("Error: " . mysqli_error($mysqli));
  }

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
              <a class="nav-link" aria-current="page" href="ajouter_voyage.php">Ajouter une offres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="liste_clients_admin.php">Liste des clients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="message_admin.php">Messages</a>
              </li>
          </ul>
          <?php if(isset($_SESSION["id_admin"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
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
                    <li><a class="dropdown-item" href="../php/deconnexion_admin.php">déconnecter</a></li>
              </ul>
            </div>
          </div>
          <?php else:?>
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
        <br>
        <section>
            <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h1 id="bienvenue-admin">Liste des Clients</h1>
            </div>
        </section>
        <section>
        <?php if(isset($_SESSION["id_admin"]) && $_SESSION["role"] === "admin"): ?>
            <div class="container">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">id client</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Numéro Passeport</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telephone</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <!--<th scope="row">1</th>
                            <td>Mansouri</td>
                            <td>Sabrina</td>
                            <td>02/01/2002</td>
                            <td>5020050</td>
                            <td>sabrina@gmail.com</td>
                            <td>0708851155</td>-->
                            <?php
                              while ($row1 = mysqli_fetch_assoc($result1)) 
                              { 
                            ?>
                            <td><?php echo $row1['id_client']; ?></td>
                            <td><?php echo $row1['nom']; ?></td>
                            <td><?php echo $row1['prenom']; ?></td>
                            <td><?php echo $row1['date_naissance']; ?></td>
                            <td><?php echo $row1['num_passport']; ?></td>
                            <td><?php echo $row1['email']; ?></td>
                            <td><?php echo $row1['tel']; ?></td>
                        </tr>
                            <?php 


                              }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else:?>
          <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h4 style="color:red;">Vous devez vous connecter</h4>
          </div>
        <?php endif; ?>
        </section>
        <hr>
        <section>
            <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h1 id="bienvenue-admin">Liste des Clients réservés</h1>
            </div>
        </section>
        <section>
        <?php if(isset($_SESSION["id_admin"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
            <div class="container">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">id client</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Numéro Passeport</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">id Réservation</th>
                            <th scope="col">code service</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <!--<th scope="row">1</th>
                            <td>Mansouri</td>
                            <td>Sabrina</td>
                            <td>02/01/2002</td>
                            <td>5020050</td>
                            <td>sabrina@gmail.com</td>
                            <td>0708851155</td>-->
                            <?php
                              while ($row = mysqli_fetch_assoc($result)) 
                              { 
                            ?>
                            <td><?php echo $row['id_client']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <td><?php echo $row['date_naissance']; ?></td>
                            <td><?php echo $row['num_passport']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['tel']; ?></td>
                            <td><?php echo $row['id_reservation']; ?></td>
                            <td><?php echo $row['code_service']; ?></td>
                        </tr>
                            <?php 


                              }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else:?>
          <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h4 style="color:red;">Vous devez vous connecter</h4>
          </div>
        <?php endif; ?>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>