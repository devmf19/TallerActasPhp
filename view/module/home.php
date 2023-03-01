 <div class="content-wrapper">

   <section class="content-header">
     <h1>
       Tablero
       <small>Panel de control</small>
     </h1>
   </section>

   <section class="content">
     <div class="box">

       <div class="box-body">
         <?php

          if ($_SESSION["role"] == 2) {
          ?>
            <div class="callout callout-success">
                <h4>Bienvenido, usted tiene rol de ADMINISTRADOR</h4>
              </div>
         <?php
          } else {
          ?>
          <div class="callout callout-info">
                <h4>Bienvenido, usted tiene rol de INFORMES</h4>

              </div>
              <?php
          }
          ?>
       </div>

       <div class="row">

       </div>

     </div>
   </section>

 </div>