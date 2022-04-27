<!-- Modal -->
<div class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
	<div class="modal-dialog" role="document">>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Pista</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form id="form_Pista" class="form-horizontal" role="form">
					<div class="form-row form-group">
						<!--/here teh addclass has-error will appear -->
						<label for="nombre" class="col-md-3 control-label">Nombre:</label>
						<div class="col-md-9">
							<input type="text" name="nombre" id="nombre" class='form-control' required>
							<!-- here the text will apper  -->
						</div>
					</div>

					<div class="form-row form-group">
						<!--/here teh addclass has-error will appear -->
						<label class="col-md-3 control-label">Ubicacion:</label>
						<div class="col-md-9">
							<input type="text" name="ubicacion" id="ubicacion" class='form-control'>
							<!-- here the text will apper  -->
						</div>
					</div>

					<div class="form-row form-group">
						<label class="col-md-3 control-label">Superficie:</label>
						<div class="col-md-9">
							<select class="col-md-12" name="superficie" id="superficie">

								<?php
								include_once('entity/superficie.php');
								$superficie = new Superficie();
								$resultado = $superficie->read();
								$first = true;
								foreach ($resultado as $reg) {
									$idSup = $reg['ID'];
									$descri = $reg['descripcion'];
									if ($first) {
										$first = false;
										echo '<option value="' . $idSup . '" selected >' . $descri . '</option>';
									} else {
										echo '<option value="' . $idSup . '" >' . $descri . '</option>';
									}
								}
								?>
							</select>
						</div>
					</div>

					<div class="modal-footer form-group">
						<button type="submit" class="btn btn-success">Guardar datos</button>
						<button type="button" class="btn btn-info add-new" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-arrow-left"></i> Regresar
						</button>
					</div>
				</form>

				<div id="error" class="messages"></div>
			</div>
		</div>
	</div>
</div>