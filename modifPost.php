<?php 
require "functions_inc.php";
$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$commentaire = recupText($idPost);
ModifyPost($idPost, $commentaire);
header("Location: index.php");





