<?php
//Connexion à la base de données
$dbName = "db_m152";
$dbUser = "root";
$dbPass = "julian2003";
try {
    $myDb = new PDO("mysql:host=127.0.0.1;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    $myDb = null;
}
