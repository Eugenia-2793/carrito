<?php
class AbmRol
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto
     * @param array $param
     * @return rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idrol', $param)
            and array_key_exists('rodescripcion', $param)
        ) {
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['rodescripcion']);
        }
        return $obj;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto que son claves
     * @param array $param
     * @return rol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setear($param['idrol'], "");
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
        if (isset($param['idrol']))
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
        $elObjtRol = $this->cargarObjeto($param);
        $elObjtMenu = new AbmMenu();

        if ($elObjtRol != null and $elObjtRol->insertar()) {
            //Recupero id nuevo del objeto insertado doy de alta un nuevo menú
            $param['idrol'] = $elObjtRol->getidrol();
            $resp = $elObjtMenu->altaMenu($param);
        }
        return $resp;
    }


    /**
     * BAJA
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        $elObjtMenu = new AbmMenu;
        $objMenuRol = new AbmMenuRol;
        $menuRol = $objMenuRol->buscar($param);

        if ($this->seteadosCamposClaves($param)) {
            $elObjtrol = $this->cargarObjetoConClave($param);
            if ($elObjtrol != null and $elObjtrol->eliminar()) {
                //Recupero idrol para dar de baja el menurol
                $resp = $elObjtMenu->bajaMenu($menuRol);
                echo "baja de abmrol: ";
                echo "<br>";
                echo "<br>";
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
            $buscar2['idrol'] = $param['idrol'];
            $larol = $this->buscar($buscar2);
            if ($larol != null) {
                $larol[0]->setroldescripcion($param['rodescripcion']);

                if ($larol[0] != null and $larol[0]->modificar()) {
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
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idrol']))
                $where .= " and idrol =" . $param['idrol'];
            if (isset($param['rodescripcion']))
                $where .= " and rodescripcion ='" . $param['rodescripcion'] . "'";
        }
        $arreglo = Rol::listar($where);
        return $arreglo;
    }
}
