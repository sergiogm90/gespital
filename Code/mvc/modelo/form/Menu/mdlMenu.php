<?php

class mdlMenu extends Singleton {

    const PAGE = 'index';

    public function onGestionPagina() {
        if (self::PAGE != getGet('pagina', 'index'))
            return;
    }

    public function onCargarVista($path) {
        if (self::PAGE != getGet('pagina', 'index'))
            return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo $vista;
    }

}
