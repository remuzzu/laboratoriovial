<!-- Modal -->
<div class="modal fade" id="addPista" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
	<div class="modal-dialog" role="document">>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Agregar Pista/Tramo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form>
					<div class="mb-3">
						<label class="form-label">Nombre del tramo/Nro. de pista</label>
						<input type="text" class="form-control" id="pista" name="pista" placeholder="Nombre de Tramo/Nro. Pista" />
					</div>
					<div class="mb-3">
						<label class="form-label">Información adicional</label>
						<input type="text" class="form-control" id="descri" name="descri" placeholder="Información adicional" />
					</div>

					<div class="modal-footer form-group">
						<button type="submit" class="btn btn-success">Guardar datos</button>
						<button type="button" class="btn btn-info add-new" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-arrow-left"></i> Regresar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>