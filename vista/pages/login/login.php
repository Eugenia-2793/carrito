<?php
$Titulo = "Login";
include_once '../../../configuracion.php';

$sesion = new Session();

if ($sesion->activa()) {
    header("Location:../../home/home/index.php");
} else {
    include_once("../../estructura/cabecera.php");
}

$datos = data_submitted();
?>

<div class="form-signin mx-auto p-3 text-center">
    <form id="login" name="login" method="POST" action="verificarLogin.php">
        <h2 class="h2 mb-3">Usuario</h2>
        <div class="form-group">
            <div class="input-group input-group-lg mt-3">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                <input class="form-control" type="text" id="usnombre" name="usnombre" placeholder="Username" aria-label="username" aria-describedby="basic-addon1" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-lg mt-3">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                <input class="form-control" type="password" id="uspass" name="uspass" placeholder="***********" aria-label="password" aria-describedby="basic-addon1" required>
            </div>
        </div>
        <div class="d-grid my-3">
            <button class="btn btn-lg btn-primary" type="submit">Iniciar sesión</button>
        </div>
        <?php
        if (isset($datos['error'])) {
            $mensaje = $datos['error'];
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                <div>$mensaje</div></div>";
        }
        ?>
    </form>
    <div>
        <p class="mb-0 text-muted">¿No tienes cuenta? <a href="registrar.php">¡Registrate!</a></p>
    </div>
</div>

<?php
include_once("../../estructura/pie.php");
?>