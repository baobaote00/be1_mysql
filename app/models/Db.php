<?php
class Db
{
    public static $connection = null;
    public function __construct()
    {
        if(!self::$connection) {
            // 1. Tạo connection
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
            self::$connection->set_charset('utf8mb4');
        }
        return self::$connection;
    }

    public function select($sql)
    {
        // 3. Thực thi sql
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}
