<?php
$Titulo = "Listar Productos";
include_once("../../estructura/cabecera.php");

$encuentraRol = false;
if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol == 3) {
            $encuentraRol = true;
        }
    }
}
if ($encuentraRol) {

//--------------------------------------------vamos a comprar
//-------------------------------------------------------------
$AbmObjCompra = new AbmCompra;
$id = $AbmObjCompra->recuperarIdusuario();
$filtro= array();
$filtro['idusuario'] = $id;
$micompra = $AbmObjCompra->micompra($filtro);
$idcompra = $micompra['idcompra'];
//productos
if($micompra['idcet'] == 1){
$objAbmProducto = new AbmProducto();
$listaProducto = $objAbmProducto->buscar(null);
?>



    <section>
        <h2>Listar Productos</h2>

        <!-- Listado de Productos -->
        <div class="row mb-5">
            <form id="Productos" name="Productos" method="POST" action="verCarrito.php" data-toggle="validator">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col" class='text-center'>Tipo</th>
                                <th scope="col" class='text-center'>Precio</th>
                                <th scope="col" class='text-center'>Comprar</th>
                            </tr>
                        </thead>
                        <?php

                        if (count($listaProducto) > 0) {
                            $i = 1;
                            echo '<tbody>';
                            foreach ($listaProducto as $objAbmProducto) {
                                $stock = $objAbmProducto->getProStock();

                                if($stock > 0){
                                $id =  $objAbmProducto->getIdProducto();
                                $nombre = $objAbmProducto->getProNombre();
                                $detalle =  $objAbmProducto->getProDetalle();
                                $tipo = $objAbmProducto->getProTipo();
                                $precio = $objAbmProducto->getProPrecio();

                                echo '<tr class="align-middle">';
                                echo '<td >' . $nombre .  '</td>';
                                echo '<td class="text-center">' . $tipo .  '</td>';
                                echo '<td class="text-center">' . $precio .  '</td>';
                                echo "<td  class='text-center'>
                                          <input type='checkbox' name='producto[]' value='" . $id . "'> 
                                     </td>";
                                echo '<input type="hidden" id="idcompra" name="idcompra" value="'.$idcompra.'">';

                                $i++;
                               }
                            }
                            echo '</tbody>';
                            echo '</table>';
                        }

                        ?>

                        <div class="mb-2 d-flex justify-content-end">
                            <button class="btn btn-success" type="submit"> Agregar al carrito</button>
                        </div>
                </div>
            </form>
        </div>
    </section>

<?php

     }else{
       include_once("../cliente/compra.php");
     }

//de permisos 
} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>