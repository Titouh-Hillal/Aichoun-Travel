<?php

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $date_de_naissance = $_POST["date_de_naissance"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $num_passport = $_POST["num_passport"];
    $password = $_POST["password"];
    $confirm_password = $_POST["c_password"];

    if( empty($nom) || empty($prenom) || empty($date_de_naissance) || empty($email) || empty($tel) || empty($num_passport) ||  empty($password) ){

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

    $sql="INSERT INTO client(nom,prenom,date_naissance,num_passport,email,tel,mot_de_passe_hash)
            VALUES (?,?,?,?,?,?,?)";

    $stmt = $mysqli->stmt_init();
    
    if( ! $stmt->prepare($sql)){
        die("SQL error : " . $mysqli->error);
    }

    $stmt->bind_param("sssssss",$nom,$prenom,$date_de_naissance,$num_passport,$email,$tel,$password_hash);
/*
    if($stmt->execute()){
        echo "signup succesfully";
    }
    else{
        if($mysqli->errno === 1062){
            die("email already taken ");
        }
        else {
            die($mysqli->error . " " . $mysqli->errno);
        }
        
    }*/
    //
    
    try {
        
        $stmt->execute();

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            
            echo "The email is already taken. Please choose a different email.";

        } else {
    
            echo "An error occurred while processing your request. Please try again later.";
        }
    }

    header("Location: ../Html/Connexion.html");
    exit;
    
    


    //var_dump($password_hash);

    //print_r($_POST);
?>