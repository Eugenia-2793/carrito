<?php
$Titulo = "Registrar";
include_once("../estructura/cabecera.php");

/*$datos = data_submitted();
if (isset($datos['cs'])) {
    if ($datos['cs'] == 1) {
        $sesion->cerrarSession();
        header("Location:../index/login.php");
    }
} else {
    $activa = $sesion->activa();
    if ($activa) {
        header("Location:../index/carrito.php");
    }
}*/
?>

<div class="form-signin text-center">
    <form id="registro" name="registro" action="../accion/ac_registrar.php" method="POST" data-toggle="validator">
        <h3 class="h3 mb-3 fw-normal">Registro</h3>
        <!-- Nombre -->
        <div class="form-floating">
            <input type="text" class="form-control" id="usnombre" name="usnombre" placeholder="Hannah Montana" required>
            <label for="usnombre">Nombre y Apellido</label>
        </div>
        <!-- Contraseña -->
        <div class="form-floating">
            <input type="password" class="form-control" mane="uspass" id="uspass" placeholder="***********" required>
            <label for="uspass">Contraseña</label>
        </div>
        <!-- Mail -->
        <div class="form-floating mb-4">
            <input type="email" class="form-control" mane="mail" id="mail" placeholder="name@example.com" required>
            <label for="mail">Mail</label>
        </div>
        <!-- Boton -->
        <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button>
    </form>
</div>

<?php
include_once("../estructura/pie.php");
?>