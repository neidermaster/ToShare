<!DOCTYPE html>
<?php
/* @author Neider Avendaño
 * @fecha 20-05-2020
 * @Defensoría del Espacio Público 
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
    </head>
    <body>
        <div class="panel_form-group">
            <div class="row_titulo_simple">
                <h4 class="h4">INFORMACION DEL DOCUMENTO CON NUMERO DE RADICADO <?php echo $datos['radicado']; ?></h4>
            </div>
            <div class="section-status">
                <div class="row_simple">
                    <div class="info_data">
                        <div class="label"><label>DEPENDENCIA ACTUAL: </label></div>
                        <div class="data-row"><?php echo $datos['nombre_depe_actual']; ?></div>
                    </div>
                    <div class="info_data">
                        <div class="label"><label>FECHA RADICADO: </label></div>
                        <div class="data-row"><?php echo $datos['radicado_fecha']; ?></div>
                    </div>
                </div>
                <div class = row_double_double>
                    <div class="row_double">
                        <div class="info_data_asunto">
                            <div id="label_asunto"><label>ASUNTO: </label></div>
                            <div id="data-asunto"><?php echo $datos['asunto']; ?></div>
                        </div>
                    </div>
                    <div class="row_double">
                        <div class="row_simple_media">
                            <div class="label" style="float:left"><label>FECHA DE CONSULTA: </label></div>
                            <div class="data-row_estado"><?php echo $datos['fecha_actual']; ?></div>
                        </div>
                        <div class="row_simple_media">
                            <div class="label" style="float:left"><label>ESTADO ACTUAL: </label></div>
                            <div class="data-row_estado"><?php echo $datos['estado_actual']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div></div>
            <?php include 'answerGraphic.php'; ?>
        </div>
        <div class="panel-footer">
            © Defensoría del Espacio Público - 2020
        </div>
        <div class="section-footer-img">
            <img src='<?php echo $datos['footerAnswer']; ?>' class="logo2">
        </div>
    </div>
</div>

</body>
</html>
