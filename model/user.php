<?php

require_once 'conection.php';

class User {

    public function toJson($name, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function toJson2($name, $data){
        header('Content-type:application/json;charset=utf-8');
        return json_encode([
            $name => $data
        ]);
    }

    public static function getAll() {
        $table = "users";
        $sql = "SELECT * FROM {$table}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return self::toJson("kkk", $result);
    }

    public static function getBy($colum, $value) {
        $table = "users";
        if(is_string($value)){
            $value = '"' . $value . '"';
        }
        $sql = "SELECT * FROM {$table} WHERE {$colum} = {$value}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        return $result;
    }

    public static function save($data) {
        $table = "users";
        $sql = "INSERT INTO {$table} (id, username, password, name, lastname, tipoid) VALUES (?,?,?,?,?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['id']);
        $stmt->bindParam(2, $data['username']);
        $stmt->bindParam(3, $data['password']);
        $stmt->bindParam(4, $data['name']);
        $stmt->bindParam(5, $data['lastname']);
        $stmt->bindParam(6, $data['tipoid']);
        $stmt->execute();
        return self::toJson("Usuario registrado", $data);
    }

    public static function update($data) {
        $table = "users";
        $sql = "UPDATE {$table} SET username = ?, password = ?, name = ?, lastname = ?, role = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['username']);
        $stmt->bindParam(2, $data['password']);
        $stmt->bindParam(3, $data['name']);
        $stmt->bindParam(4, $data['lastname']);
        $stmt->bindParam(5, $data['role']);
        $stmt->bindParam(6, $data['id']);

        $stmt->execute();

        return self::toJson("Usuario actualizado", $data);
    }

    public static function delete($id) {
        $table = "users";
        $result = self::getBy("id", $id);
        if ($result != null) {
            $sql = "DELETE FROM {$table} WHERE id = ?";

            $stmt = Conection::conect()->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            return self::toJson("Usuario eliminado", $result[0]);
        }
        return self::toJson("Error", "El ID de usuario ingresado no existe en la base de datos");
    }
}