<?php
$Titulo = "Listado de Compras";
include_once("../../estructura/cabecera.php");

$objAbmCompra = new AbmCompra();
$filtro = array();
$filtro['idusuario'] = $user->getidusuario();
$listaCompra = $objAbmCompra->listarCompras($filtro);
$encuentraRol = false;
$name = $user->getusnombre();

if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol == 3) {
            $encuentraRol = true;
        }
    }
}

if ($encuentraRol) {
?>

    <section>
        <?php
        echo "<h2>Listado de Compras de " . $name . "</h2>";
        ?>
        <!-- Listado de Compras -->
        <div class="row mb-5" id="">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id Compra</th>
                            <th scope="col">Fecha Inicio</th>
                            <th scope="col">Fecha Fin</th>
                            <th scope="col" class='text-center'>Precio</th>
                            <th scope="col" class='text-center'>Estado</th>
                        </tr>
                    </thead>
                    <?php

                    if (count($listaCompra) > 0) {
                        foreach ($listaCompra as $abmCompra) {
                            $tipoestado = $abmCompra[1][0];
                            $listaHistorial = [];
                            if ($tipoestado != "iniciada") {
                                array_push($listaHistorial, $abmCompra);;
                            }
                        }
                        if (count($listaHistorial) > 0) {
                            $i = 1;
                            echo '<tbody>';
                            foreach ($listaHistorial as $objAbmCompra) {
                                // Obtenemos el estado de la compra
                                $estados = $objAbmCompra[1][0];

                                $idcompra = $objAbmCompra[0]->getIdCompra();
                                $precio = $objAbmCompra[0]->getcomPrecio();

                                // Obtenemos un objeto CompraEstado
                                $abmCompraEstado = new AbmCompraEstado;
                                $objCompraEstado = $abmCompraEstado->buscaObjCompraEstado($idcompra);
                                $fechaini = $objCompraEstado[0]->getCeFechaIni();
                                $fechafin = $objCompraEstado[0]->getCeFechaFin();

                                echo '<tr class="align-middle">';
                                echo '<th scope="row">' . $idcompra . '</th>';
                                echo '<td>' . $fechaini . '</td>';
                                echo '<td>' . $fechafin . '</td>';
                                echo '<td class="text-center">$ ' . $precio . '</td>';
                                switch ($estados) {
                                    case "iniciada":
                                        echo '<td class="text-center"><span class="badge bg-warning text-dark">' . $estados . '</span></td>';
                                        break;
                                    case "aceptada":
                                        echo '<td class="text-center"><span class="badge bg-success">' . $estados . '</span></td>';
                                        break;
                                    case "enviada":
                                        echo '<td class="text-center"><span class="badge bg-primary">' . $estados . '</span></td>';
                                        break;
                                    case "cancelada":
                                        echo '<td class="text-center"><span class="badge bg-danger">' . $estados . '</span></td>';
                                        break;
                                }
                                $i++;
                            }
                            echo '</tbody>';
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>

<?php

} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>