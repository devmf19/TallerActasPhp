 <div class="content-wrapper">

   <section class="content-header">

     <h1>
       Realizar venta
     </h1>

   </section>

   <section class="content">
    <div class="row">

      <div class="col-lg-5 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border"></div>

            <form role="form" method="post" class="formularioVenta">

              <div class="box-body">
    
                <div class="box">

                  <!--=====================================
                  ENTRADA DEL VENDEDOR
                  ======================================-->
              
                  <div class="form-group">
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="text" class="form-control" id="nuevoUsuarioSesion" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                      <input type="hidden" name="idUsuarioSesion" value="<?php echo $_SESSION["id"]; ?>">

                    </div>
                  </div> 

                  <!--=====================================
                  ENTRADA DEL CÓDIGO DE FACTURA
                  ======================================--> 

                  <div class="form-group">
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <?php

                      $item = null;
                      $valor = null;
                      $venta = SalesController::ctrShowSale($item, $valor);

                      if(!$venta){
                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                      } else {
                        foreach ($venta as $key => $value) {
                          // REORRIDO EN BLANO
                        }

                        
                        $codigo = $value["cod_factura"] + 1;
                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                      }

                      ?>
                    </div>
                  </div>

                  <!--=====================================
                  ENTRADA DEL CLIENTE
                  ======================================--> 

                  <div class="form-group">
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                          <option value="">Seleccionar cliente</option>
                          <?php

                          $column = null;
                          $valueT = null;
                          $customer = CustomersController::ctrShowCustomer($column, $valueT);

                          foreach ($customer as $key => $value) {
                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }

                          ?>
                      </select>
                      
                    </div>
                  </div>
                  
                  
                  <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
                  ======================================--> 

                  <div class="form-group row">
                    <div class="row" style="padding:10px 15px">
                
                      <div class="col-xs-6" style="padding-right:0px; ">
                        <b>Opción | Producto</b>
                      </div>

                      <div class="col-xs-3" style="padding-right:0px;">
                        <b>Cantidad</b>
                      </div>

                      <div class="col-xs-3" style="padding-right:0px;">
                        <b>Subtotal</b>
                      </div>

                    </div>
                  </div>

                  <div class="form-group row nuevoProducto">

                          

                  </div>

                  <input type="hidden" id="listaProductos2" name="listaProductos2">

                  <!--=====================================
                  BOTÓN PARA AGREGAR PRODUCTO
                  ======================================-->

                  <!-- <button type="button" class="btn btn-success btnAgregarProducto" data-toggle="modal" data-target="#modalCreateProduct">Nuevo producto</button> -->

                  <hr>

                  <div class="row">

                    <!--=====================================
                    ENTRADA  TOTAL
                    ======================================-->
                    
                    <div class="col-xs-8 pull-right">
                      <table class="table">

                        <thead>
                          <tr>
                            <th>Total</th>      
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td >
                              <div class="input-group">
                            
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="0" placeholder="00000" readonly required>
                                <input type="hidden" name="totalVenta" id="totalVenta">
                          
                              </div>
                            </td>
                          </tr>
                        </tbody>

                      </table>
                    </div>

                  </div>
        
                </div>

              </div>

              <div class="box-footer">

                  <button type="submit" class="btn btn-primary pull-right">Realizar venta</button>

              </div>

            </form>

          <?php

             $guardarVenta = new SalesController();
             $guardarVenta->ctrCreateSale();
            
          ?>

          </div>
      </div>

      <!--lista de productos-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablaProductos3">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Img</th>
                  <th>Cod.</th>
                  <th>Producto</th>
                  <th>Marca</th>
                  <th>Stock</th>
                  <th>Acción</th>
                </tr>

              </thead>

            </table>
          </div>

        </div>
      </div>
    
    </div>
   </section>
 </div>

 
 <script src="view/js/sales.js"></script>