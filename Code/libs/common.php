<?php

//LIBRERIA DE FUNCIONES QUE FACILITA LA PROGRAMACIÓN DEL PROGRAMADOR

//OBTIENE TODOS LOS CAMPOS {{CAMPO}} DE UNA VISTA
function getTagsVista($vista){
    preg_match_all('/\{{(.*?)\}}/', $vista, $tags);
    return $tags[1];
}

// POR EL METODO GET REALIZA ISSET Y DEVUELVE EL VALOR AUTOMATICAMENTE
function getGet($name){
    return (isset($_GET[$name])) ? $_GET[$name] : null;
}

// POR EL METODO POST REALIZA ISSET Y DEVUELVE EL VALOR AUTOMATICAMENTE
function getPost($name){
    return (isset($_POST[$name])) ? $_POST[$name] : null;
}

//REALIZA ISSET DE UN ARRAY Y DEVUELVE SUS VALORES
function getArray($arr, $index ){
    return (isset($arr[$index])) ? $arr[$index] : null;
}

//CONVIERTE UN ARRAY A OBJETO
function arrayToObj($array){     // La clase StdClass es una clase predefinida en PHP vacía
    $object = new stdClass();
    foreach ($array as $key => $value) {
        // Si $value es un array estamos creando un objeto que contiene un array de objetos
        if (is_array($value)){
            $value = arrayToObj($value);
        }
        $object->$key = $value;
    }
    return $object;
}

//REDIRECCIONA A OTRA PAGINA
function redirectTo($url) {
    header ("Location: $url");
    exit;
}

//ENCUENTRA LA POSICION DE UNA CADENA
function contains($needle, $haystack) {
    return strpos($haystack, $needle) !== false;
}

//FUNCIONES DE COOKIES

//REALIZA ISSET DE COKKIE Y DEVUELVE SU VALOR
function getCookie($name){
    return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : null;
}

//AÑADE UNA COOKIE Y EL TIEMPO DE EXPIRACION EN DIAS
function addCookie($nombre, $valor, $tiempoDias){
    return setcookie($nombre, $valor, time() + ($tiempoDias * 24 * 60 * 60));
}

//BORRA UNA COOKIE
function eraseCookie($name){
    return setcookie($name, "", -3600);
}
//-------------------------------------------------------

