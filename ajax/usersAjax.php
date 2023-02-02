<?php
// require_once "../controller/userController.php";
// require_once "../model/user.php";
class UsersAjax{

    private function addBtn($rta){
        require_once "../controller/userController.php";
        require_once "../model/user.php";

        if($rta == false || empty($rta)){
            $rta = [
                "num" => "",
                "id" => "",
                "name" => "",
                "lastname" => "",
                "username" => "",
                "tipoid" => "",
                "rol" => "",
                "btn" => ""
            ];
        } else {
            for($i = 0; $i < count($rta); $i++){
                $rta[$i]["num"] = $i + 1;
                $id = $rta[$i]["id"];

                if($rta[$i]['role'] == 1){
                    $rol = "<td><button class='btn btn-danger btn-xs btnSetRole' userId='".$id."' role='1'>Informes</button></td>";
                    $rta[$i]["role"] = $rol;
                } else {
                    $rol = "<td><button class='btn btn-success btn-xs btnSetRole' userId='".$id."' role='2'>Administrador</button></td>";
                    $rta[$i]["role"] = $rol;
                }

                $btn = "<td>
                <div class='btn-toolbar'> 
                  <div class='btn-group'>
                    <button class='btn btn-warning btnUpdateUser' userId='".$id."' data-toggle='modal' data-target='#modalUpdateUser'><i class='fa fa-pencil'></i></button>
                  </div>  
                  <div class='btn-group'>
                    <button class='btn btn-danger btnDeleteUser' userId='".$id."'><i class='fa fa-times'></i></button>
                  </div> 
                </div>
              </td>"; 
                $rta[$i]["btn"] = $btn;
                
            }
        }
        
        return $rta;
    }
    
    function login($username, $password){
        UserController::login($username, $password);
        //echo json_encode($rta);
    }

    function recover($email){
        UserController::recover($email);
    }

    function register($data){ 
        require_once "../controller/userController.php";
        require_once "../model/user.php";
        $rta = UserController::save($data);
        echo json_encode($rta);
    }

    function getUser($id){
        require_once "../controller/userController.php";
        require_once "../model/user.php";
        $rta = UserController::getOne($id);
        echo json_encode($rta);
    }

    function setRole($id, $role){
        require_once "../controller/userController.php";
        require_once "../model/user.php";
        $rta = UserController::updateColumn($id, "role", $role);
        echo json_encode($rta);
    }

    function getAll(){
        require_once "../controller/userController.php";
        require_once "../model/user.php";
        $rta = UserController::list();
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    function update($data){
        require_once "../controller/userController.php";
        require_once "../model/user.php";
        $rta = UserController::update($data);
        echo json_encode($rta);
    }

    function delete($id){
        require_once "../controller/userController.php";
        require_once "../model/user.php";
        $rta = UserController::delete($id);
        echo json_encode($rta);
    }

    
}

$ajax = new UsersAjax();

if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST["option"]) && $_POST["option"] == "login"){ // lOGIN
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
            
            $ajax->login($_POST["username"], $_POST["password"]);

        }
    } else if(!empty($_POST["option"]) && $_POST["option"] == "recover"){ //RECOVER
        if(!empty($_POST["rec_email"])){
            
            $ajax->recover($_POST["rec_email"]);
            
        }
    } else if(!empty($_POST["option"]) && $_POST["option"] == "signup"){ //SIGNUP
        
        $ajax->register($_POST);

    } else if(!empty($_POST["option"]) && $_POST["option"] == "getUser"){ //GET USER
        if(!empty($_POST['id'])){

            $ajax->getUser($_POST['id']);
            
        }
    } else if(!empty($_POST["option"]) && $_POST["option"] == "setRole"){ //GET USER
        if(!empty($_POST['id'])){

            $ajax->setRole($_POST['id'], $_POST['role']);
            
        }
    } else if(!empty($_POST["option"]) && $_POST["option"] == "getUsers"){ //GET USER

            $ajax->getAll();
            
    } else if(!empty($_POST["option"]) && $_POST["option"] == "updateUser"){ //GET USER
        if(!empty($_POST['up_id'])){

            $ajax->update($_POST);
            
        }
    } else if(!empty($_POST["option"]) && $_POST["option"] == "deleteUser"){ //GET USER
        if(!empty($_POST['id'])){

            $ajax->delete($_POST['id']);
            
        }
    }
    

}

