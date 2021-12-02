<?php
$Titulo = "Registrar";
include_once("../../estructura/cabecera.php");
?>

<div class="form-signin mx-auto p-3 text-center">
    <form id="registro" name="registro" action="../../pages/usuario/abmUsuario.php" method="POST" data-toggle="validator">
        <h2 class="h2 mb-3">Registro</h2>
        <!-- Nombre -->
        <div class="form-floating">
            <input type="text" class="form-control" id="usnombre" name="usnombre" placeholder="Hannah Montana" required>
            <label for="usnombre">Nombre y Apellido</label>
        </div>
        <!-- Contraseña -->
        <div class="form-floating">
            <input type="password" class="form-control" name="uspass" id="uspass" placeholder="***********" required>
            <label for="uspass">Contraseña</label>
        </div>
        <!-- Mail -->
        <div class="form-floating mb-4">
            <input type="email" class="form-control" name="usmail" id="usmail" placeholder="name@example.com" required>
            <label for="usmail">Mail</label>
        </div>
        <!--Habilitado-->
        <input id="usdeshabilitado" name="usdeshabilitado" value="0000-00-00 00:00:00" type="hidden">
        <!-- accion = nuevo (input oculto) -->
        <input id="accion" name="accion" value="registrar" type="hidden">
        <!-- Boton -->
        <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button>
    </form>
</div>

<?php
include_once("../../estructura/pie.php");
?>