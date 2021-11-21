<?php

class Compra
{
    private $idcompra;
    private $cofecha;
    private $idusuario;
    private $comprecio;
    private $mensajeoperacion;


    public function __construct()
    {
        $this->idcompra = "";
        $this->cofecha = "";
        $this->idusuario = new Usuario();
        $this->comprecio = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idcompra, $cofecha, $idusuario, $comprecio)
    {
        $this->setIdCompra($idcompra);
        $this->setCoFecha($cofecha);
        $this->setIdUsuario($idusuario);
        $this->setIdUsuario($comprecio);
    }

    public function getIdCompra()
    {
        return $this->idcompra;
    }
    public function setIdCompra($idcompra)
    {
        $this->idcompra = $idcompra;
    }

    public function getCoFecha()
    {
        return $this->cofecha;
    }
    public function setCoFecha($cofecha)
    {
        $this->cofecha = $cofecha;
    }

    public function getIdUsuario()
    {
        return $this->idusuario;
    }
    public function setIdUsuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

      public function getcomPrecio()
    {
        return $this->comprecio;
    }
    public function setcomPrecio($comprecio)
    {
        $this->comprecio = $comprecio;
    }
   

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($msj)
    {
        $this->mensajeoperacion = $msj;
    }


    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdCompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdUsuario($row['idusuario']);
                        $objUsuario->cargar();
                    }

                    $this->setear($row['idcompra'], $row['cofecha'], $objUsuario, $row['comprecio']);
                    $resp = true;
                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compra (cofecha, idusuario, comprecio) VALUES ('{$this->getCoFecha()}','{$this->getIdUsuario()->getIdUsuario()}', '{$this->getcomPrecio()}');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdCompra($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra SET idcompra='{$this->getIdCompra()}', cofecha='{$this->getCoFecha()}', idusuario='{$this->getIdUsuario()->getIdUsuario()}', comprecio='{$this->getcomPrecio()}' WHERE idcompra='{$this->getIdCompra()}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compra WHERE idcompra=" . $this->getIdCompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Compra->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->eliminar: " . $base->getError());
        }
        return $resp;
    }

    //REVISAR ESTA FUNCION CUANDO SE CREA EL OBJETO COMPRA.---------------------------------------------
    
    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Compra();

                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdUsuario($row['idusuario']);
                        $objUsuario->cargar();
                    }
                    //el idpadre????
                    //$obj->setear($row['idcompra'], $row['cofecha'], $objUsuario, $row['idpadre'], $row['medeshabilitado']);
                   $obj->setear($row['idcompra'], $row['cofecha'], $objUsuario, $row['comprecio']);
                   array_push($arreglo, $obj);
                }
            }
        } else {
            //$this->setmensajeoperacion("Compra->listar: " . $base->getError());
        }

        return $arreglo;
    }
}
