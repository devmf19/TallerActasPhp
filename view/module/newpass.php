<div class="login-box">
    <div class="login-logo" style="color: fff;">
        <h1 style="color: aliceblue;"><b>Actas</b> Unicor</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Nueva contraseña</p>

        <form method="post">
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Ingrese su nueva contraseña" name="rec_password" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar contraseña</button>
                </div>
                <?php
                $recover = UserController::newPassword();
                ?>
            </div>
        </form>
        </div>

    </div>
</div>