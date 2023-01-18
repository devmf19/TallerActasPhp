<?php

class ActaController {

    public static function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function list(){
        return Acta::getAll();
    }

    public static function save($data){
        return Acta::save($data);
    }

    public static function update($data){
        return Acta::update($data);
    }

    public static function delete($id){
        return Acta::delete($id);
    }
}