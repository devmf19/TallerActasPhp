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
                <select class="form-control input-lg" id="new_tipoid" name="new_tipoid" required>
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
                <input type="hidden" name="option" id="option" value="signup" required>

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
                <div class="col-xs-12">
                    <button type="button" class="btn btn-primary btn-block btn-flat" onclick="createUser()">Registrarme</button>
                </div>
                
            </div>
            <br>
            <a href="login">Ya tengo una cuenta</a>
        </form>
        </div>

    </div>
</div>