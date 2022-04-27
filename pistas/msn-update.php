<?php
include_once('entity/pista.php');
$ot = new pista();


if (isset($_POST) && !empty($_POST)) {
    $id = intval($_POST['idPista']);

    $nombre = $_POST['nombre'];
	$ubicacion = $_POST['ubicacion'];
    $IDSup = $_POST['superficie'];
	
    $res = $ot->update($id, $nombre, $ubicacion, $IDSup);
    switch ($res) {
        case 0:
            $message = "El nro. de pista por el que se está tratando de modificar ya existe!";
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
$datos_pista = $ot->single_record($id);
?>

<script>
    setTimeout(function() {
        $('#mydiv').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>