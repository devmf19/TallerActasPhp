 <div class="content-wrapper">

   <section class="content-header">

     <h1>
       Administrar categorias
     </h1>

   </section>

   <!-- Contenido principal -->
   <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCategory">
          Registrar categoria
        </button>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Categoria</th>
              <th>Detalle</th>
              <th>Opciones</th>
            </tr>
          </thead>

          <tbody>
        
          <?php

          $column = null;
          $value = null;

          $categories = CategoriesController::ctrShowCategory($column, $value);

          foreach($categories as $key => $data) {

            echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$data["nombre"].'</td>
                  <td>'.$data["detalle"].'</td>
                  <td>
                    <div class="btn-toolbar">';
                    if($_SESSION["rol"] == "Administrador"){

                      echo '<div class="btn-group">
                              <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateCategory"><i class="fa fa-pencil"></i></button>
                            </div>  
                            <div class="btn-group">
                              <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$data["id"].'"><i class="fa fa-times"></i></button>
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

   </section>
 </div>

  <!-- ---------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ------------------ MODAL CREAR CATEGORIA ------------------ -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalCreateCategory" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--CABEZA DEL MODAL-->
         <div class="modal-header" style="background:#3c8dbc; color:white">

           <h4 class="modal-title">Registrar categoria</h4>

         </div>

         <!--CUERPO DEL MODAL-->
         <div class="modal-body">
           <div class="box-body">

             <!-- campo para ingresar el nombre -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar el nombre de la categoria" id="nuevaCategoria" required>

               </div>
             </div>

             <!-- campo para ingresar el detalle -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                 <input type="text" class="form-control input-lg" name="nuevoDetalleCategoria" placeholder="Describa brevemente">

               </div>
             </div>
           </div>
         </div>

         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Registrar categoria</button>
           <?php

            $createCategory = new CategoriesController;
            $createCategory->ctrCreateCategory();

            ?>
         </div>
       </form>
     </div>
   </div>
 </div>

 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ---------------- MODAL ACTUALIZAR CATEGORIA --------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalUpdateCategory" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--CABEZA DEL MODAL-->
         <div class="modal-header" style="background:#3c8dbc; color:white">

           <h4 class="modal-title">Actualizar categoria</h4>

         </div>

         <!--CUERPO DEL MODAL-->
         <div class="modal-body">
           <div class="box-body">

             <!-- campo para ingresar el nombre -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="hidden"  name="idCategoria" id="idCategoria" required>
                 <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" value="" required>

               </div>
             </div>

             <!-- campo para ingresar el detalle-->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                 <input type="text" class="form-control input-lg" id="editarDetalleCategoria" name="editarDetalleCategoria" value="">

               </div>
             </div>

           </div>
         </div>

         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Actualizar categoria</button>

         </div>

         <?php

          $editCategory = new CategoriesController;
          $editCategory->ctrUpdateCategory();

          ?>

       </form>
     </div>
   </div>
 </div>

 <?php

  $deleteCategory = new CategoriesController;
  $deleteCategory->ctrDeleteCategory();

  ?>