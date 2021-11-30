<?php
$Titulo = "Editar Menú";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$menuEncontrado = new AbmMenu();
$filtro = array();
$filtro['idmenu'] = $datos['accion'];
$unMenu = $menuEncontrado->buscar($filtro);

$encuentraRol = false;

if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol  == 1) {
            $encuentraRol = true;
        }
    }
}

if ($encuentraRol) {
?>

    <!-- Botones -->
    <div class="mb-4">
        <a class="btn btn-dark" href="../../pages/menu/listar.php" role="button"><i class="fas fa-angle-double-left"></i> Regresar</a>
    </div>

    <section class="content p-3">
        <h2 class="h2 mb-3 text-center">Editar Menú</h2>

        <form id="editar" name="editar" method="POST" action="abmMenu.php" data-toggle="validator">
            <div class="form-signin mx-auto">
                <?php

                foreach ($unMenu as $menuEncontrado) {
                    $id =              $menuEncontrado->getIdMenu();
                    $nombre =          $menuEncontrado->getMeNombre();
                    $descripcion =     $menuEncontrado->getMeDescripcion();
                    $padre =           $menuEncontrado->getIdPadre();
                    $medeshabilitado = $menuEncontrado->getMeDeshabilitado();

                    //clave primeria
                    echo ' <input id="idmenu" name="idmenu" value="' . $id . '" type="hidden">';
                    //usnombre
                    echo ' <label for="Nombre" class="control-label">Nombre *</label> <input type="text" class="form-control" name="menombre" id="menombre"  value="' . $nombre . '">';
                    //uspass
                    echo '<label for="Descripcion">Descripcion *</label> <input class="form-control" type="text" id="medescripcion"  name="medescripcion" value="' . $descripcion . '">';
                    //padre
                    echo "<!-- Padre -->
                    <div class='mb-3'>
                        <legend class='col-form-label col-sm-8'>Menú Padre *</legend>
                        <div class='col-sm-8 col-md-11'>";
                    switch ($padre) {
                        case 1:
                            echo "<div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='1' checked>
                                            <label class='form-check-label' for='idpadre'>Administrador</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='2'>
                                            <label class='form-check-label' for='idpadre'>Deposito</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='3'>
                                            <label class='form-check-label' for='idpadre'>Cliente</label>
                                        </div>";
                            break;
                        case 2:
                            echo "<div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='1'>
                                            <label class='form-check-label' for='idpadre'>Administrador</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='2' checked>
                                            <label class='form-check-label' for='idpadre'>Deposito</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='3'>
                                            <label class='form-check-label' for='idpadre'>Cliente</label>
                                        </div>";
                            break;
                        case 3:
                            echo "<div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='1'>
                                            <label class='form-check-label' for='idpadre'>Administrador</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='2'>
                                            <label class='form-check-label' for='idpadre'>Deposito</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='idpadre' id='idpadre' value='3' checked>
                                            <label class='form-check-label' for='idpadre'>Cliente</label>
                                        </div>";
                            break;
                    }
                    echo "</div>
                    </div>";
                    //echo '<label for="padre">Padre * </label> <input class="form-control" type="text" id="idpadre" name="idpadre" value="' . $padre . '">';
                    //usdeshabilitado
                    echo "<!-- Habilitado -->
                    <div class='mb-3'>
                        <label for='Duenio'>Habilitado</label> 
                        <input type='date' class='form-control' id='medeshabilitado' name='medeshabilitado' value='" . $medeshabilitado . "'>
                    </div>";
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
} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>