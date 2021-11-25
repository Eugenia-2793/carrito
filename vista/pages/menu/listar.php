<?php
$Titulo = "Listar Menus";
include_once("../../estructura/cabecera.php");

$objAbmMenu = new AbmMenu();
//$listaMenu = $objAbmMenu->buscar(null);   
$listaMenu = $objAbmMenu->listarMenu(null);  
//print_r($listaMenu);
?>

<h2 class="mt-5">Listar Menu</h2>

 <!-- Boton Agregar menu -->
 <div class="mb-2 d-flex justify-content-end">
    <a class="btn btn-primary" href="nuevo.php" role="button"><i class="fas fa-plus"></i> Nuevo Menu</a>
  </div>

<!-- Listado de menus -->
<div class="row mb-5" id="">
  <form id="menu"  name="menu" method="POST" action="editar.php" data-toggle="validator">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Padre</th>
            <th scope="col">habilitado</th>
            <th scope="col">rol</th>
            <th scope="col" class='text-center'>Editar<th>
          </tr>
        </thead>
        <?php

        if (count($listaMenu) > 0) {
        // $i = 1;
          echo '<tbody>';
          foreach ($listaMenu as $objAbmMenu) {
             //$id =  $objAbmMenu->getidMenu();
             $id =           $objAbmMenu[0]->getIdMenu();
             $nombre =       $objAbmMenu[0]->getMeNombre();
             $descripcion =  $objAbmMenu[0]->getMeDescripcion(); 
             $padre =        $objAbmMenu[0]->getIdPadre(); 
             $habilitado =   $objAbmMenu[0]->getMeDeshabilitado(); 
            
            $roles="";
            foreach($objAbmMenu[1] as $rol){
              $roles = $roles. "". $rol. '  ';
            }

            echo '<tr class="align-middle">';
            echo '<th scope="row">' . $id. '</th>';
            echo '<td>' . $nombre .     '</td>';
            echo '<td>' . $descripcion. '</td>';
            echo '<td>' . $padre.'</td>';
            echo '<td>' . $habilitado.'</td>';
            echo '<td>'. $roles . '</td>';
         
            //<!---------en listas usussarios saca el id y lo manda por boton-------------->
            if($id > 3){
              echo "<td  class='text-center'>
                   <button type='submit' class='btn btns-success btn-sm' value=".$id." name='accion' id='accion'>
                   <i class='fa fa-pen'> </i>
                   </button>    
                   </td>     
                   ";
            }else{
              echo "<td  class='text-center'> </td>   " ;
            }
          }
          echo '</tbody>';
          echo '</table>';
        }else{
            echo "No hay menu(s) registrado en la Base de datos";
        }

        ?>


    </div>
  </form>
</div>

<?php
include_once("../../estructura/pie.php");
?>