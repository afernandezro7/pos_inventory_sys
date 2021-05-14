<?php

require_once "../models/connection.php";
require_once "../models/user.model.php";

class AjaxUsers{

    private $idUser;

    public function setIdUser($idUser){
        $this -> idUser = $idUser;
    }

    public function ajaxEditUser(){
        $table ="users";
        $item = "id";
        $idUser = $this->idUser;
        $res = User::find($table, $idUser, $item);

        $data = array(
            'id'=> $res['id'],
            'name'=> $res['name'],
            'userName'=> $res['userName'],
            'role'=> $res['role'],
            'avatar'=> $res['avatar']
        );

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}


if(isset($_POST['idUser'])){
    $editar = new AjaxUsers();
    $editar->setIdUser($_POST['idUser']);
    $editar->ajaxEditUser();
}
