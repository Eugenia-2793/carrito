
<?php
$Titulo = "Editar menu";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$menuEncontrado = new AbmMenu();
$filtro = array();
$filtro['idmenu'] = $datos['accion'];
$unMenu = $menuEncontrado->buscar($filtro);

//print_r($unMenu);
?>
<h2 class="mt-5">Editar Menu</h2>

<a class="dropdown-item" href="../../pages/menu/listar.php">
    <span class="fas fa-users fa-fw" aria-hidden="true" title="menu"> </span> Volver a menu
</a> <br>

<form id="editar" name="editar" method="POST" action="abmMenu.php" data-toggle="validator">

  <?php
       
       foreach ($unMenu as $menuEncontrado) {
           $id =              $menuEncontrado->getIdMenu();
           $nombre =          $menuEncontrado->getMeNombre();
           $descripcion =     $menuEncontrado->getMeDescripcion(); 
           $padre =           $menuEncontrado->getIdPadre();
           $medeshabilitado = $menuEncontrado->getMeDeshabilitado();
         
          //clave primeria
             echo ' <input id="idmenu" name="idmenu" value="' . $id . '" type="hidden">';
          //usnombre
             echo ' <label for="Nombre" class="control-label">Nombre *</label> <input type="text" class="form-control" name="menombre" id="menombre"  value="' . $nombre . '">';
          //uspass
             echo '<label for="Descripcion">Descripcion *</label> <input class="form-control" type="text" id="medescripcion"  name="medescripcion" value="' . $descripcion . '">';
          //usmail
            echo '<label for="padre">Padre * </label> <input class="form-control" type="text" id="idpadre" name="idpadre" value="' . $padre . '">';
          //usdeshabilitado
             echo ' <label for="medeshabilitado">Habilitado </label> <br>  <input type="date" id="medeshabilitado" name="medeshabilitado"  value="' . $medeshabilitado . '">';

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
