<?php
$Titulo = "crear items";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();

  $AbmObjProducto = new AbmProducto;
  $enStock = $AbmObjProducto->enStock($datos);

if($enStock){

    $AbmObjItem = new AbmCompraItem;
    $AbmObjItem->altavariositems($datos);
    $filtro['idcompra']= $datos['idcompra'];;
    $itemsdecompra = $AbmObjItem->buscar($filtro);
    $precio = $AbmObjItem->recuperarPrecio($itemsdecompra);
    $preciofinal = $precio;

    $AbmObjCompra = new AbmCompra;
    $busca['idcompra']= $datos['idcompra'];
    $compraunica = $AbmObjCompra->buscar($busca);
    $precio = $AbmObjCompra->actualizarprecio($compraunica, $preciofinal);

   $mensaje = "Compra creada con exito";
   echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
   <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
   <div>" . $mensaje . "</div>
   </div>";
   echo '<a href="compra.php" class="btn btn-warning" >ver Compra</a>';


}else{
  $mensaje = "No se pudo realizar su compra, vuelva y verifique stock";
  echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
  <div>" . $mensaje . "</div>
  </div>";
  echo '<a href="listarProductos.php" class="btn btn-warning" >ver Productos</a>';
}


include_once("../../estructura/pie.php");
?>