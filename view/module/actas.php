<div class="content-wrapper">

<section class="content-header">

  <h1>
    Actas
  </h1>

</section>

<!-- Contenido principal -->
<section class="content">

 <div class="box">

   <div class="box-header with-border">
     <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewActa">
       Nueva acta
     </button>
   </div>

   <div class="box-body">

     <table class="table table-bordered table-striped dt-responsive tabla">

       <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Creador</th>
           <th>Asunto</th>
           <th>Inicia</th>
           <th>Termina</th>
           <th>Creada</th>
           <th>Responsable</th>
           <th>Opciones</th>
         </tr>
       </thead>

       <tbody>
     
       <?php

       $column = null;
       $value = null;

       $actas = ActaController::list();

       foreach($actas as $key => $data) {
         $creator = UserController::getOne($data["creator_id"]);
         $inCharge = UserController::getOne($data["in_charge"]);

         echo '<tr>
               <td>'.($key+1).'</td>
               <td>'.$creator["name"].' .'.$creator["lastname"].'</td>
               <td>'.$data["issue"].'</td>
               <td>'.$data["start_time"].'</td>
               <td>'.$data["end_time"].'</td>
               <td>'.$data["created_date"].'</td>
               <td>'.$inCharge["name"].' .'.$inCharge["lastname"].'</td>
               
               <td>
                 <div class="btn-toolbar">
                   <div class="btn-group">
                      <a href="index.php?route=seeEntry&cod_factura='.$data["id"].'"><button class="btn btn-info" ><i class="fa fa-eye"></i></button></a>
                   </div> 
                   ';
                   if($_SESSION["role"] == 1){

                     echo '
                     <div class="btn-group">
                        <button class="btn btn-warning btnEditActa" id="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateActa"><i class="fa fa-pencil"></i></button>
                     </div>
                     <div class="btn-group">
                        <button class="btn btn-danger btnDeleteActa" id="'.$data["id"].'"><i class="fa fa-times"></i></button>
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

</section>

</div>

<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ------------------ crear acta -------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalNewActa" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">

    <form class="form_new_acta" role="form" method="post" enctype="multipart/form-data">
       
    <!--modal header-->
       <div class="modal-header" style="background:#3c8dbc; color:white">
         <h4 class="modal-title">Nueva acta</h4>
       </div>

       <!--modal body-->
       <div class="modal-body">
         <div class="box-body">

            <!-- seleccionar creador -->
            <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="new_creator_id" name="new_creator_id" required>
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
               <input type="text" class="form-control input-lg" id="new_issue" name="new_issue"  placeholder="Asunto del acta" required>

             </div>
           </div>

           <!-- fecha -->
           <div class="form-group">
             <div class="input-group">

                <span class="input-group-addon">Fecha</span>
                <input type="date" class="form-control input-lg" id="up_start_time" name="new_start_date" required>

             </div>
           </div>

           <!-- horas de inicio y fin -->
           <div class="form-group row">
              
              <div class="col-xs-6">
                <div class="input-group">

                  <span class="input-group-addon">Inicia</span>
                  <input type="time" class="form-control input-lg" id="new_start_time" name="new_start_time" min="09:00" max="22:00" required>

                </div>
              </div>
              <div class="col-xs-6">
                <div class="input-group">

                  <input type="time" class="form-control input-lg" id="new_end_time" name="new_end_time" min="09:00" max="22:00" required>
                  <span class="input-group-addon">Termina</span>

                </div>
              </div>


           </div>

           <!-- seleccionar responsable -->
           <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg" id="new_in_charge"  name="new_in_charge" required>
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
               <input type="text" class="form-control input-lg" id="new_order_of_day" name="new_order_of_day" placeholder="Orden del día" required>

             </div>
           </div>

           <!-- descripcion de hechos -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control input-lg" id="new_facts_description" name="new_facts_description" placeholder="Descripción de hechos" required>

             </div>
           </div>

         
          </div>
       </div>

       <!--modal footer-->
       <div class="modal-footer">

         <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
         <button type="submit" id="btn_new_acta" class="btn btn-success">Registrar acta</button>
         <?php

            $crateActa = new ActaController();
            $crateActa->save();

           ?>

       </div>
    </form>
   
   </div>
</div>
</div> 


<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- --------------- actualizar acta ------------------ -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalUpdateActa" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <!--modal header-->
      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Actualizar acta</h4>

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

           <!-- fecha -->
           <div class="form-group">
             <div class="input-group">

                <span class="input-group-addon">Fecha</span>
                <input type="date" class="form-control input-lg" id="up_start_time" name="up_start_date" required>

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

          $updateActa = new ActaController();
          $updateActa->update();

         ?>
      </div>
    
     </form>

  </div>
</div>
</div>


<?php

$deleteActa = new ActaController();
$deleteActa->delete();

?>
