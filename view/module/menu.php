<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">

            <li class="active">
                <a href="home">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <li>
                <a href="reports">
                    <i class="fa fa-home"></i>
                    <span>Informes</span>
                </a>
            </li>

            <?php

            if ($_SESSION["role"] == 2) {
                ?>
                    <li>
                        <a href="actas">
                            <i class="fa fa-th"></i>
                            <span>Actas</span>
                        </a>
                    </li>

                    <li>
                        <a href="users">
                            <i class="fa fa-user"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                <?php 
            }

            ?>

            

        </ul>

    </section>

</aside>