<?php

class Sell{

    static public function getLastSellCode(){
        $sql = "SELECT * FROM sells ORDER BY id DESC LIMIT 1";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();

    }

    static public function findAllBasic(){

        $sql = "SELECT s.*, u.name AS 'vendor',c.name AS 'client' FROM sells s INNER JOIN clients c ON s.client_id= c.id INNER JOIN users u ON s.vendor_id= u.id ORDER BY s.createdAt ASC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();

    }



}