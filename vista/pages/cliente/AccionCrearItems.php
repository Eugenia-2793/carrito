<?php
$Titulo = "crear items";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();
//  echo "</br>Por data_submited</br>";
//  print_r($datos);
//  echo "</br>--------------------</br>";
//Array ( [idproducto] => Array ( [0] => 1 [1] => 2 ) [idcompra] => 27 [proprecio] => Array ( [0] => 350 [1] => 350 ) [cicantidad] => Array ( [0] => 2 [1] => 2 ) )

//HACER.
//mando los datos a crear items y luego los listo con el estado de la compra,
//esto queda en vista del usuario como algo q solo puede eliminar.

//verifico que exista productos para el item
  $AbmObjProducto = new AbmProducto;
  $enStock = $AbmObjProducto->enStock($datos);

if($enStock){

    $AbmObjItem = new AbmCompraItem;
    $AbmObjItem->altavariositems($datos);
   // $filtro['idcompra']= $datos['idcompra'];
    $filtro['idcompra']= $datos['idcompra'];;
    $itemsdecompra = $AbmObjItem->buscar($filtro);
    $precio = $AbmObjItem->recuperarPrecio($itemsdecompra);
    $preciofinal = $precio;
    //echo "precio finl: $preciofinal";


    //$cantidad = count($itemsdecompra);
    //echo "cantidad de item: $cantidad";
    //print_r($itemsdecompra);

    //Eso es en caso de que cuando un usuario inicia una compra, la cantidad de stock de los items que compra se reducen. Pero, si cancela la compra, esos items vuelven a tener la cantidad de stock que tenían.

    $AbmObjCompra = new AbmCompra;
    $busca['idcompra']= $datos['idcompra'];
    // echo "busca </br> $busca";
    $compraunica = $AbmObjCompra->buscar($busca);
    //actualizar el precio de la compra:
    $precio = $AbmObjCompra->actualizarprecio($compraunica, $preciofinal);
    // if($precio){
    //   // echo "todo correcto";
    // }
   //$mostrarCompra = $AbmObjCompra->mostrarCompra($compraunica);

   $mensaje = "Compra creada con exito";
   echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
   <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
   <div>" . $mensaje . "</div>
   </div>";
   echo '<a href="compra.php" class="btn btn-warning" >ver Compra</a>';


}else{
  $mensaje = "no hay productos en stock";
  echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
  <div>" . $mensaje . "</div>
  </div>";
  echo '<a href="listarProductos.php" class="btn btn-warning" >ver Productos</a>';
}


include_once("../../estructura/pie.php");
?>