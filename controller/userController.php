<?php

class UserController {

    private const SALT = '$5$rounds=5000$usesomesillystringforsalt$';
    private static function hash($password) {
        return hash('sha512', self::SALT . $password);
    }
    private static function verify($password, $hash) {
        return ($hash == self::hash($password));
    }

    public static function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function validate($data){
        if (is_numeric($data["id"])) {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["name"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["lastname"])){
                    if(preg_match('/^[a-zA-Z0-9]+$/', $data["username"])){
                        if(preg_match('/^[a-zA-Z0-9]+$/', $data["password"])){
                            return "ok";
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

    public static function login($username, $password){
            if (isset($username) && isset($password)) {
                if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                    // eccriptación de contraseña
                    $passwordHash = self::hash($password);
                    
                    $column = "username";
                    $value = $username;

                    $user2 = new User();
    
                    $rta = $user2->getBy($column, $value);
    
                    if ($rta[0]["username"] == $username && $rta[0]["password"] ==$password) {
    
                        $_SESSION["login"] = 1;
                        $_SESSION["id"] = $rta[0]["id"];
                        $_SESSION["name"] = $rta[0]["name"];
                        $_SESSION["lastname"] = $rta[0]["lastname"];
                        $_SESSION["username"] = $rta[0]["username"];
                        $_SESSION["role"] = $rta[0]["role"];

                        echo '<script>
								window.location = "home";
							</script>';
                    } else {
                        echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                    }
                }
            }
    }

    public static function list(){
        return User::getAll();
    }

    public static function save($data){
        $validate = self::validate($data);
        if($validate == "ok"){
            if(User::getBy("id", $data["id"])==null){
                if(User::getBy("username", $data["username"])==null){
                    
                    $data['password'] = self::hash($data['password']);
                    return User::save($data);

                } else {
                    return self::toJson("Error", "Este usuario ya se encuentra registrado en la base de datos.");
                }
            } else {
                return self::toJson("Error", "Este id ya se encuentra registrado en la base de datos.");
            } 
        }
        return self::toJson("Error", $validate);
    }

    public static function update($data){
        $validate = self::validate($data);
        if($validate == "ok"){
            if(User::getBy("username", $data["username"])==null){
                return User::update($data);
            } else {
                return self::toJson("Error", "Este usuario ya se encuentra registrado en la base de datos.");
            }
        }
        return self::toJson("Error", $validate);
    }

    public static function delete($id){
        return User::delete($id);
    }
}