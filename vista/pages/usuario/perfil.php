<?php

 $Titulo = "Perfil de Usuario";
include_once '../../estructura/cabecera.php';

$sesion = new Session();
$datos = data_submitted();

if (!$sesion->activa()) {
    header('Location: login.php');
} else {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
    
        $user = $sesion->getidUser();
        $objAbmUsuario = new AbmUsuario();
        $filtro = array();
        $filtro['idusuario'] = $user;
        //print_r($datos);
        $unUsuario = $objAbmUsuario->buscar($filtro);
    } else {
        header('Location: cerrarSesion.php');
    }
}


foreach ($unUsuario as $usuarioEncontrado) {
    
    $id = $usuarioEncontrado->getidusuario();
    $nombre = $usuarioEncontrado->getusnombre();
    $pass = $usuarioEncontrado->getuspass();
    $mail = $usuarioEncontrado->getusmail();
    $usdeshabilitado = $usuarioEncontrado->getusdeshabilitado();


    echo "<h2 class='mt-5'> $nombre </h2>";
?>



<form id="edit" name="edit" method="POST" action="abmUsuario.php" data-toggle="validator">

  <?php
           //clave primeria
           echo ' <input id="idusuario" name="idusuario" value="' . $id . '" type="hidden">';
           //usnombre
           echo ' <input id="usnombre"  name="usnombre"  value="' . $nombre . '" type="hidden">';
           //uspass
           echo '<label for="Contrasenia">Contraseña *</label> <input class="form-control" type="text" id="uspass" name="uspass" value="' . $pass . '" >';
           //usmail
           echo '<label for="mail">Mail * </label> <input class="form-control" type="mail" id="usmail" name="usmail" value="' . $mail . '">';
           //usdeshabilitado
           echo ' <input id="usdeshabilitado" name="usdeshabilitado"  value="' . $usdeshabilitado . '" type="hidden">';
       }       
  ?>
 <!-----------ESTO SE ENVIARIA A UNA ACCION Y DE AHI AL ABMUSUARIO------------------->

       <!-- accion = nuevo (input oculto) -->
       <input id="accion" name="accion" value="editar" type="hidden">
       <!-- Botón enviar -->
       <div class="text-center mt-3 mb-5">
           <input class="btn btn-danger btn-lg"  type="reset" value="Limpiar">
           <input class="btn btn-primary btn-lg"  type="submit" value="Editar">
       </div>

 </form>


<?php
include_once("../../estructura/pie.php");
?>