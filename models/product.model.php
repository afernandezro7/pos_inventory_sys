<?php

class Product{

    static public function findAll(){
        $sql = "SELECT p.*, c.name AS 'category' FROM products p INNER JOIN categories c ON p.category_id= c.id ORDER BY 'barcode' ASC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        "SELECT e.id, e.titulo, u.nombre AS 'Autor'
        FROM entradas e
        INNER JOIN usuarios u ON e.usuario_id= u.id;";

        return $stmt->fetchAll();
    }

}