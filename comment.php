<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});

$input=json_decode(file_get_contents('php://input'),true);
$rating=$input['rating'];
$comment=$input['comment'];
$id=$input['productId'];

$commentModel = new CommentModel();
$item = $commentModel->addComment($id,$rating,$comment);

echo json_encode($item);