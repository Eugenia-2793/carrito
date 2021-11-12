<?php
$Titulo = "Listar usuarios";
include_once("../../estructura/cabecera.php");


$objAbmUsuario = new AbmUsuario();
$listaUsuario = $objAbmUsuario->buscar(null);   
//$listaUsuario = $objAbmUsuario->listarUsuarios(null);
?>

<h2 class="mt-5">Listar Usuarios</h2>

 <!-- Boton Agregar Usuario -->
 <div class="mb-2 d-flex justify-content-end">
    <a class="btn btn-primary" href="nuevo.php" role="button"><i class="fas fa-plus"></i> Nuevo Usuario</a>
  </div>

<!-- Listado de usuarios -->
<div class="row mb-5" id="">
  <form id="Usuario"  name="Usuario" method="POST" action="editar.php" data-toggle="validator">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Password</th>
            <th scope="col">Mail</th>
            <th scope="col">habilitado</th>
            <!-- <th scope="col">Rol</th> -->
            <th scope="col" class='text-center'>Editar <th>
          </tr>
        </thead>
        <?php

        if (count($listaUsuario) > 0) {
         $i = 1;
          echo '<tbody>';
          foreach ($listaUsuario as $objAbmUsuario) {
             $id =  $objAbmUsuario->getidusuario();
            
            // var_dump($objAbmUsuario);
            echo '<tr class="align-middle">';
            echo '<th scope="row">' . $id. '</th>';
            echo '<td>' . $objAbmUsuario->getusnombre() .  '</td>';
            echo '<td>' . $objAbmUsuario->getuspass() .    '</td>';
            echo '<td>' . $objAbmUsuario->getusmail() .  '</td>';
            echo '<td>' . $objAbmUsuario->getusdeshabilitado() .'</td>';
            // echo '<td>' . "aca van roles"  .'</td>';


            //<!---------en listas usussarios saca el id y lo manda por boton-------------->
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