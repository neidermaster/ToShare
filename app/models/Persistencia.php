<?php
/**
 * Description of Persistencia
 *
 * @author navendano
 */

//error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class Persistencia {
    
    public function connDB() {
        $ruta = $_SERVER['DOCUMENT_ROOT'];        
        // Conectar con Oracle:
        include $ruta . '/consultaWeb/app/config/config.php';        
        $cadenaConexion = $servidor . '/' . $servicio;
        $conexion = oci_connect($usuario, $contrasena, $cadenaConexion) or die("Error al conectar : " . oci_error());
        return $conexion;
    }
}
