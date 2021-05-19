<?php

require_once "../models/connection.php";
require_once "../models/product.model.php";
require_once "../models/category.model.php";

class AjaxProducts{
    private $idCategory;
    private $idProduct;

    public function setIdCategory($idCategory){
        $this -> idCategory = $idCategory;
    }

    public function setIdProduct($idProduct){
        $this -> idProduct = $idProduct;
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

    public function ajaxEditProduct(){
        $idProduct = $this -> idProduct;

        $res = Product::findOne("id",$idProduct);

        if($res){
            $data = array(
                'ok'=> true,
                'data'=> array(
                    'id'=> $res['id'],
                    'category_id'=> $res['category_id'],
                    'category'=> $res['category'],
                    'barcode'=> $res['barcode'],
                    'stock'=> $res['stock'],
                    'description'=> $res['description'],
                    'cost'=> $res['cost'],
                    'sell_price'=> $res['sell_price'],
                    'image'=> $res['image'],
                )
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
// Edit product
if(isset($_POST['idProduct'])){
    $edit = new AjaxProducts();
    $edit->setIdProduct($_POST['idProduct']);
    $edit->ajaxEditProduct();
}

// Get barcode
if(isset($_POST['idCategory'])){
    $product = new AjaxProducts();
    $product->setIdCategory($_POST['idCategory']);
    $product->ajaxGetBarcode();
}