<?php
/**
 * Description of Controller
 *
 * @author Neider Avendaño
 * @fecha 20-05-2020
 * @Defensoría del Espacio Público 
 */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class Controller {
    
    function loadModel($model) {
        //carga
        require_once '../app/models/' . $modelo . '.php';
        // instancia del modelo
        return new $modelo();
        
    }
    
    // Cargar vista
    public function loadVista($vista, $datos =[]) {
        //carga
        //echo 'estoy el loadVista';
        if(file_exists('../app/views/' . $vista . '.php')){
            
            require_once '../app/views/' . $vista . '.php';
        } else {
            // si no existe el archivo de la vista
            die('la vista NO existe');
        }
    }
    
    public function loadAnswer($vista, $datos =[]) {
        //carga
        
        if(file_exists( $vista . '.php')){
            
            require_once $vista . '.php';
        } else {
            // si no existe el archivo de la vista
            die('la vista ' . $vista . '.php NO existe');
        }
    }
}
