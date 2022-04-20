<?php
/**
 * Modulo de consulta Web para atencion a Ciudadanos.
 * @autor Sebastian Ortiz
 * @fecha 2012/06
 *
 */
//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<!--
Index default Main
-->
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">     
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    </head>
    <body>
        <?php include_once '../app/views/header.php'; ?>
        <div class="panel_ayuda"><!--Division 1-->
            <h5><?php echo $datos['tituloDescripcion']; ?></h5>
            <a class="description"><?php echo $datos['descripcion']; ?></a>
        </div> <!-- Fin Division 1-->

        <form action= "<?php echo $datos['formActionInicio'] ?>" method="POST" autocomplete="off">
            <div class="panel_form-group"><!--Division 2-->
                <div class="form-group section-form"> <!-- Seccion 1 Campos de texto -->
                    <label  for="txt_radicado">Número de Radicado</label>
                    <a id="asterisco">*</a>
                    <input type="number" name="txt_radicado"
                           class="form-control"
                           value="" maxlength="14" tabindex="1"
                           onkeypress="return alpha(event, numbers)"
                           placeholder="Digite el Número"
                           required>
                    <label for="txt_codigoverificacion">Código de Verificación</label>
                    <a id="asterisco">*</a>
                    <input type="text" name="txt_codigoverificacion"
                           class="form-control form-cuadro-texto"
                           value="" maxlength="5" tabindex="2"
                           onkeypress="return alpha(event, numbers + letters)"
                           placeholder="Digite el Código"
                           required>
                    <!--<label for="captcha">¿Eres humano?</label>
                    <a id="asterisco">*</a>
                    <div class="g-recaptcha panel_captcha" data-sitekey="6LdoEPMUAAAAALvai64kZJ0aosGIr0p9djjgrNWC">
                    </div>-->
                </div>
                <div class="section_img-ayuda"> <!-- Seccion 2 Ayuda-->
                    <img id="img-ayuda" src='<?php echo $datos['ayudaConsulta'] ?>'>
                </div>
            </div><!-- Fin Division 2-->
            <br>
            <div class="panel_btn-form-action"> <!-- Seccion 3 Botones-->
                <div class="section_btn-action">
                    <input type="submit" name="consultar" class="btn btn-primary submitBtn" value="Consultar"/>
                </div>
                <div class="section_btn-action">
                    <input type="reset" name="limpiar" class="btn btn-primary submitBtn" value="Nueva Consulta" ">
                </div>
                <div class="section_btn-action">
                    <input type="submit" name="cerrar" class="btn btn-primary submitBtn" value="Cerrar" onclick="location.href = 'https://www.dadep.gov.co/'">
                </div>
            </div> 
        </form>
        <br>
        <!-- F</div> <!-- Fin Division general del formulario -->
        <?php include_once '../app/views/footer.php'; ?>

    </body>
</html>
