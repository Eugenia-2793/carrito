<?php
class AbmUsuario
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param)
    {

        $obj = null;
        if (
            array_key_exists('idusuario', $param)
            and array_key_exists('usnombre', $param)
            and array_key_exists('uspass', $param)
            and array_key_exists('usmail', $param)
            and array_key_exists('usdeshabilitado', $param)
        ) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['usnombre'], $param['uspass'], $param['usmail'], $param['usdeshabilitado']);
        }
        return $obj;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], "", "", "", "");
        }
        return $obj;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idusuario']))
            $resp = true;
        return $resp;
    }

    /**
     * ALTA
     * @param array $param
     */
    public function alta($param)
    {
        $param['uspass'] = md5($param['uspass']);
        $resp = false;
        $param['idusuario'] = null;
        $elObjtUsuario = $this->cargarObjeto($param);

        if ($elObjtUsuario != null and $elObjtUsuario->insertar()) {
            //nuevo--------------------------------------------
            //Recupero id nueva del objeto insertado //rol name nuevoRol
            $param['idusuario'] = $elObjtUsuario->getidusuario();
            $resp = $this->altaUsuarioRolIngresante($param);
            //---------------------------------------------------
            //$resp = true;
        }
        return $resp;
    }

    //---------------------funciones de alta extra-------------------

    /**
     * instanciamos el usuarirol y asignamos un rol al nuevo
     * que por defecto es el cliente. 
     * DESDE REGISTRO
     * @param array $param
     * @return boolean
     */
    public function altaUsuarioRolIngresante($datos)
    {
        $resp = false;

        $usuarioRol = new AbmUsuariorol();
        $param = ['idusuario' => $datos['idusuario'], 'idrol' => 3];
        if ($usuarioRol->alta($param)) {
            $resp = true;
        }

        return $resp;
    }


    /**
     * objeto de la clase usuariorol donde se le asigna un nuevo rol
     *DESDE ADMINISTRADOR
     * @param array $datos array de datos de todo el obj usuario + nuevoRol
     * @return boolean
     */
    public function altaUsuarioRolExistente($datos)
    {
        $resp = false;
        $usuarioRol = new AbmUsuariorol();
        $param = ['idusuario' => $datos['idusuario'], 'idrol' => $datos['nuevoRol']];
        if ($usuarioRol->alta($param)) {
            $resp = true;
        }
        return $resp;
    }


    //-------------------------------------------------------------

    /**
     * BAJA 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtUsuario = $this->cargarObjetoConClave($param);
            if ($elObjtUsuario != null and $elObjtUsuario->eliminar()) {
                $param['idusuario'] = $elObjtUsuario->getidusuario();
                //$resp = $this->bajaUsuarioRolIngresante($param);
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * instanciamos el usuariorl y asinamos un rol al nuevo
     * que por defecto es el cliente. 
     * DESDE REGISTRO
     * @param array $param
     * @return boolean
     */
    public function bajaUsuarioRolIngresante($datos)
    {
        $resp = false;
        $objUsuario = new AbmUsuario();
        $objUsuarioRol = new AbmUsuarioRol();
        $filtro = array();
        $filtro['idusuario'] = $datos['idusuario'];
        $abmusuariorol = new AbmUsuarioRol;
        $user = $objUsuario->buscar($filtro);
        $idrol = $abmusuariorol->buscarRolesUsuario($user[0]);
        $bandera = true;
        for ($i = 0; $i < count($idrol) && $bandera; $i++) {
            $filtroRolDelete = array();
            $filtroRolDelete['idusuario'] = $datos['idusuario'];
            $filtroRolDelete['idrol'] = $idrol[$i];
            if (!($objUsuarioRol->baja($filtroRolDelete))) {
                $bandera = false;
            }
        }
        $resp = $bandera;

        return $resp;
    }


    /**
     * MODIFICACION
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $filtro = array();
        $filtro['idusuario'] = $param['idusuario'];
        /* Si el usuario envia el input de password vacío significa que no la modifica,
        por ende, debo asignarle la contraseña actual a $param */
        if ($param['uspass'] == "null") {
            $unabmUser = new AbmUsuario();
            $unUser = $unabmUser->buscar($filtro);
            $pass = $unUser[0]->getuspass();
            $param['uspass'] = $pass;
        } else {
            $param['uspass'] = md5($param['uspass']);
        }
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $buscar2 = array();
            $buscar2['idusuario'] = $param['idusuario'];
            $elUsuario = $this->buscar($buscar2);
            if ($elUsuario != null) {
                $elUsuario[0]->setusnombre($param['usnombre']);
                $elUsuario[0]->setuspass($param['uspass']);
                //$elUsuario[0]->setuspass($elUsuario[0]->getuspass());
                $elUsuario[0]->setusmail($param['usmail']);
                $elUsuario[0]->setusdeshabilitado($param['usdeshabilitado']);
                if ($elUsuario[0] != null and $elUsuario[0]->modificar()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }


    /**
     * MODIFICAR USUARIOROL
     * @param array $param
     * @return boolean
     */
    public function modificarUsuarioRol($param)
    {
        $resp = false;
        $filtro = array();
        $filtro['idusuario'] = $param['idusuario'];
        $param['uspass'] = md5($param['uspass']);
        $unabmUser = new AbmUsuario();
        $objUsuarioRol = new AbmUsuarioRol();
        $unUser = $unabmUser->buscar($filtro); // Usuario
        $idRolesUser = $objUsuarioRol->buscarRolesUsuario($unUser[0]); // Roles actuales del usuario

        $nuevoRol = $param['nuevoRol'];
        $filtroRol = array(); // Rol actual de la colección de roles y el id de usuario
        $filtroRol['idusuario'] = $param['idusuario'];

        $bandera = true;
        for ($i = 0; $i < count($nuevoRol) && $bandera; $i++) {
            $filtroRol['idrol'] = $nuevoRol[$i];
            $existerol = $objUsuarioRol->buscar($filtroRol);
            // Comprobamos que el usuario no tenga el rol con el id actual de la iteracion para agregarlo
            if ($existerol == null) {
                if (!($objUsuarioRol->alta($filtroRol))) {
                    $bandera = false;
                }
            }
        }

        /*
        // Agregamos los nuevos roles
        foreach ($nuevoRol as $idNuevoRol) {
            $filtroRol['idrol'] = $idNuevoRol[$i];
            $existerol = $objUsuarioRol->buscar($filtroRol);
            // Comprobamos que el usuario no tenga el rol con el id actual de la iteracion para agregarlo
            if ($existerol == null) {
                $objUsuarioRol->alta($filtroRol);
            }
        }
        */

        if ($bandera) {
            // Creamos un arreglo con los roles que debemos quitar
            $noRoles = []; // Arreglo con los roles que no tiene el usuario
            foreach ($idRolesUser as $unRol) {
                $encuentra = true;
                // Verifico que hayan roles en nuevoRol, si no, le asigno todos los roles de idRolesUser
                if ($nuevoRol != null) {
                    for ($i = 0; $i < count($nuevoRol); $i++) {
                        if ($nuevoRol[$i] == $unRol) {
                            $encuentra = false;
                        }
                    }
                    if ($encuentra) {
                        array_push($noRoles, $unRol);
                    }
                } else {
                    array_push($noRoles, $unRol);
                }
            }

            // Quitamos los roles que ya no estén
            foreach ($noRoles as $unNoRol) {
                $filtroRolDelete = array(); // Rol actual de la colección de roles y el id de usuario
                $filtroRolDelete['idusuario'] = $param['idusuario'];
                $filtroRolDelete['idrol'] = $unNoRol;

                $existeNorol = $objUsuarioRol->buscar($filtroRolDelete);
                // Comprobamos que el usuario no tenga el rol con el id actual de la iteracion para eliminarlo
                if ($existeNorol != null) {
                    if (!($objUsuarioRol->baja($filtroRolDelete))) {
                        $bandera = false;
                    }
                }
            }
        }
        $resp = $bandera;

        return $resp;
    }


    /**
     * BUSCAR
     * @param array $param
     * @return array
     */
    //($param = null)
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idusuario']))
                $where .= " and idusuario =" . $param['idusuario'];
            if (isset($param['usnombre']))
                $where .= " and usnombre ='" . $param['usnombre'] . "'";
            if (isset($param['uspass']))
                $where .= " and uspass ='" . $param['uspass'] . "'";
            if (isset($param['usmail']))
                $where .= " and usmail ='" . $param['usmail'] . "'";
            if (isset($param['usdeshabilitado']))
                $where .= " and usdeshabilitado ='" . $param['usdeshabilitado'] . "'";
        }
        $arreglo = Usuario::listar($where);
        return $arreglo;
    }


    /**
     * busca todos los usuarios
     * Busca los roles que tienen esos usuarios activos
     *
     * @return array multidimensional con arrays de objusuario/ array con sus roles
     */
    public function listarUsuarios($param)
    {
        $listaActivos = [];
        $listaUsuarios = $this->buscar($param);
        if (count($listaUsuarios) > 0) {
            foreach ($listaUsuarios as $usuario) {

                $roles = [];
                // $datosUSuario va a guardar un obj usuario y un array de roles de dicho usuario
                $datosUsuario = [];
                $usuarioRol = new AbmUsuarioRol();
                $roles = $usuarioRol->buscarDesRolesUsuario($usuario);
                array_push($datosUsuario, $usuario);
                array_push($datosUsuario, $roles);
                array_push($listaActivos, $datosUsuario);
            }
        }
        return $listaActivos;
    }
}//clase
