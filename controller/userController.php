<?php

require_once '../model/user.php';

class userController {
    public $user;

    public function __construct() {
        $this->user = new User();
    }

    public function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode([
            $tittle => $data
        ]);
    }

    public function validate($data){
        if (is_numeric($data["id"])) {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["name"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["lastname"])){
                    if(preg_match('/^[a-zA-Z0-9]+$/', $data["username"])){
                        if(preg_match('/^[a-zA-Z0-9]+$/', $data["password"])){
                            return true;
                        } else {
                            return "La contraseña ingresada contiene carácteres inválidos.";
                        }
                    } else {
                        return "La usuario ingresado contiene carácteres inválidos.";
                    }
                } else {
                    return "El apellido ingresado contiene carácteres inválidos.";
                }
            } else {
                return "El nombre ingresado contiene carácteres inválidos.";
            }
        } else {
            return "Solo puede ingresar números en el id.";
        }
    }

    public function list(){
        return $this->user->getAll();
    }

    public function save($data){
        $validate = $this->validate($data);
        if($validate == true){
            return $this->user->save($data);
        }
        return $this->toJson("Error", $validate);
    }
}

$obj = new userController();

if($_POST["option"] == 1) {
    echo $obj->list();
}

if($_POST["option"] == 2) {
    echo $obj->save($_POST);
}