<?php

/**
 * Description of Model
 * Modelo de base
 *
 * @author Neider Avendaño
 * @fecha 20-05-2020
 * @Defensoría del Espacio Público 
 */
class Model {

    private $db, $ruta_raiz2 = '../..';

    function __construct() {
        /* INSTANCIA DE PERSISTENCIA */
        /* @var $root_path type */
        include_once $_SERVER["DOCUMENT_ROOT"] . '/config.php';
        $ADODB_COUNTRECS = false;
        include_once $_SERVER["DOCUMENT_ROOT"] . '/include/db/ConnectionHandler.php';
        //include '../../include/db/ConnectionHandler.php';
        $this->db = new ConnectionHandler($this->ruta_raiz2);
    }

}
