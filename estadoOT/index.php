<main id="main">
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="text-center rounded col-md-12">
					<h2 class="title">Estados de Ordenes de Trabajo</h2>


					<div class="col-sm-2">
						<a href="sglv_estadoOT.php?frm=create_est" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nuevo Estado</a>
					</div>
					<br>

					<div class="table-responsive">
						<table class="table borderless display" id="tablaEstado">
							<thead>
								<tr class="row-active">
									<th scope="col">Nro.</th>
									<th scope="col">Descripción</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>

							<tbody>
								<?php
								include_once('entity/estadosOT.php');
								$ot = new Estado();
								$resultado = $ot->read();

								$i = 0;
								foreach ($resultado as $reg) {
									$descri = $reg['descri'];
									$idEstado = $reg['ID'];
									$i++;

								?>
									<input type="hidden" id="IDEstado" value="<?php echo ($idEstado); ?>" />
									<tr>
										<td class="row-transparente"><?php echo ($i) ?></td>
										<td class="row-transparente"><?php echo ($descri) ?></td>
										<td class="row-transparente">
											<a href="sglv_estadoOT.php?frm=update&id=<?php echo $idEstado; ?>" class="edit" title="Editar" data-toggle="tooltip">
												<i class="fa fa-pencil fa-lg">
												</i>
											</a>
											<a href="sglv_estadoOT.php?frm=delete&id=<?php echo $idEstado; ?>" class="delete" title="Eliminar" data-toggle="tooltip">
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
		$('#tablaEstado').DataTable({
			"ordering": false, // false to disable sorting (or any other option)
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			}
		});
	});
</script>