<?php

/**
 * Captura de los datos del formulario de CosnsultaWeb
 * @author Neider Avendaño
 * @fecha 20-05-2020
 * @Defensoría del Espacio Público 
 */

/* Mediante $_SERVER[‘HTTP_CLIENT_IP’] verificamos si la IP es una conexión compartida.
  Mediante $_SERVER[‘HTTP_X_FORWARDED_FOR’] verificamos si la IP pasa por un proxy.
  Mediante $_SERVER[‘REMOTE_ADDR’] obtenemos la dirección IP desde la cual está viendo la página actual el usuario. */

//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../controllers/Consulta.php';
$classConsulta = new Consulta;
$data = ['numRadicado' => $_POST['txt_radicado']
    , 'codVerificacion' => $_POST['txt_codigoverificacion']
    , 'recaptcha' => $_POST['g-recaptcha-response']
    , 'remoteIp' => $_SERVER['REMOTE_ADDR']
];

$classConsulta->consultarRegistro($data);
