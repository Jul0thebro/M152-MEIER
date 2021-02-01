<?php
/*
Auteur : Julian Meier
Description : 
Version : v1.0
Date : 25.01.2021
*/

$img = filter_input(INPUT_GET, 'image', FILTER_SANITIZE_STRING);
//$nom = $_

//Crude qui ajoute des données à la base de donnée
/*$req = $myDb->prepare("INSERT INTO media(nomFichierMedia, typeMedia) VALUES(:libelle, :continent)");
 $req->bindParam(":nom", $nom);
 $req->bindParam(":type", $type);*/

$uploads_dir = 'assets/img';

//move_uploaded_file($_GET['img'], $_FILES[''])
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Meier-Site-Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="post.php" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
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
                            <div class="row">

                                <!-- main col left -->
                                <div class="col-sm-5">


                                    <div class="well mt-5">
                                        <form class="form-horizontal mt-5" role="form" method="POST" action="#" enctype="multipart/form-data">
                                            <h4>Poster</h4>
                                            <div class="form-group" style="padding:14px;">
                                                <!-- Pour le texte -->
                                                <textarea class="form-control" placeholder="Poster un message ..."></textarea>
                                            </div>
                                            <!-- Envois les données -->
                                            <button class="btn btn-primary pull-right" type="submit">Post</button>
                                            <!-- Pour les images -->
                                            <input type="file" multiple accept="image/*" name="image[]">
                                        </form>
                                    </div>
                                    
                                    <?php
                                    //Va nous permettre de download les fichiers upload
                                    foreach ($_FILES["image"]["error"] as $key => $error) {
                                        if ($error == UPLOAD_ERR_OK) {
                                            $tmp_name = $_FILES["image"]["tmp_name"][$key];
                                            // basename() peut empêcher les attaques de système de fichiers;
                                            // la validation/assainissement supplémentaire du nom de fichier peut être approprié
                                            $name = basename($_FILES["image"]["name"][$key]);
                                            //PROBLEME de droit le dossier de sauvegarde qui est img n'accepte pas la sauvegarde
                                            move_uploaded_file($tmp_name, "$uploads_dir/$name");
                                        }
                                    }
                                    $nbImage = count($_FILES["image"]["name"]);
                                    for ($i = 0; $i < $nbImage; $i++) {
                                        $name = $_FILES["image"]["name"][$i];
                                        echo " ";
                                        echo $name;
                                    }

                                    //var_dump($_FILES["image"]["name"]);
                                    //<image src="assets/<?php echo $img; ></image>
                                    ?>


                                    <!--
                                    <div class="well mt-5 pb-5">
                                        <form method="POST" action="#" enctype="multipart/form-data">
                                        
                                            <input type="file" multiple accept="image/*" name="image[]">
                                            <textarea></textarea>
                                            <button class="btn btn-primary pull-right" type="submit">Post</button>
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                            <!--/row-->
                        </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->

            </div>
        </div>
    </div>


    <!--post modal-->
    <div id="postModal" class="modal fade mt-5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                    Poster un message ...
                </div>
                <div class="modal-body">
                    <form class="form center-block">
                        <div class="form-group">
                            <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div>
                        <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
                        <ul class="pull-left list-inline">
                            <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
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