 <div class="content-wrapper">

   <section class="content-header">

     <h1>
       Detalle de venta
     </h1>

   </section>

   <section class="content">

     <div class="box">

     <div class="box-header with-border">
      <?php
        $column = "cod_factura";
        $value = $_GET["cod_factura"];
        $sale = SalesController::ctrShowSale($column, $value);
        
        $column = "id";
        $value = $sale["idcliente"];
        $customer = CustomersController::ctrShowCustomer($column, $value);

        $column = "id";
        $value = $sale["idusuario"];
        $user = UsersController::ctrShowUser($column, $value);
      ?>
        <p><b>Código de factura:</b> <?php echo $sale["cod_factura"];?></p>
        <p><b>Fecha:</b> <?php echo $sale["fecha_hora"];?></p>
        <p><b>Cliente:</b> <?php echo $customer["nombre"];?></p>
        <p><b>Vendedor:</b> <?php echo $user["nombre"];?></p>
        <p><b>Total:</b> <?php echo $sale["total_venta"];?></p>
      </div>

       <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio venta</th>
              <th>Subtotal</th>
              <th>Ganancias</th>
            </tr>
          </thead>

          <tbody>
        
          <?php

          $value = $_GET["cod_factura"];
          $detail = SalesController::ctrSeeSale($value);

          foreach($detail as $key => $data) {
            $product = ProductsController::ctrShowProduct("id", $data["id_producto"], "id");
            $subtotal = $data["cantidad"] * $data["precio_venta"];
            $ganancia = $data["cantidad"] * $data["ganancia"];

            echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$product["nombre"].'</td>
                  <td>'.$data["cantidad"].'</td>
                  <td>'.$data["precio_venta"].'</td>
                  <td>'.$subtotal.'</td>
                  <td>'.$ganancia.'</td>

                </tr>';
          }
          ?>
          </tbody>

        </table>
      </div>
     </div>

   </section>
 </div>