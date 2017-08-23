<?php

class ListadoParser {

    public static function loadContent($vista) {
        $vista = self::_pasoSiguiente($vista);
        return $vista;
    }

    private static function _pasoSiguiente($vista) {
        foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
            $str = '';
            switch ($tag) {
                case 'listado':
                    $datos = $_SESSION['datos'];
                    if (count($datos) > 0) {
                        $str = "<table border='1'>
                            <thead>
                            <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            </tr>
                            </thead>
                            ";
                        foreach ($datos as $usuario) {
                            $str .= "
                                <tr>
                                <td>" . $usuario['id'] . "</td>
                                <td><strong>" . $usuario['nombre'] . "</strong></td>
                                <td><strong>" . $usuario['apellidos'] . "</strong></td>    
                                </tr>
                                ";
                        }
                        $str .= "</table>";
                    } else
                        $str = '<p> <b>No se han encontrado resultados...</b></p>';
                    break;
            }
            $vista = str_replace('{{' . $tag . '}}', $str, $vista);
        }
        return $vista;
    }

}
