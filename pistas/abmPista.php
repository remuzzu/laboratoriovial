<?php
require "entity/pista.php";
?>

<main id="main">
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="text-center rounded col-md-12">
					<h2 class="title">Tramos/Pistas</h2>

					<!--<a href="sglv_general.php?frm=createPista" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nueva Pista</a>-->

					<div class="col-sm-2">
						<button class="btn btn-info add-new" data-toggle="modal" data-target="#addPista" id="addPistaModalBtn">
							<i class="fa fa-plus"></i> Nueva Pista
						</button>
					</div>
					<br>

					<div class="table-responsive">
						<table class="table table-striped table-bordered dt-responsive nowrap display" id="tablaPista">
							<thead>
								<tr class="row-active">
									<th scope="col" class="idPista">ID</th>
									<th scope="col">N° Pista</th>
									<th scope="col">Ubicación</th>
									<th scope="col">Superficie</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<!-- Usuamos el mismo modal para CReate Update Delete (CRUD) -->
<?php include("modal_CRUD_pista.php"); ?>

<script type="text/javascript">
	$(document).ready(function() {
		var idPista, opcion;
		var fila; //captura la fila, para editar o eliminar

		tablaPista = $('#tablaPista').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			dom: 'Bfrtip',
			buttons: [
				'csv', 'excel', 'pdf', 'print' //, 'colvis'
			],
			"ajax": {
				"url": "pistas/funciones/showPista.php",
				"method": 'POST',
				"dataSrc": ""
			},
			"columns": [{
					"data": "ID" //, "visible": false
				},
				{
					"data": "nombre"
				},
				{
					"data": "ubicacion"
				},
				{
					"data": "descripcion"
				},
				{
					"defaultContent": "<div class='text-center'>" +
						"<div class='btn-group'>" +
						"<button class='btn btn-primary btn-sm btnEditar'>" +
						"<i class='fa fa-pencil fa-lg'></i>" +
						"</button>" +
						"<button class='btn btn-danger btn-sm btnBorrar'>" +
						"<i class='fa fa-trash fa-lg'></i>" +
						"</button>" +
						"</div>" +
						"</div>"
				}
			],
			// Ocultamos la 1er.columna que contiene el ID para poder editar/eliminar
			"aoColumnDefs": [{
				"sClass": "dpass",
				"aTargets": [0]
			}] // first column in visible columns array gets class "dpass"
			//"aoColumnDefs": [{
			//	"bVisible": false,
			//	"aTargets": [0]
			//}]
		});

		//para limpiar los campos antes de dar de Alta una Persona
		$("#addPistaModalBtn").click(function() {
			idPista = null; //No tenemos seleccionado ningún ID de pista, por eso lo seteamos a null

			// Reseteamos el formulario modal
			$("#form_Pista")[0].reset();

			// Eliminamos el mensaje de error 
			$(".form-group").removeClass('has-error').removeClass('has-success');
			$(".text-danger").remove();

			// Empty the message div
			$(".messages").html("");

			$("#form_createPista").trigger("reset");
			$(".modal-header").css("background-color", "#17a2b8");
			$(".modal-header").css("color", "white");
			$(".modal-title").text("Agregar Pista");
			$('#modalCRUD').modal('show');
		});

		//submit para el Alta y Actualización
		$('#form_Pista').submit(function(e) {
			e.preventDefault(); //Evita el comportambiento normal del submit, es decir, recarga total de la página

			$(".text-danger").remove();

			// validation
			var nombre = document.getElementById("nombre").value;
			var ubicacion = document.getElementById("ubicacion").value;
			var superficie = document.getElementById("superficie").value;

			if (nombre == "") {
				$("#nombre").closest('.form-group').addClass('has-error');
				$("#nombre").after('<p class="text-danger">El nombre es un campo obligatorio</p>');
			} else {
				$("#nombre").closest('.form-group').removeClass('has-error');
				$("#nombre").closest('.form-group').addClass('has-success');
			}

			if (ubicacion == "") {
				$("#ubicacion").closest('.form-group').addClass('has-error');
				$("#ubicacion").after('<p class="text-danger">La ubicación es un campo obligatorio</p>');
			} else {
				$("#ubicacion").closest('.form-group').removeClass('has-error');
				$("#ubicacion").closest('.form-group').addClass('has-success');
			}

			if (superficie == "") {
				$("#superficie").closest('.form-group').addClass('has-error');
				$("#superficie").after('<p class="text-danger">La superficie es un campo obligatorio</p>');
			} else {
				$("#superficie").closest('.form-group').removeClass('has-error');
				$("#superficie").closest('.form-group').addClass('has-success');
			}

			if (nombre && ubicacion && superficie) {
				//submit the form to server
				$.ajax({
					url: "pistas/funciones/createPista.php",
					type: "POST",
					datatype: "json",
					data: {
						nombre: nombre,
						ubicacion: ubicacion,
						superficie: superficie,
					},
					success: function(response) {
						response = JSON.parse(response);
						console.log(response);

						if (response.success) {
							$("#error").hide();

							// reset the form
							$("#form_Pista")[0].reset();
							tablaPista.ajax.reload(null, false);
							$('#modalCRUD').modal('hide');
						} else {
							// remove the error 
							$(".form-group").removeClass('has-error').removeClass('has-success');

							$(".messages").html('<div class="alert alert-danger alert-dismissible" role="alert">' +
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
								'<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
								'</div>');
						}
					}
				});
			}
		});

		$('.idPista').on('click', 'tablaPista tbody tr td', function() {
			columna = parseInt($(this).index());
			idFila = this.closest("tr").className

			alert($('.' + idFila + ' td').eq(columna).text());
		});

		//Borrar
		$(document).on("click", ".btnBorrar", function() {
			fila = $(this);

			idPista = parseInt(fila.closest("tr").find('td:eq(0)').text());
			var nombre = parseInt(fila.closest("tr").find('td:eq(1)').text());

			var respuesta = confirm("¿Está segur@ de borrar la pista " + nombre + "?");
			if (respuesta) {
				$.ajax({
					url: "pistas/funciones/deletePista.php",
					type: "POST",
					datatype: "json",
					data: {
						idPista: idPista
					},
					success: function() {
						tablaPista.row(fila.parents('tr')).remove().draw();
					}
				});
			}
		});

		//Editar        
		$(document).on("click", ".btnEditar", function() {
			fila = $(this).closest("tr");

			idPista = parseInt(fila.find('td:eq(0)').text());
			var nombre = parseInt(fila.find('td:eq(1)').text());
			var ubicacion = parseInt(fila.find('td:eq(2)').text());
			
			console.log(ubicacion);
			var superficie = parseInt(fila.find('td:eq(3)').text());

			$("#nombre").val(nombre);
			$("#ubicacion").val(ubicacion);
			$("#superficie").val(superficie);
			
			$(".modal-header").css("background-color", "#007bff");
			$(".modal-header").css("color", "white");
			
			$(".modal-title").text("Editar Usuario");
			
			$('#modalCRUD').modal('show');
		});
	});

	//https://www.youtube.com/watch?v=44w-jw9Y_PY
</script>