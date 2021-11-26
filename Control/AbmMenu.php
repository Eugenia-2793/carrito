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
     * Creamos un nuevo menu con el nombre del nuevo rol
     * y idpadre = 0 por defecto. 
     * @param array $param
     * @return boolean
     */
    public function altaMenu($datos)
    {
        $resp = false;
        $nombreMenu = $datos['rodescripcion'];
        $param = ['idmenu' => "DEFAULT", 'menombre' => $nombreMenu, 'medescripcion' => "menu de rol " . $nombreMenu, 'idpadre' => 0, 'medeshabilitado' => "0000-00-00 00:00:00"];

        $elObjtMenu = $this->cargarObjeto($param);

        if ($elObjtMenu != null and $elObjtMenu->insertar()) {
            $param['idrol'] = $datos['idrol'];
            $param['idmenu'] = $elObjtMenu->getIdMenu();
            $resp = $this->altaMenuRol($param);;
        }
        return $resp;
    }


    /**
     * Creamos un nuevo menurol con el idrol y el idmenu
     * @param array $param
     * @return boolean
     */
    public function altaMenuRol($datos)
    {
        $resp = false;
        $idmenu = $datos['idmenu'];
        $idrol = $datos['idrol'];
        $elObjtMenuRol = new AbmMenuRol();
        $param = ['idmenu' => $idmenu, 'idrol' => $idrol];

        if ($elObjtMenuRol->alta($param)) {
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
     * Creamos un nuevo menu con el nombre del nuevo rol
     * y idpadre = 0 por defecto. 
     * @param array $param
     * @return boolean
     */
    public function bajaMenu($param)
    {
        $resp = false;
        $datos['idmenu'] = $param[0]->getIdMenu()->getIdMenu();
        $datos['idrol'] = $param[0]->getIdRol()->getidrol();

        if ($this->seteadosCamposClaves($datos)) {
            $elObjtMenu = $this->cargarObjetoConClave($datos);
            if ($elObjtMenu != null and $elObjtMenu->eliminar()) {
                $resp = $this->bajaMenuRol($datos);
            }
        }
        return $resp;
    }


    /**
     * Creamos un nuevo menurol con el idrol y el idmenu
     * @param array $datos
     * @return boolean
     */
    public function bajaMenuRol($datos)
    {
        $resp = false;
        $elObjtMenuRol = new AbmMenuRol();

        if ($elObjtMenuRol->baja($datos)) {
            $resp = true;
            echo "bajamenurol de abmmenu: ";
            echo "<br>";
            echo "<br>";
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
}
