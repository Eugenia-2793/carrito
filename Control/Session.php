<?php

class Session
{
    /** CONSTRUCTOR **/
    public function __construct()
    {
        session_start();
    }


    /** GETS Y SETS **/
    public function getIdUser()
    {
        return $_SESSION['idusuario'];
    }

    public function setIdUser($idUser)
    {
        $_SESSION['idusuario'] = $idUser;
    }

    public function getUserName()
    {
        return $_SESSION['usnombre'];
    }

    public function setUserName($userName)
    {
        $_SESSION['usnombre'] = $userName;
    }

    public function getPass()
    {
        return $_SESSION['uspass'];
    }
    public function setPass($pass)
    {
        $_SESSION['uspass'] = $pass;
    }


    /** INICIAR **/
    public function iniciar($nombreUsuario, $passUsuario)
    {
        $this->setUserName($nombreUsuario);
        $this->setPass($passUsuario);
    }


    /** VALIDAR **/
    public function validar()
    {

        $inicia = false;
        $nombreUsuario = $this->getUserName();
        $passUsuario = $this->getPass();
        $abmUsuario = new AbmUsuario();
        $where = array();
        $filtro1 = array();
        $filtro1['usnombre'] = $nombreUsuario;
        $filtro2 = array();
        $filtro2['uspass'] = $passUsuario;
        $where['usnombre'] = $nombreUsuario;
        $where['uspass'] = $passUsuario;
        $listaUsuarios = $abmUsuario->buscar($where);
        $username = $abmUsuario->buscar($filtro1);
        $pass =  $abmUsuario->buscar($filtro2);
        $error = "";
        if ($username == null) {
            $error .= "Este usuario no existe";
        } elseif ($pass == null) {
            $error .= "Contraseña incorrecta";
        }
        if (count($listaUsuarios) > 0) {
            $fechaDes = $listaUsuarios[0]->getUsdeshabilitado();
            if ($fechaDes != "0000-00-00 00:00:00") {
                $error .= "El usuario está deshabilitado";
            } else {
                $inicia = true;
                $this->setIdUser($listaUsuarios[0]->getidusuario());
            }
        }
        return array($inicia, $error);
    }


    /** ACTIVA **/
    public function activa()
    {
        $activa = false;
        if (isset($_SESSION['usnombre'])) {
            $activa = true;
        }
        return $activa;
    }


    /** GET USUARIO **/
    public function getUsuario()
    {
        $abmUsuario = new AbmUsuario();
        $where = ['idusuario' => $_SESSION['idusuario']];
        $listaUsuarios = $abmUsuario->buscar($where);
        if ($listaUsuarios >= 1) {
            $usuarioLog = $listaUsuarios[0];
        }
        return $usuarioLog;
    }


    /** GET ROL **/
    public function getRol()
    {
        $abmUsuarioRol = new AbmUsuarioRol();
        $usuario = $this->getUsuario();
        $idUsuario = $usuario->getIdUsuario();
        $param = ['idusuario' => $idUsuario];
        $listaRolesUsu = $abmUsuarioRol->buscar($param);
        if ($listaRolesUsu > 1) {
            $rol = $listaRolesUsu;
        } else {
            $rol = $listaRolesUsu[0];
        }
        return $rol;
    }


    /*---------------- PARA TERMINAR LA SESSION ----------------*/
    /**
     * Destruye la session creada.
     */
    public function cerrarSession()
    {
        session_unset();
        session_destroy();
    }


    /*---------------- MOSTRAR VALORES DE SESSION ----------------*/

    /*public function mostrarValorVariables()
    {
        print_object($_SESSION);
    }*/
}
