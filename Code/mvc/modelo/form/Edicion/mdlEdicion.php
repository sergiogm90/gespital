<?php

class mdlEdicion extends Singleton {

    const PAGE = 'edicion';

    public function onGestionPagina() {
// ¡¡¡Cuidado!!!, aqui no se puede por la condición de siempre: if (getGet('pagina') != self::PAGE|| count($_POST) <= 0) return;
// porque a esta página se llega sin pulsar un botón.
        if (getGet('pagina') != self::PAGE)
            return;
        $search = $_SESSION['modificacion']['id'];
        if (is_null(getPost('edicion'))) {
            $datos = Usuario::searchIdDB($search);
            if (count($datos) > 0) {
// Utilizamos la validación para rellenar los campos del formulario.
                $val = Validacion::getInstance();
                $toValidate = $datos[0];
                $rules = array(
                    'nombre' => 'required|alpha_space',
                    'apellidos' => 'required|alpha_space'
                );
                $val->addRules($rules);
                $val->run($toValidate);
            } else
                redirectTo('index.php?pagina=mensaje');
        } else {
// Validamos
            $val = Validacion::getInstance();
            $toValidate = $_POST;
            $rules = array(
                'nombre' => 'required|alpha_space',
                'apellidos' => 'required|alpha_space'
            );
            $val->addRules($rules);
            $val->run($toValidate);
// Guardamos los datos en la sesión
            if ($val->isValid()) {
                $_SESSION[self::PAGE] = $val->getOks();
                $id = $_SESSION['modificacion']['id'];
// Guardamos en el array datos los datos de $_SESSION['edicion'] que sólo contiene el nombre pero el método Usuario::modifyDB espera un array
                $data = $_SESSION['edicion'];
                $datos = Usuario::modifyDB($data, $id);
                if ($datos)
                    $_SESSION['mod'] = true;
                else
                    $_SESSION['mod'] = false;
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
        echo EdicionParser::loadContent($vista);
    }

}
