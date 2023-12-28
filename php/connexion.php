<?php

$email=$_POST["email"];
$password=$_POST["password"];

if($_SERVER["REQUEST_METHOD"] === "POST"){


    $mysqli = require __DIR__ . "/base_de_données.php";

    $sql = sprintf("SELECT * FROM client WHERE email = '%s'",$mysqli->real_escape_string($email));

    $result = $mysqli->query($sql);

    $client = $result->fetch_assoc();

    if($client){
        if(password_verify($_POST["password"] , $client["mot_de_passe_hash"])){

            session_start();

            $_SESSION['id_client'] = $client['id_client'];
            $_SESSION['prenom'] = $client['prenom'];
            $_SESSION['nom'] = $client['nom'];
            $_SESSION['tel'] = $client['tel'];
            $_SESSION['email'] = $client['email'];
            $_SESSION['num_passport'] = $client['num_passport'];
            $_SESSION["role"] = "client";

            header("Location: ../Html/Acceuil.php");
            exit;
        }
        
        
        else{
            echo '<script>alert("Login failed");</script>';
        }
        
    }
}
$htmlFile = '../Html/Connexion.html'; // Specify the path to your HTML file

// Read the contents of the HTML file
$htmlContent = file_get_contents($htmlFile);

// Manipulate the HTML content
$manipulatedContent = "<p>Login failed</p>";

// Replace a specific placeholder or element in the HTML content
$htmlContent = str_replace('<p id="login_failed"></p>', $manipulatedContent, $htmlContent);

// Output the manipulated HTML content
echo $htmlContent;

?>