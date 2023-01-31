<?php

require_once 'conection.php';

class Assistant {

    public static function toJson($name, $data) {
        // header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function toJson2($name, $data){
        // header('Content-type:application/json;charset=utf-8');
        return json_encode([
            $name => $data
        ]);
    }

    public static function getAll() {
        $table = "assistants";
        $sql = "SELECT * FROM {$table}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getBy($colum, $value) {
        $table = "assistants";
        $sql = "SELECT * FROM {$table} WHERE {$colum} = {$value}";
        $stmt = Conection::conect()->prepare($sql);
        
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function save($data) {
        $table = "assistants";
        $sql = "INSERT INTO {$table} (acta_id, assistant_id) VALUES (?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['acta_id']);
        $stmt->bindParam(2, $data['assistant_id']);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function update($data) {
        $table = "assistants";
        $sql = "UPDATE {$table} SET acta_id = ?, assistant_id = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['acta_id']);
        $stmt->bindParam(2, $data['assistant_id']);
        $stmt->bindParam(3, $data['id']);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function updateValue($column1, $value1, $column2, $value2) {
        $table = "users";
        $stmt = Conection::conect()->prepare("UPDATE $table SET $column1 = ? WHERE $column2 = ?");

        $stmt->bindParam(1, $value1, PDO::PARAM_STR);
        $stmt->bindParam(2, $value2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function delete($id) {
        $table = "assistants";
        $sql = "DELETE FROM {$table} WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
}