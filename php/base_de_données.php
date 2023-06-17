<?php

$host = "localhost";
$dbname = "aichountraveldb";
$username = "root";
$password = "";

$mysqli = new mysqli( hostname: $host,
                      username: $username,
                      password: $password ,
                      database: $dbname);

if ($mysqli->connect_errno){
    die("Connection user : ". $mysqli->connect_error);
}
return $mysqli;

?>