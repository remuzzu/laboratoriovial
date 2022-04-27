<?php
include_once('entity/OT.php');
$ot = new ordenTrabajo();


if (isset($_POST) && !empty($_POST)) {
    $id = intval($_POST['idOT']);

    $nroOT = $_POST['nroOT'];
	$nroPresu = $_POST['nroPresu'];
	$fechaAlta = date("d/m/Y", strtotime($_POST['fechaAlta']));
	$IDCliente = $_POST['cliente'];
	$descriTrabajo = $_POST['descri'];
	$detalle = $_POST['detalle'];
	$importe = $_POST['importe'];
	$IDEstado = $_POST['estado'];
    $responsable = $_POST['respons'];
    
    $res = $ot->update($id, $nroOT, $nroPresu, $fechaAlta, $IDCliente, $descriTrabajo, $detalle, 
    $importe, $IDEstado, $responsable);
    switch ($res) {
        case 0:
            $message = "La nro. OT por la que se está tratando de modificar ya existe!";
            $class = "alert alert-danger";
            break;
        case 1:
            $message = "Datos actualizados con éxito";
            $class = "alert alert-success";
            break;
        case 2:
            $message = "No se pudieron actualizar los datos";
            $class = "alert alert-danger";
            break;
        default:
            break;
    }

?>
    <div id="mydiv" class="<?php echo $class ?>">
        <?php echo $message; ?>
    </div>
<?php
}
$datos_ot = $ot->single_record($id);
?>

<script>
    setTimeout(function() {
        $('#mydiv').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>