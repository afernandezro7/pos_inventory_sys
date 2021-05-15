<?php

require_once "../models/connection.php";
require_once "../models/user.model.php";

class AjaxUsers{

    private $idUser;
    private $userStatus;
    private $userName;


    public function setIdUser($idUser){
        $this -> idUser = $idUser;
    }

    public function setUserStatus($status){
        $this -> userStatus = $status;
    }
    public function setUserName($userName){
        $this -> userName = $userName;
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

    public function findUserName(){
        $table ="users";
        $userName = $this->userName;
        $res = User::find($table, $userName);
        header('Content-Type: application/json');
        if($res == false){
            $response = false;
        }else{
            $response = true;
        }
        echo json_encode($response);
    }
}

// Edit user
if(isset($_POST['idUser'])){
    $edit = new AjaxUsers();
    $edit->setIdUser($_POST['idUser']);
    $edit->ajaxEditUser();
}

//Toggle status of user
if(isset($_POST['activateId']) && isset($_POST['userStatus']) ){
    $edit = new AjaxUsers();
    $edit->setIdUser($_POST['activateId']);
    $edit->setUserStatus($_POST['userStatus']);
    $edit->toggleUserStatus();
}

//search username already exists
if(isset($_POST['searchUsername']) ){
    $edit = new AjaxUsers();
    $edit->setUserName($_POST['searchUsername']);
    $edit->findUserName();
}