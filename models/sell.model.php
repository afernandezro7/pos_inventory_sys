<?php

class Sell{

    static public function getLastSellCode(){
        $sql = "SELECT * FROM sells ORDER BY id DESC LIMIT 1";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();

    }



}