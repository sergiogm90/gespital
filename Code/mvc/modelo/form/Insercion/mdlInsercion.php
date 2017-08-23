<?php

class mdlInsercion extends Singleton {

    const PAGE = 'insercion';

    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE)
            return;
// Validamos
        $val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
        $toValidate = ($_POST);
        $rules = array(
            'nombre' => 'required|alpha_space',
            'apellidos' => 'required|alpha_space');
           $val->addRules($rules);
    $val->run($toValidate);
        if (!is_null(getPost(self::PAGE))) {
            if ($val->isValid()) {
// Guardamos los datos en session
                $_SESSION[self::PAGE] = $val->getOks();
// Al utilizar medoo, el argumento $data que se pasa a Socio::insertDB debe ser un array
                $data = $_SESSION['insercion'];
                $datos = Usuario::insertDB($data);
                
                if ($datos)
                    $_SESSION['ins'] = true;
                else
                    $_SESSION['ins'] = false;
// Cambiamos el paso
                redirectTo('index.php?pagina=mensaje');
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
        echo InsercionParser::loadContent($vista);
    }

}
