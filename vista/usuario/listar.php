<?php
$Titulo = "Listar usuarios";
include_once("../../estructura/cabecera.php");


$objAbmUsuario = new AbmUsuario();
$listaUsuario = $objAbmUsuario->buscar(null);
?>

<h2 class="mt-5">Listar Usuarios</h2>
<


<div class="row mb-5" id="">
  <!-- Boton Agregar UsuarioAbmUsuario -->
  <div class="mb-2 d-flex justify-content-end">
    <a class="btn btn-primary" href="#" role="button"><i class="fas fa-plus"></i> Nuevo Usuario</a>
  </div>
  <form id="Usuario">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Password</th>
            <th scope="col">Email</th>
            <th scope="col">habilitado</th>
            <th scope="col">Rol</th>
          </tr>
        </thead>
        <?php

        if (count($listaUsuario) > 0) {
          $i = 1;
          echo '<tbody>';
          foreach ($listaUsuario as $objAbmUsuario) {
            // var_dump($objAbmUsuario);
            echo '<tr class="align-middle">';
            echo '<th scope="row">' . $i . '</th>';
            echo '<td>' . $objAbmUsuario->getusnombre() .  '</td>';
            echo '<td>' . $objAbmUsuario->getuspass() .    '</td>';
            echo '<td>' . $objAbmUsuario->getusmail() .  '</td>';
            echo '<td>' . $objAbmUsuario->getusdeshabilitado() .'</td>';
            echo '<td>' . "aca deberian ir los roles" .'</td>';
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