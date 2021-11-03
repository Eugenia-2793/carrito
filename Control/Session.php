<?php

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    
    /**
     * modifica un atributo de session a partir de la descripcion del atrbuto
     * y su valor, pasados por parametro
     * @param string $nombreAtributo
     * @param $valor (puede ser de cualquier tipo)
     *
     */
    public function setAtributo($nombreAtributo, $valor)
    {
        if (
            session_status() === PHP_SESSION_ACTIVE
            && is_string($nombreAtributo)
        ) {
            $_SESSION[$nombreAtributo] = $valor;
        }
    }



    /**
     * Retorna valor de atributo cuya descripcion es pasada por parametro
     * @param string $nombreAtributo
     * @return $atributo
     */

    public function getAtributo($nombreAtributo)
    {
        $atributo = null;
        if (
            session_status() === PHP_SESSION_ACTIVE
            && is_string($nombreAtributo)
            && isset($_SESSION[$nombreAtributo])
        ) {
            $atributo = $_SESSION[$nombreAtributo];
        }

        return $atributo;
    }


   
    /**
     * Elimina atributo cuya descripcion es pasada por parametro
     * @param string $nombreAtributo
     */
    public function borrarAtributo($nombreAtributo)
    {
        if (
            session_status() === PHP_SESSION_ACTIVE
            && is_string($nombreAtributo)
            && isset($_SESSION[$nombreAtributo])
        ) {
            unset($_SESSION[$nombreAtributo]);
        }
    }



    /**
     * Setea los datos en la session iniciandola
     * @param array $datos
     * @return boolean
     */
    public function iniciarSession($datos)
    {
        $this->session_started;
        $this->setAtributo("usuario", $datos["NombreUsuario"]);
        $this->setAtributo("login", $datos["login"]);
        $this->setAtributo("rol", $datos["roles"]);
        $this->setAtributo("idusuario", $datos["idusuario"]);

        $resp = true;

        return $resp;

        /*	OPCIÓN PARA RECUPERAR $ID DE SESSION
		LA DEJO PARA TENERLA
		$id= session_id();
		$this-> setSession_id ($id);
		return $id;
		}
		public function setSession_id ($id){
			$_SESSION["key"]= $id;
		}*/
    }


    /**
     * Chequea si hay permiso de administrador entre los roles de la session iniciada
     * 
     */
    public function esAdministrador()
    {
        $resp = false;
        $roles = $_SESSION["rol"];
        foreach ($roles as $rol) {
            if ($rol == "admin") {
                $resp = true;
            }
        }
        return $resp;
    }



    /**
     * Busca el status de la session
     * Averigua si es = a ACTIVA
     * @return boolean
     */
    public function activa()
    {
        $resp = true;
        session_status();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $resp = false;
        }
        return $resp;
    }



    /**
     * Busca si hay un usuario logueado en la session y si tiene permiso de administrador
     * si no lo hay devuelve falso
     * @return boolean
     */
    public function validar()
    {
        $resp = false;
        if (isset($_SESSION["login"])) {
            $pag = $_SERVER["REQUEST_URI"];
            //echo($pag);
            if (
                $pag == "/carrito/vista/listarUsuario.php" ||
                $pag == "/carrito/vista/listarRoles.php" ||
                $pag == "/carrito/vista/actualizarlogin.php" ||
                $pag == "/carrito/vista/eliminarUsuario.php"
            ) {
                //echo "estoy en la pagina";
                if ($this->esAdministrador() != true) {

                    header("location: http://localhost/carrito/vista/index/home.php");
                }
            }
            $resp = true;
        }
        return $resp;
    }



    /**
     * Destruye la session creada.
     */
    public function cerrarSession()
    {
        session_destroy();
    }


    /*---------------- MOSTRAR VALORES DE SESSION ----------------*/

    /*public function mostrarValorVariables()
    {
        print_object($_SESSION);
    }*/
}
