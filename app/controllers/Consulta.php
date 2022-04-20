<?php

/**
 * Description of Consulta
 * Controlador de paso entre formulario y modelo para validaciones y 
 * obtencion de los datos de consulta
 *
 * @author Ing. Neider Avendano
 * @empresa DADEP
 * @año 2020 
 */

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class Consulta {

    private $consultaModel, $resValida, $dataForm;
    private $errorClass, $answerClass;

    function consultarRegistro($data) {
        date_default_timezone_set('America/Bogota');
        $this->dataForm = $data;
        $fechah = date("dmy") . "_" . time("hms");
        $usua_nuevo = 3;
        /* if ($numRadicado) {
          $numRadicado = str_replace("-", "", $numRadicado);
          $numRadicado = str_replace("_", "", $numRadicado);
          $numRadicado = str_replace(".", "", $numRadicado);
          $numRadicado = str_replace(",", "", $numRadicado);
          $numRadicado = str_replace(" ", "", $numRadicado); */
        include_once '../models/ConsultaModel.php';
        $this->consultaModel = new ConsultaModel();
        //echo 'Imprime Datos antes de enviar a validar: ' . print_r($this->dataForm);
        //echo '<br>';

        $this->resValida = $this->consultaModel->getValidacionConsulta($this->dataForm);
        
        if ($this->resValida == 0) { //validaciones correctas, se despliega resultado
            //echo 'Validacion correcta, ahora se construye la respuesta <br>';
            require_once 'Answer.php';
            $this->answerClass = new Answer();
            $this->answerClass->getDataForm($this->dataForm);
        } else { // Error en validacion de datos
            include_once 'Errores.php';
            $this->errorClass = new Errores();
            $this->message = $this->errorClass->getmensaje($this->resValida);
            /* Modal con css */
            //include '../views/modal/index.php';
            echo '<script language="javascript">
                    alert("' . $this->message . '");                    
                    window.location="https://www.dadep.gov.co/consultaWeb/public/";
                    </script>';
        }
    }

    public function inicio() {
        
    }

}
