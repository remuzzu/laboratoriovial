<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
    <?php include("menu.html"); ?>
    
    <!--==========================
    Hero Section (Imagen del menú)
	============================-->
	<section id="hero" style="background: url(assets/img/ensayos.jpg) top center; 
		background-size: cover; height: 70vh;">
		<div class="hero-container">
            <h1>Sistema de Gerenciamiento<br>del Laboratorio Vial</h1>
		</div>
    </section><!-- #hero -->

    <?php include("sglv/recupera.php"); ?>
    
    <?php include("footer.html"); ?>
</body>

</html>