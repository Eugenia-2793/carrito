<?php
$Titulo = "Listar Productos";
include_once("../../estructura/cabecera.php");

$colProducto = new AbmProducto();
$listaProducto = $colProducto->buscar(null);
//print_r($listaProducto);
?>

<!-- <style>
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
</style> -->


<section>
<div class="container">
    <h2>Comprar Productos</h2>

    <a href="verCarrito.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i></a>

  <div id="products" class="row list-group">
        <?php
        //get rows query
        /*$query = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 10");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){*/

        if (count($listaProducto) > 0 ) {
           
            echo '<tbody>';
            foreach ($listaProducto as $colProducto) {
                if(($es = $colProducto->getProStock()) >= 1 ){
               $id = $colProducto->getidProducto();
               $nombre = $colProducto->getProNombre();
               $detalle = $colProducto->getProDetalle();
               $precio = $colProducto->getProPrecio();

          ?>
        <div class="item col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h4 class="list-group-item-heading"><?php echo $nombre; ?></h4>
                    <p class="list-group-item-text"><?php echo $detalle; ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?php echo '$'. $precio; ?></p>
                        </div>
                        <!---------------->
                        <form id="productos" name="productos" method="POST" action="carritoAccion.php" data-toggle="validator">
                        <div class="col-md-6">
                            <input type="hidden" class="btn btn-success" id="producto" name="producto" value="<?php echo $id; ?>">
                            <input class="btn btn-success" type="submit" value="Agregar al carrito">
                        </div>
                        </form>
                        <!---------------->
                    </div>
                </div>
            </div>
        </div>
        <?php } } }else{ ?>
        <p>Product(s) not found.....</p>
        <?php } ?>
      </div>
    </div>

  <!--------------------------------------------------------------------->









</section>

<?php
include_once("../../estructura/pie.php");
?>