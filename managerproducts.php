<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
session_start();
if (!isset($_SESSION['username'])) {
    header('location: http://localhost/be1_mysql/login.php');
}

$productModel = new ProductModel();
$productList = $productModel->getProducts();
if (isset($_GET['id'])) {
    $productModel->updateProduct($_GET['id'], $_POST['productName'], $_POST['productDescription'], $_POST['productPrice'], $_POST['productPhoto']);
    header('location:managerproducts.php');
}
if (isset($_GET['delete_id'])) {
    $productModel->deleteProduct($_GET['delete_id']);
    header('location:managerproducts.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <table class="table">
            <thread>
                <td>ID</td>
                <td style="width: 100px;">Product photo</td>
                <td>Product name</td>
                <td>Update</td>
                <td>Delete</td>
            </thread>
            <?php
            foreach ($productList as $item) {
            ?>
                <tr>
                    <td><?php echo $item['id'] ?></td>
                    <td><img src="/<?php echo BASE_URL ?>/public/images/<?php echo $item['product_photo'] ?>" class="img-fluid" alt="..."></td>
                    <td><?php echo $item['product_name'] ?></td>
                    <td>
                        <a href="updateproduct.php?id=<?php echo  $item['id'] ?>" class="btn btn-primary">UPDATE</a>
                    </td>
                    <td>
                        <form action="/<?php echo BASE_URL ?>/managerproducts.php?delete_id=<?php echo  $item['id'] ?>" method="post" onsubmit="return confirm('xoa khong')">
                            <input class="btn btn-primary" type="submit" value="DELETE">
                        </form>
                    </td>
                </tr>

            <?php } ?>
        </table>
    </div>
</body>

</html>