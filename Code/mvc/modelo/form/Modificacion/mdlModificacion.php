<?php

class mdlModifiacion extends Singleton {
const PAGE = 'modificacion';
public

function onGestionPagina() {
    if (getGet('pagina') != self::PAGE)
        return;
// Validamos
    $val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
    $toValidate = ($_POST);
    $rules = array(
        'id' => 'required|number'
    );
    $val->addRules($rules);
    $val->run($toValidate);
    if (!is_null(getPost(self::PAGE))) {
        if ($val->isValid()) {
// Guardamos los datos en session
            $_SESSION[self::PAGE] = $val->getOks();
// Cambiamos el paso
            redirectTo('index.php?pagina=edicion');
        }
    }
    }
    public

    function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE)
            return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo ModificacionParser::loadContent($vista);
    }

}
