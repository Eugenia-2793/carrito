<?php
$Titulo = "Listar usuarios";
include_once("../../estructura/cabecera.php");

$objAbmCompra = new AbmCompra();
$listaCompra = $objAbmCompra->listarCompras(null);
$encuentraRol = false;
// print_r($listaCompra);


?>

  <section>
    <h2>Listado de Compras</h2>

    <!-- Boton Agregar Usuario 
    <div class="mb-2 d-flex justify-content-end">
      <a class="btn btn-primary" href="nuevo.php" role="button"><i class="fas fa-plus"></i> Nuevo Usuario</a>
    </div>-->

    <!-- Listado de usuarios -->
    <div class="row mb-5" id="">
      <form id="Usuario" name="Usuario" method="POST" action="editar.php" data-toggle="validator">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">idcompra</th>
                <th scope="col">Cofecha</th>
                <th scope="col">Coprecio</th>
                <th scope="col">Estado</th>
                <th scope="col" class='text-center'>Cambiar estado</th>
                <th scope="col" class='text-center'>Borrar</th>
              </tr>
            </thead>
            <?php

 if (count($listaCompra) > 0) {
     $i = 1;
     echo '<tbody>';
     foreach ($listaCompra as $objAbmCompra) {
       $idcompra = $objAbmCompra[0]->getIdCompra();
       $cofecha = $objAbmCompra[0]->getCoFecha();
       $idusuario = $objAbmCompra[0]->getIdUsuario()->getidusuario();
       $precio = $objAbmCompra[0]->getcomPrecio();
       $roles = "";

       foreach ($objAbmCompra[1] as $est) {
        $estados = $est ;
       }
 

       echo '<tr class="align-middle">';
       echo '<th scope="row">' . $idcompra . '</th>';
       echo '<td>'. $cofecha.'</td>';
       echo '<td>'. $precio.'</td>';
       echo '<td>'. $estados.'</td>';     
       echo '<td class="text-center"> 
               <button class="btn btn-success btn-sm" type="submit" value="' . $estados. '" formaction="editar.php" name="editar" id="editar">
               <i class="fa fa-pen"></i>
             </button> 
             </td>';
       echo '<td class="text-center"> 
               <button class="btn btn-danger btn-sm" type="submit" value="' . $idcompra. '" formaction="eliminar.php" name="idcompra" id="idcompra">
               <i class="fas fa-trash-alt"></i>
             </button> 
             </td>';

         $i++;
               echo '</tbody>';
               echo '</table>';

    }}
             ?>


        </div>
      </form>
    </div>
  </section>

<?php

include_once("../../estructura/pie.php");
?>