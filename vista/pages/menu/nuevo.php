<?php
$Titulo = "Nuevo Menú";
include_once("../../estructura/cabecera.php");

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
        <h2 class="h2 mb-3 text-center">Nuevo Menú</h2>


        <form id="nueva" name="nueva" method="POST" action="abmMenu.php" data-toggle="validator">
            <div class="form-signin mx-auto">
                <!--Clave primaria-->
                <input id="idmenu" name="idmenu" value="null" type="hidden">

                <!-- Nombre-->
                <div class="mb-3">
                    <label for="Nombre" class="control-label">Nombre *</label>
                    <input type="text" class="form-control" name="menombre" id="menombre" required>
                </div>
                <!-- Contrasenia -->
                <div class="mb-3">
                    <label for="Contrasenia">Descripcion *</label>
                    <input type="text" class="form-control" name="medescripcion" id="medescripcion" required>
                </div>
                <!-- Padre -->
                <div class="mb-3">
                    <legend class="col-form-label col-sm-8">Menú Padre *</legend>
                    <div class="col-sm-8 col-md-11">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="idpadre" id="idpadre" value="1">
                            <label class="form-check-label" for="idpadre">Administrador</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="idpadre" id="idpadre" value="2">
                            <label class="form-check-label" for="idpadre">Deposito</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="idpadre" id="idpadre" value="3">
                            <label class="form-check-label" for="idpadre">Cliente</label>
                        </div>
                    </div>
                </div>


                <!-- Habilitado -->
                <div class="mb-3">
                    <label for="Duenio">Habilitado</label>
                    <input type="date" class="form-control" name="medeshabilitado" id="medeshabilitado">
                </div>

                <div id="obligatorio" class="form-text">Los campos con "*" son obligatorios</div>
            </div>
            <!-- accion = nuevo (input oculto) -->
            <input id="accion" name="accion" value="crear" type="hidden">
            <!-- Botón enviar -->
            <div class="text-center mt-3 mb-5">
                <input class="btn btn-danger btn-lg" type="reset" value="Limpiar">
                <input class="btn btn-primary btn-lg" type="submit" value="Enviar">
            </div>
        </form>

    </section>

<?php
} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>