<?php
/*
 * Nueva conexion al Cluster DADEP por Service Name
 */
$usuario = "user";
$contrasena = "pass";
//$servicio = "pruebas"; // Developer
//$servidor = "172.1.1.1:1521"; //Developer
$servicio = "cdbdadep_pdb1.snetdbprod01.vcndadepprod02.oraclevcn.com"; // produccion
$servidor = "172.1.1.1:1521"; //Servidor de Produccion en nube IP privada
$driver = "oci8";
//$path = "http://172.1.1.1/consultaWeb/"; //Pruebas
$path = "https://www.dadep.gov.co/consultaWeb/"; //Producción

