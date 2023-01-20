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
        if (is_numeric($data["new_id"])) {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["new_name"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["new_lastname"])){
                    if(preg_match('/^[a-zA-Z0-9]+$/', $data["new_username"])){
                        if(preg_match('/^[a-zA-Z0-9]+$/', $data["new_password"])){
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
    
                    if ($rta[0]["username"] == $username && $rta[0]["password"] ==$passwordHash) {
    
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

    public static function getBy( $column, $value){
        return User::getBy($column, $value);
    }
    public static function getOne($id){
        $column = "id";
        return User::getBy($column, $id);
    }

    public static function save(){
        if(!empty($_POST)){
            $data = $_POST;
            $validate = self::validate($data);
            if($validate == "ok"){
                if(User::getBy("id", $data["new_id"])==null){
                    if(User::getBy("username", $data["new_username"])==null){
                        
                        $data['new_password'] = self::hash($data['new_password']);
                        $result =  User::save($data);
                        if($result == "ok"){
                            echo '<script>
                                    swal({
                                        type: "success",
                                        title: "¡Usuario registrado, ya puede ingresar al sistema!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                    }).then(function(result){
                                        if(result.value){
                                            window.location = "login";
                                        }
                                    });
                                </script>';
                        }
                        

                    } else {
                        return "error";
                        // return self::toJson("Error", "Este usuario ya se encuentra registrado en la base de datos.");
                    }
                } else {
                    return "error";
                    // return self::toJson("Error", "Este id ya se encuentra registrado en la base de datos.");
                } 
            }
            return "error";
            // return self::toJson("Error", $validate);
        }
        
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

    public static function recover(){
        $data = $_POST;
        if(!empty($data) && $data["rec_email"]!=""){
            $email = $data["rec_email"];
            $user = self::getBy("email", $email);
            if($user == false){
                echo '<script>
                        swal({
                            type: "error",
                            title: "¡El correo ingresado no está asociado a ningún usuario",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "login";
                            }
                        });
                    </script>';
                return;
            }
            
            $token = self::generateToken();
            $rta = User::updateValue("token", $token, "email", $email);
            if($rta == "ok"){
                $url = "http://192.168.1.44:80/TallerActasPhp/index.php?route=newpass&id=".$user["id"]."&token=".$token;
                $toSend = $email;
                $issue = "Actas Unicor - Restablecer contraseña";
                // $body = emailTemplate($url);
                $body = "Hola";
                $headers = "From: actasunicortaller@gmail.com\r\n"; 
                $headers .= "Reply-To: actasunicortaller@gmail.com\r\n"; 
                $headers .= "X-MAILER: php/". phpversion(); 

                // $emailrta = mail($toSend, $issue, $body, $headers);
                if(Email::send($toSend, $issue, $body)){

                    echo '<script>
                            swal({
                                type: "success",
                                title: "¡Revise su correo electrónico y siga las instrucciones!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                    window.location = "login";
                                }
                            });
                        </script>';
                } else {
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error: "'.error_get_last()['message'].',
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                    window.location = "login";
                                }
                            });
                        </script>';
                }
            }
        }
    }

    public static function generateToken($length = 20) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length/strlen($x)) )),1,$length);
    }
}