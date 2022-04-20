<?php

/**
 * Description of ConsultaModel
 *
 * @author navendano
 */
//error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class ConsultaModel {

    private $db;
    private $numRadicado, $codigoVerificacion, $recaptcha, $remoteIp, $message;
    private $codValida, $resValidaCaptcha, $resValidaRadicado, $resValidaConfidencial, $successResponse;
    private $persistenciaClass, $error;

    /**
     * 
     * idRadicadoConCodigoVerificacion
     * 
     * @param type $radicado
     * @param type $codigoverificacion
     * @return type
     * @navendano, Defensor�a del Espacio�P�blico 
     * Modificado 03-2020
     */
    public function getValidacionConsulta($dataquery) {
        $this->numRadicado = $dataquery['numRadicado'];
        $this->codigoVerificacion = $dataquery['codVerificacion'];
        $this->recaptcha = $dataquery['recaptcha'];
        $this->remoteIp = $dataquery['remoteIp'];

        /* echo '<br>*** ESTAS EN LA CLASE QUE VALIDA ***<br>';
          echo 'los datos digitados son: <br> Radicado = ' . $this->numRadicado . '<br>';
          echo 'codigo de verificacion = ' . $this->codigoVerificacion . '<br>';
          echo 'captcha = ' . $this->recaptcha . '<br>';
          echo 'Esta es la IP remota: ' . $this->remoteIp .'<BR>'; */


        # 1 - Validaci�n del Captcha
        $this->resValidaCaptcha = $this->getValidaCaptcha($this->recaptcha);
        if ($this->resValidaCaptcha == true) {
            #2 - Validaci�n del numero de radicado y codigo de verificacion

            $this->resValidaRadicado = $this->getValidaRadicado($this->numRadicado, $this->codigoVerificacion); // Is Array
            if ($this->resValidaRadicado == 0) {
                $this->message = 0;
            } else { // ERROR por Radicado o codigo de verificaion invalidos
                $this->message = $this->resValidaRadicado;
            }
        } else { // ERROR por captcha invalido            
            /*
             * hacer registro de auditoria
             */
            $this->message = 6;
        }
        /*
         * Registro de Auditoría
         */
        
        //$resValidacion = $this->message;
        $resRegitroAuditoria = $this->setRegistroAuditoria($dataquery, $this->message);
        if ($resRegitroAuditoria == false) {
            echo 'ERROR DE REGISTRO EN DB AUDITORIA';
        }
        return $this->message;
    }

    private function getValidaCaptcha($captchaResponse) {
        $this->recaptcha = $captchaResponse;
        $this->secret = '6Ld2YfIUAAAAAGOomQw6pExNmHschBmn1xjpXYQa';
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $verify = file_get_contents($url . "?secret=" . $this->secret . "&response=" . $this->recaptcha);
        $captcha_success = json_decode($verify, true);
        $this->successResponse = $captcha_success['success'];
        //$timeResponse = $captcha_success['challenge_ts'];
        if ($this->successResponse == 1) {
            $this->message = true;
        } else {
            $this->message = $captcha_success;
        }
        return $this->message;
    }

    public function getValidaConfidencialidad($numRadicado) {

        $this->numRadicado = $numRadicado;
        // Validacion de confidencialidad
        $qrestriction = "select SGD_SPUB_CODIGO
                        from RADICADO
                        where RADI_NUME_RADI=$this->numRadicado";

        require_once 'Persistencia.php';
        $this->persistenciaClass = new Persistencia();
        $this->db = $this->persistenciaClass->connDB();

        if (!$this->db) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        if ($this->db) {
            $consultaOracle = oci_parse($this->db, $qrestriction);
            oci_execute($consultaOracle);
            // Existencia del radicado
            while (($row = oci_fetch_object($consultaOracle)) != false) {
                // Use nombres de atributo en mayúsculas para cada columna estándar de Oracle
                $codConfidencial = $row->SGD_SPUB_CODIGO;
            }
            // cierre de la conexion Oracle
            oci_free_statement($consultaOracle);
            oci_close($this->db);
            // Confidencialidad
            if ($codConfidencial == 1) {
                $this->message = 4;
            } elseif ($codConfidencial == 0) {
                $this->message = 0; // Validaci�n correcta
            }
        }
        return $this->message;
    }

    public function getValidaRadicado($numRadicado, $codValidacion) {
        $this->numRadicado = $numRadicado;
        $this->codValida = $codValidacion;
        $radicado = 0;

        if (strlen($this->numRadicado) < 14 || strlen($this->numRadicado) > 14) {
            $this->message = 2; // c�digo de error 2
            return $this->message;
        }
        if (strlen($this->numRadicado) == 14) {
            $qradica = "select RADI_NUME_RADI, SGD_RAD_CODIGOVERIFICACION, SGD_TRAD_CODIGO
                        from RADICADO
                        where RADI_NUME_RADI = $this->numRadicado";

            require_once 'Persistencia.php';
            $this->persistenciaClass = new Persistencia();
            $this->db = $this->persistenciaClass->connDB();

            if (!$this->db) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
            if ($this->db) {
                $consultaOracle = oci_parse($this->db, $qradica);
                oci_execute($consultaOracle);
                // Existencia del radicado
                while (($row = oci_fetch_object($consultaOracle)) != false) {
                    // Use nombres de atributo en mayúsculas para cada columna estándar de Oracle
                    $radicado = $row->RADI_NUME_RADI;
                    $codigo = $row->SGD_RAD_CODIGOVERIFICACION;
                    $tiporad = $row->SGD_TRAD_CODIGO;
                }
                // cierre de la conexion Oracle
                oci_free_statement($consultaOracle);
                oci_close($this->db);

                // Solo prueba
                /* echo 'radicado: ' .$radicado. '<br>';
                  echo 'codigo: ' .$codigo. '<br>';
                  echo 'tipo: ' . $tiporad. '<br>'; */

                # Se valida que el radicado existe

                if ($radicado == $this->numRadicado) {
                    # Se valida que sea un radicado de entrada solamente Tipo "2"
                    if ($tiporad == 2) {
                        # Se valida codigo de verificacion
                        if ($codigo == $this->codValida) {
                            # Se valida confidencialidad
                            $this->resValidaConfidencial = $this->getValidaConfidencialidad($this->numRadicado);
                            if ($this->resValidaConfidencial == 0) {
                                $this->message = 0;
                            } else {
                                $this->message = $this->resValidaConfidencial;
                            }
                        } else {
                            $this->message = 5;
                        }
                    } else { // No es radicado de entrada.
                        $this->message = 1;
                    }
                } else {
                    $this->message = 3; // No existe el radicado
                }
            }
        }
        return $this->message; // Is Array
    }

    private function setRegistroAuditoria($datos, $error) {
        $this->numRadicado = $datos['numRadicado'];
        $this->codigoVerificacion = $datos['codVerificacion'];
        $this->recaptcha = $datos['recaptcha'];
        $this->remoteIp = $datos['remoteIp'];
        $this->error = $this->getError($error);
        $fecha_actual = date("Y-m-d H:i:s");
        $hora_actual = date("H:i:s");

        /* Solo prueba */
        /* echo 'Fecha: ' . $fecha_actual . '<br>';
          echo 'Hora: ' . $hora_actual . '<br>';
          echo 'Radicado: ' . $this->numRadicado . '<br>';
          echo 'cod_verifica: ' . $this->codigoVerificacion . '<br>';
          echo 'recaptcha: ' . $this->recaptcha . '<br>';
          echo 'IP: ' . $this->remoteIp . '<br>'; */

        $isqlAudit = "INSERT INTO SGD_AUDITORIA_CONSULTA_WEB
                            (SGD_AUD_FECHA
                            , SGD_AUD_HORA
                            , SGD_AUD_RADICADO
                            , SGD_AUD_CODVERIFICA
                            , SGD_AUD_RECAPTCHA
                            , SGD_AUD_REMOTE_IP
                            , SGD_AUD_RESPUESTA
                            )
                        VALUES(TO_DATE('$fecha_actual', 'yyyy-mm-dd hh24:mi:ss')
                            , '$hora_actual'
                            , '$this->numRadicado'
                            , '$this->codigoVerificacion'
                            , '$this->recaptcha'
                            , '$this->remoteIp'
                            , '$this->error')";

        require_once 'Persistencia.php';
        $this->persistenciaClass = new Persistencia();
        $this->db = $this->persistenciaClass->connDB();

        if (!$this->db) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        if ($this->db) {
            //echo 'HAy COnexion, el insert queda asi: <br>';
            //echo $isqlAudit;

            $consultaOracle = oci_parse($this->db, $isqlAudit);
            $res = oci_execute($consultaOracle);
            // Existencia del radicado
            if ($res) {
                $resRegistro = true;
            } else {
                $resRegistro = false;
            }
            // cierre de la conexion Oracle
            oci_free_statement($consultaOracle);
            oci_close($this->db);
        }
        return $resRegistro;
    }

    private function getError($codError) {

        include_once '../controllers/Errores.php';
        $errorClass = new Errores;
        $txtError = $errorClass->getMensaje($codError);
        return $txtError;
    }

}
