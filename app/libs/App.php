<?php

/**
 * Description of Core
 * Mapear la url ingresada en el navegador,
 * 1-controlador
 * 2-método
 * 3-parámetro
 * @author Neider Avendaño
 * @fecha 20-05-2020
 * @Defensoría del Espacio Público 
 */

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class App {
    /*
     * Mientras no haya nada en la URL se cargará por defecto esto
     * controlador = main
     * metodo = index
     * parametro = un array vacio.
     */

    protected $controladorActual = 'main';
    protected $metodoActual = 'inicio';
    protected $parametros = [];

    function __construct() {
        // Instancio el metodo para cargar automaticamente la url
        $url = $this->getUrl();
        
        if (file_exists('../app/controllers/' . ucwords($url[0] . '.php'))) {
            unset($url[0]);
        } else {
        }
        // se requiere el nuevo controlador        
        require_once '../app/controllers/' . ucwords($this->controladorActual) . '.php';
        $this->controladorActual = new $this->controladorActual;
        if (isset($url[1])) {
            if (method_exists($this->controladorActual, $url[1])) {
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }
        // Chequear y obtener los posibles parametrs
        $this->parametros = $url ? array_values($url) : [];
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    /**
     * Este metodo divide la url que se recibe a partir del separador '/'
     * y devuelve un Array
     * donde [0] sera el controlador
     * [1] sera el metodo
     * [2] seran los parametros
     * @return type
     */
    public function getUrl() {
        //Se valida que este seteada la url
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}
