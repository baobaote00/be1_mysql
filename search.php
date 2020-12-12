<?php
require_once './config/database.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
$productModel = new ProductModel();
$productList = $productModel->getProductByName($_GET['keyword']);

$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getCategories();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php
                foreach ($categoryList as $item) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="category.php/<?php echo $item['id'] ?>"><?php echo $item['category_name'] ?></a>
                </li>
                <?php
                }
                ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="search.php" method="get" >
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="keyword">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3">
            <?php
            foreach ($productList as $item) {
            ?>
            <div class="col mb-4">
                <div class="card">
                    <img src="./public/images/<?php echo $item['product_photo'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                            $strName = strtolower(str_replace(' ', '-', $item['product_name'])) . '-' . $item['id'];
                            ?>
                            <a href="./product.php/<?php echo $strName; ?>">
                                <?php echo $item['product_name'] ?>
                            </a>
                        </h5>
                        <p><?php echo $item['product_price'] ?></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
    </div>
</body>

</html>