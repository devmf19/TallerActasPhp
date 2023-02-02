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

                <!-- <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.</p> -->
              </div>
         <?php
          } else {
          ?>
          <div class="callout callout-info">
                <h4>Bienvenido, usted tiene rol de INFORMES</h4>

                <!-- <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.</p> -->
              </div>
              <?php
          }
          ?>
       </div>

       <div class="row">

         <div class="col-lg-12">
           <?php
            // if($_SESSION["rol"] =="Administrador"){

            //  include "home/entrysTable.php";

            // }
            ?>
         </div>

       </div>

     </div>
   </section>

 </div>