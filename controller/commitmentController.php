<?php

class CommitmentController {
    public static function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function list(){
        return Commitment::getAll();
    }

    public static function save($data){
        return Commitment::save($data);
    }

    public static function update($data){
        return Commitment::update($data);
    }

    public static function delete($id){
        return Commitment::delete($id);
    }
}