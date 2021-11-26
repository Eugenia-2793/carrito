<?php
class AbmCompraEstado
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto($param)
    {
        //Los param llegan bien Array ( [idcompraestado] => [idcompra] => 19 [idcompraestadotipo] => 1 [cefechaini] => 21-11-26 12:50:44 [cefechafin] => 0000-00-00 00:00:00 )
        $obj = null;
        if (
            array_key_exists('idcompraestado', $param) and array_key_exists('idcompra', $param)
            and array_key_exists('idcompraestadotipo', $param) and array_key_exists('cefechaini', $param)
            and array_key_exists('cefechafin', $param)
        ) {

            //creo objeto estadotipos
            $objcompra = new Compra();
            $objcompra->setIdCompra($param['idcompra']);
            $objcompra->cargar(); //primer error
            // echo "</br> ------------- la compra </br> ";
            // print_r($objcompra);

            //creo objeto usuario
            $objCompraEstadoTipo = new CompraEstadoTipo();
            $objCompraEstadoTipo->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objCompraEstadoTipo->cargar();
            // echo "</br> ------------- el estado tipo </br> ";
            // print_r($objCompraEstadoTipo);

            //agregarle los otros objetos
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], $objcompra, $objCompraEstadoTipo, $param['cefechaini'], $param['cefechafin']);
        //    echo "</br>  ya hecha la funcion cargar objeto </br>";
        //    print_r($obj);

        }
        return $obj;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraestado'])) {
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], null, null, null, null);
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
        if (isset($param['idcompraestado']))
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
        echo "entra al alta de Abmcompraestado </br>";
        $resp = false;
        $param['idcompraestado'] = null;
        $elObjtArchivoE = $this->cargarObjeto($param);
        //print_r($elObjtArchivoE);
        if ($elObjtArchivoE != null and $elObjtArchivoE->insertar()) {
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
    /* public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtArchivoE = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoE!=null and $elObjtArchivoE->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    } */

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
            $elObjtArchivoE = $this->cargarObjeto($param);
            if ($elObjtArchivoE != null and $elObjtArchivoE->modificar()) {
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
            if (isset($param['idcompraestado']))
                $where .= " and idcompraestado =" . $param['idcompraestado'];
            if (isset($param['idcompra']))
                $where .= " and idcompra =" . $param['idcompra'];
            if (isset($param['idcompraestadotipo']))
                $where .= " and idcompraestadotipo ='" . $param['idcompraestadotipo'] . "'";
            if (isset($param['cefechaini']))
                $where .= " and cefechaini ='" . $param['cefechaini'] . "'";
            if (isset($param['cefechafin']))
                $where .= " and cefechafin ='" . $param['cefechafin'] . "'";
        }
        $arreglo = CompraEstado::listar($where);
        return $arreglo;
    }
}
