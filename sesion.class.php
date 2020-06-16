<?php
class sesion
{
    public function __construct()
    {
        session_start();
    }

    public function set($nombre, $valor)
    {

        $_SESSION[$nombre] = $valor;
        $_SESSION['pw']    = $pw;
        $_SESSION['tipo']  = $tipo;
    }
    public function get($nombre)
    {
        if (isset($_SESSION[$nombre])) {
            return $_SESSION[$nombre];
        } else {
            return false;
        }
    }
    public function eliminaVariable($nombre)
    {
        unset($_SESSION[$nombre]);
    }
    public function terminaSesion()
    {
        $_SESSION = array();
        session_destroy();
    }
}
