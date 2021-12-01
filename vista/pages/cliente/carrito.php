<?php
$Titulo = "ver compras";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();
//  echo "</br>Por data_submited</br>";
//  print_r($datos);
//  echo "</br>--------------------</br>";
//Array ( [idproducto] => Array ( [0] => 1 [1] => 2 ) [idcompra] => 27 [proprecio] => Array ( [0] => 350 [1] => 350 ) [cicantidad] => Array ( [0] => 2 [1] => 2 ) )

//HACER.
//mando los datos a crear items y luego los listo con el estado de la compra,
//esto queda en vista del usuario como algo q solo puede eliminar.

$AbmObjItem = new AbmCompraItem;
$AbmObjItem->altavariositems($datos);
$filtro= $datos['idcompra'];
$itemsdecompra = $AbmObjItem->buscar($filtro);
// $cantidad = count($itemsdecompra);
// echo $cantidad;
//print_r($itemsdecompra);

$AbmObjCompra = new AbmCompra;
$filtro= $datos['idcompra'];
$compraunica = $AbmObjCompra->buscar($filtro);
//$precio = $AbmObjCompra->precio($itemsdecompra);
//$mostrarCompra = $AbmObjCompra->mostrarCompra($compraunica);

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
include_once("../../estructura/pie.php");
?>