
<?php
$Titulo = "Editar usuarios";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$objAbmUsuario = new AbmUsuario();
$filtro = array();
$filtro['idusuario'] = $datos['accion'];
//print_r($datos);
$unUsuario = $objAbmUsuario->buscar($filtro);
?>
<h2 class="mt-5">Editar Usuarios</h2>

<a class="dropdown-item" href="../../pages/usuario/listar.php">
    <span class="fas fa-users fa-fw" aria-hidden="true" title="Usuarios"> </span> Volver a Usuarios
</a> <br>

<form id="editar" name="editar" method="POST" action="abmUsuario.php" data-toggle="validator">

  <?php
       
       foreach ($unUsuario as $usuarioEncontrado) {
           $id = $usuarioEncontrado->getidusuario();
           $nombre = $usuarioEncontrado->getusnombre();
           $pass = $usuarioEncontrado->getuspass();
           $mail = $usuarioEncontrado->getusmail();
           $usdeshabilitado = $usuarioEncontrado->getusdeshabilitado();
         
           //clave primeria
           echo ' <input id="idusuario" name="idusuario" value="' . $id . '" type="hidden">';
           //usnombre
           echo ' <label for="Nombre" class="control-label">Nombre *</label> <input type="text" class="form-control" name="usnombre" id="usnombre"  value="' . $nombre . '">';
           //uspass
           echo '<label for="Contrasenia">Contraseña *</label> <input class="form-control" type="text" id="uspass" name="uspass"value="' . $pass . '">';
           //usmail
           echo '<label for="mail">Mail * </label> <input class="form-control" type="mail" id="usmail" name="usmail" value="' . $mail . '">';
           //usdeshabilitado
           echo ' <label for="Duenio">Habilitado </label> <br>  <input type="date" id="usdeshabilitado" name="usdeshabilitado"  value="' . $usdeshabilitado . '">';

       }       
  ?>


       <!-- accion = nuevo (input oculto) -->
       <input id="accion" name="accion" value="editar" type="hidden">
       <!-- Botón enviar -->
       <div class="text-center mt-3 mb-5">
           <input class="btn btn-danger btn-lg"  type="reset" value="Limpiar">
           <input class="btn btn-primary btn-lg"  type="submit" value="Enviar">
       </div>




<?php
include_once("../../estructura/pie.php");
?>
