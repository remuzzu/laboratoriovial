<?php
include_once('entity/estadosOT.php');
$ot = new Estado();

if (isset($_POST) && !empty($_POST)) {
    $descri = $_POST['descri'];

    $res = $ot->insert($descri);
    switch ($res) {
        case 0:
            $message = "El estado ya existe!";
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