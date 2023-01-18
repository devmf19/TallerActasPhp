<div>
  <h3>Registro de ingreso de productos</h3>
</div>

<div>
  <table class="table table-bordered table-striped dt-responsive tabla" width="100%">
         
    <thead>
      <tr>
        
        <th style="width:10px">#</th>
        <th>Código</th>
        <th>Proveedor</th>
        <th>Receptor</th>
        <th>Total</th> 
        <th>Fecha</th>
        <th>Acciones</th>
  
      </tr> 
    </thead>
  
    <tbody>
  
    <?php
  
      $rta = EntryController::ctrShowEntry(null, null);
  
      foreach ($rta as $key => $value) {
        
        echo '<tr>
  
              <td>'.($key+1).'</td>
              <td>'.$value["cod_factura"].'</td>';
  
              $column = "id";
              $valueC = $value["idproveedor"];
              $customer = ProvidersController::ctrShowProvider($column, $valueC);
              echo '<td>'.$customer["nombre"].'</td>';
  
              $valueC = $value["idusuario"];
              $user = UsersController::ctrShowUser($column, $valueC);
              echo '<td>'.$user["nombre"].'</td>
  
              <td>$ '.number_format($value["total_compra"],2).'</td>
              <td>'.$value["fecha_hora"].'</td>
  
              <td>
                <div class="btn-group">';
  
                if($_SESSION["rol"] == "Administrador"){

                  echo '<a href="index.php?route=seeEntry&cod_factura='.$value["cod_factura"].'"><button class="btn btn-info" ><i class="fa fa-eye"></i></button></a>
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


