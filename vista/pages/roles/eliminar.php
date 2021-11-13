<?php
$Titulo = "Listar Roles";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$objAbmRol = new AbmRol();
$filtro = array();
$filtro['idrol'] = $datos['idrol'];
$unrol = $objAbmRol->buscar($filtro);
?>

<h2 class="mt-5"> Borrar Rol </h2>

<a class="dropdown-item" href="../../pages/roles/listar.php">
    <span class="fas fa-users fa-fw" aria-hidden="true" title="rols"> </span> Volver a roles
</a> 

<form id="borrar" name="borrar" method="POST" action="abmRol.php" data-toggle="validator">

  <?php
       
       foreach ($unrol as $rolEncontrado) {
           $id = $rolEncontrado->getidrol();
           $des = $rolEncontrado->getroldescripcion();
           //clave primeria
           echo ' <input id="idrol" name="idrol" value="' . $id . '" type="hidden">';
           //descripcion
           echo ' <input type="hidden" name="rodescripcion" id="rodescripcion"  value="' . $des . '" required>';
       }

    ?>
       <!-- accion = borrar (input oculto) 
       <input id="accion" name="accion" value="borrar" type="hidden">
      -->
       
     <?php
       echo "<div class='card text-center border border-3 border-primary' style='width: 25rem;'>
                <div class='card-body'>
                    <h4 class='card-title'>¡Atención!</h4>
                    <p class='card-text'>¿Realmente desea eliminar este usuario?</p>
                    <button href='#' class='btn btn-primary' id='accion' name='accion' type='submit' value='borrar' style='width: 3rem;'>Sí</button>
                    <a href='listar.php' class='btn btn-primary'  style='width: 3rem;'>No</a>
                </div>
            </div>";

            
    
     ?>

<?php
include_once("../../estructura/pie.php");
?>