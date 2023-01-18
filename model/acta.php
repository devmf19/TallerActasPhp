<?php

require_once 'conection.php';

class Acta {

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
        $table = "acta";
        $sql = "SELECT * FROM {$table}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        // return $this->toJson("kkk", $result);
        return $result;
    }

    public static function getBy($colum, $value) {
        $table = "acta";
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
        $table = "acta";
        $sql = "INSERT INTO {$table} (creator_id, issue, created_date, start_time, end_time, in_charge, order_of_day, facts_description) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['creator_id']);
        $stmt->bindParam(2, $data['issue']);
        $stmt->bindParam(3, $data['created_date']);
        $stmt->bindParam(4, $data['start_time']);
        $stmt->bindParam(5, $data['end_time']);
        $stmt->bindParam(6, $data['in_charge']);
        $stmt->bindParam(7, $data['order_of_day']);
        $stmt->bindParam(8, $data['facts_description']);
        $stmt->execute();
        return self::toJson("Acta registrada", $data);
    }

    public static function update($data) {
        $table = "acta";
        $sql = "UPDATE {$table} SET issue = ?, start_time = ?, end_time = ?, in_charge = ?, order_of_day = ?, facts_description = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['issue']);
        $stmt->bindParam(2, $data['start_time']);
        $stmt->bindParam(3, $data['end_time']);
        $stmt->bindParam(4, $data['in_charge']);
        $stmt->bindParam(5, $data['order_of_day']);
        $stmt->bindParam(6, $data['facts_description']);
        $stmt->bindParam(7, $data['id']);

        $stmt->execute();

        return self::toJson("Acta actualizada", $data);
    }

    public static function delete($id) {
        $table = "acta";
        $result = self::getBy("id", $id);
        if ($result != null) {
            $sql = "DELETE FROM {$table} WHERE id = ?";

            $stmt = Conection::conect()->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            return self::toJson("Acta eliminada", $result[0]);
        }
        return self::toJson("Error", "El ID de acta ingresado no existe en la base de datos");
    }
}