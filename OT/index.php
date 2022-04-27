<main id="main">
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="text-center rounded col-md-12">
					<h2 class="title">Ordenes de Trabajo</h2>


					<div class="col-sm-2">
						<a href="sglv_OT.php?frm=create" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nueva OT</a>
					</div>
					<br>

					<div class="table-responsive">
						<!--<table class="table borderless display" id="tablaEstado">-->
						<table class="table table-striped table-bordered dt-responsive nowrap display" id="tablaEstado">
							<thead>
								<tr class="row-active">
									<th scope="col">N° OT</th>
									<th scope="col">Presupuesto N°</th>
									<th scope="col">Fecha Alta</th>
									<th scope="col">Cliente</th>
									<th scope="col">Descripción Trabajo</th>
									<th scope="col">Detalle Trabajo</th>
									<th scope="col">Importe</th>
									<th scope="col">Estado</th>
									<th scope="col">Responsable a cargo</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>

							<tbody>
								<?php
								include_once('entity/OT.php');
								$ot = new ordenTrabajo();
								$resultado = $ot->read();

								$i = 0;
								foreach ($resultado as $reg) {
									$idOT = $reg['ID'];
									$cliente = $reg['razonSocial'];
									$estado = $reg['descriEstado'];

									$fechaAlta = new DateTime($reg['fechaAlta']);
									//$fechaAlta = $fechaAlta->format("d/m/Y"); 
									$fechaAlta = $fechaAlta->format("Y/m/d");

									$i++;

								?>
									<input type="hidden" id="idOT" value="<?php echo ($idOT); ?>" />
									<tr>
										<td class="row-transparente"><?php echo ($reg['nroOT']) ?></td>
										<td class="row-transparente"><?php echo ($reg['nroPresu']) ?></td>
										<td class="row-transparente"><?php echo ($fechaAlta) ?>
										<td class="row-transparente"><?php echo ($cliente) ?></td>
										<td class="row-transparente"><?php echo ($reg['descri']) ?></td>
										<td class="row-transparente"><?php echo ($reg['detalle']) ?></td>
										<td class="row-transparente"><?php echo ($reg['importe']) ?></td>
										<td class="row-transparente"><?php echo ($estado) ?></td>
										<td class="row-transparente"><?php echo ($reg['responsable']) ?></td>

										<td class="row-transparente">
											<a href="sglv_OT.php?frm=update&id=<?php echo $idOT; ?>" class="edit" title="Editar" data-toggle="tooltip">
												<i class="fa fa-pencil fa-lg">
												</i>
											</a>
											<a href="sglv_OT.php?frm=delete&id=<?php echo $idOT; ?>" class="delete" title="Eliminar" data-toggle="tooltip">
												<i class="fa fa-trash fa-lg">
												</i>
											</a>
										</td>
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
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
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