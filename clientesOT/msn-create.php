<?php

include_once('entity/clientesOT.php');
$cl = new Cliente();

if (isset($_POST) && !empty($_POST)) {
    $razonSocial = $_POST['razonSocial'];
    $cuit = $_POST['cuit'];

    $res = $cl->insert($razonSocial, $cuit);
    switch ($res) {
        case 0:
            $message = "El cliente ya existe (según su cuit o razon social)!";
            $class = "alert alert-danger";
            break;
        case 1:
            $message = "Datos insertados con éxito!";
            $class = "alert alert-success";
            break;
        case 2:
            $message = "No se pudieron insertar los datos!";
            $class = "alert alert-danger";
            break;
    }

?>
    <div id="mydiv" class="<?php echo $class ?>">
        <?php echo $message; ?>
    </div>
<?php
}
?>

<script>
    setTimeout(function() {
        $('#mydiv').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>