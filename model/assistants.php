<?php

require_once 'conection.php';

class Assistant {

    public static function toJson($name, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function toJson2($name, $data){
        header('Content-type:application/json;charset=utf-8');
        return json_encode([
            $name => $data
        ]);
    }

    public static function getAll() {
        $table = "assistants";
        $sql = "SELECT * FROM {$table}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return self::toJson("kkk", $result);
    }

    public static function getBy($colum, $value) {
        $table = "assistants";
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
        $table = "assistants";
        $sql = "INSERT INTO {$table} (acta_id, assistant_id) VALUES (?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['acta_id']);
        $stmt->bindParam(2, $data['assistant_id']);
        $stmt->execute();
        return self::toJson("Asistente registrado", $data);
    }

    public static function update($data) {
        $table = "assistants";
        $sql = "UPDATE {$table} SET acta_id = ?, assistant_id = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['acta_id']);
        $stmt->bindParam(2, $data['assistant_id']);
        $stmt->bindParam(3, $data['id']);

        $stmt->execute();

        return self::toJson("Asistente actualizado", $data);
    }

    public static function delete($id) {
        $table = "assistants";
        $result = self::getBy("id", $id);
        if ($result != null) {
            $sql = "DELETE FROM {$table} WHERE id = ?";

            $stmt = Conection::conect()->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            return self::toJson("Asistente eliminado", $result[0]);
        }
        return self::toJson("Error", "El ID de asistente ingresado no existe en la base de datos");
    }
}