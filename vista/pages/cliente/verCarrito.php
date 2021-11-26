<?php
$Titulo = "Carrito";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();
// print_r($datos);
// echo "</br>--------------------</br>";
//recuperar id usuario
//hacer una funcion que si el ususario con ese id no tiene una compra pendiente, que cree una nueva.
//creo una nueva compra, con estado y estadotipo.
//->>>teniendo la compra, y los productos(cantiddad, precio), creo el item.
//compora, producto e item tienen precio.



$AbmObjCompra = new AbmCompra;
$id = $AbmObjCompra->recuperarIdusuario();
echo "</br>el id de aca $id </br>";
$filtro= array();
$filtro['idusuario'] = $id;
$compra = $AbmObjCompra->buscar($filtro);


if(!($compra == null)){
   //existe compra - continuar. - traer los items de esta compra.
   echo "entro primero";
  $existe = $AbmObjCompra->existeCompra($filtro);

}else{
    //no existe compra - continuar. - acomodar los productos seleccionador.
   echo "entro segundo";
   $nueva = $AbmObjCompra->nuevaCompra($filtro); //id de la compra


}

?>



<!-- Volver a la pagina anterior sin que esta pierda los datos-->
</br>
<button class="btn btn-warning" onclick="goBack()">Volver</button>
<script>
function goBack() {
  window.history.back();
}
</script>
<!---------------------------------------------------------------->

<?php
include_once("../../estructura/pie.php");
?>