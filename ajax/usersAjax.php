<?php
// require_once "../controller/userController.php";
// require_once "../model/user.php";
class UsersAjax{
    
    function login($username, $password){
        UserController::login($username, $password);
        //echo json_encode($rta);
    }

    function recover($email){
        UserController::recover($email);
    }

    function register($data){
        UserController::save($data);
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
            
    }
    

}

