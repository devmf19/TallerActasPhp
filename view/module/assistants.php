
<div class="box box-solid">

   <div class="box-header with-border">
     <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewAssistant">
       Nueva asistencia
     </button>
   </div>

   <div class="box-body">

     <table class="table table-bordered table-striped dt-responsive" id="assistantsTable">

       <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Nombre de asistente</th>
           <th>Opciones</th>
         </tr>
       </thead>

     </table>
   </div>

</div>

<!-- ---------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- -------------------- nueva asistencia -------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalNewAssistant" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <!--body header-->
      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Registrar nueva asistencia</h4>

      </div>

      <!--modal body-->
      <div class="modal-body">
        <div class="box-body">

          <!-- seleccionar acta -->
          <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="new_acta_id_a" name="new_acta_id_a" required>
                <option value="">Acta</option>
                <?php
                  $actas = ActaController::list();
                  foreach ($actas as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["issue"].'</option>';
                  }
                ?>
              </select>

              </div>
            </div>

          <!-- seleccionar asistente -->
            <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="new_assistant_id" name="new_assistant_id" required>
                <option value="">Asistente</option>
                <?php
                  $users = UserController::list();
                  foreach ($users as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["name"].' '. $value["lastname"].'</option>';
                  }
                ?>
              </select>

              </div>
            </div>

        </div>
      </div>

      <!--modal footer-->
      <div class="modal-footer">

        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Registrar asistencia</button>
        <?php

         $createAssistant = new assistantController();
         $createAssistant->save();

         ?>
      </div>
    </form>
  </div>
</div>
</div>

<?php

$deleteAssistant = new assistantController;
$deleteAssistant->delete();

?>