<?php
class AbmCompra
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idcompra', $param) and array_key_exists('cofecha', $param)
            and array_key_exists('idusuario', $param) and array_key_exists('comprecio', $param)
           
        ) {
            //creo objeto estadotipos
            $objUsuario = new Usuario();
            $objUsuario->setidusuario($param['idusuario']);       
            $objUsuario->cargar();
           

            //agregarle los otros objetos (aca se rompe)
            $obj = new Compra();
            $obj->setear($param['idcompra'], $param['cofecha'], $objUsuario, $param['comprecio']);
         
        }
        return $obj;
    }

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * carga solo las claves
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param)
    {
        print_r($param);
        $obj = null;
        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->setear($param['idcompra'], null, null, null);
        }
        return $obj;
        echo "</br>el print pero cargando con clave</br>";
        print_r($obj);
        echo "</br>-------------------------------------</br>";
    }

 
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * claves seteadas
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompra']))
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
        //print_r($param);
        $resp = false;
        $param['idcompra'] = null;
        $elObjCompra = $this->cargarObjeto($param);
       if ($elObjCompra != null and $elObjCompra->insertar()) {
           $resp = true;
        //ahora le seteo el estado iniciada a la nueva compra
        $param['idcompra'] = $elObjCompra->getIdCompra();
        $resp = $this->altaEstadoNueva($param);
       }
        return $resp;
    }

    /**
     * Carga un objeto con los datos pasados por parámetro y lo 
     * Inserta en la base de datos
     * @param array $param
     * @return boolean
     */
    public function altaEstadoNueva($param)
    { 
        echo "</br>entra a altaEstadoNueva </br>";
        $resp = false;
        $compraEstadoTipo = new AbmCompraEstado;
        $datos= ['idcompraestado' => null, 'idcompra' => $param['idcompra'], 'idcompraestadotipo' => 1, 'cefechaini' => $param['cofecha'] , 'cefechafin' => '0000-00-00 00:00:00'];
        //idcompraestado, idcompra, idcompraestadotipo, cefechaini, cefechafin
        //echo "</br> </br>";
        //Array ( [idcompraestado] => [idcompra] => 14 [idcompraestadotipo] => 1 [cefechaini] => 21-11-26 12:27:42 [cefechafin] => 0000-00-00 00:00:00 )
        if ($compraEstadoTipo->alta($datos)) {
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
     public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtArchivoE = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoE!=null and $elObjtArchivoE->eliminar()){
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
            if (isset($param['idcompra']))
                $where .= " and idcompra =" . $param['idcompra'];
            if (isset($param['cofecha']))
                $where .= " and cofecha =" . $param['cofecha'];
            if (isset($param['idusuario']))
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            if (isset($param['comprecio']))
                $where .= " and comprecio =" . $param['comprecio'];    
        }
        $arreglo = Compra::listar($where);
        return $arreglo;
    }

    /**
     * Si la compra existe trae los productos/items que tiene
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function existeCompra($param)
    {
        $id = $param['idusuario'];
        $existeObj = $this->cargarObjetoConClave($id);
       // print_r($existeObj);
        //recuperar los productos

    }

        /**
     * inicia una compra
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function nuevaCompra($param)
    {    
        $id= $param['idusuario'];
        $DateAndTime = date('y-m-d h:i:s ', time()); 

        $datos = array('idcompra'=> '', 'cofecha' => $DateAndTime, 'idusuario' => $id, 'comprecio' => 0 );
        $nuevoObj = $this->alta($datos); //booleano
        if($nuevoObj){  
            echo "todo salio bien :)";

        }
        


        //$compraEstadoTipo = new AbmCompraEstadoTipo;
        //$nuevoObj = $compraEstadoTipo->asignartipo();
        //con poner el compra estado tipo ya me deberia cargar el que yo quiero¿


        //print_r($nuevoObj);

    }

    /*
 INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');
 */

    


}//clase
