<header class="main-header">
    <!-- LOGO -->
    <a href="home" class="logo">

        <!-- logo mini -->
        <span class="logo-mini"><b>Uni</b>cor</span>

        <!-- logo normal -->
        <span class="logo-lg"><b>Actas</b> Unicor</span>

    </a>

    <!-- BARRA DE NAVEGAION -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- boton de navegaion -->
        <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- perfil de usuario -->
        <div class="navbar-custom-menu">

            <ul class="nav narvbar-nav">
                <li class="dropdown user user-menu" >
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <span ><?php echo $_SESSION["name"] ?></span>
                    </a>

                    <!-- dropdown -->
                    <ul class="dropdown-menu" style="margin: 5px -35px;">
                            <div>
                                <a href="logout" class="btn btn-danger btn-flat" style="margin: 5px 10px;">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>



    </nav>

</header>