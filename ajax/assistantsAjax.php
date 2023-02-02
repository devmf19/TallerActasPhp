<?php

class AssistantAjax {
    private function addBtn($rta)
    {
        require_once "../controller/userController.php";
        require_once "../model/user.php";

        if ($rta == false || empty($rta)) {
            $rta = [
                "num" => "",
                "id" => "",
                "assistant_id" => "",
                "btn" => ""
            ];
        } else {
            for ($i = 0; $i < count($rta); $i++) {
                $rta[$i]["num"] = $i + 1;
                $id = $rta[$i]["id"];
                $assitant_id = $rta[$i]["assistant_id"];

                $rta2 = UserController::getOne($assitant_id);
                $rta[$i]["assistant_id"] = $rta2["name"] . " " . $rta2["lastname"];

                $btn = "<div class='btn-toolbar'>
                            <div class='btn-group'>
                                <button class='btn btn-danger btnDeleteAssistant' assistantId='{$id}'><i class='fa fa-times'></i></button>
                            </div> 
                        </div>";
                $rta[$i]["btn"] = $btn;
            }
        }

        return $rta;
    }

    public function getAll()
    {
        require_once "../controller/assistantController.php";
        require_once "../model/assistants.php";
        $rta = AssistantController::list();
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function createAssistant($data)
    {
        require_once "../controller/assistantController.php";
        require_once "../model/assistants.php";
        $rta = AssistantController::save($data);
        echo json_encode($rta);
    }

    public function deleteAssistant($id)
    {
        require_once "../controller/assistantController.php";
        require_once "../model/assistants.php";
        $rta = AssistantController::delete($id);
        echo json_encode($rta);
    }
}

$ajax = new AssistantAjax();

if (isset($_POST) && !empty($_POST)) {
    if (!empty($_POST["option"]) && $_POST["option"] == "createAssistant") {
        if (!empty($_POST["new_acta_id_a"]) && !empty($_POST["new_assistant_id"])) {

            $ajax->createAssistant($_POST);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "getAssistants") {

        $ajax->getAll();

    } else if (!empty($_POST["option"]) && $_POST["option"] == "deleteAssistant") {
        if (!empty($_POST["id"])) {

            $ajax->deleteAssistant($_POST["id"]);
        }
    }
}