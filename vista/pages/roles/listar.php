<?php
$Titulo = "Listar Roles";
include_once("../../estructura/cabecera.php");

$objAbmRol = new AbmRol();
$listaRol = $objAbmRol->buscar(null);   

?>

<h2 class="mt-5">Listar Roles</h2>

 <!-- Boton Agregar Rol -->
 <div class="mb-2 d-flex justify-content-end">
    <a class="btn btn-primary" href="nuevo.php" role="button"><i class="fas fa-plus"></i> Nuevo Rol</a>
  </div>

<!-- Listado de Rols -->
<div class="row mb-5" id="">
  <form id="Rol"  name="Rol" method="POST" action="editar.php" data-toggle="validator">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="">#</th>
            <th scope="col">Descripcion</th>
            <th scope="col" class='text-center'>Editar <th>
          </tr>
        </thead>
        <?php

        if (count($listaRol) > 0) {
         $i = 1;
          echo '<tbody>';
          foreach ($listaRol as $objAbmRol) {
             $id =  $objAbmRol->getidrol();
             $des = $objAbmRol->getroldescripcion();
            
            // var_dump($objAbmRol);
            echo '<tr class="align-middle">';
            echo '<th scope="row">' . $id. '</th>';
            echo '<td>' . $des .  '</td>';
            /*if($des != 'administrador' && $des != 'deposito' && $des != 'cliente'){
            echo "<td  class='text-center'>
                   <button type='submit' class='btn btn-success btn-sm' value=".$id." name='accion' id='accion'>
                   <i class='fa fa-pen'> </i>
                   </button>         
                   ";
            }*/

            echo "<td  class='text-center'>
            <button type='submit' class='btn btn-success btn-sm' value=".$id." name='accion' id='accion'>
            <i class='fa fa-pen'> </i>
            </button>         
            ";

            
            $i++;
          }
          echo '</tbody>';
          echo '</table>';
        }

        ?>


    </div>
  </form>
</div>

<?php
include_once("../../estructura/pie.php");
?>