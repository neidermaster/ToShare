<?php

/**
 * Description of Errores
 * Identifica y retorna los mensajes de error
 *
 * @author Ing. Neider Avendano
 * @empresa DADEP
 * @año 2020 
 */
class Errores {

    private $codigoError;

    public function getMensaje($codigoError) {

        $this->codigoError = $codigoError;

        switch ($this->codigoError) {
            case 0:
                $this->messageError = "Consulta Exitosa";
                break;
            case 1:
                $this->messageError = "Error: No es un Número de Radicado válido, Por favor verifique y reintente.";
                break;
            case 2:
                $this->messageError = "Error: ¡El Número de Radicado dede tener 14 cifras!, Verifique y reintente.";
                break;
            case 3:
                $this->messageError = "Error: ¡El Número de Radicado No Existe!, Verifique y reintente.";
                break;
            case 4:
                $this->messageError = "Error: ¡EL NUMERO DIGITADO TIENE ACCESO RESTRINGIDO, COMUNÍQUESE CON LA DEFENSORÍA DEL ESPACIO PÚBLICO!";
                break;
            case 5:
                $this->messageError = "Error: El Código de Verificación es incorrecto, por favor verifiquelo y reintente.";
                break;
            case 6:
                $this->messageError = "Error: reCaptcha Invalido, no eres humano!!!";
                break;
        }
        return $this->messageError;
    }

}
