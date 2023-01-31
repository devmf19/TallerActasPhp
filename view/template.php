<?php
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Actas Unicor</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- ---------------------------------------------------------------- -->
    <!-- ------------------------- CSS PLUGINS -------------------------- -->
    <!-- ---------------------------------------------------------------- -->

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="view/dist/css/AdminLTE.css">

    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="view/dist/css/skins/_all-skins.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- DataTables -->
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="view/bower_components/select2/dist/css/select2.min.css">

       <!-- Daterange picker -->
    <link rel="stylesheet" href="view/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Morris chart -->
    <link rel="stylesheet" href="view/bower_components/morris.js/morris.css">

    <!-- ---------------------------------------------------------------- -->
    <!-- ---------------------- JAVASCRIPT PLUGINS ---------------------- -->
    <!-- ---------------------------------------------------------------- -->

    <!-- jQuery 3 -->
    <script src="view/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- FastClick -->
    <script src="view/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script src="view/dist/js/adminlte.min.js"></script>

    <!-- DataTables -->
    <script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!-- Select2 -->
    <script src="view/bower_components/select2/dist/js/select2.full.min.js"></script>

    <!-- SweetAlert 2 -->
    <script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>
    
    
    <script src="view/plugins/jqueryNumber/jquerynumber.min.js"></script>

    <!-- daterangepicker http://www.daterangepicker.com/-->
    <script src="view/bower_components/moment/min/moment.min.js"></script>
    <script src="view/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
    <script src="view/bower_components/raphael/raphael.min.js"></script>
    <script src="view/bower_components/morris.js/morris.min.js"></script>

    <!-- ChartJS http://www.chartjs.org/-->
    <script src="view/bower_components/Chart.js/Chart.js"></script>
    
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="view/dist/js/demo.js"></script> -->
</head>

<!-- ---------------------------------------------------------------- -->
<!-- -------------------------------- BODY -------------------------- -->
<!-- ---------------------------------------------------------------- -->

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        
        <?php
        if (
            isset($_SESSION['login']) &&
            $_SESSION['login'] == 1
        ) {
            echo ('<div class="wrapper">');

            // MODULO HEADER
            include "module/header.php";

            // MODULO MENU
            include "module/menu.php";

            // VALIDACION DE RUTAS PERMITIDAS
            if (isset($_GET["route"])) {
                $route  = $_GET["route"];
                if (
                    $route == "home" ||
                    $route == "reports" ||
                    $route == "actas" ||
                    $route == "commitments" ||
                    $route == "assistants" ||
                    $route == "users" ||
                    $route == "signup" ||
                    $route == "login" ||
                    $route == "logout"
                ) {
                    include "module/" . $route . ".php";
                } else {
                    include "module/404.php";
                }
            } else {
                include "module/home.php";
            }

            //FOOTER
            include "module/footer.php";

            echo ('</div>');
        } else {
            if (isset($_GET["route"])){
                $route  = $_GET["route"];
                if (
                    $route == "recover" ||
                    $route == "newpass" ||
                    $route == "signup" ||
                    $route == "login"
                ) {
                    include "module/" . $route . ".php";
                } else {
                    include 'module/login.php';
                }
            } else {
                include 'module/login.php';
            }

        }
        ?>

    </div>

    <script src="view/js/template.js"></script>
    <script src="view/js/login.js"></script>
    <script src="view/js/reports.js"></script>
    <script src="view/js/users.js"></script>
    <script src="view/js/actas.js"></script>
    <script src="view/js/assistants.js"></script>

</body>

</html>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
</script>