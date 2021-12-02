<?php
class AbmProducto
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Producto
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idproducto', $param) and array_key_exists('pronombre', $param) and array_key_exists('prodetalle', $param)
            and array_key_exists('procantstock', $param) and array_key_exists('proprecio', $param) and array_key_exists('protipo', $param)
        ) {
            $obj = new Producto();
            $obj->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock'], $param['proprecio'], $param['protipo']);
        }
        return $obj;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Producto
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idproducto'])) {
            $obj = new Producto();
            $obj->setear($param['idproducto'], null, null, null, null, null);
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
        if (isset($param['idproducto']))
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
        $elObjtProducto = $this->cargarObjeto($param);

        if ($elObjtProducto != null and $elObjtProducto->insertar()) {
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
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto != null and $elObjtProducto->eliminar()) {
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
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjeto($param);
            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
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
            if (isset($param['idproducto']))
                $where .= " and idproducto =" . $param['idproducto'];
            if (isset($param['pronombre']))
                $where .= " and pronombre =" . $param['pronombre'];
            if (isset($param['prodetalle']))
                $where .= " and prodetalle ='" . $param['prodetalle'] . "'";
            if (isset($param['procantstock']))
                $where .= " and procantstock ='" . $param['procantstock'] . "'";
            if (isset($param['proprecio']))
                $where .= " and proprecio ='" . $param['proprecio'] . "'";
            if (isset($param['protipo']))
                $where .= " and protipo ='" . $param['protipo'] . "'";
        }
        $arreglo = Producto::listar($where);
        return $arreglo;
    }




    /**
     * Recupera los productos por id en cantidad.
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscarProductoporId($datos)
    {
     //Array ( [producto] => Array ( [0] => 1 [1] => 2 ) )
     $productos = array();
      if(!(empty($datos['producto']))){
          foreach($datos['producto'] as $producto){
             $idProducto['idproducto'] = $producto;
             $unProducto = $this->buscar($idProducto);
            array_push($productos, $unProducto);
           }//foreach
      }//if
      //productos es un arreglo de arreglos
      return $productos;
    }//function


    /**
     * Si hay stock crea los items 
     * @param array $param
     * @return array
     */
    public function enStock($datos){
      //Array (  [idproducto] => Array ( [0] => 1 [1] => 5 ) 
      //         [cicantidad] => Array ( [0] => 5 [1] => 20 ) 
      //         [proprecio] => Array ( [0] => 350 [1] => 350 ))
      
     //print_r($datos);   
     $hayStock = false;
     $cant = count($datos['idproducto']);

     $listado = array('idproducto'=> '','pronombre' => '', 'protipo' =>'', 'prodetalle' => '' , 'procantstock' => '',  'proprecio' => '');
     for($i=0; $i < $cant; $i++){

        $cantidad= $datos['cicantidad'][$i];

        $objProducto = new AbmProducto();
        $idProducto = array();
        $idProducto['idproducto'] = $datos['idproducto'][$i];
        $listProductos = $objProducto->buscar($idProducto);
        $unProducto = $listProductos[0];
        
        $idproducto = $unProducto->getIdProducto();
        $pronombre = $unProducto->getProNombre();
        $protipo = $unProducto->getProTipo();
        $detalle = $unProducto->getProDetalle();
        $stock = $unProducto->getProStock();
        $precio = $unProducto->getProPrecio(); 

        $nuevostock = $stock - $cantidad;
        // echo "stock=". $stock;
        // echo "cantidad=". $cantidad;
        // echo "total=".$nuevostock;
        // ordenado como el ogt $obj->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock'], $param['proprecio'], $param['protipo']);
        $listado = array('idproducto'=> $idproducto,'pronombre' => $pronombre, 'protipo' =>$protipo, 'prodetalle' => $detalle , 'procantstock' => $nuevostock,  'proprecio' => $precio);
        $modifico = $this->modificacion($listado);   
           if($modifico){
              $hayStock= true;
           }//if
       
        }//foreach
    return $hayStock;
    }//function



}//clase


