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

        return $stmt->fetchAll();
    }

    public static function getBetween($initialDate, $endDate) {
        $table = "acta";

        $initialDate = '"' . $initialDate . '"';
        $endDate = '"' . $endDate . '"';

        $sql = "SELECT * FROM {$table} WHERE created_date BETWEEN {$initialDate} AND {$endDate}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        // return $this->toJson("kkk", $result);
        return $result;
    }

    public static function getPending() {
        $table = "acta";
        $now = date("Y-m-d");
        $now = '"' . $now . '"';

        $sql = "SELECT * FROM {$table} WHERE created_date > {$now}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        // return $this->toJson("kkk", $result);
        return $result;
    }

    public static function save($data) {
        $table = "acta";
        $sql = "INSERT INTO {$table} (creator_id, issue, created_date, start_time, end_time, in_charge, order_of_day, facts_description) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $now = date("Y-m-d");
        $stmt->bindParam(1, $data['new_creator_id']);
        $stmt->bindParam(2, $data['new_issue']);
        $stmt->bindParam(3, $data['new_start_date']);
        $stmt->bindParam(4, $data['new_start_time']);
        $stmt->bindParam(5, $data['new_end_time']);
        $stmt->bindParam(6, $data['new_in_charge']);
        $stmt->bindParam(7, $data['new_order_of_day']);
        $stmt->bindParam(8, $data['new_facts_description']);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function update($data) {
        $table = "acta";
        $sql = "UPDATE {$table} SET issue = ?, start_time = ?, end_time = ?, in_charge = ?, order_of_day = ?, facts_description = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['up_issue']);
        $stmt->bindParam(2, $data['up_start_time']);
        $stmt->bindParam(3, $data['up_end_time']);
        $stmt->bindParam(4, $data['up_in_charge']);
        $stmt->bindParam(5, $data['up_order_of_day']);
        $stmt->bindParam(6, $data['up_facts_description']);
        $stmt->bindParam(7, $data['id_acta']);

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
        $table = "acta";
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