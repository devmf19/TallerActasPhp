<?php

class CommitmentAjax {
    private function addBtn($rta)
    {
        require_once "../controller/userController.php";
        require_once "../model/user.php";

        if ($rta == false || empty($rta)) {
            $rta = [
                "num" => "",
                "id" => "",
                "acta_id" => "",
                "in_charge" => "",
                "description" => "",
                "start_date" => "",
                "end_date" => "",
                "btn" => ""
            ];
        } else {
            for ($i = 0; $i < count($rta); $i++) {
                $rta[$i]["num"] = $i + 1;
                $id = $rta[$i]["id"];
                $in_charge = $rta[$i]["in_charge"];

                $rta2 = UserController::getOne($in_charge);
                $rta[$i]["in_charge"] = $rta2["name"] . " " . $rta2["lastname"];

                $btn = "<div class='btn-toolbar'>
                            <div class='btn-group'>
                                <button class='btn btn-danger btnDeleteCommitment' commitmentId='{$id}'><i class='fa fa-times'></i></button>
                            </div> 
                        </div>";
                $rta[$i]["btn"] = $btn;
            }
        }

        return $rta;
    }

    public function getAll()
    {
        require_once "../controller/commitmentController.php";
        require_once "../model/commitment.php";
        $rta = CommitmentController::list();
        $rta = self::addBtn($rta);
        echo json_encode($rta);
    }

    public function createCommitment($data)
    {
        require_once "../controller/commitmentController.php";
        require_once "../model/commitment.php";
        $rta = CommitmentController::save($data);
        echo json_encode($rta);
    }

    public function deleteCommitment($id)
    {
        require_once "../controller/commitmentController.php";
        require_once "../model/commitment.php";
        $rta = CommitmentController::delete($id);
        echo json_encode($rta);
    }
}

$ajax = new CommitmentAjax();

if (isset($_POST) && !empty($_POST)) {
    if (!empty($_POST["option"]) && $_POST["option"] == "createCommitment") {
        if (!empty($_POST["new_acta_id_c"])) {

            $ajax->createCommitment($_POST);
        }
    } else if (!empty($_POST["option"]) && $_POST["option"] == "getCommitments") {

        $ajax->getAll();

    } else if (!empty($_POST["option"]) && $_POST["option"] == "deleteCommitment") {
        if (!empty($_POST["id"])) {

            $ajax->deleteCommitment($_POST["id"]);
        }
    }
}