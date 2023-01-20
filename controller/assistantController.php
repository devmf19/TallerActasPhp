<?php

class AssistantController {

    public static function toJson($tittle, $data) {
        // header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function list(){
        return Assistant::getAll();
    }

    public static function getOne($id){
        $column = "id";
        return User::getBy($column, $id);
    }

    public static function save(){
        $data = $_POST;
        if (isset($_POST["acta_id"]) && $_POST["acta_id"] != "" && isset($_POST["assistant_id"]) && $_POST["assistant_id"] != "") {

            $rta = Assistant::save($data);

            if ($rta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡Se registró un nuevo asistente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "assistants";
                        }
                    });
                </script>';
            }
        }
    }

    public static function update($data){
        return Assistant::update($data);
    }

    public static function delete(){
        if (isset($_GET["id_assistant"])) {
            
            $id = $_GET["id_assistant"];
            $rta = Assistant::delete($id);

            if ($rta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "Asistente eliminado",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "assistants";
                        }
                    });
				</script>';
            }
        }
    }
}