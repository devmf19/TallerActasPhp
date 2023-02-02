<?php

class ActaController
{
    public static function validate($data)
    {
        $now = strtotime(date('Y-m-d'));
        $date = strtotime($data['new_created_date']);
        $start_time = strtotime($data['new_start_time']);
        $end__time = strtotime($data['new_end_time']);

        if (is_numeric($data['new_creator_id'])) {
            if ($data['new_issue'] != "") {
                if ($date >= $now) {
                    if ($date >= $now) {
                        return 'ok';
                    } else {
                        return "La fecha del acta no puede er anterior al día de hoy";
                    }
                } else {
                    return "La fecha del acta no puede ser anterior al día de hoy";
                }
            } else {
                return "El asunto del acta no puede estar vacío";
            }
        } else {
            return "El id del usuario solo puede contener números";
        }
    }

    public static function list()
    {
        return Acta::getAll();
    }

    public static function getOne($id)
    {
        $column = "id";
        return Acta::getBy($column, $id);
    }

    public static function getByIssue($issue)
    {
        $column = "issue";
        return Acta::getBy($column, $issue);
    }

    public static function getByCreator($creatorId)
    {
        $column = "creator_id";
        return Acta::getBy($column, $creatorId);
    }

    public static function getBetween($initialDate, $endDate)
    {
        return Acta::getBetween($initialDate, $endDate);
    }

    public static function getPending()
    {
        return Acta::getPending();
    }

    public static function save($data)
    {
        //$data = $_POST;
        $response = [
            'state' => '',
            'msg' => ''
        ];
        if (!empty($data) && $data["new_issue"] != "") {
            $rta =  Acta::save($data);
            if ($rta == "ok") {
                $response['state'] = 'success';
                $response['msg'] = 'Acta registrada.';
            } else {
                $response['state'] = 'error';
                $response['msg'] = 'No se regitró el acta';
            }
        } else {
            $response['state'] = 'error';
            $response['msg'] = 'No se recibió el asunto del acta.';
        }
        return $response;
    }

    public static function update($data)
    {
        $data = $_POST;
        $response = [
            'state' => '',
            'msg' => ''
        ];
        if (!empty($data) && $data["up_id_acta"] != "") {
            $rta =  Acta::update($data);
            if ($rta == "ok") {
                $response['state'] = 'success';
                $response['msg'] = 'Acta Actualizada.';
            } else {
                $response['state'] = 'error';
                $response['msg'] = 'No se actualizó el acta';
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
            'msg' => 'No existe un acta con el id recibido'
        ];
        $rta = Acta::delete($id);
        if ($rta == "ok") {
            $response['state'] = 'success';
            $response['msg'] = 'Acta eliminada';
        }
        return $response;
    }
}
