<?php
require_once './config/database.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
$userModel = new UserModel();
var_dump($_POST);
var_dump(!$userModel->login($_POST['username'],$_POST['password']));
if (isset($_POST['username'])&&isset($_POST['password'])) {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    header('location: http://localhost/be1_mysql/managerproducts.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="login.php" method="post" id="form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Press username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Press password">
            </div>
            <input type="submit" value="submit">
        </form>
    </div>

</body>

</html>