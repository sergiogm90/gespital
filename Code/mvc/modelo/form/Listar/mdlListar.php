<?php

class mdlListar extends Singleton {

    const PAGE = 'listar';

    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE)
            return;
// Si no ha pasado por el paso Busqueda (si se modifica el valor de la variable en la url), se vuelve a visualizar la página inicial
        $_SESSION[self::PAGE]=true;
        $_SESSION['datos'] = Usuario::searchAllDB();
        redirectTo('index.php?pagina=listado');
    }

}