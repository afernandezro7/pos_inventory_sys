<?php
require_once "models/connection.php";

class User{

    /**
    *
    * Find User by userName
    *
    */
    static public function find(String $table,String $value,String $item="userName")
    {
        $sql = "SELECT * FROM $table WHERE $item= :$item";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':'.$item, $value, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }


    /**
    *
    * Create User 
    *
    */
    static public function createUser(String $table,Array $data)
    {
        $user = User::find($table, $data['userName'], "userName");

        if(isset($user["userName"])){
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'El usuario ya existe'
            );
        }else {
            $sql = "INSERT INTO $table(name, userName, password, role, avatar ) VALUES (:name, :userName, :password, :role, :avatar)";
            $stmt = Connection::connect()->prepare($sql);
            $stmt -> bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt -> bindParam(':userName', $data['userName'], PDO::PARAM_STR);
            $stmt -> bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt -> bindParam(':role', $data['role'], PDO::PARAM_STR);
            $stmt -> bindParam(':avatar', $data['avatar'], PDO::PARAM_STR);
            $response = $stmt->execute();

            if($response){
                return array(
                    'ok'=>true,
                    'type'=>'success',
                    'msg'=>'Usuario creado correctamente'
                );
            }else{
                return array(
                    'ok'=>false,
                    'type'=>'error',
                    'msg'=>'Error creando usuario contacte soporte'
                );

            }

        }
    }


}