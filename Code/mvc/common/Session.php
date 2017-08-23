<?php

class Session {

   //GESTIONA EL INICIO DE SESION
    public static function startSession() {
// Retorna null si las sesiones no están habilitadas o hay una sesión iniciada
        if (session_status() != PHP_SESSION_NONE)
            return;
        session_start();
    }

    //GESTIONA EL CIERRE Y BORRADO DE LA COOKIE DE SESION DEL NAVEGADOR
    public static function closeSession() {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 3600, "/");
        }
        session_unset();
        session_destroy();
    }

    //REALIZA ISSET DE UNA VARIABLE DE SESION Y DEVUELVE SU VALOR
    public static function get($index) {
        return (isset($_SESSION[$index])) ? $_SESSION[$index] : null;
    }

    //ELIMINA UNA VARIABLE DE $_SESSION
    public static function del($index) {
        if (array_key_exists($index, $_SESSION))
            unset($_SESSION[$index]);
    }
}
