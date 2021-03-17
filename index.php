    <?php
/*
Auteur : Julian Meier
Description : 
Version : v1.0
Date : 25.01.2021
*/

require "functions_inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Meier-Site-Publication</title>
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

                                    
                                    <div class="panel panel-default">
                                        <div class="panel-thumbnail"><img src="assets/img/welcome-image.png" class="img-responsive"></div>
                                        <div class="panel-body">
                                        </div>
                                    </div>
                                    <?php 
                                    
                                    $texts = showPost();
                              
                                    //Va permettre d'afficher les posts
                                    foreach ($texts as $text){
                                        echo "   <div class=\"panel panel-default\">";
                                        $medias = recupMedia($text["idPost"]);
                                        foreach($medias as $media){
                                            $verifImgVidAud = explode(".",$media["nomFichierMedia"]);
                                            if ($verifImgVidAud[1] == "png" || $verifImgVidAud[1] == "jpg" || $verifImgVidAud[1] == "jpeg" || $verifImgVidAud[1] == "PNG" || $verifImgVidAud[1] == "JPG" || $verifImgVidAud[1] == "JPEG"){
                                                echo "<div class=\"panel-thumbnail\"><img src=\"assets/uploads/".$media["nomFichierMedia"]."\" class=\"img-responsive\"></div>";
                                            }
                                            else if ($verifImgVidAud[1] == "mp4"){
                                                echo "<div class=\"panel-thumbnail\"><video width=\"320\" height=\"240\" autoplay muted loop> <source src=\"assets/uploads/".$media["nomFichierMedia"]."\" type=\"video/mp4\"> </video></div>";
                                            }
                                            else if ($verifImgVidAud[1] == "mp3"){
                                                echo "<div class=\"panel-thumbnail\"><audio width=\"320\" height=\"240\" controls> <source src=\"assets/uploads/".$media["nomFichierMedia"]."\" type=\"audio/mp3\"> </audio></div>";
                                            }
                                        }
                                        // manque lien js pour la modal
                                        echo "<div class=\"panel-body\"><p class=\"lead\">".$text["commentaire"]."
                                              <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteModal\">
                                              ❌
                                              </button>
                                              <p class=\"lead\" style=\"float: right;\">Date : ".$text["DateDeCreation"]."</p>
                                              
                                              <div class=\"modal fade\" id=\"deleteModal\" tabindex=\"-1\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                                                <div class=\"modal-dialog\">
                                                    <div class=\"modal-content\">
                                                    <div class=\"modal-header\">
                                                        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Modal title</h5>
                                                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                    </div>
                                                    <div class=\"modal-body\">
                                                        ...
                                                    </div>
                                                    <div class=\"modal-footer\">
                                                        <a href=\"index.php\" data-bs-dismiss=\"modal\" class=\"btn btn-primary\" role=\"button\" data-bs-toggle=\"button\">Annuler</a>
                                                        <a href=\"index.php?id=".$text["idPost"]."\" class=\"btn btn-primary\" role=\"button\" data-bs-toggle=\"button\">Supprimer</a>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                              </div>
                                              </div>";
                                    }
                                    ?>

                                    <div class="panel panel-default">
                                        <div class="panel-thumbnail"><img src="assets/img/bg_5.jpg" class="img-responsive"></div>
                                        <div class="panel-body">
                                            <p class="lead">Urbanization</p>
                                            <p>45 Followers, 13 Posts</p>

                                            <p>
                                                <img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <!-- main col right -->
                                <div class="col-sm-7">

                                    <div class="panel panel-default">
                                        <div class="panel-thumbnail"><img src="assets/img/bg_4.jpg" class="img-responsive"></div>
                                        <div class="panel-body">
                                            <p class="lead">Social Good</p>
                                            <p>1,200 Followers, 83 Posts</p>

                                            <p>
                                                <img src="assets/img/photo.jpg" height="28px" width="28px">
                                                <img src="assets/img/photo.png" height="28px" width="28px">
                                                <img src="assets/img/photo_002.jpg" height="28px" width="28px">
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
                                </div>
                            </div>

                        </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->

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