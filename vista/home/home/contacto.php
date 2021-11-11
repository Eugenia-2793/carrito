<?php
$Titulo = "Contacto";
include_once("../../estructura/cabecera.php");
?>

<div class="form-signin mx-auto p-3 text-center">
    <form id="contacto" name="contacto" action="../accion/ac_contacto.php" method="POST" data-toggle="validator">
        <h2 class="h2 mb-3">Contacto</h2>
        <!-- Nombre -->
        <div class="form-floating">
            <input type="text" class="form-control" id="uslogin" name="uslogin" placeholder="Hannah Montana" required>
            <label for="uslogin">Nombre y Apellido</label>
        </div>
        <!-- Mail -->
        <div class="form-floating">
            <input type="email" class="form-control" mane="mail" id="mail" placeholder="name@example.com" required>
            <label for="mail">Mail</label>
        </div>
        <!-- Mensaje -->
        <div class="form-floating mb-4">
            <textarea class="form-control" placeholder="Escribanos un comentario" name="descripcion" id="descripcion"></textarea>
            <label for="descripcion">Comentarios</label>
        </div>
        <!-- Boton -->
        <button class="w-100 btn btn-lg btn-success" type="submit">Enviar</button>
    </form>
</div>

<?php
include_once("../../estructura/pie.php");
?>