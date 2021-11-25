<?php
$Titulo = "Nuevo Usuario";
include_once("../../estructura/cabecera.php");
?>

<section>
	<h2 class="h2 mb-3 text-center">Nuevo Usuario</h2>


	<form id="nueva" name="nueva" method="POST" action="abmUsuario.php" data-toggle="validator">
		<div class="form-signin mx-auto">
			<!--Clave primaria-->
			<input id="idusuario" name="idusuario" value="null" type="hidden">

			<!-- Nombre-->
			<div class="mb-3">
				<label for="Nombre" class="control-label">Nombre *</label>
				<input type="text" class="form-control" name="usnombre" id="usnombre" required>
			</div>
			<!-- Contrasenia -->
			<div class="mb-3">
				<label for="Contrasenia">Contraseña *</label>
				<input type="text" class="form-control" name="uspass" id="uspass" placeholder="******" required>
			</div>
			<!-- mail -->
			<div class="mb-3">
				<label for="mail">Mail * </label>
				<input type="email" class="form-control" name="usmail" id="usmail" placeholder="alguno@gmail.com" required>
			</div>
			<!-- Habilitado -->
			<div class="mb-2">
				<label for="Duenio">Habilitado</label>
				<input type="date" class="form-control" name="usdeshabilitado" id="usdeshabilitado">
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
include_once("../../estructura/pie.php");
?>