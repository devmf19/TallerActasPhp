<?php

class UserController
{

    private const SALT = '$5$rounds=5000$usesomesillystringforsalt$';
    private static function hash($password)
    {
        return hash('sha512', self::SALT . $password);
    }

    public static function alert($type, $tittle)
    {
        echo '<br><br>
            <div class="alert alert-' . $type . '" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>
                ' . $tittle . '
            </div>';
    }

    public static function validate($data)
    {
        if ($data["new_tipoid"] == 1 || $data["new_tipoid"] == 2) {
            if (is_numeric($data["new_id"])) {
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["new_name"])) {
                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["new_lastname"])) {
                        if (preg_match('/^[a-zA-Z0-9]+$/', $data["new_username"])) {
                            if (preg_match('/^[a-zA-Z0-9]+$/', $data["new_password"])) {
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
        } else {
            return "Tipo de id inválido.";
        }
    }

    public static function validate2($data)
    {
        if ($data["up_tipoid"] == 1 || $data["up_tipoid"] == 2) {
            if (is_numeric($data["up_id"])) {
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["up_name"])) {
                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data["up_lastname"])) {
                        if (preg_match('/^[a-zA-Z0-9]+$/', $data["up_username"])) {
                            return "ok";
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
        } else {
            return "Tipo de id inválido.";
        }
    }


    public static function login($username, $password)
    {

        if ($username != "" && $password != "") {
            if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                // eccriptación de contraseña
                $passwordHash = self::hash($password);

                $column = "username";
                $value = $username;

                $user = new User();

                $rta = $user->getBy($column, $value);
                if ($rta != false) {
                    if ($rta["username"] == $username && $rta["password"] == $passwordHash) {

                        $_SESSION["login"] = 1;
                        $_SESSION["id"] = $rta["id"];
                        $_SESSION["name"] = $rta["name"];
                        $_SESSION["lastname"] = $rta["lastname"];
                        $_SESSION["username"] = $rta["username"];
                        $_SESSION["role"] = $rta["role"];


                        echo '<script>
                                 window.location = "home";
                            </script>';
                    }
                } else {
                    self::alert("danger", "Usuario no registrado");
                }
            } else {
                self::alert("warning", "El usuario no puede contener carácteres especiales");
            }
        }
    }

    public static function list()
    {
        return User::getAll();
    }

    public static function getBy($column, $value)
    {
        return User::getBy($column, $value);
    }
    public static function getOne($id)
    {
        $column = "id";
        return User::getBy($column, $id);
    }

    public static function save($data)
    {
        $response = [
            'state' => '',
            'msg' => ''
        ];
        $validate = self::validate($data);
        if ($validate == "ok") {
            if (User::getBy("id", $data["new_id"]) == false) {
                if (User::getBy("username", $data["new_username"]) == false) {
                    if (User::getBy("email", $data["new_email"]) == false) {
                        $data['new_password'] = self::hash($data['new_password']);
                        $result =  User::save($data);
                        if ($result == "ok") {
                            $response['state'] = 'success';
                            $response['msg'] = 'Registro exitoso, ya puede iniciar sesión.';
                        }
                    } else {
                        $response['state'] = 'error';
                        $response['msg'] = 'El correo ingresado ya se encuentra registrado en la base de datos.';
                    }
                } else {
                    $response['state'] = 'error';
                    $response['msg'] = 'El usuario ingresado ya se encuentra registrado en la base de datos.';
                }
            } else {
                $response['state'] = 'error';
                $response['msg'] = 'El id ingresado ya se encuentra registrado en la base de datos.';
            }
        } else {
            $response['state'] = 'error';
            $response['msg'] = $validate;
        }

        return $response;
    }

    public static function oldPassword($data)
    {
        if ($data['up_passsword'] == "") {
            $user = User::getBy("id", $data['id']);
            $data['up_passsword'] = $user['password'];
        }
        return $data;
    }

    public static function update($data)
    {
        $response = [
            'state' => '',
            'msg' => ''
        ];
        $validate = self::validate2($data);
        if ($validate == "ok") {
            if (User::getByAndId("username", $data["up_username"], "id", $data["up_id"]) != false) {
                if (User::getByAndId("email", $data["up_email"], "id", $data["up_id"]) != false) {
                    $data = self::oldPassword($data);
                    $rta =  User::update($data);
                    if ($rta) {
                        $response['state'] = 'success';
                        $response['msg'] = 'Usuario actualizado';
                    }
                } else {
                    $response['state'] = 'error';
                    $response['msg'] = 'El correo ingresado ya está asociado a otro usuario';
                }
            } else {
                $response['state'] = 'error';
                $response['msg'] = 'El usuario ingresado ya está asociado a otro usuario';
            }
        } else {
            $response['state'] = 'error';
            $response['msg'] = $validate;
        }


        return $response;
    }

    public static function updateColumn($id, $column, $value)
    {
        return User::updateValue($column, $value, "id", $id);
    }

    public static function delete($id)
    {
        $response = [
            'state' => 'error',
            'msg' => 'No existe un usuario con el id recibido'
        ];
        $rta = User::delete($id);
        if ($rta == "ok") {
            $response['state'] = 'success';
            $response['msg'] = 'Usuario eliminado';
        }
        return $response;
    }

    public static function recover($email)
    {
        if ($email != "") {
            $user = self::getBy("email", $email);
            if ($user == false) {
                self::alert("danger", "El correo ingresado no se encuentra asociado a ningún usuario");
                return;
            }

            $token = self::generateToken();
            $rta = User::updateValue("token", $token, "email", $email);
            if ($rta == "ok") {
                $url = "http://localhost/TallerActasPhp/index.php?route=newpass&id=" . $user["id"] . "&token=" . $token;
                $toSend = $email;
                $issue = "Actas Unicor - Restablecer contraseña";
                $body = emailTemplate($url);
                if (Email::send($toSend, $issue, $body)) {
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
                }
            }
        }
    }

    public static function newPassword()
    {
        if (isset($_GET["id"]) && isset($_GET["token"])) {

            $id = $_GET["id"];
            $token = $_GET["token"];

            $user = self::getOne($id);

            if ($user["token"] == $token) {
                if (!empty($_POST) && $_POST["rec_password"] != "") {
                    $newPassword = self::hash($_POST["rec_password"]);
                    $rta = User::updateValue("password", $newPassword, "id", $id);
                    User::updateValue("token", "", "id", $id);
                }
            }
        }
    }

    public static function generateToken($length = 20)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length / strlen($x)))), 1, $length);
    }
}
