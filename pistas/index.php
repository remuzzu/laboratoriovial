<main id="main">
	<section id="about">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center">
					<!-- Formulario de Busqueda de Datos -->
					<div id="div-form">
						<h2 class="section-heading mb-4">
							<span class="section-heading-lower">
								Datos de Tramos/Pistas
							</span>
						</h2>
						<hr>
						<div class="form-row form-group">
							<label class="col-md-3 control-label">Parámetros:</label>
							<div class="col-md-9">
								<select class="col-md-12" name="parametro" id="parametro">
									<option value="0" selected>Rugosidad</option>
									<option value="1">Textura</option>
									<option value="2">Ahuellamiento</option>
								</select>
							</div>
						</div>

						<div class="form-row form-group">
							<label class="col-md-3 control-label">Pistas:</label>
							<div class="col-md-6">
								<select class="col-md-12" name="pista" id="pista">
									<option value='-1' selected>Todas</option>

									<?php
									include_once('entity/pista.php');
									$pista = new Pista();
									$resultado = $pista->read();

									foreach ($resultado as $reg) {
										$idPista = $reg['ID'];
										$nombre = $reg['nombre'];

										if (isset($estado) and $estado == $idPista) {
											echo '<option value="' . $idPista . '" selected >' . $nombre . '</option>';
										} else {
											echo '<option value="' . $idPista . '">' . $nombre . '</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="col-sm-3">
								<a class="btn btn-info add-new" data-toggle="modal" data-target="#addPista"><i class="fa fa-plus"></i> Pista</a>
							</div>
							<!-- Click on Modal Button -->
						</div>

						<div class="form-row form-group">
							<label class="col-md-3 control-label">Año:</label>
							<div class="col-md-9">
								<select class="col-md-12" name="anio" id="anio">
									<option value="-1" selected>Todos</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<button class="btn btn-success" onclick="traerDatos()"><i class="fa fa-table"></i> Traer datos</button>
							<!--<a href="sglv_OT.php?frm=index" class="btn btn-info add-new"><i class="fa fa-upload"></i> Cargar Valores</a>-->
							<!--<a class="btn btn-info add-new" data-toggle="modal" data-target="#newVR"><i class="fa fa-upload"></i> Cargar Valores</a>-->
							<button class="btn btn-info add-new" onclick="showVR()" data-toggle="tooltip" title="El botón se habilitará cuando seleccione alguna pista en particular" disabled id="buttonVR"><i class="fa fa-upload"></i> Cargar Valores</button>
						</div>
					</div>

					<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
						<span class="glyphicon glyphicon-plus-sign"></span> Add Member
					</button>


					<table id="tableVR" style="display:none;">
					</table>
				</div>
			</div>
		</div>
	</section>
</main>

<?php include("modal_new_pista2.php"); ?>
<?php include("modal_new_VR.php"); ?>
<?php include("modal_prueba.php"); ?>

<table class="table" id="manageMemberTable">                  
	<thead>
		<tr>
			<th>S.no</th>
			<th>Name</th>                                                   
			<th>Address</th>
			<th>Contact</th>                                
			<th>Active</th>
			<th>Option</th>
		</tr>
	</thead>
</table>

<script type="text/javascript" src="js/index.js"></script>

<script>
	$(document).on('change', '#pista', function(event) {
		var pista = document.getElementById("pista").value;
		if (pista == -1) {
			document.getElementById('buttonVR').disabled = true;
			document.getElementById('buttonVR').title = "El botón se habilitará cuando seleccione alguna pista en particular";
		} else {
			document.getElementById('buttonVR').disabled = false;
			document.getElementById('buttonVR').title = "";
		}
	});

	function showVR() {
		var parametro = document.getElementById("parametro").value;
		var IDpista = document.getElementById("pista").value;
		var IDhuella = document.getElementById("huella").value;
		var anio = document.getElementById("anio").value;

		$("#newVR").modal();


		/*
		var id = $(this).val();
		var nombre = $('#nombre' + id).text();
		var identidad = $('#identidad' + id).text();
		var correo = $('#correo' + id).text();
		var producto = $('#id_producto' + id).text();

		
		$('#nombre').val(nombre);
		$('#identidad').val(identidad);
		$('#correo').val(correo);
		$('#id_producto').val(producto);*/
	}

	function traerDatos() {
		//Mostramos los datos que seleccionamos
		var parametro = document.getElementById("parametro").value;
		var IDpista = document.getElementById("pista").value;
		var anio = document.getElementById("anio").value;

		$.ajax({
			type: 'POST',
			url: 'pistas/funciones/demo_file.php',
			data: {
				parametro: parametro,
				IDpista: IDpista,
				anio: anio
			},
			//data: {id: id}, // Opción 1
			//data:'id='+ id, // Opción 2
			dataType: 'json',
			success: function(data) {
				console.log(data);
				//caso 1
				//console.log(data);
				//console.log(data[0].ubicacion);

				//caso 2
				//console.log(data);

				//caso 3
				//var temp = data[0].IDSuperficie;
				//console.log(temp);

				//caso 4
				var strjson = JSON.stringify(data);
				var jsonParse = JSON.parse(strjson);

				//console.log(strjson);
				//console.log(jsonParse);

				$("#tableVR").show();
				$("#tableVR").empty();
				$('#tableVR').append(
					'<thead>' +
					'<tr class="row-active">' +
					'<th scope="col">N° Pista</th>' +
					'<th scope="col">Ubicación</th>' +
					'<th scope="col">Superficie</th>' +
					'<th scope="col">Acciones</th>' +
					'</tr>' +
					'</thead>');

				$i = 0;
				for (row in strjson) {

					$('#tableVR').append(
						'<tr>' +
						'<td>' + data[$i].nombre + '</td>' +
						'<td>' + data[$i].ubicacion + '</td>' +
						'<td>' + data[$i].descripcion + '</td>' +
						'<td><a href="sglv_OT.php?frm=update&id=' + data[$i].ID +
						'" class="edit" title="Editar" data-toggle="tooltip">' +
						'<i class="fa fa-pencil fa-lg"></i>' +
						'</a>' +
						'<a href="sglv_OT.php?frm=delete&id=' + data[$i].ID +
						'" class="delete" title="Eliminar" data-toggle="tooltip">' +
						'<i class="fa fa-trash fa-lg"></i>' +
						'</a>' +
						'</td>' +
						'</tr>');
					$i++;
				}

			}
		});
	};

	/*
	EL MÁS IMPORTANTE!!!
	https://www.youtube.com/watch?v=VFLja08YEfg

	https://codersfolder.com/2016/07/crud-with-php-mysqli-bootstrap-datatables-jquery-plugin/
	*/
</script>