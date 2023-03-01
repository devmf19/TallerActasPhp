<?php

class ActaController
{
    public static function validate($data)
    {
        $now =  new DateTime("now", new DateTimeZone('America/Bogota'));
        $now = $now->format('Y-m-d H:i');
        $initial = $data['new_created_date'] . ' ' . $data['new_start_time'];
        $end = $data['new_created_date'] . ' ' . $data['new_end_time'];

        $exist = Acta::getBy("issue", $data["new_issue"]);

        if (empty($exist)) {
            if (is_numeric($data['new_creator_id'])) {
                if ($data['new_issue'] != "") {
                    if ($initial >= $now) {
                        if ($end > $initial) {
                            return 'ok';
                        } else {
                            return "La hora de finalizar el acta no puede ser anterior a la hora de inicio";
                        }
                    } else {
                        return "La fecha y hora de inicio del acta no puede ser anterior al día y momento actual";
                    }
                } else {
                    return "El asunto del acta no puede estar vacío";
                }
            } else {
                return "El id del usuario solo puede contener números";
            }
        } else {
            return "El asunto del acta ya se regitró anteriormente";
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
        return Acta::getByIssue($issue);
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
        $response = [
            'state' => '',
            'msg' => ''
        ];
        $validate = self::validate($data);
        if ($validate == "ok") {
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
            $response['msg'] = $validate;
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
