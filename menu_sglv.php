<!--==========================
	Header (menú)
	============================-->
<header id="header">
    <div class="container">

        <div id="logo" class="pull-left">
            <!--<a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a>-->
            <!-- Uncomment below if you prefer to use a text logo -->
            <h2><a href="index.php">SGLV</a></h2>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <?php if ($tipo_usuario == 1) { ?>
                    <li><a href='#'>Administrar Usuarios</a></li>
                <?php } ?>

                <li class="menu-has-children"><a href="">Carga de Datos</a>
                    <ul>
                        <?php if ($tipo_usuario == 2 or $tipo_usuario == 1) { ?>
                            <li><a href="sglv_estadoOT.php?frm=index">Estados de OT</a></li>
                            <li><a href="sglv_clientesOT.php?frm=index">Clientes</a></li>
                            <li><a href="sglv_OT.php?frm=index">Orden de Trabajo</a></li>
                        <?php } ?>
                        <?php if ($tipo_usuario == 3 or $tipo_usuario == 1) { ?>
                            <li>
                                <hr>
                            </li>
                            <li><a href="sglv_estadoOT.php?frm=index">Secciones de Inicio</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a href="sglv_clientesOT.php?frm=index">Alta de cursos</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <li class="menu-has-children"><a href="">Pistas</a>
                    <ul>
                        <?php if ($tipo_usuario == 2 or $tipo_usuario == 1) { ?>
                            <li><a href="sglv_general.php?frm=abmPista">Carga de Pistas</a></li>
                        <?php } ?>
                        <?php if ($tipo_usuario == 2 or $tipo_usuario == 1) { ?>
                            <li><a href="sglv_general.php?frm=valoresRefe">Valores de referencia</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <?php if ($tipo_usuario == 1) { ?>
                    <li class="menu-has-children"><a href="">Visualizaciones</a>
                        <ul>
                            <li><a href="sglv_general.php?frm=descargas">Descargas</a></li>
                        </ul>
                    </li>
                <?php } ?>


                <?php if ($tipo_usuario == 1) { ?>
                    <li class="menu-has-children"><a href="">Programador</a>
                        <ul>
                            <li><a href="sglv_programador.php?frm=varchar_to_date">Convert varchar a date de OT</a></li>
                            <li><a href="sglv_programador.php?frm=varchar_to_date_descargas">Convert varchar a date de Descargas</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <li><a href="sglv/closesession.php">Cerrar Sesión</a></li>
            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->