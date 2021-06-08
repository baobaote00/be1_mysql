<?php
class CommentModel extends Db
{
    public function getComment()
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM comment");
        return parent::select($sql);
    }
    public function getCommentFormProduct($productId)
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM `comment` WHERE `product_id`=?");
        $sql->bind_param('i',$productId);
        return parent::select($sql);
    }
    public function getRatingAverage($productId)
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT AVG(`rating`) FROM `comment` WHERE `product_id`=?");
        $sql->bind_param('i',$productId);
        return parent::select($sql)[0]['AVG(`rating`)'];
    }
    public function addComment($productId,$rating,$comment)
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("INSERT INTO `comment` VALUES (null,?,?,?)");
        $sql->bind_param('iii',$comment,$rating,$productId);
        return $sql->execute();
    }
}
