<?php
class UserModel extends Db 
{
    public function login($username,$password)
    {
        $sql = parent::$connection->prepare("SELECT * FROM user WHERE `username`=? AND `password`=?");
        // $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $sql->bind_param('ss',$username,$password);
        return count(parent::select($sql))==0;
    }
}
