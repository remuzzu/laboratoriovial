<main id="main">
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="text-center rounded col-md-12">
					<h2 class="title">Clientes</h2>


					<div class="col-sm-2">
						<a href="sglv_clientesOT.php?frm=create_cl" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nuevo Cliente</a>
					</div>
					<br>

					<div class="table-responsive">
						<table class="table borderless display" id="tablaCliente">
							<thead>
								<tr class="row-active">
									<th scope="col">Nro.</th>
									<th scope="col">Razon Social</th>
									<th scope="col">Cuit</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>

							<tbody>
								<?php
								include_once('entity/clientesOT.php');
								$cliente = new Cliente();
								$resultado = $cliente->read();

								$i = 0;
								foreach ($resultado as $reg) {
									$razonSocial = $reg['razonSocial'];
									$idCliente = $reg['ID'];
									$cuit = $reg['cuit'];
									$i++;

								?>
									<input type="hidden" id="IDCliente" value="<?php echo ($idCliente); ?>" />
									<tr>
										<td class="row-transparente"><?php echo ($i) ?></td>
										<td class="row-transparente"><?php echo ($razonSocial) ?></td>
										<td class="row-transparente"><?php echo ($cuit) ?></td>
										<td class="row-transparente">
											<a href="sglv_clientesOT.php?frm=update&id=<?php echo $idCliente; ?>" class="edit" title="Editar" data-toggle="tooltip">
												<i class="fa fa-pencil fa-lg">
												</i>
											</a>
											<a href="sglv_clientesOT.php?frm=delete&id=<?php echo $idCliente; ?>" class="delete" title="Eliminar" data-toggle="tooltip">
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
	$('#tablaCliente').DataTable({
		"ordering": false, // false to disable sorting (or any other option)
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
		}
	});
});
</script>