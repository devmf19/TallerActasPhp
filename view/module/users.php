<?php

if($_SESSION["rol"] == "Vendedor"){

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
               <th>Rol</th>
               <th>Estado</th>
               <th>Foto</th>
               <th style="width:150px">Último login</th>
               <th>Opciones</th>
             </tr>
           </thead>

           <tbody>
          
           <?php

           $column = null;
           $value = null;

           $users = UsersController::ctrShowUser($column, $value);

           foreach($users as $key => $data) {

             echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$data["nombre"].'</td>
                    <td>'.$data["usuario"].'</td>
                    <td>'.$data["rol"].'</td>';

                    if($data["estado"] != 0){
                      echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$data["id"].'" estadoUsuario="0">Activado</button></td>';
                    }else{
                      echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$data["id"].'" estadoUsuario="1">Desactivado</button></td>';
                    } 

                    if($data["foto"] != ""){
                      echo '<td><img src="'.$data["foto"].'" class="img-thumbnail" width="40px"></td>';
                    }else{
                      echo '<td><img src="view/img/users/default/default-user.png" class="img-thumbnail" width="40px"></td>';
                    }

                    echo '<td>'.$data["ultimo_login"].'</td>
                    
                    <td>
                      <div class="btn-toolbar">
                        <div class="btn-group">
                          <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateUser"><i class="fa fa-pencil"></i></button>
                        </div>  
                        <div class="btn-group">
                          <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$data["id"].'" fotoUsuario="'.$data["foto"].'" usuario="'.$data["usuario"].'"><i class="fa fa-times"></i></button>
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

             <!-- campo para subir la foto de perfil del usuario -->
             <div class="form-group">

               <div class="panel">Foto de perfil</div>
               <input type="file" class="nuevaFoto" name="nuevaFoto">
               <p class="help-block">Peso máximo de la foto 2MB</p>
               <img src="view/img/users/default/default-user.png" class="img-thumbnail previsualizar" width="100px">

             </div>
           
            </div>
         </div>

         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Registrar usuario</button>
           <?php

            $createUser = new UsersController();
            $createUser->ctrCreateUser();

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

             <!-- campo para ingresar la cedula -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                 <input type="number" class="form-control input-lg" id="editarCedula" name="editarCedula" value="" required>

               </div>
             </div>

             <!-- campo para ingresar el nombre -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value=""  required>

               </div>
             </div>

             <!-- campo para ingresar el telefono -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                 <input type="number" class="form-control input-lg" id="editarTelefono" name="editarTelefono" value="" required>

               </div>
             </div>

             <!-- campo para ingresar el usuario para iniciar sesion -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                 <input type="text" class="form-control input-lg" name="editarUsuario" value="" id="editarUsuario" readonly required>

               </div>
             </div>

             <!-- campo para ingresar la contraseña -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                 <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Ingresar la nueva contraseña">
                 <input type="hidden" id="passwordActual" name="passwordActual">

               </div>
             </div>

             <!-- campo para seleccionar el rol que tendra el nuevo usuario -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-users"></i></span>
                 <select class="form-control input-lg" name="editarRol">

                   <option value="" id="editarRol"></option>
                   <option value="Administrador">Administrador</option>
                   <option value="Vendedor">Vendedor</option>

                 </select>

               </div>
             </div>

             <!-- campo para subir la foto de perfil del usuario -->
             <div class="form-group">

               <div class="panel">Foto de perfil</div>
               <input type="file" class="nuevaFoto" name="editarFoto">
               <p class="help-block">Peso máximo de la foto 2MB</p>
               <img src="view/img/users/default/default-user.png" class="img-thumbnail previsualizarEditar" width="100px">
               <input type="hidden" name="fotoActual" id="fotoActual">

             </div>
           </div>
         </div>

         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Actualizar usuario</button>

         </div>

         <?php

          $editUser = new UsersController();
          $editUser->ctrUpdateUser();

          ?>

       </form>
     </div>
   </div>
 </div>

 <?php

  $deleteUser = new UsersController();
  $deleteUser->ctrDeleteUser();

  ?>