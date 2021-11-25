<?php
$Titulo = "Listar nuevo";
include_once("../../estructura/cabecera.php");

?>

<h2 class="mt-5">Nuevo menu</h2>
<p>Los campos con "*" son obligatorios</p>


<form id="nueva" name="nueva" method="POST" action="abmMenu.php" data-toggle="validator">
	<div class="row mx-md-3 justify-content-center">
        <!--Clave primaria-->
		<input id="idmenu" name="idmenu" value="null" type="hidden">

		<!-- Nombre--> 
		<div class="col-sm-8 col-md-6 col-lg-3 mb-3">
			<label for="Nombre" class="control-label">Nombre *</label>
			<input type="text" class="form-control" name="menombre" id="menombre"  required>
		</div>
		<!-- Contrasenia -->
		<div class="col-sm-8 col-md-6 col-lg-3 mb-3">
			<label for="Contrasenia">Descripcion *</label>
			<input type="text" class="form-control" name="medescripcion" id="medescripcion" required>
		</div>
		<!-- mail -->
		<div class="col-sm-8 col-md-6 col-lg-3 mb-3">
			<label for="mail">Padre * </label>
			<input type="text" class="form-control" name="idpadre" id="idpadre"  required>
		</div>
		<!-- Habilitado -->
		<div class="col-sm-8 col-md-6 col-lg-3 mb-3">
			<label for="Duenio">Habilitado</label> 
            <input type="date" class="form-control"  name="medeshabilitado" id="medeshabilitado">
		</div>
		
	</div>
	<!-- accion = nuevo (input oculto) -->
	<input id="accion" name="accion" value="crear" type="hidden">
	<!-- Botón enviar -->
	<div class="text-center mt-3 mb-5">
		<input class="btn btn-danger btn-lg"  type="reset" value="Limpiar">
		<input class="btn btn-primary btn-lg"  type="submit" value="Enviar">
	</div>
</form>


<?php
include_once("../../estructura/pie.php");
?>

