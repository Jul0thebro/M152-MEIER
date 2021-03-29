<?php

$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
require "functions_inc.php";
$text = recupText($idPost);

$random = uniqid();
//Va nous permettre de download les fichiers upload
if ($textePost != null) {
    addText($textePost);
}

//il faut mettre l'id du bon post 
foreach ($_FILES["image"]["error"] as $key => $error) {
    //vérifie si la taille du fichier n'est pas trop grande et que l'extension est bonne
    if ($_FILES["image"]["size"][$key] < 9000000 && (strpos($_FILES["image"]["type"][$key], "image") === 0 || strpos($_FILES["image"]["type"][$key], "video") === 0 || strpos($_FILES["image"]["type"][$key], "audio") === 0)) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["image"]["tmp_name"][$key];
            // basename() peut empêcher les attaques de système de fichiers;
            // la validation/assainissement supplémentaire du nom de fichier peut être approprié
            $name = basename($_FILES["image"]["name"][$key]);
            $name = explode(".", $name);
            //upload l'image dans le dossier uploads
            $verif = move_uploaded_file($tmp_name, "$uploads_dir/" . $name[0] . $random . "." . $name[1]);
            //vérifie que l'image soit bien upload avant de l'ajouter à la base de données
            if ($_FILES["image"]["error"][$key] == UPLOAD_ERR_OK && $verif) {
                //Commence la transaction
                startTransaction();
                //Permet de récuperer le dernier id qui est celui du post
                $idPost = takeLastPostId();
                if (addImage($name[0] . $random . "." . $name[1], $_FILES["image"]["type"][$key], $idPost[0]["MAX(idPost)"]) == false || $textePost == null) {
                    unlink($uploads_dir . $name[0] . $random . $name[1]);
                    // Annule la transaction avec le post 
                    StopTransaction();
                } else {
                    // Confirme la transaction si il y n'y a pas eu d'erreurs
                    confirmTransaction();
                }
            }
        }
    } else {
        echo "l'image est trop grande ou du mauvais type !<br/>";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Meier-Site-Publication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">

                <!-- sidebar -->
                <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">

                    <ul class="nav">
                        <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                    </ul>

                    <ul class="nav hidden-xs" id="lg-menu">
                        <li class="active"><a href="#featured"><i class="glyphicon glyphicon-list-alt"></i> Featured</a></li>
                        <li><a href="#stories"><i class="glyphicon glyphicon-list"></i> Stories</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-paperclip"></i> Saved</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-refresh"></i> Refresh</a></li>
                    </ul>

                    <!-- tiny only nav-->
                    <ul class="nav visible-xs" id="xs-menu">
                        <li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
                        <li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
                        <li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
                        <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
                    </ul>

                </div>
                <!-- /sidebar -->

                <!-- main right col -->
                <div class="column col-sm-10 col-xs-11" id="main">

                    <!-- top nav -->
                    <div class="navbar navbar-blue navbar-static-top">
                        <div class="navbar-header">
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="http://usebootstrap.com/theme/facebook" class="navbar-brand logo">b</a>
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <form class="navbar-form navbar-left">
                                <div class="input-group input-group-sm" style="max-width:360px;">
                                    <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <ul class="nav navbar-nav ml-5">
                                <li>
                                    <a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="post.php"><i class="glyphicon glyphicon-plus"></i> Post</a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">More</a></li>
                                        <li><a href="">More</a></li>
                                        <li><a href="">More</a></li>
                                        <li><a href="">More</a></li>
                                        <li><a href="">More</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /top nav -->

                    <div class="padding">
                        <div class="full col-sm-9">
                            <!-- content -->
                            <div class="row pt-5">
                                <!-- main col left -->
                                <div class="col-sm-5 mt-5">

                                    <form action="modifPost.php?id=<?php echo $idPost?>" class="mt-5" method="POST">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Texte du post</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $text["commentaire"]; ?>" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Médias : </label>
                                            <?php
                                            $medias = recupMedia($idPost);
                                            foreach ($medias as $media) {
                                                $verifImgVidAud = explode(".", $media["nomFichierMedia"]);
                                                if (strpos($media["typeMedia"], "image") === 0) {
                                                    echo "<div class=\"panel-thumbnail\"><img src=\"assets/uploads/" . $media["nomFichierMedia"] . "\" class=\"img-responsive\"></div>";
                                                    echo "<input type=\"checkbox\" value=". $media["nomFichierMedia"] . "\">";
                                                } else if (strpos($media["typeMedia"], "video") === 0) {
                                                    echo "<div class=\"panel-thumbnail\"><video width=\"320\" height=\"240\" autoplay muted loop> <source src=\"assets/uploads/" . $media["nomFichierMedia"] . "\" type=\"video/mp4\"> </video></div>";
                                                    echo "<input type=\"checkbox\" value=". $media["nomFichierMedia"] . "\">";
                                                } else if (strpos($media["typeMedia"], "audio") === 0) {
                                                    echo "<div class=\"panel-thumbnail\"><audio width=\"320\" height=\"240\" controls> <source src=\"assets/uploads/" . $media["nomFichierMedia"] . "\" type=\"audio/mp3\"> </audio></div>";
                                                    echo "<input type=\"checkbox\" value=". $media["nomFichierMedia"] . "\">";
                                                }
                                            }
                                            ?>

                                            <div class="well mt-5">
                                                    <h4>Rajouter des médias</h4>
                                                    <!-- Pour les images -->
                                                    <input type="file" multiple accept="image/*,video/*,audio/*" name="image[]">
                                            </div>
                                        </div>
                                        <a class="btn btn-primary mb-1" href="index.php">Annuler</a>
                                        <button type="submit" class="btn btn-primary">Confirmer</button>
                                    </form>

                                </div>
                                <!--/row-->
                            </div><!-- /col-9 -->
                        </div><!-- /padding -->
                    </div><!-- /main -->
                </div>
            </div>
        </div>


        <!--post modal-->
        <div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                        Update Status
                    </div>
                    <div class="modal-body">
                        <form class="form center-block">
                            <div class="form-group">
                                <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/296a36043d.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-toggle=offcanvas]').click(function() {
                    $(this).toggleClass('visible-xs text-center');
                    $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
                    $('.row-offcanvas').toggleClass('active');
                    $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
                    $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
                    $('#btnShow').toggle();
                });
            });
        </script>