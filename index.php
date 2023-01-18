<?php
session_start();

require_once "controller/templateController.php";
require_once "controller/actaController.php";
require_once "controller/assistantController.php";
require_once "controller/commitmentController.php";
require_once "controller/userController.php";

require_once "model/acta.php";
require_once "model/assistants.php";
require_once "model/commitment.php";
require_once "model/user.php";

require_once "ajax/usersAjax.php";



$template = new TemplateController();

// se llama el metodo encargado de invocar la plantilla
$template->template();

