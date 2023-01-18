 <div class="content-wrapper">

   <section class="content-header">

     <h1>
       Administrar ventas
     </h1>

   </section>

   <section class="content">
     <div class="box">

       <div class="box-header with-border">
        
        <a href="sell">
          <button class="btn btn-primary">
            Nueva venta
          </button>
        </a>

       </div>
       
       <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">
         
        <thead>
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Total</th> 
           <th>Fecha</th>
           <th>Acciones</th>
                  
         </tr> 
        </thead>

        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){
            $initialDate = $_GET["fechaInicial"];
            $endDate = $_GET["fechaFinal"];
          }else{
            $initialDate = null;
            $endDate = null;
          }

          $rta = SalesController::ctrSalesDateRange($initialDate, $endDate);

          foreach ($rta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>
                  <td>'.$value["cod_factura"].'</td>';

                  $column = "id";
                  $valueC = $value["idcliente"];
                  $customer = CustomersController::ctrShowCustomer($column, $valueC);
                  echo '<td>'.$customer["nombre"].'</td>';

                  $valueC = $value["idusuario"];
                  $user = UsersController::ctrShowUser($column, $valueC);
                  echo '<td>'.$user["nombre"].'</td>

                  <td>$ '.number_format($value["total_venta"],2).'</td>
                  <td>'.$value["fecha_hora"].'</td>

                  <td>
                    <div class="btn-group">';

                      if($_SESSION["rol"] == "Administrador"){

                      echo '<a href="index.php?route=seeSale&cod_factura='.$value["cod_factura"].'"><button class="btn btn-info" ><i class="fa fa-eye"></i></button></a>
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