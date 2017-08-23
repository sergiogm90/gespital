<?php

class Usuario {

    public static function searchIdDB($id) {
        $database = medoo::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $datos = $database->select('autores', '*', ["id[=]" => $id]);
        $database->closeConnection();
        return $datos;
    }
    
    public static function searchAllDB() {
        $database = medoo::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $datos = $database->select('autores', '*');
        $database->closeConnection();
        return $datos;
    }

    public static function modifyDB($data, $id) {
        $database = medoo::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $datos = $database->update('autores', $data, ['id' => $id]);
        $database->closeConnection();
        return $datos;
    }

    public static function removeDB($id) {
        $database = medoo::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $datos = $database->delete('autores', ["id[=]" => $id]);
        $database->closeConnection();
        return $datos;
    }
    
    public static function insertDB($data) {
        $database = medoo::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $datos = $database->insert('autores', $data);
        $database->closeConnection();
        return $datos;
    }

}
