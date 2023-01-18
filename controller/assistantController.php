<?php

class AssistantController {

    public static function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function list(){
        return Assistant::getAll();
    }

    public static function save($data){
        return Assistant::save($data);
    }

    public static function update($data){
        return Assistant::update($data);
    }

    public static function delete($id){
        return Assistant::delete($id);
    }
}