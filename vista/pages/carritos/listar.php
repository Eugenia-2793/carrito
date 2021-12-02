<?php
$Titulo = "Listado de Compras";
include_once("../../estructura/cabecera.php");

$objAbmCompra = new AbmCompra();
$listaCompra = $objAbmCompra->listarCompras(null);
$encuentraRol = false;
// print_r($listaCompra);

if ($sesion->activa()) {
  foreach ($idrol as $unIdRol) {
    if ($unIdRol == 1) {
      $encuentraRol = true;
    }
  }
}

if ($encuentraRol) {
?>

  <section>
    <h2>Listado de Compras</h2>

    <!-- Listado de Compras -->
    <div class="row mb-5" id="">
      <form id="ListaCompras" name="ListaCompras" method="POST" action="cancelarCompra.php" data-toggle="validator">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Id Compra</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <!-- <th scope="col" class='text-center'>Coprecio</th> -->
                <th scope="col" class='text-center'>Estado</th>
                <th scope="col" class='text-center'>Cambiar Estado</th>
              </tr>
            </thead>
            <?php

            if (count($listaCompra) > 0) {
              $i = 1;
              echo '<tbody>';
              foreach ($listaCompra as $objAbmCompra) {
                $idcompra = $objAbmCompra[0]->getIdCompra();
                //$cofecha = $objAbmCompra[0]->getCoFecha();
                $usnombre = $objAbmCompra[0]->getIdUsuario()->getusnombre();
                $precio = $objAbmCompra[0]->getcomPrecio();

                // Obtenemos el estado de la compra
                $estados = $objAbmCompra[1][0];

                // Obtenemos un objeto CompraEstado
                $abmCompraEstado = new AbmCompraEstado;
                $objCompraEstado = $abmCompraEstado->buscaObjCompraEstado($idcompra);
                $fechaini = $objCompraEstado[0]->getCeFechaIni();
                $fechafin = $objCompraEstado[0]->getCeFechaFin();


                echo '<tr class="align-middle">';
                echo '<th scope="row">' . $idcompra . '</th>';
                echo '<td>' . $usnombre . '</td>';
                echo '<td>' . $fechaini . '</td>';
                echo '<td>' . $fechafin . '</td>';
                //echo '<td class="text-center">' . $precio . '</td>';
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

                echo '<td class="text-center">';

                if ($estados == "iniciada") {
                  echo '<button class="btn btn-outline-success btn-sm" type="submit" value="' . $idcompra . '" formaction="aceptarCompra.php" name="idcompraestado" id="idcompraestado">
                          Aceptar
                        </button>
                        <button class="btn btn-outline-danger btn-sm" type="submit" value="' . $idcompra . '" name="idcompraestado" id="idcompraestado">
                          Cancelar
                        </button>';
                } elseif ($estados == "aceptada") {
                  echo '<button class="btn btn-outline-primary btn-sm" type="submit" value="' . $idcompra . '" formaction="enviarCompra.php" name="idcompraestado" id="idcompraestado">
                          Enviar
                        </button>
                        <button class="btn btn-outline-danger btn-sm" type="submit" value="' . $idcompra . '" name="idcompraestado" id="idcompraestado">
                          Cancelar
                        </button>';
                }
                echo '</td>';
                $i++;
              }
            }
            ?>

        </div>
      </form>
    </div>
  </section>

<?php
  echo '</tbody>';
  echo '</table>';
} else {
  include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>