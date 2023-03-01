<?php
$id = "-1";
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    echo '<script>
            window.location = "actas";
        </script>';
}
?>

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            Detalles del acta
        </h1>

    </section>

    <!-- Contenido principal -->
    <section class="content">

        <div class="box  box-solid">

            <div class="box-header with-border">
                <h3 class="box-title">Código: <strong> <?php echo $_GET['id'] ?> </strong></h3>
                <input type="hidden" id="detailsActaId" value="<?php echo $_GET['id'] ?>">
            </div>

            <div class="box-body">

                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true">
                                    Detalles
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="box-body">
                                <div class="row invoice-info">
                                    <div class="col-sm-3 invoice-col">
                                        <address>
                                            <strong>Asunto:</strong><br>
                                            <strong>Creador:</strong><br>
                                            <strong>Fecha:</strong><br>
                                            <strong>Hora de inicio:</strong><br>
                                            <strong>Hora final:</strong><br>
                                            <strong>Responsable</strong><br>
                                            <strong>Orden del día:</strong><br>
                                        </address>
                                    </div>

                                    <div class="col-sm-9 invoice-col">
                                        <address>
                                            <span id="spanIssue"></span><br>
                                            <span id="spanCreator"></span><br>
                                            <span id="spanDate"></span><br>
                                            <span id="spanStart"></span><br>
                                            <span id="spanEnd"></span><br>
                                            <span id="spanInCharge"></span><br>
                                            <span id="spanOrder"></span><br>
                                        </address>
                                    </div>
                                    <br>
                                </div>
                                <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col">
                                        <address>
                                            <strong>Descripción de hechos:</strong><br>
                                            <p id="pFactsDescription"></p>
                                        </address>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true">
                                    Compromisos
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="box-body">
                                <div class="box box-solid">

                                    <div class="box-header with-border">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewCommitment">
                                            Nuevo compromiso
                                        </button>
                                    </div>

                                    <div class="box-body">

                                        <table class="table table-bordered table-striped dt-responsive" id="commitmentsTable">
                                            <thead>
                                                <tr>
                                                    <th style="width:10px">#</th>
                                                    <th>Descripción</th>
                                                    <th>Responsable</th>
                                                    <th>Inicia</th>
                                                    <th>Termina</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true">
                                    Asistentes
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true" style="height: 0px;">
                            <div class="box-body">
                                <div class="box box-solid">

                                    <div class="box-header with-border">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewAssistant">
                                            Nueva asistencia
                                        </button>
                                    </div>

                                    <div class="box-body">

                                        <table class="table table-bordered table-striped dt-responsive" id="assistantsTable">

                                            <thead>
                                                <tr>
                                                    <th style="width:10px">#</th>
                                                    <th>Nombre de asistente</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
</div>



<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ------------------ crear compromiso -------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalNewCommitment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form_new_acta" role="form" method="post" enctype="multipart/form-data">

                <!--modal header-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Nuevo compromiso</h4>
                </div>

                <!--modal body-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- descripcion -->
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                <input type="text" class="form-control input-lg" id="new_description_c" name="new_description_c" placeholder="Descripción del compromiso" required>
                                <input type="hidden" id="new_acta_id_c" name="new_acta_id_c" value="<?php echo ($_GET['id']) ?>" required>

                            </div>
                        </div>

                        <!-- seleccionar responsable -->
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <select class="form-control input-lg" id="new_in_charge_c" name="new_in_charge_c" required>
                                    <option value="">Responsable</option>
                                    <?php
                                    $users = UserController::list();
                                    foreach ($users as $key => $value) {
                                        echo '<option value="' . $value["id"] . '">' . $value["name"] . ' ' . $value["lastname"] . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>



                        <!-- horas de inicio y fin -->
                        <div class="form-group row">

                            <div class="col-xs-6">
                                <div class="input-group">

                                    <span class="input-group-addon">Inicia</span>
                                    <input type="time" class="form-control input-lg" id="new_start_date_c" name="new_start_date_c" min="06:00" max="22:00" required>

                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">

                                    <input type="time" class="form-control input-lg" id="new_end_date_c" name="new_end_date_c" min="06:00" max=22:00" required>
                                    <span class="input-group-addon">Termina</span>

                                </div>
                            </div>


                        </div>


                    </div>
                </div>

                <!--modal footer-->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="createCommitment()">Registrar compromiso</button>
                    <?php

                    // $crateCommitment = new CommitmentController();
                    // $crateCommitment->save();

                    ?>

                </div>
            </form>

        </div>
    </div>
</div>


<!-- ---------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- -------------------- nueva asistencia -------------------- -->
<!-- ----------------------------------------------------------- -->
<!-- ----------------------------------------------------------- -->

<div id="modalNewAssistant" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--body header-->
                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <h4 class="modal-title">Registrar nueva asistencia</h4>

                </div>

                <!--modal body-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- seleccionar asistente -->
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <select class="form-control input-lg" id="new_assistant_id" name="new_assistant_id" required>
                                    <option value="">Asistente</option>
                                    <?php
                                    $users = UserController::list();
                                    foreach ($users as $key => $value) {
                                        echo '<option value="' . $value["id"] . '">' . $value["name"] . ' ' . $value["lastname"] . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="hidden" id="new_acta_id_a" name="new_acta_id_a" value="<?php echo ($_GET['id']) ?>" required>

                            </div>
                        </div>

                    </div>
                </div>

                <!--modal footer-->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="createAssistant()">Registrar asistencia</button>
                    <?php

                    // $createAssistant = new assistantController();
                    // $createAssistant->save();

                    ?>
                </div>
            </form>
        </div>
    </div>
</div>