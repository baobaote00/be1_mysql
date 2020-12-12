<?php
class test extends Db
{
    public function getTest()
    {
        // 2. Tạo câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM test");
        return parent::select($sql);
    }
}
