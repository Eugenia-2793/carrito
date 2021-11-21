<?php
$Titulo = "Eliminar Producto";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$id = $datos['idproducto'];

$objProducto = new AbmProducto();
$filtro = array();
$filtro['idproducto'] = $datos['idproducto'];
$listProductos = $objProducto->buscar($filtro);
$unProducto = $listProductos[0];
/* Verificamos que el producto sea una película para eliminar los archivos */
$pronombre = $unProducto->getProNombre();
$detalle = $unProducto->getProDetalle();
$protipo = $unProducto->getProTipo();
?>

<section>
    <div class="row my-5">
        <form class="mb-5" id="eliminarProducto" method="POST" action="abmProducto.php">
            <div class="d-flex justify-content-center">
                <?php
                echo "<input class='d-none' id='idproducto' name='idproducto' type='hidden' value='" . $id . "'>";
                echo "<input class='d-none' id='pronombre' name='pronombre' type='hidden' value='" . $pronombre . "'>";
                echo "<input class='d-none' id='protipo' name='protipo' type='hidden' value='" . $protipo . "'>";
                echo "<div class='card text-center border border-3 border-primary' style='width: 25rem;'>
                <div class='card-body'>
                    <h4 class='card-title'>¡Atención!</h4>
                    <p class='card-text'>¿Realmente desea eliminar este producto?</p>
                    <button href='#' class='btn btn-primary' id='accion' name='accion' type='submit' value='borrar' style='width: 3rem;'>Sí</button>
                    <button href='#' class='btn btn-primary' id='accion' name='accion' type='submit' value='noAccion' style='width: 3rem;'>No</button>
                </div>
            </div>";
                ?>
            </div>
        </form>
    </div>
</section>

<?php
include_once("../../estructura/pie.php");
?>