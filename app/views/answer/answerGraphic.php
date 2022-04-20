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
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="panel-graphic-estado">
            <!-- ESTE ES EL GRAFICO -->
            <div class="section-status-graphic">
                <div class="row_titulo_status"> <!--Fila 1 - titulo-->
                    <div> ESTADO DEL DOCUMENTO </div>
                </div>
                <div class="row_triple"> <!--Fila 2 imagenes-->
                    <div>
                        <img src='<?php echo $datos['imagen_inicio']; ?>' class="img_status">
                    </div>
                    <div>
                        <img src='<?php echo $datos['imagen_central']; ?>'  class="img_status">
                    </div>
                    <div>
                        <img src='<?php echo $datos['imagen_final']; ?>' class="img_status">
                    </div>
                </div>
                <!--<div class="row_info_status"> <!--Fila 3 Labels de estado estado
                    <div class="label_status">
                        Radicado
                    </div>
                    <div class="label_status">
                        En trámite
                    </div>
                    <div class="label_status">
                        Finalizado
                    </div>
                </div>-->
                <div class="row_info_tramite"> <!--Fila 4 flecha indicando estado-->
                    <div class="label_status" id="img_inicio">
                        <img src='<?php echo $datos['aqui_inicio']; ?>'>
                    </div>
                    <div class="label_status" id="img_centro">
                        <img src='<?php echo $datos['aqui_central']; ?>'>
                    </div>
                    <div class="label_status" id="img_final">
                        <img src='<?php echo $datos['aqui_final']; ?>'>
                    </div>
                </div>
                <div class="row_info_terminos"> <!--Fila 5 info del tiempos legales 2 filas-->
                    <div class="row_simple_terminos">
                        <div class="row_tram_legal">
                            <img id="color_tramite" src='<?php echo $datos['plazo1']; ?>'>
                        </div>                    
                        <div class="info_tram_legal">
                            <?php echo $datos['termino']; ?> días
                        </div>
                    </div>
                    <div class="row_simple_terminos">
                        <div class="row_tram_proceso">
                            <img  id="color_tramite" src='<?php echo $datos['plazo2']; ?>'>
                        </div>                    
                        <div class="info_tram_proceso">
                            <?php echo $datos['dias_transcurridos']; ?> días
                        </div>
                    </div>
                </div>                
            </div>
            <div class="panel-convensiones">
                <div class="section-conventions">
                    <div id="left">
                        <div id="up">
                            <div id="img-convention">
                                <img src='<?php echo $datos['plazo1']; ?>'>
                            </div>
                            <div class="label-convention">
                                <label>TIEMPO DE TÉRMINO LEGAL</label>
                            </div>
                        </div>
                        <div id="down">
                            <div id="img-convention">
                                <img src='<?php echo $datos['plazo2']; ?>'>
                            </div>
                            <div class="label-convention">
                                <label>TIEMPO TRANSCURRIDO HASTA HOY</label>
                            </div>
                        </div>
                    </div>
                    <div id="central"></div>

                    <div class="panel_btn-form-action">
                        <div class="label_link">
                            <a href="https://www.dadep.gov.co/ventanilla-virtual">Solicitar copia de documentos</a>
                            <!--<a href= "<?php //echo $datos['nueva_consulta']  ?>">Detalle Histórico</a>-->
                        </div>
                        <div class="label_link">
                            <a href="<?php echo $datos['nueva_consulta'] ?>">Nueva Consulta</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
