
 <div class="box box-solid">

   <div class="box-header with-border">
     <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewCommitment">
       Nuevo compromiso
     </button>
   </div>

   <div class="box-body">

     <table class="table table-bordered table-striped dt-responsive tabla">

       <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Descripción</th>
           <th>Asunto acta</th>
           <th>Responsable</th>
           <th>Inicia</th>
           <th>Termina</th>
           <th>Opciones</th>
         </tr>
       </thead>

       <tbody>
     
       <?php

       $column = null;
       $value = null;

       $commitments = CommitmentController::list();

       foreach($commitments as $key => $data) {
         $acta = ActaController::getOne($data["acta_id"]);
         $inCharge = UserController::getOne($data["in_charge"]);

         echo '<tr>
               <td>'.($key+1).'</td>
               <td>'.$data["description"].'</td>
               <td>'.$acta["issue"].'</td>
               <td>'.$inCharge["name"].' .'.$inCharge["lastname"].'</td>
               <td>'.$data["start_date"].'</td>
               <td>'.$data["end_date"].'</td>
               
               <td>
                 <div class="btn-toolbar">
                   <div class="btn-group">
                      <a href="index.php?route=seeEntry&cod_factura='.$data["id"].'"><button class="btn btn-info" ><i class="fa fa-eye"></i></button></a>
                   </div> 
                   ';
                   if($_SESSION["role"] == 1){

                     echo '
                     <div class="btn-group">
                        <button class="btn btn-warning btnEditCommitment" id="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateCommitment"><i class="fa fa-pencil"></i></button>
                     </div>
                     <div class="btn-group">
                        <button class="btn btn-danger btnDeleteCommitment" id="'.$data["id"].'"><i class="fa fa-times"></i></button>
                     </div> 
                     ';
   
                   }  
                   
                 echo '</div>
               </td>

             </tr>';
       }
       ?>
       </tbody>

     </table>
     
   </div>
  
 </div>




<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ------------------ crear compromiso -------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalNewCommitment" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">

    <form class="form_new_acta" role="form" method="post" enctype="multipart/form-data">
       
    <!--modal header-->
       <div class="modal-header" style="background:#3c8dbc; color:white">
         <h4 class="modal-title">Nuevo compromiso</h4>
       </div>

       <!--modal body-->
       <div class="modal-body">
         <div class="box-body">

         <!-- seleccionar acta -->
          <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="new_acta_id_c" name="new_acta_id_c" required>
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

            <!-- seleccionar responsable -->
            <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="new_in_charge_c" name="new_in_charge_c" required>
                <option value="">Responsable</option>
                <?php
                  $users = UserController::list();
                  foreach ($users as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["name"].' '. $value["lastname"].'</option>';
                  }
                ?>
              </select>

              </div>
            </div>

           <!-- descripcion -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="text" class="form-control input-lg" id="new_description_c" name="new_description_c"  placeholder="Descripción del compromiso" required>

             </div>
           </div>

           <!-- horas de inicio y fin -->
           <div class="form-group row">
              
              <div class="col-xs-6">
                <div class="input-group">

                  <span class="input-group-addon">Inicia</span>
                  <input type="date" class="form-control input-lg" id="new_start_date_c" name="new_start_date_c" min="09:00" max="18:00" required>

                </div>
              </div>
              <div class="col-xs-6">
                <div class="input-group">

                  <input type="date" class="form-control input-lg" id="new_end_date_c" name="new_end_date_c" min="09:00" max="18:00" required>
                  <span class="input-group-addon">Termina</span>

                </div>
              </div>


           </div>

         
          </div>
       </div>

       <!--modal footer-->
       <div class="modal-footer">

         <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
         <button type="submit" id="btn_new_acta" class="btn btn-success">Registrar compromiso</button>
         <?php

            $crateCommitment = new CommitmentController();
            $crateCommitment->save();

           ?>

       </div>
    </form>
   
   </div>
</div>
</div> 


<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- --------------- actualizar compromiso ------------------ -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalUpdateActa" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <!--modal header-->
      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Actualizar compromiso</h4>

      </div>

      <!--modal body-->
      <div class="modal-body">
        <div class="box-body">

           <!-- seleccionar creador -->
           <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="up_creator_id" name="up_creator_id" required>
                <option value="">Creador del acta</option>
                <?php
                  $users = UserController::list();
                  foreach ($users as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["name"].' '. $value["lastname"].'</option>';
                  }
                ?>
              </select>

              </div>
            </div>

           <!-- asunto -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="text" class="form-control input-lg" id="up_issue" name="up_issue"  placeholder="Asunto del acta" required>
               <input type="hidden" name="id_acta" id="id_acta" required>
             </div>
           </div>

           <!-- horas de inicio y fin -->
           <div class="form-group row">
              
              <div class="col-xs-6">
                <div class="input-group">

                  <span class="input-group-addon">Inicia</span>
                  <input type="time" class="form-control input-lg" id="up_start_time" name="up_start_time" min="09:00" max="18:00" required>

                </div>
              </div>
              <div class="col-xs-6">
                <div class="input-group">

                  <input type="time" class="form-control input-lg" id="up_end_time" name="up_end_time" min="09:00" max="18:00" required>
                  <span class="input-group-addon">Termina</span>

                </div>
              </div>


           </div>

           <!-- seleccionar responsable -->
           <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="up_in_charge" name="up_in_charge" required>
                <option value="">Responsable del acta</option>
                <?php
                  $users = UserController::list();
                  foreach ($users as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["name"].' '. $value["lastname"].'</option>';
                  }
                ?>
              </select>

              </div>
            </div>

           <!-- orden del dia -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-phone"></i></span>
               <input type="text" class="form-control input-lg" id="up_order_of_day" name="up_order_of_day" placeholder="Orden del día" required>

             </div>
           </div>

           <!-- descripcion de hechos -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control input-lg" id="up_facts_description" name="up_facts_description" placeholder="Descripción de hechos" required>

             </div>
           </div>
         
        
        </div>
       </div>
      <!--modal footer-->
      <div class="modal-footer">

        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Actualizar acta</button>
        <?php

        //   $updateActa = new ActaController();
        //   $updateActa->update();

         ?>
      </div>
    
     </form>

  </div>
</div>
</div>


<?php

// $deleteActa = new ActaController();
// $deleteActa->delete();

?>
