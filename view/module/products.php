 <div class="content-wrapper">

   <section class="content-header">

     <h1>
       Administrar productos
     </h1>

   </section>

   <!-- Contenido principal -->
   <section class="content">

     <div class="box">

       <div class="box-header with-border">

         <a href="new-entry">
           <button class="btn btn-primary">
            Nuevo ingreso
           </button>
         </a>
         
           <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateProduct">
            Nuevo producto
           </button>

       </div>

       <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablaProductos">

            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Desripción</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>P. Compra</th>
                <th>P. Venta</th>
                <th>Opciones</th>
              </tr>
            </thead>
          </table>
          <input type="hidden" value="<?php echo $_SESSION['rol']; ?>" id="rolOculto">
        </div>
     </div>

   </section>
 </div>

 <!--=====================================
MODAL NUEVO PRODUCTO
======================================-->

<div id="modalCreateProduct" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Nuevo producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg"  name="nuevoIdCategoria" required>
                <option value="">Seleccionar categoría</option>
                <?php

                  $category = CategoriesController::ctrShowCategory(null, null);
                  foreach ($category as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }
                  
                ?>
              </select>

              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR MARCA -->

            <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg"  name="nuevoIdMarca" required>
                <option value="">Seleccionar marca</option>
                <?php

                  $brand = BrandsController::ctrShowBrand(null, null);
                  foreach ($brand as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }
                  
                ?>
              </select>

              </div>
            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoCodigoProducto" name="nuevoCodigoProducto" placeholder="Ingrese el código del nuevo producto" required>

              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoProducto" name="nuevoProducto" placeholder="Ingrese el nombre del nuevo producto" required>

              </div>
            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg"  name="nuevoDesripcionProducto" placeholder="Ingrese la desripción del nuevo producto">

              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              <div class="panel">Subir foto del producto</div>

              <input type="file" class="nuevaImagen" name="nuevaImagenProducto">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="view/img/products/default/default-product.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Registrar producto</button>

        </div>

      </form>

        <?php

          $editarProducto = new ProductsController();
          $editarProducto -> ctrCreateProduct();

        ?>      

    </div>

  </div>

</div> 



 <!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalUpdateProduct" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg"  name="editarCategoria" required>
                <option id="editarCategoria"></option>
                <?php

                  $category = CategoriesController::ctrShowCategory(null, null);
                  foreach ($category as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }
                  
                ?>
              </select>

              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR MARCA -->

            <div class="form-group">
              <div class="input-group">
                
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 
              <select class="form-control input-lg"  name="editarMarca" required>
                <option id="editarMarca"></option>
                <?php

                  $brand = BrandsController::ctrShowBrand(null, null);
                  foreach ($brand as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }
                  
                ?>
              </select>

              </div>
            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigoProducto" readonly required>
                <input type="hidden" id="idProducto" name="idProducto" >

              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" id="editarProducto" name="editarProducto" required>

              </div>
            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion">

              </div>
            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>
            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6">
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                  </div>
                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 
                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" required>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              <div class="panel">Subir foto del producto</div>

              <input type="file" class="nuevaImagen" name="editarImagenProducto">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="view/img/products/default/default-product.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Guardar cambios</button>

        </div>

      </form>

        <?php

          $editarProducto = new ProductsController();
          $editarProducto -> ctrUpdateProduct();

        ?>      

    </div>

  </div>

</div> 