<?php
/**
 * @author Neider Avendaño
 * @fecha 05-05-2020
 * @Defensoría del Espacio Público 
 */

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>

<!--
Header standard
-->
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <link rel="stylesheet" href="<?php echo $datos['thisUrl']; ?>css/default.css">        
    </head>
    <div class="panel-header">
        <div class="fila_logos">
            <!--<div id="logo1">
                <img src='<?php //echo $datos['logoEmpresa']; ?>' class="logo1">
            </div>-->
            <div>
                <img src='<?php echo $datos['logoOrfeo']; ?>' class="logo2">
            </div>
        </div>
        <!--<div class="fila_titulo">
            <div class="titulo">
                <h2 class="page-titulo"><?php //echo $datos['titulo']; ?></h2>
            </div>
        </div>-->
    </div>

</html>
