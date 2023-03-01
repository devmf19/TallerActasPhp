<?php
require_once "../controller/actaController.php";
require_once "../model/acta.php";

class ActasAjax
{
    private function addBtn($rta)
    {
        require_once "../controller/userController.php";
        require_once "../model/user.php";

        if ($rta == false || empty($rta)) {
            $rta = [
                "num" => "",
                "creator_id" => "",
                "issue" => "",
                "created_date" => "",
                "start_time" => "",
                "end_time" => "",
                "in_charge" => "",
                "btn" => ""
            ];
        } else {
            for ($i = 0; $i < count($rta); $i++) {
                $rta[$i]["num"] = $i + 1;
                $id = $rta[$i]["id"];
                $creator_id = $rta[$i]["creator_id"];
                $in_charge = $rta[$i]["in_charge"];

                $rta2 = UserController::getOne($creator_id);
                $rta[$i]["creator_id"] = $rta2["name"] . " " . $rta2["lastname"];

                $rta2 = UserController::getOne($in_charge);
                $rta[$i]["in_charge"] = $rta2["name"] . " " . $rta2["lastname"];

                $btn = "<div class='btn-toolbar'>
                            <div class='btn-group'>
                                <a href='index.php?route=seeActa&id={$id}'>
                                    <button class='btn btn-info'>
                                        <i class='fa fa-eye'></i>
                                    </button>
                                </a>
                            </div> 
                            <div class='btn-group'>
                                <button class='btn btn-warning btnUpdateActa' actaId='{$id}' data-toggle='modal' data-target='#modalUpdateActa'><i class='fa fa-pencil'></i></button>
                            </div>
                            <div class='btn-group'>
                                <button class='btn btn-danger btnDeleteActa' actaId='{$id}' onclick='updateActa()'><i class='fa fa-times'></i></button>
                            </div> 
                        </div>";
                $rta[$i]["btn"] = $btn;
            }
        }

        return $rta;
    }

    public function getActa($id)
    {
        $rta = ActaController::getOne($id);
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function getByIssue($issue)
    {
        $rta = ActaController::getByIssue($issue);
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function getAll()
    {
        require_once "../controller/actaController.php";
        require_once "../model/acta.php";
        $rta = ActaController::list();
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function getBetween($initialDate, $endDate)
    {
        $rta = ActaController::getBetween($initialDate, $endDate);
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function getPending()
    {
        $rta = ActaController::getPending();
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function getByCreator($id)
    {
        $rta = ActaController::getByCreator($id);
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function createActa($data)
    {
        require_once "../controller/actaController.php";
        require_once "../model/acta.php";
        $rta = ActaController::save($data);
        echo json_encode($rta);
    }

    public function updateActa($data)
    {
        require_once "../controller/actaController.php";
        require_once "../model/acta.php";
        $rta = ActaController::update($data);
        echo json_encode($rta);
    }

    public function deleteActa($id)
    {
        require_once "../controller/actaController.php";
        require_once "../model/acta.php";
        $rta = ActaController::delete($id);
        echo json_encode($rta);
    }
}

$ajax = new ActasAjax();


if (isset($_POST) && !empty($_POST)) {
    if (!empty($_POST["option"]) && $_POST["option"] == "getBetween") { 
        if (!empty($_POST["initialDate"]) && !empty($_POST["endDate"])) {

            $ajax->getBetween($_POST["initialDate"], $_POST["endDate"]);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "getPending") {
        
        $ajax->getPending();
        
    } else if (!empty($_POST["option"]) && $_POST["option"] == "getByActa") {
        if (!empty($_POST["id"])) {

            $ajax->getActa($_POST["id"]);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "getByIssue") {
        if (!empty($_POST["issue"])) {

            $ajax->getByIssue($_POST["issue"]);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "getByCreator") {
        if (!empty($_POST["creatorId"])) {

            $ajax->getByCreator($_POST["creatorId"]);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "createActa") {
        if (!empty($_POST["new_creator_id"])) {

            $ajax->createActa($_POST);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "getActas") {

        $ajax->getAll();

    } else if (!empty($_POST["option"]) && $_POST["option"] == "updateActa") {
        if (!empty($_POST["up_id_acta"])) {

            $ajax->updateActa($_POST);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "deleteActa") {
        if (!empty($_POST["id"])) {

            $ajax->deleteActa($_POST["id"]);
        }
    }
}
