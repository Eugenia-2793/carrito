<?php
class AbmCompraItem
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjeto($param)
    {
        //print_r ($param);
        $obj = null;
        if (
            array_key_exists('idcompraitem', $param) and array_key_exists('idproducto', $param)
            and array_key_exists('idcompra', $param) and array_key_exists('cicantidad', $param)
            and array_key_exists('itemprecio', $param)
        ) {

            //creo objeto estadotipos
            $objProducto = new Producto();
            $objProducto->setIdProducto($param['idproducto']);
            $objProducto->cargar();

            //creo objeto usuario
            $objCompra = new Compra();
            $objCompra->setIdCompra($param['idcompra']);
            $objCompra->cargar();

            //agregarle los otros objetos
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'], $objProducto, $objCompra, $param['cicantidad'], $param['itemprecio']);
        }
        return $obj;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraitem'])) {
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'], null, null, null, null);
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
        if (isset($param['idcompraitem']))
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
        $param['idcompraitem'] = null;
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
            if (isset($param['idcompraitem']))
                $where .= " and idcompraitem =" . $param['idcompraitem'];
            if (isset($param['idproducto']))
                $where .= " and idproducto =" . $param['idproducto'];
            if (isset($param['idcompra']))
                $where .= " and idcompra ='" . $param['idcompra'] . "'";
            if (isset($param['cicantidad']))
                $where .= " and cicantidad ='" . $param['cicantidad'] . "'";
            if (isset($param['itemprecio']))
                $where .= " and itemprecio ='" . $param['itemprecio'] . "'";    
        }
        $arreglo = CompraItem::listar($where);
        return $arreglo;
    }


   
   
    /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function altavariositems($param)
    { 
        $acomodados= $this->acomodar($param);
        $precioActualizado = $this->precioActualizadado($acomodados);
        // print_r($precioActualizado); 
        $cant = count($precioActualizado);
        $items = array();
        // echo "<br/> cantidad:". $cant;
        for($i=0; $i < $cant; $i++){
            $producto = $precioActualizado[$i];
            $secargo = $this->alta($producto);
              if($secargo){
                array_push($items, $producto);
               // $actualizarprecio= $this->actualizarprecio($items);
              }//if
         }//for
      //return $items ;
    }

    /**
     * hacer un arreglo de datos de item. acomodados
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function acomodar($param)
    { 
      //param = Array ( [idproducto] => Array ( [0] => 1 [1] => 3 ) [idcompra] => 27 [proprecio] => Array ( [0] => 350 [1] => 300 ) [cicantidad] => Array ( [0] => 3 [1] => 1 ) )
        $cant = count($param['idproducto']);
        $listado[] = array('idcompraitem'=> '','idproducto' => '', 'idcompra' =>'', 'cicantidad' => '' , 'itemprecio' => '');
        for($i=0; $i < $cant; $i++){
           $listado[$i]['idcompraitem'] = null;
           $listado[$i]['idproducto'] = $param['idproducto'][$i];
           $listado[$i]['idcompra'] = $param['idcompra'];
           $listado[$i]['cicantidad'] = $param['cicantidad'][$i];
           $listado[$i]['itemprecio'] = $param['itemprecio'][$i];
          
        }
        return $listado;
    }//finfuction

    /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function precioActualizadado($acomodados)
    { 
      $cant = count($acomodados);
      for($i=0; $i < $cant; $i++){
        $precio = $acomodados[$i]['itemprecio'] ;
        $cantidad = $acomodados[$i]['cicantidad'];
        $total = $precio * $cantidad;
        $acomodados[$i]['itemprecio'] = $total;
     }//for
     return $acomodados;
    }//function


    //actualizarprecio(producto)
        /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function actualizarprecio($productos){
        //ver si madno el objeto o por parametrosss-----------------------terminar.
        //modificar precio de una compra.
        $objCompra = new AbmCompra;
        $idcompra= $productos[0]['idcompra'];
        $unacompra = $objCompra->buscar($idcompra);
        $actualizacompra= array();
        foreach($unacompra as $parametros){
        }
        //print_r($unacompra);
        //echo $precio= $unacompra['comprecio'];

    }//function






}//clase