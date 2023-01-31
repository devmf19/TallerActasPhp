<div class="login-box">
    <div class="login-logo" style="color: fff;">
        <h1 style="color: aliceblue;"><b>Actas</b> Unicor</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Ingresar al sistema</p>

        <form method="post" id="loginForm">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="username" id="username" required>
                <input type="hidden" name="option" id="option" value="login" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-primary btn-block btn-flat" id="btnLoginn">Iniciar sesión</button>
                </div>
                <?php
                    // require_once "ajax/usersAjax.php";
                    $login = new UsersAjax();
                ?>
            </div>
            <br>
            <a href="recover">Olvidé mi contraseña</a>
            <br>
            <a href="signup" class="text-center">Registrarme</a>
        </form>

    </div>

</div>
</div>