<?php
        session_start();

        // if (isset($_SESSION["client_id"], $_SESSION["prenom"], $_SESSION["nom"])){
        $htmlFile = '../Html/admin_compte.html'; // Specify the path to your HTML file
        // Read the contents of the HTML file
        $htmlContent = file_get_contents($htmlFile);

        // Manipulate the HTML content
        $manipulatedContent = "<p>{$_SESSION["prenom"]} {$_SESSION["nom"]}</p>";
        //$manipulatedContent1 = "<h2>Bienvenue {$_SESSION["prenom"]}</h2>";  

        // Replace a specific placeholder or element in the HTML content
        $htmlContent = str_replace('<p id="user_name"></p>', $manipulatedContent, $htmlContent);
        //$htmlContent1 = str_replace('<h2 id="bienvenue_admin"></h2>', $manipulatedContent1, $htmlContent1);

        // Output the manipulated HTML content
        echo $htmlContent;
       // echo $htmlContent1;

        header("Location: ../Html/admin_compte.html");
        exit;
  //  }
    
    

  
?>