<?php 
require "functions_inc.php";
echo "ui";
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
deletePost($id);

