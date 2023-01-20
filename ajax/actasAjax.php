<?php
require_once "../controller/actaController.php";
require_once "../model/acta.php";

class ActasAjax{
    public function getActa($id){
        $rta = ActaController::getOne($id);
        echo json_encode($rta);
    }
}

if(isset($_POST["id_acta"])){
    $acta = new ActasAjax();
    $acta->getActa($_POST["id_acta"]);
}