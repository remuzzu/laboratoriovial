<?php
include_once('entity/estadosOT.php');
$ot = new Estado();


if (isset($_POST) && !empty($_POST)) {
    $descri = strtoupper($_POST['descri']);
    $id = intval($_POST['idEstado']);

    $res = $ot->update($descri, $id);
    if ($res) {
        $message = "Datos actualizados con éxito";
        $class = "alert alert-success";
    } else {
        $message = "No se pudieron actualizar los datos";
        $class = "alert alert-danger";
    }

?>
    <div id="mydiv" class="<?php echo $class ?>">
        <?php echo $message; ?>
    </div>
<?php
}
$datos_estado = $ot->single_record($id);
?>

<script>
    setTimeout(function() {
        $('#mydiv').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>