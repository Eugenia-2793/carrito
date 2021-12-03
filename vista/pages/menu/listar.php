<?php
$Titulo = "Listar Menus";
include_once("../../estructura/cabecera.php");

$objAbmMenu = new AbmMenu();
$listaMenu = $objAbmMenu->buscar(null);
$encuentraRol = false;

if ($sesion->activa()) {
  foreach ($idrol as $unIdRol) {
    if ($unIdRol == 1) {
      $encuentraRol = true;
    }
  }
}

if ($encuentraRol) {
?>

  <section>
    <h2>Listar Menus</h2>

    <!-- Boton Agregar menu -->
    <div class="mb-2 d-flex justify-content-end">
      <a class="btn btn-primary" href="nuevo.php" role="button"><i class="fas fa-plus"></i> Nuevo Menu</a>
    </div>

    <!-- Listado de menus -->
    <div class="row mb-5" id="">
      <form id="menu" name="menu" method="POST" action="editar.php" data-toggle="validator">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col" class='text-center'>Padre</th>
                <th scope="col">Habilitado</th>
                <th scope="col" class='text-center'>Editar</th>
              </tr>
            </thead>
            <?php

            if (count($listaMenu) > 0) {
              $i = 1;
              echo '<tbody>';
              foreach ($listaMenu as $objAbmMenu) {
                $id = $objAbmMenu->getIdMenu();
                $nombre = $objAbmMenu->getMeNombre();
                $descripcion = $objAbmMenu->getMeDescripcion();
                $padre = $objAbmMenu->getIdPadre();
                $habilitado = $objAbmMenu->getMeDeshabilitado();

                echo '<tr class="align-middle">';
                echo '<th scope="row">' . $i . '</th>';
                echo '<td>' . $nombre .     '</td>';
                echo '<td>' . $descripcion . '</td>';
                echo '<td class="text-center">' . $padre . '</td>';
                echo '<td>' . $habilitado . '</td>';
                echo "<td class='text-center'>
                                    <button type='submit' class='btn btn-success btn-sm' value=" . $id . " name='accion' id='accion'>
                                    <i class='fa fa-pen'></i>
                                    </button>   
                                    <button class='btn btn-danger btn-sm' type='submit' value=" . $id . " formaction='eliminar.php' name='idmenu' id='idmenu'>
                                    <i class='fas fa-trash-alt'></i>
                                    </button>
                                </td>";

                $i++;
              }
              echo '</tbody>';
              echo '</table>';
            } else {
              echo "No hay menu(s) registrado en la Base de datos";
            }

            ?>


        </div>
      </form>
    </div>
  </section>

<?php
} else {
  include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>