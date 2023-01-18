 <div class="content-wrapper">

   <section class="content-header">

     <h1>
       Administrar marcas
     </h1>

   </section>

   <!-- Contenido principal -->
   <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateBrand">
          Registrar marca
        </button>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Marca</th>
              <th>Detalle</th>
              <th>Opciones</th>
            </tr>
          </thead>

          <tbody>
        
          <?php

          $column = null;
          $value = null;

          $brands = BrandsController::ctrShowBrand($column, $value);

          foreach($brands as $key => $data) {

            echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$data["nombre"].'</td>
                  <td>'.$data["detalle"].'</td>
                  <td>
                    <div class="btn-toolbar">';
                    if($_SESSION["rol"] == "Administrador"){

                      echo '<div class="btn-group">
                              <button class="btn btn-warning btnEditarMarca" idMarca="'.$data["id"].'" data-toggle="modal" data-target="#modalUpdateBrand"><i class="fa fa-pencil"></i></button>
                            </div>  
                            <div class="btn-group">
                              <button class="btn btn-danger btnEliminarMarca" idMarca="'.$data["id"].'"><i class="fa fa-times"></i></button>
                            </div> 
                      ';
    
                    } 
                      
                    echo ' </div>
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
 <!-- -------------------- MODAL CREAR MARCA -------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalCreateBrand" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--CABEZA DEL MODAL-->
         <div class="modal-header" style="background:#3c8dbc; color:white">

           <h4 class="modal-title">Registrar marca</h4>

         </div>

         <!--CUERPO DEL MODAL-->
         <div class="modal-body">
           <div class="box-body">

             <!-- campo para ingresar el nombre -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar el nombre de la marca" id="nuevaMarca" required>

               </div>
             </div>

             <!-- campo para ingresar el detalle -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                 <input type="text" class="form-control input-lg" name="nuevoDetalleMarca" placeholder="Describa brevemente">

               </div>
             </div>
           </div>
         </div>

         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Registrar marca</button>
           <?php

            $createBrand = new BrandsController();
            $createBrand->ctrCreateBrand();

            ?>
         </div>
       </form>
     </div>
   </div>
 </div>

 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ------------------ MODAL ACTUALIZAR MARCA ----------------- -->
 <!-- ----------------------------------------------------------- -->
 <!-- ----------------------------------------------------------- -->

 <div id="modalUpdateBrand" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--CABEZA DEL MODAL-->
         <div class="modal-header" style="background:#3c8dbc; color:white">

           <h4 class="modal-title">Actualizar marca</h4>

         </div>

         <!--CUERPO DEL MODAL-->
         <div class="modal-body">
           <div class="box-body">

             <!-- campo para ingresar el nombre -->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                 <input type="hidden"  name="idMarca" id="idMarca" required>
                 <input type="text" class="form-control input-lg" id="editarMarca" name="editarMarca" value="" id="editarMarca" required>

               </div>
             </div>

             <!-- campo para ingresar el detalle-->
             <div class="form-group">
               <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                 <input type="text" class="form-control input-lg" id="editarDetalleMarca" name="editarDetalleMarca" value="">

               </div>
             </div>

           </div>
         </div>

         <!--PIE DEL MODAL-->
         <div class="modal-footer">

           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-success">Actualizar marca</button>

         </div>

         <?php

          $editBrand = new BrandsController;
          $editBrand->ctrUpdateBrand();

          ?>

       </form>
     </div>
   </div>
 </div>

 <?php

  $deleteBrand = new BrandsController;
  $deleteBrand->ctrDeleteBrand();

  ?>