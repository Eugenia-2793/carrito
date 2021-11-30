<?php
include_once '../../../configuracion.php';

$sesion = new Session();
$datos = data_submitted();
print_r($datos);

$encuentraRol = false;
if (!$sesion->activa()) {
    header('Location: ../login/login.php');
} else {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {

        $user = $sesion->getUsuario();
        $usrol = $sesion->getRol();
        $rol = $usrol[0]->getobjrol();
        $descrp = $rol->getroldescripcion();

        $abmusuariorol = new AbmUsuarioRol;
        $idrol = $abmusuariorol->buscarRolesUsuario($user);

        $Titulo = "Carrito";
        foreach ($idrol as $unIdRol) {
            if ($unIdRol  == 3) {
                $encuentraRol = true;
            }
        }
        include_once("../../estructura/cabecera.php");
    } else {
        header('Location: ../login/cerrarSesion.php');
    }
}


if ($encuentraRol) {
?>

    <div class="container2">
        <h2 class="mb-3 text-center">Carrito de Compras</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acción</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody id="items">
                <tr>
                    <th scope="row">id</th>
                    <td>Café</td>
                    <td>1</td>
                    <td>
                        <button class="btn btn-info btn-sm">
                            +
                        </button>
                        <button class="btn btn-danger btn-sm">
                            -
                        </button>
                    </td>
                    <td>$ <span>500</span></td>
                </tr>
            </tbody>
            <tfoot>
                <tr id="footer">
                    <th scope="row" colspan="5">Carrito vacío - comience a comprar!</th>
                    <th scope="row" colspan="2">Total productos</th>
                    <td>10</td>
                    <td>
                        <button class="btn btn-danger btn-sm" id="vaciar-carrito">
                            Vaciar todo
                        </button>
                    </td>
                    <td class="font-weight-bold">$ <span>5000</span></td>
                </tr>
            </tfoot>
        </table>
    </div>


<?php
} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>