<?php

class Sell{

    static public function findOne(String $item, $value){
        $sql = "SELECT * FROM sells  WHERE $item = :value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    static public function getLastSellCode(){
        $sql = "SELECT * FROM sells ORDER BY id DESC LIMIT 1";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();

    }

    static public function findAllBasic(){

        $sql = "SELECT s.*, u.name AS 'vendor',c.name AS 'client' FROM sells s INNER JOIN clients c ON s.client_id= c.id INNER JOIN users u ON s.vendor_id= u.id ORDER BY s.createdAt DESC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();

    }

    static public function createSell(Array $data)
    {

        $sql = "INSERT INTO sells(sell_code, client_id, vendor_id, taxes, net_price, total_price, payment_method) VALUES (:sell_code, :client_id, :vendor_id, :taxes, :net_price, :total_price, :payment_method)";
        
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':sell_code', $data['sell_code'], PDO::PARAM_STR);
        $stmt -> bindParam(':client_id', $data['client_id'], PDO::PARAM_STR);
        $stmt -> bindParam(':vendor_id', $data['vendor_id'], PDO::PARAM_STR);
        $stmt -> bindParam(':taxes', $data['taxes'], PDO::PARAM_STR);
        $stmt -> bindParam(':net_price', $data['net_price'], PDO::PARAM_STR);
        $stmt -> bindParam(':total_price', $data['total_price'], PDO::PARAM_STR);
        $stmt -> bindParam(':payment_method', $data['payment_method'], PDO::PARAM_STR);
        $response = $stmt->execute();

        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Venta creada correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error creando Venta contacte soporte'
            );

        } 
    }

    //pivote table one to many
    static public function createSellProducts(Array $data)
    {

        $sql = "INSERT INTO sells_products(sell_id, product_id, units, price) VALUES (:sell_id, :product_id, :units, :price)";
        
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':sell_id', $data['sell_id'], PDO::PARAM_STR);
        $stmt -> bindParam(':product_id', $data['product_id'], PDO::PARAM_STR);
        $stmt -> bindParam(':units', $data['units'], PDO::PARAM_STR);
        $stmt -> bindParam(':price', $data['price'], PDO::PARAM_STR);
       
        $response = $stmt->execute();

        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Productos registrados en la venta correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error registrando productos en la Venta contacte soporte',
                'res'=>$response
            );

        } 
    }

    static public function deleteSellItems(String $table='sells_products', String $item , $value){
        $sql = "DELETE FROM $table WHERE $item = :value"; 
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $response = $stmt->execute();   
        
        if($response){

            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'venta eliminada correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error eliminando venta, contacte soporte'
            );

        }
    }



    



}