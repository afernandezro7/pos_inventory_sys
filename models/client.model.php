<?php

class Client{

    static public function findOne(String $item, $value){
        $sql = "SELECT * FROM clients WHERE $item = :value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    static public function findAll(){
        $sql = "SELECT * FROM clients ORDER BY createdAt DESC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function createClient(Array $data)
    {

        // $query = "INSERT INTO products(name"
        //         ", identity"
        //         ", emai"l
        //         ", phone"
        //         ", address"
        //         ", birth"
        //         ") VALUES (:name"
        //                   ", :identity"
        //                   ", :email"
        //                   ", :phone"
        //                   ", :address"
        //                   ", :birth"
        //                   ")";
        $insert = "INSERT INTO clients(name";
        $values = ") VALUES (:name";
        $closer = ")";

        if(!empty($data['identity'])){
            $insert .= ', identity';
            $values .= ', :identity';
        }
        if(!empty($data['email'])){
            $insert .= ', email';
            $values .= ', :email';
        }
        if(!empty($data['phone'])){
            $insert .= ', phone';
            $values .= ', :phone';
        }
        if(!empty($data['address'])){
            $insert .= ', address';
            $values .= ', :address';
        }
        if(!empty($data['birth'])){
            $insert .= ', birth';
            $values .= ', :birth';
        }

        $sql = $insert . $values . $closer;
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':name', $data['name'], PDO::PARAM_STR);

        if(!empty($data['identity'])){
            $stmt -> bindParam(':identity', $data['identity'], PDO::PARAM_STR);
        }

        if(!empty($data['email'])){
            $stmt -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        }
        
        if(!empty($data['phone'])){
            $stmt -> bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        }
        
        if(!empty($data['address'])){
            $stmt -> bindParam(':address', $data['address'], PDO::PARAM_STR);
        }
        
        if(!empty($data['birth'])){
            $stmt -> bindParam(':birth', $data['birth'], PDO::PARAM_STR);
        }
       
        $response = $stmt->execute();

        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Cliente creado correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error creando cliente contacte soporte'
            );

        } 
    }


}