<?php
//require "conexion.php";
//require "programador/funcs.php";
?>

<main id="main">
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="text-center rounded col-md-12">
					<h2 class="title">Convertir varchar a date en OT</h2>

					<div class="form-group">
						<!--<input type="submit" name="convertFecha" value="Aceptar" id="convertFecha" onclick="convertFecha();">-->
						<button type="submit" id="btnfun1" name="btnfun1" class="btn btn-success" onClick='action()'>Realizar Cambios</button>
					</div>

				</div>
			</div>
		</div>
	</section>
</main>

<script>
    function action()
    {
        $.ajax({
            type: 'POST', //aqui puede ser igual get
            url: 'programador/funcs.php',//aqui va tu direccion donde esta tu funcion php
            data: {
				action:'convertFecha'
			},
            success:function(response){
                alert(response);
           },
           error:function(data){
            	alert(response);
           }
         });
    }
</script>