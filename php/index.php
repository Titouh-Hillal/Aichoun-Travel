<?php

     session_start();

     if (isset($_SESSION["id_client"])){

        $htmlFile = '../Html/Account.php'; // Specify the path to your HTML file

        // Read the contents of the HTML file
        $htmlContent = file_get_contents($htmlFile);

        // Manipulate the HTML content
        $manipulatedContent = "<p>{$_SESSION["prenom"]} {$_SESSION["nom"]}</p>";
        

        // Replace a specific placeholder or element in the HTML content
        $htmlContent = str_replace('<p id="user_name"></p>', $manipulatedContent, $htmlContent);

        // Output the manipulated HTML content
        echo $htmlContent;
      
        header("Location: ../Html/Account.php");
        exit;
     }
    
    

  
?>