<?php

class CommitmentController {
    public static function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function getOne($id){
        $column = "id";
        return Commitment::getBy($column, $id);
    }

    public static function list(){
        return Commitment::getAll();
    }

    public static function save(){
        $data = $_POST;
        if(isset($data["new_acta_id_c"]) && $data["new_acta_id_c"] != ""){
            $rta = Commitment::save($data);

            if ($rta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡Se registró el compromiso!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "commitments";
                        }
                    });
                </script>';
            }
        }
    }

    public static function update(){
        $data = $_POST;
        if(!empty($data)){
            $rta = Commitment::update($data);
            if ($rta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "Compromiso actualizdo",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "commitments";
                        }
					});
				</script>';
            }
        }
    }

    public static function delete(){
        if (isset($_GET["id_commitment"])) {
            
            $id = $_GET["id_commitment"];
            $rta = Commitment::delete($id);

            if ($rta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "Compromiso eliminado",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "commitments";
                        }
                    });
				</script>';
            }
        }
    }
}