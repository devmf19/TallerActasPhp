<?php

class Conection
{
    static public function conect()
    {
        $host = "localhost";
        $dbName = "actas";
        $user = "root";
        $password = "";
        
        try {
            return new PDO("mysql:host={$host};dbname={$dbName}", "{$user}", "{$password}");
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
