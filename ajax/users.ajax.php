<?php

require_once "../models/connection.php";
require_once "../models/user.model.php";

class AjaxUsers{

    private $idUser;
    private $userStatus;


    public function setIdUser($idUser){
        $this -> idUser = $idUser;
    }

    public function setUserStatus($status){
        $this -> userStatus = $status;
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

    public function toggleUserStatus(){
        $table ="users";
        $item = "id";
        $idUser = $this->idUser;
        $status = $this->userStatus;
        $res = User::find($table, $idUser, $item);
        $statusValid = ($status== 0 || $status== 1) ? true : false;




        $data = array(
            'ok'=> false,
            'msg'=> "Error al intentar cambiar estado"
        );
        header('Content-Type: application/json');

        if(isset($res['id']) && !empty($res['id']) && $statusValid){           
           
            $data = User::editUserSimple($table,'status', $status, 'id', $res['id']);

        }

        echo json_encode($data);
    }
}

// Edit user
if(isset($_POST['idUser'])){
    $edit = new AjaxUsers();
    $edit->setIdUser($_POST['idUser']);
    $edit->ajaxEditUser();
}

//Toggle status of
if(isset($_POST['activateId']) && isset($_POST['userStatus']) ){
    $edit = new AjaxUsers();
    $edit->setIdUser($_POST['activateId']);
    $edit->setUserStatus($_POST['userStatus']);
    $edit->toggleUserStatus();
}