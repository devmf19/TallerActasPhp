<?php

class ActaController {

    public static function toJson($tittle, $data) {
        header('Content-type:application/json;charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public static function list(){
        return Acta::getAll();
    }

    public static function getOne($id){
        $column = "id";
        return Acta::getBy($column, $id);
    }

    public static function getByIssue($issue){
        $column = "issue";
        return Acta::getBy($column, $issue);
    }

    public static function save(){
        $data = $_POST;
        if(!empty($data) && $data["new_issue"]!=null){
            $exist = self::getByIssue($data["new_issue"]);

            if($exist != null){
                echo '<script>
                    swal({
                        type: "danger",
                        title: "¡Este asunto ya pertenece a un acta!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "actas";
                        }
                    });
                </script>';
            } else {
                $rta =  Acta::save($data);
                if ($rta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡Acta registrada!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "actas";
                            }
                        });
                    </script>';
                }
            }
            
        }
        
    }

    public static function update(){
        $data = $_POST;
        if(!empty($data)){
            $rta = Acta::update($data);
            if ($rta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "Acta actualizada",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "actas";
                        }
					});
				</script>';
            }
        }
    }

    public static function delete(){
        if (isset($_GET["id_acta"])) {
            
            $id = $_GET["id_acta"];
            $rta = Acta::delete($id);

            if ($rta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "Acta eliminado",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "actas";
                        }
                    });
				</script>';
            }
        }
    }
}