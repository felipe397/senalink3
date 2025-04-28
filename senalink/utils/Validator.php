<?php
// utils/Validator.php
// Utilidad para validar datos antes de guardarlos

class Validator {
    public static function validarEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validarCamposObligatorios($data, $campos) {
        foreach ($campos as $campo) {
            if (empty($data[$campo])) {
                return false;
            }
        }
        return true;
    }
}
?>
