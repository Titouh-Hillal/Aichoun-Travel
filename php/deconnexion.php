<?php

    session_start();

    unset($_SESSION["id_client"]);
    unset($_SESSION["prenom"]);
    unset($_SESSION["nom"]);

    session_destroy();
    
    header("Location: ../Html/Acceuil.php");
    exit;
?>