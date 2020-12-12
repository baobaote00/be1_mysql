<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
$productModel = new ProductModel();
if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $value = $productModel->getProductById($id);
}

if (!empty($_POST['productName']) && !empty($_POST['productPrice']) && !empty($_POST['productDescription']) && !empty($_POST['productPhoto'])) {
    $alert =  $productModel->updateProduct($_POST['id'],$_POST['productName'], $_POST['productPrice'], $_POST['productDescription'], $_POST['productPhoto'])?'<div class="alert alert-success" role="alert"><strong>Thêm thành công</strong></div>':'<div class="alert alert-danger" role="alert"><strong>Thêm thất bại</strong></div>';
    header('location:managerproduct.php');
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
    <form action="../updateproduct.php" method="post">
        <input type="text" name="id" value="<?php echo $value['id']?>" style="display: none;">
        <label><span>Product Name: </span><input type="text" id="product-name" name="productName" value="<?php echo $value['product_name']?>"></label><br>
        <label><span>Product Description: </span><input type="text" name="productDescription" id="product-description" value="<?php echo $value['product_description']?>"></label><br>
        <label><span>Product Price: </span><input type="number" name="productPrice" id="product-price" value="<?php echo $value['product_price']?>"></label><br>
        <label><span>Product Photo: </span><input type="file" name="productPhoto" id="product-photo"></label><br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>