<?php
    $service = $_POST['service'];
    $ville = $_POST['ville'];
    $image = $_FILES['imageInput']['name'];
    $prix = $_POST['prix'];
    $details = $_POST['text'];

    $mysqli = require __DIR__ . "/base_de_données.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($service) && !empty($ville) && !empty($image) && !empty($prix) && !empty($details)) {

            $targetDirectory = '../img/';
            $targetFile = $targetDirectory . $image;

            if (move_uploaded_file($_FILES['imageInput']['tmp_name'], $targetFile)) {
                $stmt = $mysqli->prepare("INSERT INTO service (code_service, type_service, prix, type_vol, class_vol, compagnie, nom_hotel, nombre_chambre, localisation, details, image) VALUES (NULL, ?, ?, NULL, NULL, NULL, NULL, NULL,? , ?, ?)");
                $stmt->bind_param('sssss', $service, $prix, $ville, $details, $image);
                $stmt->execute();
                header("Location: ../Html/ajouter_voyage.php");
                exit;
            } else {
                echo 'Failed to move the uploaded file.';
            }
        } else {
            header("Location: ../Html/message_admin.php");
            exit;
        }
    }
?>
