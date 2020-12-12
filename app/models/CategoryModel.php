<?php
class CategoryModel extends Db
{
    public function getCategories()
    {
        // 2. Tạo câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM categories");
        return parent::select($sql);
    }
}
