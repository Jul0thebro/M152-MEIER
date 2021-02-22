
<?php 
require "pdo-connexion.php";

function addText($commentaire)
{
    static $ps = null;
    $sql = 'INSERT INTO post(commentaire) VALUES(:commentaire)';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(":commentaire", $commentaire);

        if ($ps->execute())
            $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function showText()
{
    static $ps = null;
    $sql = 'SELECT commentaire, idPost FROM post';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    $answer = false;
    try {
        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function showImage()
{
    static $ps = null;
    $sql = 'SELECT media.nomFichierMedia FROM media, post WHERE post.idPost = media.idPost';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    $answer = false;
    try {
        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function addImage($nom, $type)
{
    static $ps = null;
    $sql = 'INSERT INTO media(nomFichierMedia, typeMedia) VALUES(:nom, :types)';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(":nom", $nom);
        $ps->bindParam(":types", $type);

        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}