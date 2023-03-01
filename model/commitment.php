<?php

require_once 'conection.php';

class Commitment {

    public static function getAll() {
        $table = "commitment";
        $sql = "SELECT * FROM {$table}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getBy($colum, $value) {
        $table = "commitment";
        if(is_string($value)){
            $value = '"' . $value . '"';
        }
        $sql = "SELECT * FROM {$table} WHERE {$colum} = {$value}";
        $stmt = Conection::conect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function save($data) {
        $table = "commitment";
        $sql = "INSERT INTO {$table} (acta_id, in_charge, description, start_date, end_date) VALUES (?,?,?,?,?)";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['new_acta_id_c']);
        $stmt->bindParam(2, $data['new_in_charge_c']);
        $stmt->bindParam(3, $data['new_description_c']);
        $stmt->bindParam(4, $data['new_start_date_c']);
        $stmt->bindParam(5, $data['new_end_date_c']);
        
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function update($data) {
        $table = "commitment";
        $sql = "UPDATE {$table} SET in_charge = ?, description = ?, start_date = ?, end_date = ? WHERE id = ?";
        $stmt = Conection::conect()->prepare($sql);

        $stmt->bindParam(1, $data['up_in_charge_c']);
        $stmt->bindParam(2, $data['up_description_c']);
        $stmt->bindParam(3, $data['up_start_date_c']);
        $stmt->bindParam(4, $data['up_end_date_c']);
        $stmt->bindParam(5, $data['up_id_c']);

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
        $table = "commitment";
        $sql = "DELETE FROM {$table} WHERE id = ?";
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