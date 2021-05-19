<?php

require_once "../models/connection.php";
require_once "../models/product.model.php";

class AjaxDatatableProducts{

    public function showProductsTable(){
        echo '{
            "data": [
              [
                "1",
                "views/img/products/10000001.jpg",
                "10000001",
                "Xiaomi Redmi 5",
                "Celulares Xiaomi",
                "28",
                "128",
                "178",
                "hace 2 días",
                "acciones"
              ],
              [
                "2",
                "views/img/products/10000001.jpg",
                "10000001",
                "Xiaomi Redmi 7",
                "Celulares Xiaomi",
                "28",
                "148",
                "198",
                "hace 2 días",
                "acciones"
              ]
              
            ]
        }';
    }
}

// Edit Category
    $products = new AjaxDatatableProducts();
    $products->showProductsTable();
