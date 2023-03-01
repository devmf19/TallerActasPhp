<?php

require_once 'conection.php';

class User {

    public static function getAll() {
        $table = "users";
        $sql = "SELECT * FROM {$table}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getBy($colum, $value) {
        $table = "users";
        if(is_string($value)){
            $value = '"' . $value . '"';
        }
        $sql = "SELECT * FROM {$table} WHERE {$colum} = {$value}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function getByAndId($colum1, $value1, $column2, $value2) {
        $table = "users";
        if(is_string($value1)){
            $value1 = '"' . $value1 . '"';
        }
        if(is_string($value2)){
            $value2 = '"' . $value2 . '"';
        }
        $sql = "SELECT * FROM {$table} WHERE {$colum1} = {$value1} AND {$column2} = {$value2}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function save($data) {
        $table = "users";
        $sql = "INSERT INTO {$table} (id, username, password, name, lastname, tipoid, email) VALUES (?,?,?,?,?,?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['new_id']);
        $stmt->bindParam(2, $data['new_username']);
        $stmt->bindParam(3, $data['new_password']);
        $stmt->bindParam(4, $data['new_name']);
        $stmt->bindParam(5, $data['new_lastname']);
        $stmt->bindParam(6, $data['new_tipoid']);
        $stmt->bindParam(7, $data['new_email']);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function update($data) {
        $table = "users";
        $sql = "UPDATE {$table} SET username = ?, password = ?, name = ?, lastname = ?, role = ?, tipoid = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['up_username']);
        $stmt->bindParam(2, $data['up_password']);
        $stmt->bindParam(3, $data['up_name']);
        $stmt->bindParam(4, $data['up_lastname']);
        $stmt->bindParam(5, $data['up_role']);
        $stmt->bindParam(6, $data['up_tipoid']);
        $stmt->bindParam(7, $data['up_id']);

        return $stmt->execute();
    }

    public static function updateValue($column1, $value1, $column2, $value2) {
        $table = "users";
        $sql = "UPDATE {$table} SET {$column1} = ? WHERE {$column2} = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $value1);
        $stmt->bindParam(2, $value2);

        if ($stmt->execute()) {
            return self::getBy("id", $value2);
        } else {
            return [
                'state' => 'error',
                'msg' => 'No se pudo actualizar el rol'
            ];
        }
    }

    public static function delete($id) {
        $table = "users";
        $result = self::getBy("id", $id);
        if ($result != null) {
            $sql = "DELETE FROM {$table} WHERE id = ?";

            $stmt = Conection::conect()->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            return "ok";
        }
        return "error";
    }
}