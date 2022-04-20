<?php
/**
 * @author Neider Avendaño
 * @fecha 05-05-2020
 * @Defensoría del Espacio Público 
 */

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

session_start();

include_once '../../controllers/Consulta.php';

$consulta = new Consulta();
$valida = $consulta->consultarRegistro();



?>
