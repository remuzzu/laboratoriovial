<?php
include_once('entity/clientesOT.php');
$cl = new Cliente();

if (isset($_POST) && !empty($_POST)) {
    $razonSocial = trim(strtoupper($_POST['razonSocial']));
    $cuit = trim(strtoupper($_POST['cuit']));
    $id = intval($_POST['idCliente']);

    $res = $cl->update($razonSocial, $cuit, $id);
    switch ($res) {
        case 0:
            $message = "El cliente ya existe (según su cuit o razon social)!";
            $class = "alert alert-danger";
            break;
        case 1:
            $message = "Datos actualizados con éxito!";
            $class = "alert alert-success";
            break;
        case 2:
            $message = "No se pudieron actualizar los datos!";
            $class = "alert alert-danger";
            break;
    }
?>
    <div id="mydiv" class="<?php echo $class ?>">
        <?php echo $message; ?>
    </div>
<?php
}
$datos_cliente = $cl->single_record($id);
?>

<script>
    setTimeout(function() {
        $('#mydiv').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>