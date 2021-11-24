<?php
$Titulo = "Editar Rol";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$objAbmRol = new AbmRol();
$filtro = array();
$filtro['idrol'] = $datos['accion'];
//print_r($datos);
$unrol = $objAbmRol->buscar($filtro);
?>

<!-- Botones -->
<div class="mb-4">
    <a class="btn btn-dark" href="../../pages/usuario/listar.php" role="button"><i class="fas fa-angle-double-left"></i> Regresar</a>
</div>

<section class="content p-3">
    <h2 class="h2 mb-3 text-center">Editar Rol</h2>

    <form id="editar" name="editar" method="POST" action="abmRol.php" data-toggle="validator">
        <div class="form-signin mx-auto">
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
                <input class="btn btn-danger btn-lg" type="reset" value="Limpiar">
                <input class="btn btn-primary btn-lg" type="submit" value="Enviar">
            </div>


        </div>
    </form>
</section>
<?php
include_once("../../estructura/pie.php");
?>