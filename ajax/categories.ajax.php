<?php

require_once "../models/connection.php";
require_once "../models/category.model.php";

class AjaxCategories{
    private $idCategory;
    private $categoryName;

    public function setIdCategory($idCategory){
        $this -> idCategory = $idCategory;
    }
    public function setCategoryName($categoryName){
        $this -> categoryName = $categoryName;
    }

    public function ajaxEditCategory(){
        $item = "id";
        $idCategory = $this->idCategory;
        $res = Category::findOne( $idCategory, $item);

        $data = array(
            'id'=> $res['id'],
            'name'=> $res['name'],
        );

        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

// Edit Category
if(isset($_POST['idCategory'])){
    $edit = new AjaxCategories();
    $edit->setIdCategory($_POST['idCategory']);
    $edit->ajaxEditCategory();
}