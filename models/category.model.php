<?php

class Category{

    static public function findOne(String $value,String $item="name"){
        $sql = "SELECT * FROM categories WHERE $item= :value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    static public function findAll(){
        $sql = "SELECT * FROM categories ORDER BY 'createdAt' DESC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function createCategory(Array $data){
        $category = Category::findOne( $data['name']);

        if(isset($category["name"])){
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'La categoría ya existe'
            );
        } else {
            $sql = "INSERT INTO categories(name) VALUES (:name)";
            $stmt = Connection::connect()->prepare($sql);
            $stmt -> bindParam(':name', $data['name'], PDO::PARAM_STR);
            $response = $stmt->execute();

            if($response){
                return array(
                    'ok'=>true,
                    'type'=>'success',
                    'msg'=>'Categoría creada correctamente'
                );
            }else{
                return array(
                    'ok'=>false,
                    'type'=>'error',
                    'msg'=>'Error creando categoría contacte soporte'
                );

            }
        }
    }

    static public function editCategory(Array $data){
        $category = Category::findOne($data['id'], "id");

        if(isset($category["id"])){

            $sql = "UPDATE categories SET name = :name WHERE id= :id";           
            $stmt = Connection::connect()->prepare($sql);
            $stmt -> bindParam(':id', $data['id'], PDO::PARAM_STR);
            $stmt -> bindParam(':name', $data['name'], PDO::PARAM_STR);
            $response = $stmt->execute();
    
            if($response){
                return array(
                    'ok'=>true,
                    'type'=>'success',
                    'msg'=>'Categoría modificada correctamente'
                );
            }else{
                return array(
                    'ok'=>false,
                    'type'=>'error',
                    'msg'=>'Error modificando la categoría contacte soporte'
                );
    
            }
        }else {
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'La categoría no existe'
            );
        }


    }

    static public function deleteCategory(String $item , $value){
        $sql = "DELETE FROM categories WHERE $item = :value"; 
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> bindParam(':value', $value, PDO::PARAM_STR);
        $response = $stmt->execute();   
        
        if($response){
            return array(
                'ok'=>true,
                'type'=>'success',
                'msg'=>'Categoría eliminada correctamente'
            );
        }else{
            return array(
                'ok'=>false,
                'type'=>'error',
                'msg'=>'Error eliminando la categoría contacte soporte'
            );

        }
    }
}