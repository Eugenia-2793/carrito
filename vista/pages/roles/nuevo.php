<?php
$Titulo = "Listar usuarios";
include_once("../../estructura/cabecera.php");
?>

<h2 class="mt-5">Nuevo Rol</h2>



<form id="nueva" name="nueva" method="POST" action="abmRol.php" data-toggle="validator">
	<div class="row mx-md-3 justify-content-center">
        <!--Clave primaria-->
		<input id="idrol" name="idrol" value="null" type="hidden">

		<!-- Nombre--> 
		<div class="col-sm-8 col-md-6 col-lg-3 mb-3">
			<label for="Nombre" class="control-label">Descripcion *</label>
			<input type="text" class="form-control" name="rodescripcion" id="rodescripcion"  required>
		</div>

	<!-- accion = nuevo (input oculto) -->
	<input id="accion" name="accion" value="crear" type="hidden">
	<!-- Botón enviar -->
	<div class="text-center mt-3 mb-5">
		<input class="btn btn-danger btn-lg"  type="reset" value="Borrar">
		<input class="btn btn-primary btn-lg"  type="submit" value="Crear">
	</div>
</form>


<?php
include_once("../../estructura/pie.php");
?>