<?php
/**
 * @author Neider Avendaño
 * @fecha 05-05-2020
 * @Defensoría del Espacio Público 
 */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <title>DADEP - SISTEMA DE GESTION DOCUMENTAL</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <link rel="stylesheet" href="<?php echo $datos['cssAnswer']; ?>">
    </head>
    <body>
        <div class="panel_answer">
            <?php include 'answerHeader.php'; ?>
            <?php include 'answerForm.php' ?>
        </div>
    </body>
</html>
