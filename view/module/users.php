<?php

if($_SESSION["role"] == "1"){

  echo '<script>
    window.location = "home";
  </script>';

  return;

}

?>
 <div class="content-wrapper">
   <section class="content-header">

     <h1>
       Administrar usuarios
     </h1>

   </section>

   <!-- Contenido principal -->
   <section class="content">

     <div class="box">

       <div class="box-header with-border">
         <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateUser">
           Registrar usuario
         </button>
       </div>

       <div class="box-body">

         <table class="table table-bordered table-striped dt-responsive tabla">

           <thead>
             <tr>
               <th style="width:10px">#</th>
               <th>Nombre</th>
               <th>Usuario</th>
               <th>Tipo Id</th>
               <th># Id</th>
               <th>Rol</th>
               <th>Opciones</th>
             </tr>
           </thead>

           <tbody>
          
           <?php

           $column = null;
           $value = null;

           $users = UserController::list();

           foreach($users as $key => $data) {
             $tipoid = $data["tipoid"];
             echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$data["name"].' '. $data["lastname"].'</td>
                    <td>'.$data["username"].'</td>
                    <td>'.$tipoid.'</td>
                    <td>'.$data["id"].'</td>';

                    if($data["role"] == 1){
                      echo '<td><button class="btn btn-danger btn-xs btnSetRole" userId="'.$data["id"].'" role="1" option="setRole">Informes</button></td>';
                    }else{
                      echo '<td><button class="btn btn-success btn-xs btnSetRole" userId="'.$data["id"].'" role="2" option="setRole">Administrador</button></td>';
                    } 

                    echo
                     '<td>
                      <div class="btn-toolbar"> 
                        <div class="btn-group">
                          <button class="btn btn-warning btnUpdateUser" userId="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateUser"><i class="fa fa-pencil"></i></button>
                        </div>  
                        <div class="btn-group">
                          <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$data["id"].'"><i class="fa fa-times"></i></button>
                        </div> 
                      </div>
                    </td>

                  </tr>';
           }
           ?>
           </tbody>

         </table>
       </div>
   </section>
 </div>

 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ------------------ MODAL CREAR USUARIO -------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalCreateUser" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--CABEZA DEL MODAL-->
         <div class="modal-header" style="background:#3c8dbc; color:white">

           <h4 class="modal-title">Registrar usuario</h4>

         </div>

         <!--CUERPO DEL MODAL-->
         <div class="modal-body">
           <div class="box-body">

             <!-- campo para ingresar la cedula -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                 <input type="number" class="form-control input-lg" name="nuevoCedula"  id="nuevoCedula" placeholder="Digite el número de cédula" required>

               </div>
             </div>

             <!-- campo para ingresar el nombre -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar el nombre" required>

               </div>
             </div>

             <!-- campo para ingresar el telefono -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                 <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Digite el número de teléfono" required>

               </div>
             </div>

             <!-- campo para ingresar el usuario para iniciar sesion -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                 <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar el usuario" id="nuevoUsuario" required>

               </div>
             </div>

             <!-- campo para ingresar la contraseña -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                 <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar la contraseña" required>

               </div>
             </div>

             <!-- campo para seleccionar el rol que tendra el nuevo usuario -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-users"></i></span>
                 <select class="form-control input-lg" name="nuevoRol">

                   <option value="">Selecionar rol</option>
                   <option value="Administrador">Administrador</option>
                   <option value="Vendedor">Vendedor</option>

                 </select>

               </div>
             </div>
           
            </div>
         </div>

         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Registrar usuario</button>
           <?php

            // $createUser = new UsersController();
            // $createUser->ctrCreateUser();

            ?>
         </div>
       </form>
     </div>
   </div>
 </div>

 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ---------------- MODAL ACTUALIZAR USUARIO ----------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalUpdateUser" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--CABEZA DEL MODAL-->
         <div class="modal-header" style="background:#3c8dbc; color:white">

           <h4 class="modal-title">Actualizar usuario</h4>

         </div>

         <!--CUERPO DEL MODAL-->
         <div class="modal-body">
           <div class="box-body">
                
              <!-- actualizar tipo de identificacion -->

              <div class="form-group">
                <div class="input-group">
                    
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg" name="up_tipoid" required>
                    <option value="" id="up_tipoid"></option>
                    <option value="1">Cédula de ciudadanía</option>
                    <option value="2">Tarjeta de identidad</option>
                  </select>

                </div>
              </div>

                <!-- numero de identificacion -->

              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input type="number" class="form-control input-lg" id="up_id" name="up_id"  placeholder="Número de identificación" readonly required>
                  <input type="hidden" name="option" id="option" value="getUser" required>

                </div>
              </div>

              <!-- actualizar nombre -->

              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input type="text" class="form-control input-lg" id="up_name" name="up_name"  placeholder="Nombres" required>

                </div>
              </div>

              <!-- actualizar apeellidos -->

              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input type="text" class="form-control input-lg" id="up_lastname" name="up_lastname"  placeholder="Apellidos" required>

                </div>
              </div>

              <!-- actualizar correo -->

              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input type="email" class="form-control input-lg" id="up_email" name="up_email"  placeholder="Nuevo correo" readonly required>

                </div>
              </div>

              <!-- actualizar usuario -->

              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input type="text" class="form-control input-lg" id="up_username" name="up_username"  placeholder="Nuevo usuario" required>
                
                </div>
              </div>

              <!-- actualizar contraseña -->

              <div class="form-group">
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input type="password" class="form-control input-lg" id="up_password" name="up_password"  placeholder="Nueva contraseña" required>
                  <input type="hidden" id="actual_password" name="actual_password">

                </div>
              </div> 

            </div>
          </div>

         <!--PIE DEL MODAL-->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Actualizar usuario</button>

        </div>

         <?php

          // $editUser = new UsersController();
          // $editUser->ctrUpdateUser();

          ?>

       </form>
     </div>
   </div>
 </div>

 <?php

  // $deleteUser = new UsersController();
  // $deleteUser->ctrDeleteUser();

  ?>