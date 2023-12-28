<?php
    session_start();
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $num_passport = $_POST["num_passport"];
    $code_service = $_POST['cardId'];
    $id_client = $_SESSION['id_client'];

    $mysqli = require __DIR__ . "/base_de_données.php";

    $mysqli->set_charset("utf8");

    $sql = "INSERT INTO `réservation` (code_service, id_client, ville_depart, ville_arrive, date_depart, date_retour, heure_depart, heure_retour, nombre_adulte, nombre_enfant, nombre_chambre, id_admin)
        VALUES (?, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";

    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($sql)) {
        die("SQL error : " . $mysqli->error);
    }

    $stmt->bind_param("ss", $code_service, $id_client);

    // Execute the prepared statement
    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();

    header("Location: ../Html/Acceuil.php");
    exit;
?>
