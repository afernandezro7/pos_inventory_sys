<?php
require_once "models/connection.php";

class User{

    /**
    *
    * Find User by userName
    *
    */
    static public function findbyUserName(String $table,String $item,String $value)
    {
        $sql = "SELECT * FROM $table WHERE $item= :$item";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':'.$item, $value, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }


}