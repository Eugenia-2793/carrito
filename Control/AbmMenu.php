<?php
class AbmMenu
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idmenu', $param) and array_key_exists('menombre', $param) and array_key_exists('medescripcion', $param)
            and array_key_exists('idpadre', $param) and array_key_exists('medeshabilitado', $param)
        ) {
            $obj = new Menu();
            $obj->setear($param['idmenu'], $param['menombre'], $param['medescripcion'], $param['idpadre'], $param['medeshabilitado']);
        }
        return $obj;
    }



    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idmenu'])) {
            $obj = new Menu();
            $obj->setear($param['idmenu'], null, null, null, null);
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
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }



    /**
     * Carga un objeto con los datos pasados por parámetro y lo 
     * Inserta en la base de datos
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;

        $elObjtMenu = $this->cargarObjeto($param);

        if ($elObjtMenu != null and $elObjtMenu->insertar()) {
            $resp = true;
        }
        return $resp;
    }



    /**
     * Por lo general no se usa ya que se utiliza borrado lógico ( es decir pasar de activo a inactivo)
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenu = $this->cargarObjetoConClave($param);
            if ($elObjtMenu != null and $elObjtMenu->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }



    /**
     * Carga un obj con los datos pasados por parámetro y lo modifica en base de datos (update)
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenu = $this->cargarObjeto($param);
            if ($elObjtMenu != null and $elObjtMenu->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }



    /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idmenu']))
                $where .= " and idmenu =" . $param['idmenu'];
            if (isset($param['menombre']))
                $where .= " and menombre =" . $param['menombre'];
            if (isset($param['medescripcion']))
                $where .= " and medescripcion ='" . $param['medescripcion'] . "'";
            if (isset($param['idpadre']))
                $where .= " and idpadre ='" . $param['idpadre'] . "'";
            if (isset($param['medeshabilitado']))
                $where .= " and medeshabilitado ='" . $param['medeshabilitado'] . "'";
        }
        $arreglo = Menu::listar($where);
        return $arreglo;
    }



    /**
     * busca todos los menu
     * Busca los roles que tienen esos menu 
     *
     * @return array multidimensional con arrays de objusuario/ array con sus roles
     */
    public function listarMenu($param)
    {
        $listaActivos = [];
        $listaMenus = $this->buscar($param);
        if (count($listaMenus) > 0) {
            foreach ($listaMenus as $menu) {

                $roles = [];
                // $datosmenu va a guardar un obj menu y un array de roles de dicho menu
                $datosMenu = [];
                $menuRol = new AbmMenuRol();
                $roles = $menuRol->buscarRolesMenu($menu);
                array_push($datosMenu, $menu);
                array_push($datosMenu, $roles);
                array_push($listaActivos, $datosMenu);
            }
        }
        return $listaActivos;
    }






}
