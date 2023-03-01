<?php

class CommitmentController {

    public static function getOne($id){
        $column = "id";
        return Commitment::getBy($column, $id);
    }

    public static function list(){
        return Commitment::getAll();
    }

    public static function save($data){
        $response = [
            'state' => '',
            'msg' => ''
        ];
        if(isset($data["new_acta_id_c"]) && $data["new_acta_id_c"] != ""){
            $rta = Commitment::save($data);

            if ($rta == "ok") {
                $response['state'] = 'success';
                $response['msg'] = 'Compromiso registrado.';
            } else {
                $response['state'] = 'error';
                $response['msg'] = 'No se regitró el el compromiso';
            }
        } else {
            $response['state'] = 'error';
            $response['msg'] = 'No se recibió el id del acta.';
        }
        return $response;
    }

    public static function delete($id){
        $response = [
            'state' => 'error',
            'msg' => 'No existe un compromiso con el id recibido'
        ];
        $rta = Commitment::delete($id);
        if ($rta == "ok") {
            $response['state'] = 'success';
            $response['msg'] = 'Compromiso eliminada';
        }
        return $response;
    }
}