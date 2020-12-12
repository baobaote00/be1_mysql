<?php
class ProductModel extends Db
{
    public function getProducts()
    {
        // 2. Tạo câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM products");
        return parent::select($sql);
    }

    public function getTotalRow()
    {
        $sql = parent::$connection->prepare("SELECT COUNT(id) FROM products");
        return parent::select($sql)[0]['COUNT(id)'];
    }

    public function getProductByPage($page, $perPage)
    {
        $start = ($page - 1) * $perPage;
        $sql = parent::$connection->prepare("SELECT * FROM products LIMIT ?,?");
        $sql->bind_param('ii', $start, $perPage);
        return parent::select($sql);
    }

    public function getProductById($id)
    {
        // 2. Tạo câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM products WHERE id=?");
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }
    public function getProductByCategory($category_id)
    {
        // 2. Tạo câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM products JOIN product_category ON products.id=product_category.product_id WHERE product_category.category_id=?");
        $sql->bind_param('i', $category_id);
        return parent::select($sql);
    }

    public function getProductByName($product_name)
    {
        // 2. Tạo câu SQL
        $search = "%{$product_name}%";
        $sql = parent::$connection->prepare("SELECT * FROM `products` WHERE product_name LIKE ?");
        $sql->bind_param('s', $search);
        return parent::select($sql);
    }
    public function insertProduct($product_name, $product_price, $product_description, $prodcut_photo)
    {
        $sql = parent::$connection->prepare("INSERT INTO `products` VALUES (null,?,?,?,?)");
        $sql->bind_param('ssis', $product_name, $product_description, $product_price, $prodcut_photo);
        return $sql->execute();
    }
    public function updateProduct($id, $product_name, $product_price, $product_description, $prodcut_photo)
    {
        $sql = parent::$connection->prepare("UPDATE `products` SET `id`=?,`product_name`=?,`product_description`=?,`product_price`=?,`product_photo`=? WHERE `id`=?");
        $sql->bind_param('issisi',$id, $product_name, $product_description, $product_price, $prodcut_photo,$id);
        return $sql->execute();
    }
    public function deleteProduct($id)
    {
        $sql = parent::$connection->prepare("DELETE FROM `products` WHERE `id`=?");
        $sql->bind_param('i',$id);
        return $sql->execute();
    }
}
