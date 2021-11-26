<?php
$Titulo = "ver compras";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();
// print_r($datos);
// echo "</br>--------------------</br>";
//recuperar id usuario si 
//hacer una funcion que si el ususario con ese id no tiene una compra pendiente, que cree una nueva. si
//creo una nueva compra, con estado y estadotipo.si
//->>>teniendo la compra, y los productos(cantiddad, precio), creo el item.
//compora, producto e item tienen precio.

$AbmObjCompra = new AbmCompra;
$id = $AbmObjCompra->recuperarIdusuario();
$filtro= array();
$filtro['idusuario'] = $id;
$compra = $AbmObjCompra->buscar($filtro);


if(!($compra == null)){
   //existe compra - continuar. - traer los items de esta compra.
   //echo "entro primero <br/>";
   $existe = $AbmObjCompra->existeCompra($filtro);
   $idcompra = $existe[0]->getIdCompra();
  
}else{
    //no existe compra - continuar. - acomodar los productos seleccionador.
  //echo "entro segundo </br>";
   $nueva = $AbmObjCompra->nuevaCompra($filtro); //id de la compra
   if($nueva){
    $existe = $AbmObjCompra->existeCompra($filtro);
    $idcompra = $existe[0]->getIdCompra();
   }
}

//-------------------------PRODUCTOS-------------------------------------
//-----------------------------------------------------------------------

$AbmObjProducto = new AbmProducto;
$productos = $AbmObjProducto->buscarProductoporId($datos);
if(!($productos == null)){ //verifico que existan productos
  ?>
   
  <!-- Listado de Productos -->
  <div class="row mb-5" id="">
    <form id="carrito" name="carrito" method="POST" action="carrito.php" data-toggle="validator">
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
         echo '<input type="hidden" id="proprecio[]" name="proprecio[]" value="'. $precio.'" >';
         echo '<tr class="align-middle">';
         echo '<td >' . $nombre .  '</td>';
         echo '<td class="text-center">' . $tipo .  '</td>';
         echo '<td class="text-center"> 
              <input  type="number" max="'.$stock.'" min="1" id="cicantidad[]" name="cicantidad[]" value="1" >
              </td>';
         echo '<td  class="text-center" > x $'.$precio.'</td>';
        //  echo '<input type="hidden" id="original" value="'.$precio.'">';
   

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






//-------------------------PRODUCTOS-------------------------------------
?>


<!--------------BOTONES---------------------------->

   
<button class="btn btn-warning" onclick="goBack()">Seguir Comprando</button>
<button class="btn btn-success" type="submit"> Finalizar Compra</button>  

  <script>
      function goBack() {
        window.history.back();
      }

  </script>


<?php
include_once("../../estructura/pie.php");
?>