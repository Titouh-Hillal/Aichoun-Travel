<?php
    $email=$_POST["email"];
    $password=$_POST["password"];
    if($_SERVER["REQUEST_METHOD"] === "POST"){


        $mysqli = require __DIR__ . "/base_de_données.php";
    
        $sql = sprintf("SELECT * FROM administrateur WHERE email = '%s'",$mysqli->real_escape_string($email));
    
        $result = $mysqli->query($sql);
    
        $client = $result->fetch_assoc();
    
        if($client){
            if(password_verify($_POST["password"] , $client["mot_de_passe_hash"])){
    
                session_start();
    
                $_SESSION['id_admin'] = $client['id_admin'];
                $_SESSION['prenom'] = $client['prenom'];
                $_SESSION['nom'] = $client['nom'];
    
    
                header("Location: ../Html/admin.php");
                exit;
            }
            
            
            else{
                echo '<script>alert("Login failed");</script>';
            }
            
        }
    }


?>