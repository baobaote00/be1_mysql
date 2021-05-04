<?php
require_once './config/database.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});

$productModel = new ProductModel();

$totalRow = $productModel->getTotalRow();
$perPage = 3;
$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
//$page = isset($_GET['page']) ? $_GET['page'] : 1;

$productList = $productModel->getProductsByPage($perPage, $page);



$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getCategories();

$pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page);
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
                    <a class="nav-link" href="category.php?id=<?php echo $item['id']; ?>"><?php echo $item['category_name']; ?></a>
                </li>
                <?php
                }
                ?>
                
            </ul>
            <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <?php
            foreach ($productList as $item) {
            ?>
            <div class="col-md-4">
                <div class="card">
                    <?php
                    $productPath = strtolower(str_replace(' ', '-', $item['product_name'])) . '-' . $item['id'];
                    ?>
                    <a href="product.php/<?php echo $productPath; ?>">
                        <img src="./public/images/<?php echo $item['product_photo'] ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" onclick="getProductById(<?php echo $item['id'] ?>)"><?php echo $item['product_name'] ?></h5>
                        <p class="card-text"><?php echo $item['product_price'] ?></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
        <?php echo $pageLinks; ?>
        <div id="result"></div>
    </div>
    <script src="./ajax.js"></script>
</body>
</html>