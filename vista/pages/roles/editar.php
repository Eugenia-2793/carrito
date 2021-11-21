<?php
$Titulo = "Editar Roles";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$objAbmRol = new AbmRol();
$filtro = array();
$filtro['idrol'] = $datos['accion'];
//print_r($datos);
$unrol = $objAbmRol->buscar($filtro);
?>
<h2 class="mt-5">Editar Roless</h2>

<a class="dropdown-item" href="../../pages/roles/listar.php">
    <span class="fas fa-users fa-fw" aria-hidden="true" title="rols"> </span> Volver a roles
</a> <br>

<form id="editar" name="editar" method="POST" action="abmRol.php" data-toggle="validator">

  <?php
       
       foreach ($unrol as $rolEncontrado) {
           $id = $rolEncontrado->getidrol();
           $des = $rolEncontrado->getroldescripcion();
         
           //clave primeria
           echo ' <input id="idrol" name="idrol" value="' . $id . '" type="hidden">';
           //descripcion
           echo ' <label for="Descripcion" class="control-label">Descripcion *</label> <input type="text" class="form-control" name="rodescripcion" id="rodescripcion"  value="' . $des . '" required>';
       }
  ?>

       <!-- accion = nuevo (input oculto) -->
       <input id="accion" name="accion" value="editar" type="hidden">
       <!-- Botón enviar -->
       <div class="text-center mt-3 mb-5">
           <input class="btn btn-danger btn-lg"  type="reset" value="Limpiar">
           <input class="btn btn-primary btn-lg"  type="submit" value="Enviar">
       </div>




<?php
include_once("../../estructura/pie.php");
?>