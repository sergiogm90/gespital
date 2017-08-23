<?php

class Validacion extends Singleton {

    private $_rules = array();
    private $_errors = array();
    private $_oks = array();
    private $_exists;//para el duplicado
    private $_telfRepeat;//para la repeticion
    private $_errorFoto; // cuando es una sola foto
//  private $_errorFoto=array(); cuando son varias fotos


    /*FUNCIONES GENERALES NO SE TOCAN
    --------------------------------------------------------------------------------------------*/
    public function addRules($rules) {$this->_rules = $rules;}

    public function run($toValidate) {
        foreach ($toValidate as $field => $value) {if (!array_key_exists($field, $this->_rules)) continue;
            $rules = explode('|', $this->_rules[$field]);
            if (in_array('required', $rules)) {$this->_validate_required($field, $value);
                if (getArray($this->getErrorsByField($field), 'rule') == 'required') continue;
            }
            foreach ($rules as $rule) {
                if ($rule == 'required') continue;
                $method = '_validate_' . $rule;
                if (!method_exists(__CLASS__, $method)) continue;
                $this->$method($field, $value);
            }
            if (empty($this->getErrorsByField($field))) $this->_setError($field, $value, 'ok');
        }}

    public function isValid() {
        if (count($this->_oks) == count($this->_errors))
            return true; return false;}

    public function getOks() {return $this->_oks;}

    public function getErrorsByField($field) {return getArray($this->_errors, $field, array());}

    public function getErrors() {return $this->_errors;}

    private function _setError($field, $value, $rule) {
        $this->_errors[$field] = array('value' => $value,'rule' => $rule);
        if ($rule == 'ok') {$this->_oks[$field] = $value;}}

    private function _validate_required($field, $value) {
        if (strlen($value) == 0) $this->_setError($field, $value, 'required');}

    public function setExists($dup) {$this->_exists = $dup;}

    public function setTelfRepeat($rep) {$this->_telfRepeat = $rep;}


    /*FUNCIONES DE VALIDACION
    -------------------------------------------------------------------------------------------------*/

    //VALIDAR ALFA CON ESPACIO
    private function _validate_alpha_space($field, $value) {
        if (!preg_match('/^[a-z][a-z\s]+$/i', $value)) {
            $this->_setError($field, $value, 'alpha_space');
        }
    }

    //VALIDAR NUMEROS
    private function _validate_numeric($field, $value) {
        if (!preg_match('/^\d+$/', $value)) {
            $this->_setError($field, $value, 'numeric');
        }
    }

    //VALIDAR ALFANUMERICO
    private function _validate_alpha_numeric($field, $value) {
        if (!preg_match('/^[a-z0-9][a-z0-9]+$/i', $value))
            $this->_setError($field, $value, 'alpha_numeric');
    }

    //VALIDAR TELEFONOS
    private function _validate_tel($field, $value) {
        if (!preg_match('/^\d{9}*$/', $value)) {
            $this->_setError($field, $value, 'tel');
        }
    }

    //VALIDAR DNI
    private function _validate_dni($field, $value) {
        if (!preg_match('/^\d{8}[a-z]$/i', $value)) {
            $this->_setError($field, $value, 'dni');
        }
    }

    //VALIDAR EMAIL
    private function _validate_email($field, $value){
        if (filter_var($value, FILTER_VALIDATE_EMAIL) == false) {
            $this->_setError($field, $value, 'email');
        }
    }

    //VALIDAR DUPLICADO DNI
    private function _validate_duplicate($field, $value) {
        if ($this->_exists)
            $this->_setError($field, $value, 'duplicate');
    }

    //VALIDAR REPETICION TELEFONO
    private function _validate_repeated($field, $value) {
        if ($this->_telfRepeat)
            $this->_setError($field, $value, 'repeated');
    }

    //VALIDAR 1 FOTO
    private function _validate_foto($field, $value) {

        if ($value["error"] == UPLOAD_ERR_OK) {

            if (($value["type"] != "image/pjpeg") and ( $value["type"] != "image/jpeg")) {
                $this->_setError($field, $value, 'foto');
                $this->_errorFoto = "<b>JPEG fotos solamente, gracias!</b>";

            } elseif (!move_uploaded_file($value["tmp_name"], "fotos/" . basename($value["name"]))) {
                $this->_setError($field, $value, 'foto');
                $this->_errorFoto = "<b>Lo sentimos, hubo un problema al subir esa foto</b>" . $value["error"];

            } else
                $this->_setError($field, $value, 'ok');
        } else {
            $this->_setError($field, $value, 'foto');

            switch ($value["error"]) {
                case UPLOAD_ERR_INI_SIZE:
                    $this->_errorFoto = "<b>La foto es más grande de lo que permite el servidor.<b>";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $this->_errorFoto = "<b>La foto es más grande de lo que permite el formulario.<b>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $this->_setError($field, $value, 'required');
                    break;
                default:
                    $this->_errorFoto = "Ponte en contacto con el administrador del servidor para obtener ayuda.";
            }
        }
    }

