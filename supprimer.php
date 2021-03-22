<?php

$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
require "functions_inc.php";
$uploads_dir = 'assets/uploads/';
//recup
startTransaction();
if ($medias = recupMedia($idPost)) {
    deletePost($idPost);
    foreach ($medias as $media) {
        unlink($uploads_dir . $media["nomFichierMedia"]);
    }
    confirmTransaction();
    header("Location: index.php");
} else {
    StopTransaction();
    header("Location: index.php");
}
