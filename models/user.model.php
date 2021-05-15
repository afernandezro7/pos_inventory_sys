<?php

class User{

    /**
    *
    * Find one User by user By one Parameter
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
    * Encrypt user password
    *
    */
    static public function cryptPassword(String $password){
        $salt = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';
		$cryptPassword = crypt($password,$salt);

        return $cryptPassword;
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

    /**
    *
    * User List
    *
    */
    static public function findAll(String $table="users"){
        $sql = "SELECT * FROM $table ORDER BY 'createdAt' DESC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function editUser(String $table,Array $data)
    {
        $user = User::find($table, $data['id'], "id");

        if(isset($user["id"])){
            
            $sql = "UPDATE $table SET name = :name, userName = :userName, password = :password, role = :role, avatar = :avatar WHERE id= :id";           
            $stmt = Connection::connect()->prepare($sql);
            $stmt -> bindParam(':id', $data['id'], PDO::PARAM_STR);
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
                    'msg'=>'Usuario modificado correctamente'
                );
            }else{
                return array(
                    'ok'=>false,
                    'type'=>'error',
                    'msg'=>'Error modificando al usuario contacte soporte'
                );

            }
        }else {
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'El usuario no existe'
            );
        }
    }
    
    static public function editUserSimple(String $table,String $colName, $colValue, String $whereItem, $whereValue)
    {
        $sql = "UPDATE $table SET $colName = :colValue WHERE $whereItem= :whereValue";           
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':colValue', $colValue, PDO::PARAM_STR);
        $stmt -> bindParam(':whereValue', $whereValue, PDO::PARAM_STR);
        $response = $stmt->execute();

        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Usuario modificado correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error modificando al usuario contacte soporte'
            );

        }
    }

    static public function deleteUser(String $item , $value){
        $sql = "DELETE FROM users WHERE $item = :value"; 
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $response = $stmt->execute();   
        
        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Usuario eliminado correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error eliminando al usuario contacte soporte'
            );

        }
    }

}