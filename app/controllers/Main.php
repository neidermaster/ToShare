<?php
/**
 * Description of Main
 * Controlador principal
 *
 * @author Ing. Neider Avendano
 * @empresa DADEP
 * @año 2020 
 */

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class Main extends Controller{
    
    public function inicio(){
        include '../app/config/config.php';
        
        //echo 'este es el path: ' .$path . '<br>';
        $datos = array ('logoOrfeo' => $path . "public/img/header01.jpg"
            , 'logoEmpresa' => $path . "public/img/logo_entidad.png"
            , 'ayudaConsulta' => $path . "public/img/AyudaConsulta.png"
            , 'titulo' => "Formulario de Consulta Web"
            , 'thisUrl' => $path ."public/"
            , 'footerAnswer' => $path . "public/img/footer_img.jpg"
            /*, 'tituloDescripcion' => "Señor Ciudadano, al diligenciar el formulario, tenga en cuenta lo siguiente: <br>"
            , 'descripcion' => "* Sólo podrá consultar radicados conociendo el código de verificación que se encuentra en el sticker. <br>
                          * Consultar dos días después de recibida la comunicación."*/
            , 'formActionInicio' => $path . "app/libs/passdata.php"
        );       
        
        $this->loadVista('main/index', $datos);
    }
    
}