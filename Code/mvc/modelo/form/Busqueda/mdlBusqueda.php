<?php

class mdlBusqueda extends Singleton {

    const PAGE = 'busqueda';

    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE)
            return;
// Validamos
        $val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
        $toValidate = ($_POST);
        $rules = array(
            'id' => 'required|number'
        );
        $id = getPost('id');
        $val->addRules($rules);
        $val->run($toValidate);
        if (!is_null(getPost(self::PAGE))) {
            if ($val->isValid()) {
// Guardamos los datos en session
                $_SESSION[self::PAGE] = $val->getOks();
                $_SESSION['datos'] = Usuario::searchIdDB($id);
// Cambiamos el paso
                redirectTo('index.php?pagina=listado');
            }
        }
    }

    public function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE)
            return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo BusquedaParser::loadContent($vista);
    }

}
