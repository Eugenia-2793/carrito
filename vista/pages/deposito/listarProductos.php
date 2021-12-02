<?php
$Titulo = "Listar Productos";
include_once("../../estructura/cabecera.php");

$objAbmProducto = new AbmProducto();
$listaProducto = $objAbmProducto->buscar(null);

$encuentraRol = false;

if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol == 2) {
            $encuentraRol = true;
        }
    }
}

if ($encuentraRol) {
?>
    <section>
        <h2>Listar Productos</h2>

        <!-- Boton Agregar Producto -->
        <div class="mb-2 d-flex justify-content-end">
            <a class="btn btn-primary" href="agregarProducto.php" role="button"><i class="fas fa-plus"></i> Nuevo Producto</a>
        </div>

        <!-- Listado de Productos -->
        <div class="row mb-5">
            <form id="listarProductos" name="listarProductos" method="POST" action="modificarProducto.php" data-toggle="validator">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Detalles</th>
                                <th scope="col" class='text-center'>Tipo</th>
                                <th scope="col" class='text-center'>Stock</th>
                                <th scope="col" class='text-center'>Precio</th>
                                <th scope="col" class='text-center'>Editar</th>
                            </tr>
                        </thead>
                        <?php

                        if (count($listaProducto) > 0) {
                            $i = 1;
                            echo '<tbody>';
                            foreach ($listaProducto as $objAbmProducto) {
                                $id =  $objAbmProducto->getIdProducto();
                                $nombre = $objAbmProducto->getProNombre();
                                $detalle =  $objAbmProducto->getProDetalle();
                                $tipo = $objAbmProducto->getProTipo();
                                $stock = $objAbmProducto->getProStock();
                                $precio = $objAbmProducto->getProPrecio();

                                echo '<tr class="align-middle">';
                                echo '<th scope="row">' . $i . '</th>';
                                echo '<td>' . $nombre .  '</td>';
                                echo '<td><div class="td-detalles">' . $detalle .  '</div></td>';
                                echo '<td class="text-center">' . $tipo .  '</td>';
                                echo '<td class="text-center">' . $stock .  '</td>';
                                echo '<td class="text-center">' . $precio .  '</td>';
                                echo "<td  class='text-center'>
                                <button class='btn btn-success btn-sm' type='submit' value='" . $id . "' id='idproducto' name='idproducto' role='button'>
                                <i class='fa fa-pen'> </i>
                                </button>    
                                <button class='btn btn-danger btn-sm' type='submit' value='" . $id . "' id='idproducto' name='idproducto' role='button' formaction='eliminarProducto.php'>
                                <i class='fas fa-trash-alt'></i>
                                </button>
                            </td>";

                                $i++;
                            }
                            echo '</tbody>';
                            echo '</table>';
                        }

                        ?>


                </div>
            </form>
        </div>
    </section>

<?php
} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>