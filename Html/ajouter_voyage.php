<?php
session_start();
require_once('../php/base_de_données.php');

mysqli_set_charset($mysqli, 'utf8');
$query = "select * from service";
$result = mysqli_query($mysqli, $query);

if (isset($_POST['service_id'])) {
    $serviceId = $_POST['service_id'];

    // Perform the deletion query
    $deleteReservationsStmt = $mysqli->prepare("DELETE FROM réservation WHERE code_service = ?");
    $deleteReservationsStmt->bind_param("i", $serviceId);
    $deleteReservationsStmt->execute();


    $deleteStmt = $mysqli->prepare("DELETE FROM service WHERE code_service = ?");
    $deleteStmt->bind_param("i", $serviceId);
    $deleteStmt->execute();

    // Redirect back to the page after deletion
    $_SESSION['deletion_success'] = true;

    header("Location: ajouter_voyage.php");
    exit;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/Acceuil.css">
    <title>Aichoun Travel</title>
    <link rel="shortcut icon" href="../Img/aichoun_logo_2.png" type="image">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark shadow-sm pt-0 pb-0" id="navbar-color">
        <div class="container-fluid">
            <a class="navbar-brand " href="admin.php"><img src="../Img/aichoun_logo_2.png" alt="" height="80px"
                    width="80px">Aichoun Travel Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item" id="vols">
                        <a class="nav-link active" aria-current="page" href="ajouter_voyage.php">Ajouter une offres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="liste_clients_admin.php">Liste des clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="message_admin.php">Messages</a>
                    </li>
                </ul>
                <?php if(isset($_SESSION["id_admin"]) && $_SESSION["role"] === "admin"): ?>
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
                <?php else: ?>
                <div class="d-flex ms-auto">
                    <div class="dropdown me-2">
                        <a href="connexion_admin.html"><button class="btn btn-primary" type="button"
                                id="connexion_button">Connexion</button></a>
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
                <h1 id="bienvenue-admin">Liste des Offres et Voyages Organisés</h1>
            </div>
        </section>
        <section>
        <?php if(isset($_SESSION["id_admin"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
            <div class="container">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">code service</th>
                                <th scope="col">type service</th>
                                <th scope="col">Ville</th>
                                <th scope="col">prix</th>
                                <th scope="col">image</th>
                                <th scope="col">details</th>
                                <th>Modifier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['code_service']; ?></td>
                                <td><?php echo $row['type_service']; ?></td>
                                <td><?php echo $row['localisation']; ?></td>
                                <td><?php echo $row['prix']; ?></td>
                                <td>
                                    <?php
                                        $imagePath = $row['image'];
                                        echo '<img src="../img/' . $imagePath . '" alt="Image" width="100" height="100">';
                                    ?>
                                </td>
                                <td><?php echo $row['details']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="service_id" value="<?php echo $row['code_service']; ?>">
                                        <button type="submit" class="btn btn-danger" name="delete_service">Supprimer</button>
                                    </form>
                                </td>
                                <?php } ?>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="row">

                </div>
            </div>
            <?php else: ?>
            <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h4 style="color:red;">Vous devez vous connecter</h4>
            </div>
            <?php endif; ?>
        </section>
        <hr>
        <section>
        <?php if(isset($_SESSION["id_admin"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2">Ajouter un Voyage</h1>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form class="" action="../php/ajout_voyage.php" method="post"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3" id="floatingInput"
                                            placeholder="name@example.com" name="service">
                                        <label for="floatingInput">type service</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3" id="floatingInput"
                                            placeholder="name@example.com" name="ville">
                                        <label for="floatingInput">Ville</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="imageInput" class="form-label">joindre une image</label>
                                        <input type="file" class="form-control" id="imageInput" name="imageInput"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3" id="floatingInput"
                                            placeholder="name@example.com" name="prix">
                                        <label for="floatingInput">Prix</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here"
                                            id="floatingTextarea2" style="height: 100px" name="text"></textarea>
                                        <label for="floatingTextarea2">details</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary 1">Ajouter</button>
                                    <button type="reset" class="btn btn-primary 2">Réinitialiser</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </section>
        <?php else: ?>
            <div class="d-flex align-items-start justify-content-center" style="min-height: 10vh;">
                <h4 style="color:red;"></h4>
            </div>
        <?php endif; ?>
    </main>

    <script src="../Js/admin.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw9eINnWN/iFQU+lMMhUqJLl4JfO34y1Smvwp6gjMIWhOL+JEmY0IxtQ3vO6jN"
        crossorigin="anonymous"></script>

</body>

</html>
