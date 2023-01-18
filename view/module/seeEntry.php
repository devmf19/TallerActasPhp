<div class="content-wrapper">

<section class="content-header">

  <h1>
    Detalle de ingreso
  </h1>

</section>

<section class="content">

  <div class="box">

  <div class="box-header with-border">
   <?php
     $column = "cod_factura";
     $value = $_GET["cod_factura"];
     $entry = EntryController::ctrShowEntry($column, $value);
     
     $column = "id";
     $value = $entry[0]["idproveedor"];
     $provider = ProvidersController::ctrShowProvider($column, $value);

     $column = "id";
     $value = $entry[0]["idusuario"];
     $user = UsersController::ctrShowUser($column, $value);
   ?>
     <p><b>CÓDIGO DE INGRESO:</b> <?php echo $entry[0]["cod_factura"];?></p>
     <p><b>FEHA:</b> <?php echo $entry[0]["fecha_hora"];?></p>
     <p><b>PROVEEDOR:</b> <?php echo $provider["nombre"];?></p>
     <p><b>VENDEDOR:</b> <?php echo $user["nombre"];?></p>
     <p><b>TOTAL:</b> <?php echo $entry[0]["total_compra"];?></p>
   </div>

    <div class="box-body">

     <table class="table table-bordered table-striped dt-responsive tabla">

       <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Producto</th>
           <th>Cantidad</th>
           <th>Precio compra</th>
           <th>Precio venta</th>
           <th>Subtotal</th>
         </tr>
       </thead>

       <tbody>
     
       <?php

       $value = $_GET["cod_factura"];
       $detail = EntryController::ctrSeeEntry($value);

       foreach($detail as $key => $data) {
         $product = ProductsController::ctrShowProduct("id", $data["id_producto"], "id");
         $subtotal = $data["cantidad"] * $data["precio_compra"];

         echo ' <tr>
               <td>'.($key+1).'</td>
               <td>'.$product["nombre"].'</td>
               <td>'.$data["cantidad"].'</td>
               <td>'.$data["precio_compra"].'</td>
               <td>'.$data["precio_venta"].'</td>
               <td>'.$subtotal.'</td>

             </tr>';
       }
       ?>
       </tbody>

     </table>
   </div>
  </div>

</section>
</div>