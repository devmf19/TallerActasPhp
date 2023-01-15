<?php

require_once 'conection.php';

class User {
    private $table = "users";
    private $conection;

    public function __construct() {
        $this->conection = Conection::conect();
    }

    public function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode([
            $tittle => $data
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->toJson("Users", $result);
    }

    public function getBy($colum, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$colum} = {$value}";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        return $this->toJson("User", $result);
    }

    public function save($data) {

        $sql = "INSERT INTO {$this->table} (id, username, password, name, lastname, tipoid) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conection->prepare($sql);

        $stmt->bindParam(1, $data['id']);
        $stmt->bindParam(2, $data['username']);
        $stmt->bindParam(3, $data['password']);
        $stmt->bindParam(4, $data['name']);
        $stmt->bindParam(5, $data['lastname']);
        $stmt->bindParam(6, $data['tipoid']);
        $stmt->execute();
        return $this->toJson("Usuario registrado", $data);
    }

    public function update($data) {
        $sql = "UPDATE {$this->table} SET username = ?, password = ?, name = ?, lastname = ? WHERE id = ?";
        $statement = $this->conection->prepare($sql);

        $statement->bindParam(1, $data['username']);
        $statement->bindParam(2, $data['password']);
        $statement->bindParam(3, $data['name']);
        $statement->bindParam(4, $data['lastname']);
        $statement->bindParam(5, $data['id']);

        $statement->execute();

        return $this->toJson("Usuario actualizado", $data);
    }

    public function delete($id) {
        $result = $this->getBy("id", $id);
        if ($result != null) {
            $sql = "DELETE FROM {$this->table} WHERE id = ?";

            $stmt = $this->conection->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            return $this->toJson("Usuario eliminado", $result[0]);
        }
        return $this->toJson("Error", "El ID de usuario ingresado no existe en la base de datos");
    }
}