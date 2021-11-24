<?php
$Titulo = "Nuevo Rol";
include_once("../../estructura/cabecera.php");
?>

<section>
	<h2 class="h2 mb-3 text-center">Nuevo Rol</h2>

	<form id="nueva" name="nueva" method="POST" action="abmRol.php" data-toggle="validator">
		<div class="form-signin mx-auto">
			<!--Clave primaria-->
			<input id="idrol" name="idrol" value="null" type="hidden">

			<!-- Nombre-->
			<div class="mb-2">
				<label for="Nombre" class="control-label">Descripción *</label>
				<input type="text" class="form-control" name="rodescripcion" id="rodescripcion" required>
			</div>
			<div id="obligatorio" class="form-text">Los campos con "*" son obligatorios</div>

			<!-- accion = nuevo (input oculto) -->
			<input id="accion" name="accion" value="crear" type="hidden">
			<!-- Botón enviar -->
			<div class="text-center mt-3 mb-5">
				<input class="btn btn-danger btn-lg" type="reset" value="Borrar">
				<input class="btn btn-primary btn-lg" type="submit" value="Crear">
			</div>
		</div>
	</form>
</section>

<?php
include_once("../../estructura/pie.php");
?>