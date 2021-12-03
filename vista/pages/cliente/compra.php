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

//busco las compras que solo esten iniciadas
$AbmObjCompra = new AbmCompra;
 $id = $AbmObjCompra->recuperarIdusuario();
 $filtro= array();
 $filtro['idusuario'] = $id;
  $compra = $AbmObjCompra->buscar($filtro);
  if(!($compra == null)){
      $obj = $compra[0];
      $idcompra = $obj->getIdCompra();
      $idcetmicompra = $AbmObjCompra->estadodemicompra($idcompra);
      
      if($idcetmicompra['idcet'] == 1){
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
             $descripcion= $idcetmicompra['descripcion'];
             $fechaini = $obj->getCoFecha();
             $precio = $obj->getcomPrecio();
             $fechaini = $obj->getCoFecha();
             
              echo '<tbody>';
              echo '<tr class="align-middle">';
              echo '<td >' . $fechaini .  '</td>';
              echo '<td>' .  $precio .  '</td>';
              echo '<td>' .  $descripcion .  '</td>';
              echo "<td class='text-center'>"; 
      
              echo "<button class='btn btn-danger btn-sm' type='submit' value='" . $idcompra . "' formaction='cancelarCompra.php' name='idcompraestado' id='idcompraestado'>
                          <i class='fas fa-trash-alt'></i>
                      </button>";
              echo "</td>";
                 
            
                 
    echo '</tbody>';
      echo '</table>';
             
   }else{
      echo '<a href="historial.php" class="btn btn-warning" >Historial de compras</a>';
    }
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