    //VALIDACION VARIAS FOTOS
    private function _validate_fotos($field, $value) {

        if ($value["error"] == UPLOAD_ERR_OK) {

            if (($value["type"] != "image/pjpeg") and ($value["type"] != "image/jpeg")) {
                $this->_setError($field, $value, 'foto');
                $this->_errorFoto["$field"]= "<b>Fotos JPEG solamente, gracias!</b>";

            } elseif ( !move_uploaded_file( $value["tmp_name"], "fotos/" . basename( $value["name"] ) ) ) {
                $this->_setError($field, $value, 'foto');
                $this->_errorFoto["$field"]= "<b>Lo sentimos, hubo un problema al subir esa foto</b>" .$value["error"] ;

            } else
                $this->_setError($field, $value, 'ok');

        } else {$this->_setError($field, $value, 'foto');

            switch( $value["error"] ) {
                case UPLOAD_ERR_INI_SIZE:
                    $this->_errorFoto["$field"] = "<b>La foto es más grande de lo que permite el servidor.<b>";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $this->_errorFoto["$field"]="<b>La foto es más grande de lo que permite el formulario.<b>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $this->_setError($field, $value, 'required');
                    break;
                default:
                    $this->_errorFoto["$field"] = "Ponte en contacto con el administrador del servidor para obtener ayuda.";
            }
        }
    }


    /*FUNCION DONDE PONES CADA CASO DE VALIDACION Y EL MENSAJE QUE QUIERES QUE SALGA CUANDO NO PASE LA VALIDACION
    -------------------------------------------------------------------------------------------------------------*/

    public function getStrRule($rule) {
        switch ($rule) {
            case 'alpha_space':
                return 'Solo puede contener letras (a-z,A-Z) y espacios en blanco';
                break;

            case 'numeric':
                return 'Solo puede contener dígitos [0-9]';
                break;

            case 'alpha_numeric':
                return 'Solo puede contener letras (a-z,A-Z) y dígitos [0-9]';
                break;

            case 'dni':
                return 'Formato DNI incorrecto';
                break;

            case 'tel':
                return 'Solo puede contener 9 dígitos [0-9]';
                break;

            case 'email':
                return 'Formato email incorrecto';
                break;

            case 'duplicate':
                return 'DNI duplicado';
                break;

            case 'repeated':
                return 'Telefono repetido';
                break;
        }
        return '';
    }

    /*FUNCIONES DE RESTORE
    ------------------------------------------------------------------------------------------------*/

    //TEXT,PASSWORD Y TEXTAREA
    public function restoreValue($name) {
        if (array_key_exists($name, $this->_errors)) {
            $value = $this->_errors[$name]['value'];
            return $value;
        }
        return '';
    }

    //CHECKBOX
    public function restoreCheckbox($name, $value, $default = false) {
        if (array_key_exists($name, $this->_errors)) {
            foreach ($this->_errors[$name]['value'] as $valor) {
                if ($valor == $value)
                    return 'checked';
            }
        } elseif ($default)
            return 'checked';
        return '';
    }

    //PARA CHECKBOX MULTIPLE
    public function restoreCheckboxMultiple($name, $value, $default = false) {
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'])
                foreach ($this->_errors[$name]['value'] as $valor) {
                    if ($valor == $value)
                        return 'checked';
                }
        } elseif ($default)
            return 'checked';
        return '';
    }

    //RADIO
    public function restoreRadio($name, $value, $default = false){
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'checked';
        } elseif ($default)
            return 'checked';
        return '';
    }

    //SELECT INDIVIDUAL
    public function restoreSelect($name, $value, $default = false){
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'selected';
        } elseif ($default)
            return 'selected';
        return '';
    }

    //SELECT MULTIPLE
    public function restoreSelectMultiple($name, $value, $default = false){
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'])
                foreach ($this->_errors[$name]['value'] as $valor) {
                    if ($valor == $value)
                        return 'selected';
                }
        } elseif ($default)
            return 'selected';
        return '';
    }
}
