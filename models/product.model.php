<?php

class Product{

    static public function findOne(String $item, $value){
        $sql = "SELECT p.*, c.name AS 'category' FROM products p INNER JOIN categories c ON p.category_id= c.id WHERE p.$item = :value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

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

    static public function editProduct(Array $data){
        $product = Product::findOne("id", $data['id'] );

        if(isset($product["id"])){

            $sql = "UPDATE products SET stock = :stock, description = :description, cost = :cost, sell_price = :sell_price, image = :image WHERE id= :id";           
            $stmt = Connection::connect()->prepare($sql);
            $stmt -> bindParam(':id', $data['id'], PDO::PARAM_STR);
            $stmt -> bindParam(':stock', $data['stock'], PDO::PARAM_STR);
            $stmt -> bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt -> bindParam(':cost', $data['cost'], PDO::PARAM_STR);
            $stmt -> bindParam(':sell_price', $data['sell_price'], PDO::PARAM_STR);
            $stmt -> bindParam(':image', $data['image'], PDO::PARAM_STR);
            $response = $stmt->execute();
    
            if($response){
                return array(
                    'ok'=>true,
                    'type'=>'success',
                    'msg'=>'Producto modificado correctamente'
                );
            }else{
                return array(
                    'ok'=>false,
                    'type'=>'error',
                    'msg'=>'Error modificando producto contacte soporte'
                );
    
            }
        }else {
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'El producto no existe'
            );
        }


    }

    static public function deleteProduct(String $item , $value){
        $sql = "DELETE FROM products WHERE $item = :value"; 
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $response = $stmt->execute();   
        
        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Producto eliminado correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error eliminando producto, contacte soporte'
            );

        }
    }

    static public function reduceInventary( int $id , int $value){
        $product = Product::findOne("id", $id );

        if(isset($product["id"])){

            $newStock = intval($product["stock"]) - intval($value);

            $sql = "UPDATE products SET stock = :stock WHERE id= :id";           
            $stmt = Connection::connect()->prepare($sql);
            $stmt -> bindParam(':id', $id, PDO::PARAM_STR);
            $stmt -> bindParam(':stock', $newStock, PDO::PARAM_STR);
            
            $response = $stmt->execute();
    
            if($response){
                return array(
                    'ok'=>true,
                    'type'=>'success',
                    'msg'=>'Producto modificado correctamente'
                );
            }else{
                return array(
                    'ok'=>false,
                    'type'=>'error',
                    'msg'=>'Error modificando producto contacte soporte'
                );
    
            }
        }else {
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'El producto no existe'
            );
        }
    }

    static public function editProductItem(int $id,String $item, $value){
        $product = Product::findOne("id", $id );

        if(isset($product["id"])){

            $sql = "UPDATE products SET $item = :value WHERE id= :id";           
            $stmt = Connection::connect()->prepare($sql);
            $stmt -> bindParam(':id', $id, PDO::PARAM_STR);
            $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
            $response = $stmt->execute();
    
            if($response){
                return array(
                    'ok'=>true,
                    'type'=>'success',
                    'msg'=>'Producto modificado correctamente'
                );
            }else{
                return array(
                    'ok'=>false,
                    'type'=>'error',
                    'msg'=>'Error modificando producto contacte soporte'
                );
    
            }
        }else {
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'El producto no existe'
            );
        }


    }



}