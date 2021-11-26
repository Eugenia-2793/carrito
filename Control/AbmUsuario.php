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
        $resp = false;
        $param['idusuario'] = null;
        $elObjtUsuario = $this->cargarObjeto($param);

        if ($elObjtUsuario != null and $elObjtUsuario->insertar()) {
           $param['idusuario'] = $elObjtUsuario->getidusuario();
            $resp = $this->altaUsuarioRolIngresante($param);
        }
        return $resp;
    }

    //---------------------funciones de alta extra-------------------

    /**
     * instanciamos el usuariorl y asinamos un rol al nuevo
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
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * MODIFICACION
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
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
