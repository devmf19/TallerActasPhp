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
     <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCustomer">
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

         echo '<tr>
               <td>'.($key+1).'</td>
               <td>'.$data["creator_id"].'</td>
               <td>'.$data["issue"].'</td>
               <td>'.$data["start_time"].'</td>
               <td>'.$data["end_time"].'</td>
               <td>'.$data["created_date"].'</td>
               <td>'.$data["in_charge"].'</td>
               
               <td>
                 <div class="btn-toolbar">
                   <div class="btn-group">
                     <button class="btn btn-warning btnEditActa" id="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateCustomer"><i class="fa fa-pencil"></i></button>
                   </div>';
                   if($_SESSION["rol"] == "Administrador"){

                     echo '<div class="btn-group">
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
<!-- ------------------ MODAL CREAR CLIENTE -------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalCreateCustomer" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
       <!--CABEZA DEL MODAL-->
       <div class="modal-header" style="background:#3c8dbc; color:white">

         <h4 class="modal-title">Registrar cliente</h4>

       </div>

       <!--CUERPO DEL MODAL-->
       <div class="modal-body">
         <div class="box-body">

           <!-- campo para ingresar la cedula -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="number" class="form-control input-lg" name="nuevoCedulaC"  id="nuevoCedulaC" placeholder="Digite el número de cédula" required>

             </div>
           </div>

           <!-- campo para ingresar el nombre -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-user"></i></span>
               <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar el nombre del cliente" required>

             </div>
           </div>

           <!-- campo para ingresar el telefono -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-phone"></i></span>
               <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Digite el número de teléfono del cliente" required>

             </div>
           </div>

           <!-- campo para ingresar la direccion -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-key"></i></span>
               <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar la dirección" required>

             </div>
           </div>

           <!-- campo para ingresar la ciudad -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-lock"></i></span>
               <input type="text" class="form-control input-lg" name="nuevoCiudad" placeholder="Ingresar la ciudad" required>

             </div>
           </div>

           <!-- campo para ingresar el correo -->
           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-lock"></i></span>
               <input type="email" class="form-control input-lg" name="nuevoCorreoC" placeholder="Ingresar el correo del cliente" required>

             </div>
           </div>
         
         </div>
       </div>

       <!--PIE DEL MODAL-->
       <div class="modal-footer">

         <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
         <button type="submit" class="btn btn-success">Registrar cliente</button>
         <?php

        //    $createCustomer = new CustomersController();
        //    $createCustomer->ctrCreateCustomer();

           ?>

       </div>
    </form>
   
   </div>
</div>
</div> 


<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- --------------- MODAL ACTUALIZAR CLIENTE ------------------ -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalUpdateCustomer" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <!--CABEZA DEL MODAL-->
      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Actualizar cliente</h4>

      </div>

      <!--CUERPO DEL MODAL-->
      <div class="modal-body">
        <div class="box-body">

          <!-- campo para ingresar la cedula -->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
              <input type="hidden"  name="idCliente" id="idCliente" required>
              <input type="number" class="form-control input-lg" name="editarCedulaC" id="editarCedulaC" value="" required>

            </div>
          </div>

          <!-- campo para ingresar el nombre -->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente"  value="" required>

            </div>
          </div>

          <!-- campo para ingresar el telefono -->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="number" class="form-control input-lg" name="editarTelefonoC" id="editarTelefonoC"  value="">

            </div>
          </div>

          <!-- campo para ingresar la direccion -->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="text" class="form-control input-lg" name="editarDireccionC" id="editarDireccionC" value="">

            </div>
          </div>

          <!-- campo para ingresar la ciudad -->
          <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-lock"></i></span>
               <input type="text" class="form-control input-lg" name="editarCiudadC" id="editarCiudadC" value="">

             </div>
           </div>
          
          <!-- campo para ingresar el correo -->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="email" class="form-control input-lg" name="editarCorreoC" id="editarCorreoC" value="">

            </div>
          </div>

         </div>
       </div>
      <!--PIE DEL MODAL-->
      <div class="modal-footer">

        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Actualizar cliente</button>
        <?php

        //  $updateCustomer = new CustomersController();
        //  $updateCustomer->ctrUpdateCustomer();

         ?>
      </div>
    
     </form>

  </div>
</div>
</div>


<?php

// $deleteCustomer = new CustomersController();
// $deleteCustomer->ctrDeleteCustomer();

?>
