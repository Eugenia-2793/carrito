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
        //print_r($param);
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
            $objcompra->cargar();


            //creo objeto usuario
            $objCompraEstadoTipo = new CompraEstadoTipo();
            $objCompraEstadoTipo->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objCompraEstadoTipo->cargar();


            //agregarle los otros objetos
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], $objcompra, $objCompraEstadoTipo, $param['cefechaini'], $param['cefechafin']);
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
        $resp = false;
        $param['idcompraestado'] = null;
        $elObjtArchivoE = $this->cargarObjeto($param);
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
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoE = $this->cargarObjeto($param);
            //var_dump($elObjtArchivoE);
            echo "<br>";
            echo "<br>";
            if ($elObjtArchivoE != null and $elObjtArchivoE->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * Cambiamos el tipo de la compraestado a ACEPTADA
     * @param array $param
     * @return boolean
     */
    public function aceptarCompra($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = new AbmCompraEstado;
            $filtro = array();
            $filtro['idcompra'] = $param['idcompraestado'];
            $listaCompraEstado = $objCompraEstado->buscar($filtro);

            $objCompraEstadoTipo = new AbmCompraEstadoTipo;
            $listaCompraEstadoTipo = $objCompraEstadoTipo->buscar(['idcompraestadotipo' => 2]);
            $listaCompraEstado[0]->setIdCompraEstadoTipo($listaCompraEstadoTipo[0]);
            if ($listaCompraEstado[0] != null and $listaCompraEstado[0]->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * Cambiamos el tipo de la compraestado a ENVIADA
     * @param array $param
     * @return boolean
     */
    public function enviarCompra($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = new AbmCompraEstado;
            $filtro = array();
            $filtro['idcompra'] = $param['idcompraestado'];
            $listaCompraEstado = $objCompraEstado->buscar($filtro);

            // $idcompraestado = $listaCompraEstado[0]->getIdCompraEstado();
            $objCompraEstadoTipo = new AbmCompraEstadoTipo;
            $listaCompraEstadoTipo = $objCompraEstadoTipo->buscar(['idcompraestadotipo' => 3]);
            // $idcompra = $param['idcompra'];
            //$idcompraestadotipo = 3;
            // $fechaini = $listaCompraEstado[0]->getCeFechaIni();
            $fechafin = date("Y-m-d H:i:s");

            $listaCompraEstado[0]->setIdCompraEstadoTipo($listaCompraEstadoTipo[0]);
            $listaCompraEstado[0]->setCeFechaFin($fechafin);
            if ($listaCompraEstado[0] != null and $listaCompraEstado[0]->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * Cambiamos el tipo de la compraestado a CANCELADA
     * @param array $param
     * @return boolean
     */
    public function cancelarCompra($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = new AbmCompraEstado;
            $filtro = array();
            $filtro['idcompra'] = $param['idcompraestado'];
            $listaCompraEstado = $objCompraEstado->buscar($filtro);

            $objCompraEstadoTipo = new AbmCompraEstadoTipo;
            $listaCompraEstadoTipo = $objCompraEstadoTipo->buscar(['idcompraestadotipo' => 4]);
            $fechafin = date("Y-m-d H:i:s");

            $listaCompraEstado[0]->setIdCompraEstadoTipo($listaCompraEstadoTipo[0]);
            $listaCompraEstado[0]->setCeFechaFin($fechafin);
            if ($listaCompraEstado[0] != null and $listaCompraEstado[0]->modificar()) {
            
                $ObjItems = new AbmCompraItem;
                $itemsdecompra = $ObjItems->buscar($filtro); 
                $i= 0;
                $idproductoidcantidad[]=array('idproducto' => '', 'cicantidad' =>'' ); //mofico productos (incremento) arreglo con idproducto y cantidad.
                 foreach($itemsdecompra as $item){

                    $idproductoidcantidad[$i]['idproducto']= $item->getIdProducto(); //obj
                    $idproductoidcantidad[$i]['cicantidad']= $item->getCiCantidad(); //cantis
                    $i++;
                 }
                   $objProducto = new AbmProducto();
                  // $cambiostock = $objProducto->cambiostock($idproductoidcantidad);2producto aumenta.3 borro item.


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

    //---------------------------------------PARA ADMINISTRAR--------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------

    /** 
     * Busca todos los usuariorol correspondientes a un objusuario
     * Lista todos los roles que tiene el usuario
     * @param object
     * @return array devuelve las descripciones de cada rol de dicho usuario
     */
    public function buscarDesEstadocompra($elObjtCompra)
    {
        $listaEstCom = [];
        $listaEstCom = $this->buscar(null); //obj usuariorol

        if (count($listaEstCom) > 0) { // $listaEstCom != ""
            $estados = [];
            //Agrego TODOS los estados que tenga el usuario en el array $estados
            foreach ($listaEstCom as $compraestado) {
                if ($compraestado->getIdCompra()->getIdCompra() == $elObjtCompra->getIdCompra()) {
                    $estadodescript = $compraestado->getIdCompraEstadoTipo()->getCetDescripcion();
                    array_push($estados, $estadodescript);
                }
            }
        }
        return $estados;
    }

      /** 
     * Busca todos los usuariorol correspondientes a un objusuario
     * Lista todos los roles que tiene el usuario
     * @param object
     * @return array devuelve las descripciones de cada rol de dicho usuario
     */
    public function recuperarestado($compra)
    {
        //idcompraestadotipo
        $unacompra = $compra[0];
        $objcompraestadotipo = $unacompra->getIdCompraEstadoTipo();
        
        
        // $idcet = $objcompraestadotipo[0];
        // $idcompraestadotipo = $idcet->getIdCompraEstadoTipo();
       
      return $objcompraestadotipo;
    }

    /**
     * Cambiamos el tipo de la compraestado a CANCELADA
     * @param int $param
     * @return array
     */
    public function buscaObjCompraEstado($param)
    {
        $objCompraEstado = new AbmCompraEstado;
        $filtro = array();
        $filtro['idcompra'] = $param;
        $listaCompraEstado = $objCompraEstado->buscar($filtro);

        return $listaCompraEstado;
    }
}//clase
