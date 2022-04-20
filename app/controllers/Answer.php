<?php

/**
 * Description of Answer
 *
 * @author Neider Avendaño
 * @fecha 06-05-2020
 * @Defensoría del Espacio Público
 */
//error_reporting(7);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class Answer{
    private $data, $path;
    
    function __construct() {
        //parent::__construct();
        //include_once $_SERVER["DOCUMENT_ROOT"] . '/config.php';        
    }

    private $ruta_raiz, $dataForm, $answerClass;

    function getDataForm($data) {
        $this->data = $data;
        // separo variables
        $numRadicado = $this->data['numRadicado'];
        $codVerificacion = $this->data['codVerificacion'];
        $recaptcha = $this->data['recaptcha'];
        $remoteIp = $this->data['remoteIp'];
        
        require_once '../models/AnswerModel.php';
        $this->answerClass = new AnswerModel();
        $this->dataForm = $this->answerClass->getAnswer($numRadicado);
        $this->setViewAnswer($this->dataForm);
    }

    public function inicio() {
        
    }
    
    private function setViewAnswer($dataForm) {
        $this->dataForm = $dataForm;
        $this->path= $this->dataForm['path'];
        $this->ruta_raiz = $_SERVER["DOCUMENT_ROOT"]; // aqui es /var/www/html 
        
        // Datos ara el Header
        $this->dataForm['cssAnswer'] = $this->path . "public/css/answer.css";
        $this->dataForm['headerAnswer'] = $this->path . "public/img/header_answer.jpg";
        $this->dataForm['footerAnswer'] = $this->path . "public/img/footer_img.jpg";
        
        require_once '../libs/Controller.php';
        $mainController = new Controller;
        $resultado = $mainController->loadAnswer($this->ruta_raiz . '/consultaWeb/app/views/answer/index', $this->dataForm);
    }
}
