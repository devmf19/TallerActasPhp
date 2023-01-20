<div class="login-box">
    <div class="login-logo" style="color: fff;">
        <h1 style="color: aliceblue;"><b>Actas</b> Unicor</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Ingresar al sistema</p>

        <form action="home" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="username" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <a href="signup"><button type="button" class="btn btn-primary btn-block btn-flat" id="btnSignup">Registrarme</button></a>
                </div>
                <div class="col-xs-4">
                    <a href="recover"><button type="button" class="btn btn-primary btn-block btn-flat" id="btnSignup">Recuperar</button></a>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
                <?php
                    $login = new UsersAjax();
                ?>
            </div>
        </form>
        </div>

    </div>
</div>