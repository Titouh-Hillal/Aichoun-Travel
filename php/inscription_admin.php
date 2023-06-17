<?php

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $password = $_POST["password"];
    $confirm_password = $_POST["c_password"];

    if( empty($nom) || empty($prenom)  || empty($email) || empty($tel)  ||  empty($password) ){

        die("we need all the informations");

    }
    $uppercase = '/^[A-Z]/'; // Uppercase letter at the beginning
    $lowercase = '/[a-z]/'; // Lowercase letters
    $specialChar = '/[@$!%*?&]/'; // Special characters
    $numbers = '/[0-9]/'; //numbers
    $minLength = 8; // Minimum length

    if (preg_match($uppercase, $password) &&
        preg_match($numbers, $password) && 
        preg_match($lowercase, $password)  &&
        preg_match($specialChar, $password) &&
        strlen($password >= $minLength) ){
        } 
    else {
            echo '<script>alert("your password must contains uppercase in beginnig, at least one lowercase , number ,at least one special characters and the minimum length of 8");</script>';
    }
    if($password !== $confirm_password){
        die("the confirmation password is false");
    }
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $mysqli = require __DIR__ . "/base_de_données.php";

    $sql="INSERT INTO administrateur(nom,prenom,email,tel,mot_de_passe_hash)
            VALUES (?,?,?,?,?)";

    $stmt = $mysqli->stmt_init();

    if( ! $stmt->prepare($sql)){
        die("SQL error : " . $mysqli->error);
    }

    $stmt->bind_param("sssss",$nom,$prenom,$email,$tel,$password_hash);

    try {
        
        $stmt->execute();

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            
            echo "The email is already taken. Please choose a different email.";

        } else {
    
            echo "An error occurred while processing your request. Please try again later.";
        }
    }

    header("Location: ../Html/connexion_admin.php");
    exit;
?>