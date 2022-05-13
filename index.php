<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
	<?php include("menu-index.html"); ?>

	<!--==========================
    Hero Section (Imagen del menú)
	============================-->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<section id="hero" style="background: url(assets/hero/index.jpg) top center; background-size: cover; height: 70vh;">
					<div class="hero-container">
						<h1>Imae</h1>
						<h2>Facultad de Ciencias Exactas Ingeniería y Agrimensura</h2>
						<h2>Universidad Nacional de Rosario</h2>
					</div>
				</section>
			</div>
			<div class="carousel-item">
				<section id="hero" style="background: url(assets/hero/curso.jpg) top center; background-size: cover; height: 70vh;">
					<div class="hero-container">
						<h1>Imae</h1>
						<h2>Facultad de Ciencias Exactas Ingeniería y Agrimensura</h2>
						<h2>Universidad Nacional de Rosario</h2>
					</div>
				</section>
			</div>

			<div class="carousel-item">
				<section id="hero" style="background: url(assets/hero/personal.jpg) top center; 	background-size: cover; height: 70vh;">
					<div class="hero-container">
						<h1>Nuestro Equipo</h1>
						<h2>Facultad de Ciencias Exactas Ingeniería y Agrimensura</h2>
						<h2>Universidad Nacional de Rosario</h2>
					</div>
				</section>
			</div>
		</div>
	</div>

	<?php include("inicio/inicio.html"); ?>

	<?php include("footer.html"); ?>
</body>

<?php include("inicio/modal.php"); ?>

</html>