<?php

require_once "../models/connection.php";
require_once "../models/client.model.php";

class AjaxClients{
    private $idClient;

    public function setIdClient($idClient){
        $this -> idClient = $idClient;
    }

    public function ajaxEditClient(){
        $idClient = $this -> idClient;

        $res = Client::findOne("id",$idClient);

        if($res){
            $data = array(
                'ok'=> true,
                'data'=> array(
                    'id'=> $res['id'],
                    'name'=> $res['name'],
                    'identity'=> $res['identity'],
                    'email'=> $res['email'],
                    'phone'=> $res['phone'],
                    'address'=> $res['address'],
                    'birth'=> $res['birth']
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

// Edit client
if(isset($_POST['idClient'])){
    $edit = new AjaxClients();
    $edit->setIdClient($_POST['idClient']);
    $edit->ajaxEditClient();
}