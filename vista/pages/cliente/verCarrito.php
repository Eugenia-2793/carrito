<?php
$Titulo = "ver carrito";
include_once '../../estructura/cabecera.php';
$datos = data_submitted();
$idcompra = $datos['idcompra'];
$encuentraRol = false;
if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol  == 3) {
            $encuentraRol = true;
        }
    }
}
if ($encuentraRol) {


//-------------------------Catidad-------------------------------------
//-----------------------------------------------------------------------

$AbmObjProducto = new AbmProducto;
$productos = $AbmObjProducto->buscarProductoporId($datos);
if(!($productos == null)){ 
  ?>
   
  <!-- Listado de Productos -->
  <div class="row mb-5" id="">
    <form id="carrito" name="carrito" method="POST" action="AccionCrearItems.php" data-toggle="validator">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col" class='text-center'>Tipo</th>
            <th scope="col" class='text-center'>Cantidad</th>
            <th scope="col" class='text-center'>Precio</th>
            </tr>
          </thead>
<?php
  $i = 1;
  echo '<tbody>'; 
 
  foreach($productos as $unProducto){
    $stock = $unProducto[0]->getProStock();
    if($stock != null){

     $id =  $unProducto[0]->getIdProducto();
     $nombre = $unProducto[0]->getProNombre();
     $detalle =  $unProducto[0]->getProDetalle();
     $precio = $unProducto[0]->getProPrecio();
     $tipo = $unProducto[0]->getProTipo();

    
     //paso los datos a la tabla para visualizarlos
         echo '<input type="hidden" id="idproducto[]" name="idproducto[]" value="'.$id.'">';
         echo '<input type="hidden" id="idcompra" name="idcompra" value="'.$idcompra.'">';
         echo '<input type="hidden" id="itemprecio[]" name="itemprecio[]" value="'. $precio.'" >';
        
         echo '<tr class="align-middle">';
         echo '<td >' . $nombre .  '</td>';
         echo '<td class="text-center">' . $tipo .  '</td>';
         echo '<td class="text-center"> 
              <input  type="number" max="'.$stock.'" min="1" id="cicantidad[]" name="cicantidad[]" value="1" >
              </td>';
         echo '<td  class="text-center" > x $'.$precio.'</td>';
    }//if de stock
   $i++;
  }//foreach
  echo '</tbody>';
  echo '</table>';
   }
  else{ //si no hay productos seleccionados 
  $mensaje = "no hay productos seleccionados";
  echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
  <div>" . $mensaje . "</div>
  </div>";
   }

?>

<a href="listarProductos.php" class="btn btn-warning" >ver Productos</a>
<button class="btn btn-success" type="submit" > Finalizar Compra </button> 



<?php

//de permisos 
} else {
  include_once("../../pages/login/sinPermiso.php");
}

include_once("../../estructura/pie.php");
?>