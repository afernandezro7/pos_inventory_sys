<?php

class Product{

    static public function findAll(){
        $sql = "SELECT p.*, c.name AS 'category' FROM products p INNER JOIN categories c ON p.category_id= c.id ORDER BY 'barcode' ASC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function getLastCodeItem($idCategory){
        $sql = "SELECT * 
                FROM products 
                WHERE category_id = :idCategory
                ORDER BY barcode DESC
                LIMIT 1";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':idCategory', $idCategory, PDO::PARAM_STR);
        $response = $stmt->execute();
        return $stmt->fetch();

    }
}