
<?php 
require "pdo-connexion.php";
function startTransaction(){
    return dbM152()->beginTransaction();
}
function confirmTransaction(){
    return dbM152()->commit();
}
function StopTransaction(){
    return dbM152()->rollBack();
}



function deletePost($id){
    static $ps = null;
    $sql = 'DELETE FROM post WHERE idPost = :id';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    try {
        $ps->bindParam(":id", $id);
        return $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function showPost()
{
    static $ps = null;
    $sql = 'SELECT post.commentaire, post.idPost, post.DateDeCreation FROM post ORDER BY post.DateDeCreation DESC';

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

function recupMedia($idPost)
{
    static $ps = null;
    $sql = 'SELECT media.nomFichierMedia, media.typeMedia FROM media WHERE media.idPost = :ID';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(":ID", $idPost);
        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function addImage($nom, $type, $idPost)
{
    static $ps = null;
    $sql = 'INSERT INTO media(nomFichierMedia, typeMedia, idPost) VALUES(:nom, :types, :IDPOST)';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    try {
        $ps->bindParam(":nom", $nom);
        $ps->bindParam(":types", $type);
        $ps->bindParam(":IDPOST", $idPost);
        return $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function takeLastPostId(){
    static $ps = null;
    $sql = 'SELECT MAX(idPost) FROM post';

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

function addText($commentaire)
{
    static $ps = null;
    $sql = 'INSERT INTO post(commentaire) VALUES(:commentaire)';

    if ($ps == null) {
        $ps = dbM152()->prepare($sql);
    }
    try {
        $ps->bindParam(":commentaire", $commentaire);
        return $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}