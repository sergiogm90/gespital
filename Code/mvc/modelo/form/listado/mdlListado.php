<?php

class mdlListado extends Singleton {

    const PAGE = 'listado';

    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE)
            return;
// Si no ha pasado por el paso Busqueda (si se modifica el valor de la variable en la url), se vuelve a visualizar la página inicial
        if (!isset($_SESSION['busqueda']) && !isset($_SESSION['listar']))
            redirectTo('index.php');
    }

    public function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE)
            return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo ListadoParser::loadContent($vista);
    }

}
