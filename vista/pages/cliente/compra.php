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


// $objCompra = new AbmCompra;  
$AbmObjCompra = new AbmCompra;
$id = $AbmObjCompra->recuperarIdusuario();
$filtro= array();
$filtro['idusuario'] = $id;
$compra = $AbmObjCompra->buscar($filtro);

if(!($compra == null)){

$obj = $compra[0];
$idcompra = $obj->getIdCompra();


$AbmObjCompraEstado = new AbmCompraEstado;
$filtro= array();
$filtro['idcompra'] = $idcompra;
$compra = $AbmObjCompraEstado->buscar($filtro);
$estado = $AbmObjCompraEstado->recuperarestado($compra);
//print_r($estado); trae el objeto abmcompraestadotipo

$AbmObjCompraEstadoTipo = new AbmCompraEstadoTipo;
$idcet = $AbmObjCompraEstadoTipo->recuperarestadoid($estado);
$descripcion = $AbmObjCompraEstadoTipo->recuperardescripcion($estado);

// echo "el id $idcet";
// echo  "descripcion $descripcion";

if($idcet == 1 || $idcet == 2){
?>

<section>
    <h2>Estado de compra</h2>

    <!-- Listado de usuarios -->
    <div class="row mb-5" id="">
      <form id="Usuario" name="Usuario" method="POST" action="#" data-toggle="validator">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Precio</th>
                <th scope="col">Estado</th>
                <th scope="col" class='text-center'>Cancelar</th>
              </tr>
            </thead>
            <?php 

             $fechaini = $obj->getCoFecha();
             $precio = $obj->getcomPrecio();
             $fechaini = $obj->getCoFecha();
             
              echo '<tbody>';
              echo '<tr class="align-middle">';
              echo '<td >' . $fechaini .  '</td>';
              echo '<td>' .  $precio .  '</td>';
              echo '<td>' .  $descripcion .  '</td>';
              echo "<td class='text-center'>"; 
      
              echo "<button class='btn btn-danger btn-sm' type='submit' value='" . $id . "' formaction='eliminar.php' name='idusuario' id='idusuario'>
                          <i class='fas fa-trash-alt'></i>
                      </button>";
              echo "</td>";
                 
            
                 
    echo '</tbody>';
      echo '</table>';
             
   }else{
      echo '<a href="#" class="btn btn-warning" >Historial de compras</a>';
    }//verifico con los estados si lo pongo abajo no se ve el cartel.

   }else{
   $mensaje = "Tu carrito esta vacio";
   echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
   <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
   <div>" . $mensaje . "</div>
   </div>";
      echo '<a href="listarProductos.php" class="btn btn-success" >VAMOS A COMPRAR! </a>';
      
  
   }

  

 //permisos
 }else {
     include_once("../../pages/login/sinPermiso.php");
 }

//pie
include_once("../../estructura/pie.php");
?>