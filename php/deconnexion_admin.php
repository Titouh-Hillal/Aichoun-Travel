<?php

    session_start();

    unset($_SESSION["id_admin"]);
    unset($_SESSION["prenom"]);
    unset($_SESSION["nom"]);


    session_destroy();
    
    header("Location: ../Html/admin.php");
    exit;
    

    
    
?>