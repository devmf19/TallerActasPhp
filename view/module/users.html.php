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
               <th>#</th>
               <th>Nombre</th>
               <th>Usuario</th>
               <th>Rol</th>
               <th>Estado</th>
               <th>Foto</th>
               <th>Opciones</th>
             </tr>
           </thead>

           <tbody>
             <tr>
               <td>#</td>
               <td>Nombre</td>
               <td>Usuario</td>
               <td>Rol</td>
               <td><button class="btn btn-success btn-sm">Activo</button></td>
               <td><img src="view/img/users/default/default-user.png" class="img-circle" style="width: 30px; margin-right: 5px;" alt="foto-de-usuario"></td>
               <td>
                 <div class="btn-toolbar">
                   <div class="btn-group">
                     <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                   </div>
                   <div class="btn-group ">
                     <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                   </div>
                 </div>
               </td>
             </tr>
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
                 <input type="number" class="form-control input-lg" name="nuevaCedula" placeholder="Digite el número de cédula" required>

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
                 <select class="form-control input-lg" name="nuevoPerfil">

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

         </div>

         <?php

          // $crearUsuario = new ControladorUsuarios();
          // $crearUsuario -> ctrCrearUsuario();

          ?>

       </form>

     </div>

   </div>

 </div>