<?php
session_start();
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});

$pathURI = explode('-', $_SERVER['REQUEST_URI']);
$id = $pathURI[count($pathURI) - 1];

//$id = $_GET['id'];
$productModel = new ProductModel();
$commentModel = new CommentModel();
//Tang view
if (isset($_SESSION["view"])) {

    //Kiem tra id da ton tai trong mang
    if (!in_array($id, $_SESSION["view"])) {
        $_SESSION["view"][] = $id;

        //Goi ham tang view
        $productModel->updateView($id);
    }
} else {
    $_SESSION["view"] = array();
    $_SESSION["view"][] = $id;

    //Goi ham tang view
    $productModel->updateView($id);
}

$item = $productModel->getProductById($id);
$ratingAverage = $commentModel->getRatingAverage($id);
$comment = $commentModel->getComment($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .form-view-comment {
            display: flex;
            flex-direction: column;
        }

        .comment-view {
            background-color: #ececec;
            padding: 2px;
            margin: 2px;
            padding-left: 5px;
            overflow: hidden;
            word-wrap: break-word;
            text-indent: 20px;
        }

        .all-comment {
            font-weight: 700;
            font-size: 30px;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php
                $mainPhoto = explode(',', $item['product_photo']);
                ?>

                <img src="/<?php echo BASE_URL; ?>/public/images/<?php echo $mainPhoto[0]; ?>" class="img-fluid" alt="...">

                <?php
                foreach ($mainPhoto as $photo) {
                ?>

                    <img src="/<?php echo BASE_URL; ?>/public/images/<?php echo $photo; ?>" class="img-fluid" alt="..." style="width: 50px;">

                <?php
                }
                ?>
            </div>
            <div class="col-md-8">
                <h1><?php echo $item['product_name'] ?></h1>
                <p><?php echo $item['product_price'] ?></p>
                <p>
                    <?php echo $item['product_description'] ?>
                </p>
                <p><?php echo $item['product_view'] ?></p>
                
                <div class="form-comment border border-success p-1">
                    <input type="hidden" name="id" id="product-id" value="<?php echo $id ?>">
                    <div class="star-rating text-center">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if (number_format($ratingAverage) > $i) : ?>
                                <i class="fa fa-star" data-rating="1"></i>
                            <?php endif ?>
                            <?php if (number_format($ratingAverage) < $i) : ?>
                                <i class="far fa-star" data-rating="1"></i>
                            <?php endif ?>
                            <?php if (number_format($ratingAverage) == $ratingAverage && number_format($ratingAverage) == $i) : ?>
                                <i class="fa fa-star"></i>
                            <?php endif ?>
                            <?php if (number_format($ratingAverage) != $ratingAverage && number_format($ratingAverage) == $i) : ?>
                                <i class="fas fa-star-half-alt"></i>
                            <?php endif ?>
                        <?php endfor ?>
                        <input type="hidden" name="whatever1" class="rating-value" value="<?php echo number_format($ratingAverage, 2) ?>">
                    </div>
                    <div class="rating text-center"><span>Rating: </span> <?php echo number_format($ratingAverage, 2) ?></div>
                    <div>
                        <label for="rating" class="form-label"></label>
                        <input class="form-control" id="rating" type="number" aria-label="" max="5" min="1" value="5">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label"></label>
                        <textarea class="form-control" id="comment" rows="3" aria-label="comment" placeholder="Comment here ..."></textarea>
                    </div>
                    <div class="btn-comment text-center">
                        <button type="button" class="btn btn-success comment-submit">Comment</button>
                    </div>
                </div>

                <div class="form-view-comment border border-success p-1 my-1">
                    <span class="all-comment">All comment</span>

                    <?php foreach ($comment as $item) : ?>
                        <div class="user-comment border border-success p-1 my-1">
                            <div class="star-rating text-center">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <?php if ($item['rating'] >= $i) : ?>
                                        <i class="fa fa-star" data-rating="1"></i>
                                    <?php endif ?>
                                    <?php if ($item['rating'] < $i) : ?>
                                        <i class="far fa-star" data-rating="1"></i>
                                    <?php endif ?>
                                <?php endfor ?>
                                <input type="hidden" name="whatever1" class="rating-value" value="<?php echo number_format($ratingAverage, 2) ?>">
                            </div>
                            <span class="comment-view"><?php echo $item['description'] ?></span>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
    <script src="../public/js/comment.js"></script>
</body>

</html>