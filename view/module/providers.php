<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Administrar proveedores
    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
         <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateProvider">
           Registrar proveedor
         </button>
       </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tabla">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Ciudad</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Opciones</th>
            </tr>
          </thead>

          <tbody>
            <?php
              $column = null;
              $value = null;

              $providers = ProvidersController::ctrShowProvider($column, $value);

              foreach($providers as $key => $data) {

                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$data["nombre"].'</td>
                        <td>'.$data["direccion"].'</td>
                        <td>'.$data["ciudad"].'</td>
                        <td>'.$data["correo"].'</td>
                        <td>'.$data["telefono"].'</td>
                        
                        <td>
                          <div class="btn-toolbar">';
                          if($_SESSION["rol"] == "Administrador"){

                            echo '<div class="btn-group">
                                    <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateProvider"><i class="fa fa-pencil"></i></button>
                                  </div>  
                                  <div class="btn-group">
                                    <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$data["id"].'"><i class="fa fa-times"></i></button>
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


 <!-- ------------------------------------------------------------ -->
 <!-- ----------------------------------------------------------- -->
 <!-- ------------------ MODAL CREAR PROVEEDOR ------------------ -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalCreateProvider" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">
          <!--CABEZA DEL MODAL-->
          <div class="modal-header" style="background:#3c8dbc; color:white">

            <h4 class="modal-title">Registrar proveedor</h4>

          </div>

          <!--CUERPO DEL MODAL-->
          <div class="modal-body">
            <div class="box-body">

              <!-- campo para ingresar el nombre -->
              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoProveedor" id="nuevoProveedor" placeholder="Ingresar el nombre del proveedor" required>

                </div>
              </div>

              <!-- campo para ingresar el telefono -->
              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Digite el número de teléfono del proveedor" required>

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
                  <input type="email" class="form-control input-lg" name="nuevoCorreoP" id="nuevoCorreoP" placeholder="Ingresar el correo del proveedor" required>

                </div>
              </div>
            
            </div>
          </div>

          <!--PIE DEL MODAL-->
          <div class="modal-footer">

            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Registrar proveedor</button>
            <?php

              $createProvider = new ProvidersController();
              $createProvider->ctrCreateProvider();

              ?>

          </div>
       </form>
      
      </div>
   </div>
 </div> 

 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ------------- MODAL ACTUALIZAR PROVEEDOR ------------------ -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalUpdateProvider" class="modal fade" role="dialog">
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

             <!-- campo para ingresar el nombre -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="hidden"  name="idProveedor" id="idProveedor" required>
                 <input type="text" class="form-control input-lg" name="editarProveedor" id="editarProveedor"  value="" required>

               </div>
             </div>

             <!-- campo para ingresar el telefono -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                 <input type="number" class="form-control input-lg" name="editarTelefonoP" id="editarTelefonoP"  value="">

               </div>
             </div>

             <!-- campo para ingresar la direccion -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                 <input type="text" class="form-control input-lg" name="editarDireccionP" id="editarDireccionP" value="">

               </div>
             </div>

             <!-- campo para ingresar la ciudad -->
             <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="text" class="form-control input-lg" name="editarCiudadP" id="editarCiudadP" value="">

                </div>
              </div>
             
             <!-- campo para ingresar el correo -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                 <input type="email" class="form-control input-lg" name="editarCorreoP" id="editarCorreoP" value="">

               </div>
             </div>

            </div>
          </div>
         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Actualizar proveedor</button>
           <?php

            $updateProvider = new ProvidersController();
            $updateProvider->ctrUpdateProvider();

            ?>
         </div>
       
        </form>

     </div>
   </div>
 </div>


<?php

$deleteProvider = new ProvidersController();
$deleteProvider->ctrDeleteProvider();

?>
