<div class="login-box">
    <div class="login-logo" style="color: fff;">
        <h1 style="color: aliceblue;"><b>Actas</b> Unicor</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Recuperar cuenta</p>

        <form method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Correo asociado a su cuenta" name="rec_email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Recuperar cuenta</button>
                </div>
                <?php
                $recover = UserController::recover();
                ?>
            </div>
        </form>
        </div>

    </div>
</div>