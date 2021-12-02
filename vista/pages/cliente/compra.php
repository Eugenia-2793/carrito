<?php
$Titulo = "ver compra";
include_once '../../estructura/cabecera.php';
$encuentraRol = false;
if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol  == 3) {
            $encuentraRol = true;
        }
    }
}
if ($encuentraRol) {
?>

<section>
    <h2>Estado de compra</h2>

    <!-- Listado de usuarios -->
    <div class="row mb-5" id="">
      <form id="Usuario" name="Usuario" method="POST" action="editar.php" data-toggle="validator">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Estado</th>
                <th scope="col" class='text-center'>Cancelar</th>
              </tr>
            </thead>

            <?php 
            
    //          if (count($compraunica) > 0) {
    //              $i = 1;
    //              foreach ($compraunica as $unica) {
    //              echo '<tbody>';
         
    //                $idcompra  = $unica->getIdCompraItem();
    //                $nombre = $unica->getIdProducto();
    //                $compra = $unica->getIdCompra();
    //                $cantidad = $unica->getCiCantidad();
    //                $precio = $unica->getitemPrecio();

    //                echo '<td>' . $idcompra .  '</td>';
    //                echo '<td>' . $cantidad .  '</td>';
    //                echo '<td>' . $precio .  '</td>';
    //                echo '<td>  <input type=submit id="borrar" name="borrar">  </td>';

    //              }
    echo '</tbody>';
      echo '</table>';
    //          }
    // ?>

<?php
  }else {
     include_once("../../pages/login/sinPermiso.php");
 }


include_once("../../estructura/pie.php");
?>