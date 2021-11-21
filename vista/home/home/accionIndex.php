<?php
$Titulo = "Acción Index";
include_once("../../estructura/cabecera.php");
include_once("../../../control/controlSubeArchivos.php");

$obj = new controlArchivos();
$infoArchivo = $obj->obtenerInfoDeArchivo($_POST);
$respuesta = $infoArchivo["Descripcion"];
$link = $infoArchivo["link"];
?>


<?php
echo "<div class='alert alert-success' role='alert'>
 <div class='row px-2 my-3'>
     <div class='col-lg-7 col-xl-8'>$respuesta</div>
     <div class='col-lg-5 col-xl-4 text-lg-end'><img class='img-fluid' alt='Portada' src='" . $link . "'></div>
 </div>
</div>";
?>

<!-- Botones -->
<div class="mb-5">
    <a class="btn btn-dark" href="index.php" role="button"><i class="fas fa-angle-double-left"></i> Regresar</a>
</div>


<?php
include_once("../../estructura/pie.php");
?>