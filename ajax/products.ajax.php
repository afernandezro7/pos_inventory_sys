<?php

require_once "../models/connection.php";
require_once "../models/product.model.php";
require_once "../models/category.model.php";

class AjaxProducts{
    private $idCategory;

    public function setIdCategory($idCategory){
        $this -> idCategory = $idCategory;
    }

    public function ajaxGetBarcode(){
        $idCategory = $this -> idCategory;

        $response = Product::getLastCodeItem($idCategory);

        if($response){
            $data = array(
                'ok'=> true,
                'code'=> $response['barcode']
            );
        }else{
            $data = array(
                'ok'=> false,
                'code'=> "ERROR"
            );

        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

// Edit user
if(isset($_POST['idCategory'])){
    $product = new AjaxProducts();
    $product->setIdCategory($_POST['idCategory']);
    $product->ajaxGetBarcode();
}