<div class="login-box">
    <div class="login-logo" style="color: fff;">
        <h1 style="color: aliceblue;"><b>Actas</b> Unicor</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Registrarse</p>

        <form method="post">
            <div class="form-group">
                <div class="input-group">
                    
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <select class="form-control input-lg" id="new_tipoid" name="new_tipoid" readonly required>
                    <option value="">Tipo de identificación</option>
                    <option value="1">Cédula de ciudadanía</option>
                    <option value="2">Tarjeta de identidad</option>
                </select>

                </div>
            </div>

            <div class="form-group">
                <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                <input type="number" class="form-control input-lg" id="new_id" name="new_id"  placeholder="Número de identificación" required>

                </div>
            </div>

            <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="text" class="form-control input-lg" id="new_name" name="new_name"  placeholder="Nombres" required>

             </div>
           </div>

           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="text" class="form-control input-lg" id="new_lastname" name="new_lastname"  placeholder="Apellidos" required>

             </div>
           </div>

           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="email" class="form-control input-lg" id="new_email" name="new_email"  placeholder="Email" required>

             </div>
           </div>

           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="text" class="form-control input-lg" id="new_username" name="new_username"  placeholder="Usuario" required>

             </div>
           </div>

           <div class="form-group">
             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
               <input type="password" class="form-control input-lg" id="new_password" name="new_password"  placeholder="Contraseña" required>

             </div>
           </div>

            <div class="row">
                <div class="col-xs-8">
                    <a href="login"><button type="button" class="btn btn-primary btn-block btn-flat" id="btnLogin">Tengo cuenta</button></a>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
                </div>
                <?php
                    $signup = new UserController();
                    $signup->save();
                ?>
            </div>
        </form>
        </div>

    </div>
</div>