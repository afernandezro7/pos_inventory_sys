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
        $stmt->execute();
        return $stmt->fetch();

    }

    static public function createProduct(Array $data)
    {
        $sql = "INSERT INTO products(category_id, barcode, description, image, stock, cost, sell_price) VALUES (:category_id, :barcode, :description, :image, :stock, :cost, :sell_price)";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':category_id', $data['category_id'], PDO::PARAM_STR);
        $stmt -> bindParam(':barcode', $data['barcode'], PDO::PARAM_STR);
        $stmt -> bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt -> bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt -> bindParam(':stock', $data['stock'], PDO::PARAM_STR);
        $stmt -> bindParam(':cost', $data['cost'], PDO::PARAM_STR);
        $stmt -> bindParam(':sell_price', $data['sell_price'], PDO::PARAM_STR);
        $response = $stmt->execute();

        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Producto creado correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error creando producto contacte soporte'
            );

        } 
    }

}