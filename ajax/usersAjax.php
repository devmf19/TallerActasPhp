<?php



class UsersAjax{
    
    function login($username, $password){
        if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            UserController::login($username, $password);
        }
    }

    function register($data){
        $rta = UserController::save($data);
    }
    
}

$ajax = new UsersAjax();

if(isset($_POST) && !empty($_POST)){
    // lOGIN
    if(sizeof($_POST) == 2 && !empty($_POST["username"]) && !empty($_POST["password"])){
        $ajax->login($_POST["username"], $_POST["password"]);
    }

}

