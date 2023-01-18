<?php

require_once 'conection.php';

class Commitment {

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
        $table = "commitment";
        $sql = "SELECT * FROM {$table}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return self::toJson("kkk", $result);
    }

    public static function getBy($colum, $value) {
        $table = "commitment";
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
        $table = "commitment";
        $sql = "INSERT INTO {$table} (acta_id, in_charge, description, start_date, end_date) VALUES (?,?,?,?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['acta_id']);
        $stmt->bindParam(2, $data['in_charge']);
        $stmt->bindParam(3, $data['description']);
        $stmt->bindParam(4, $data['start_date']);
        $stmt->bindParam(5, $data['end_date']);
        $stmt->execute();
        return self::toJson("Compromiso registrado", $data);
    }

    public static function update($data) {
        $table = "commitment";
        $sql = "UPDATE {$table} SET in_charge = ?, description = ?, start_date = ?, end_date = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['in_charge']);
        $stmt->bindParam(2, $data['description']);
        $stmt->bindParam(3, $data['start_date']);
        $stmt->bindParam(4, $data['end_date']);
        $stmt->bindParam(5, $data['id']);

        $stmt->execute();

        return self::toJson("Compromiso actualizado", $data);
    }

    public static function delete($id) {
        $table = "commitment";
        $result = self::getBy("id", $id);
        if ($result != null) {
            $sql = "DELETE FROM {$table} WHERE id = ?";

            $stmt = Conection::conect()->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            return self::toJson("Compromiso eliminado", $result[0]);
        }
        return self::toJson("Error", "El ID de compromiso ingresado no existe en la base de datos");
    }
}