<?php

class Producto
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $precio;
    private $mensajeoperacion;


    public function __construct()
    {

        $this->idproducto = "";
        $this->pronombre = "";
        $this->prodetalle = "";
        $this->procantstock = "";
        $this->precio = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idproducto, $pronombre, $prodetalle, $procantstock, $precio)
    {
        $this->setIdProducto($idproducto);
        $this->setProNombre($pronombre);
        $this->setProDetalle($prodetalle);
        $this->setProStock($procantstock);
        $this->setPrecio($precio);
    }

    public function getIdProducto()
    {
        return $this->idproducto;
    }
    public function setIdProducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function getProNombre()
    {
        return $this->pronombre;
    }
    public function setProNombre($pronombre)
    {
        $this->pronombre = $pronombre;
    }

    public function getProDetalle()
    {
        return $this->prodetalle;
    }
    public function setProDetalle($prodetalle)
    {
        $this->prodetalle = $prodetalle;
    }
    public function getProStock()
    {
        return $this->procantstock;
    }
    public function setProStock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
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
        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdProducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['precio']);
                    $resp = true;
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO producto (pronombre, prodetalle, procantstock, precio) VALUES ('" . $this->getProNombre() . "','" . $this->getProDetalle() . "','" . $this->getProStock() . "','" . $this->getPrecio() . "');";
        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdProducto($base);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET idproducto='" . $this->getIdProducto() . "', pronombre='" . $this->getProNombre() . "', prodetalle='" . $this->getProDetalle() . "', procantstock='" . $this->getProStock() . "', precio='" . $this->getPrecio() . "' WHERE idproducto='" . $this->getIdProducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto=" . $this->getIdProducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['precio']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            //$this->setmensajeoperacion("Producto->listar: " . $base->getError());
        }

        return $arreglo;
    }
}
