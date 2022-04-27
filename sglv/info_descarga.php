<main id="main">
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="text-center rounded col-md-12">
					<h2 class="title">Información sobre Descargas</h2>

					<div class="table-responsive">
						<!--<table class="table borderless display" id="tablaEstado">-->
						<table class="table table-striped table-bordered dt-responsive nowrap" id="tablaEstado">
							<thead>
								<tr class="row-active">
									<th scope="col">Fecha</th>
									<th scope="col">Archivo</th>
									<th scope="col">Email</th>
									<th scope="col">Nombre</th>
									<th scope="col">Organismo</th>
									<th scope="col">Pais</th>
								</tr>
							</thead>

							<tbody>
								<?php
								include_once('entity/descargaFile.php');
								$descarga = new descargaFile();
								$resultado = $descarga->read();

								foreach ($resultado as $reg) {
									$fecha = new DateTime($reg['fecha']);
									//$fecha = $fecha->format("d/m/Y"); 
									$fecha = $fecha->format("Y/m/d");
								?>
									<tr>
										<td class="row-transparente"><?php echo ($fecha) ?></td>
										<!--<td class="row-transparente"><?php echo ($reg['fecha']) ?></td>-->
										<td class="row-transparente"><?php echo ($reg['descri']) ?></td>
										<td class="row-transparente"><?php echo ($reg['email']) ?></td>
										<td class="row-transparente"><?php echo ($reg['nombre']) ?></td>
										<td class="row-transparente"><?php echo ($reg['organismo']) ?></td>
										<td class="row-transparente"><?php echo ($reg['pais']) ?></td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<script type="text/javascript">
	$(document).ready(function() {
		$("#tablaEstado").DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
			},
			dom: 'Bfrtip',
			buttons: [
				'csv', 'excel', 'pdf', 'print' //, 'colvis'
			]
		});
	});

	//$(document).ready(function() {
	//	$('#tablaEstado').DataTable({
	//		"ordering": false, // deshabilitamos el orden para la 1er columna
	//		"language": {
	//			"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
	//		} // se utiliza para que las palabras externas al tabla sean en españos
	//		  // ej: Mostrar ... registro
	//	});
	//});
</script>