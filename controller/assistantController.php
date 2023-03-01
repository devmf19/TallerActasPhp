<?php

class AssistantController
{

    public static function list()
    {
        return Assistant::getAll();
    }

    public static function save($data)
    {
        $response = [
            'state' => '',
            'msg' => ''
        ];
        if (isset($data["new_acta_id_a"]) && $data["new_acta_id_a"] != "") {
            if (isset($data["new_assistant_id"]) && $data["new_assistant_id"] != "") {
                $exist = Assistant::exist($data["new_assistant_id"], $data["new_acta_id_a"]);
                if (empty($exist) || !$exist) {
                    $rta = Assistant::save($data);

                    if ($rta == "ok") {
                        $response['state'] = 'success';
                        $response['msg'] = 'Asistente registrado.';
                    } else {
                        $response['state'] = 'error';
                        $response['msg'] = 'No se regitró el el asistente';
                    }
                } else {
                    $response['state'] = 'error';
                    $response['msg'] = 'El usuario ya registró su asistencia anteriormente.';
                }
            } else {
                $response['state'] = 'error';
                $response['msg'] = 'No se recibió el id del asistente.';
            }
        } else {
            $response['state'] = 'error';
            $response['msg'] = 'No se recibió el id del acta.';
        }
        return $response;
    }

    public static function delete($id)
    {
        $response = [
            'state' => 'error',
            'msg' => 'No existe un asistente con el id recibido'
        ];
        $rta = Assistant::delete($id);
        if ($rta == "ok") {
            $response['state'] = 'success';
            $response['msg'] = 'Asistente eliminado';
        }
        return $response;
    }
}
