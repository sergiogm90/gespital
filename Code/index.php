<?php
require_once "include.php";
Session::startSession();

if (is_null(getGet('pagina')))
    Session::closeSession();
Controlador::init();
