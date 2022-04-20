<?php
session_start();

/** CONSULTA WEB A CIUDADANOS
 * @autor Modificado por Neider Avendaño - Defensoría del Espacio Publico
 * @version 1.0
 * @fecha 06-05-2020
* 
 * @autor JAIRO LOSADA - SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIATIOS - COLOMBIA
 * @version 3.2
 * @fecha 21/10/2005
 * @licencia GPL
 */
$ruta_raiz = "..";
$verradicado = $idRadicado;
$dependencia = 990;
$codusuario = 300;
$verrad = $idRadicado;
$ent = substr($idRadicado, -1);
error_reporting(7);
$iTpRad = 10;
include_once $_SERVER["DOCUMENT_ROOT"] . '/ver_datosrad.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/config.php';
include_once $_SERVER["DOCUMENT_ROOT"] . 'consultaWeb/models/sessionWeb.php';
/** encriptacion de pagina para inactivar en una Hora
 */
$llave = date("YmdH") . "$verrad";
$password = md5($llave);
$fechah = date("YmdHis");
// Finaliza Historicos
?>
<!DOCTYPE html>
<!--
Index default Main
-->
<html lang="es">
    <head>
        <title><?= $entidad_largo ?> - SISTEMA DE GESTION DOCUMENTAL - CUIDADANOS</title>
        <meta http-equiv="Content-Type" content="text/html;">
        <style type="text/css">
            <!--
            @import url("web.css");
            -->
        </style><script language="JavaScript" type="text/JavaScript">
            function funlinkArchivo(numrad,rutaRaiz){
            nombreventana="linkVistArch";
            url=rutaRaiz + "/linkArchivo.php?"+"&<?= session_name() . "=" . trim(session_id()) ?>&numrad="+numrad;
            ventana = window.open(url,nombreventana,'scrollbars=1,height=50,width=250');
            return;
            }
            <!--
            function MM_preloadImages() { //v3.0
            var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
            var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
            if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
            }
            function Start(URL, WIDTH, HEIGHT) {
            windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=1020,height=500";
            preview = window.open(URL , "preview", windowprops);
            }
            //-->
        </script>
    </head>
    <body bgcolor="#ffffff">
        <form name=form_cerrar action=index_web.php?<?= session_name() . "=" . session_id() . "&fechah=$fechah&krd=$krd" ?> method=post>
        </form>
        <?
        //include "cabez.php";
        ?>
        <table width="100%"  border="0" cellspacing="5" cellpadding="0">
            <tr>
                <td class="titulos2" ALIGN=CENTER >
                    <FONT SIZE=2>INFORMACION DEL DOCUMENTO CON NUMERO DE RADICADO 
                    <?
                    $isql = "
select radi_path from radicado r 
where r.radi_nume_radi = '$idRadicado';
	";
                    $rs = $db->query($isql);
                    if (!$rs->EOF) {
                        $radi_path = $rs->fields["RADI_PATH"];
                    }
                    $ext = strtolower(end(explode(".", $radi_path)));
                    if (substr($verrad, -1) == 1 and $ext == "pdf") {
                        echo "<a href='#' onclick=\"window.open('../externalFileController.php?nurad=$verrad&radiveri=" . $codVeri . "')\">$verrad</a>";
                    } else {
                        echo $verrad;
                    }
                    ?>
                    </FONT>
                </td>
            </tr>
        </table>
        <table width="100%"  border="0" cellspacing="5" cellpadding="0">
            <tr>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="borde_tab">
                        <tr>
                            <td><table width="100%"  border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                        <td width="40%" class="titulos2">
                                            DEPENDENCIA ACTUAL
                                        </td>
                                        <td class="listado2"><?
                    $isql = "
select d.depe_nomb from radicado r 
left join dependencia d on (d.depe_codi=r.radi_depe_actu)
where r.radi_nume_radi = '$idRadicado';
	";
                    $rs = $db->query($isql);
                    if (!$rs->EOF) {
                        $depe_nomb = $rs->fields["DEPE_NOMB"];
                    }
                    ?>
                                            <?= $depe_nomb ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%" class="titulos2">FECHA RADICADO </td>
                                        <td class="listado2"><?= $radi_fech_radi ?></td>
                                    </tr>
                                    <!--<tr>
                                      <td width="40%" class="titulos2">ASUNTO </td>
                                      <td class="listado2"><?= $ra_asun ?></td>
                                    </tr>-->
                                </table></td>
                        </tr>
                    </table></td>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="borde_tab">
                        <tr>
                            <td><table width="100%"  border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                    <!--<td width="40%" class="titulos2"><?= $tip3Nombre[1][$ent] ?></td>
                                    <td class="listado2"><?= $nombret_us1 ?> </td>
                                    </tr>
                                    <tr>
                                    <td width="40%" class="titulos2">MUN/DPTO</td>
                                    <td class="listado2"><?= $dpto_nombre_us1 . "/" . $muni_nombre_us1 ?></td>
                                    </tr>-->
                                </table></td>
                        </tr>
                    </table></td>
            </tr>
        </table></td>
</tr>
</table></td>
</tr>
<tr>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="borde_tab">
        </table></td>
    <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="borde_tab">
            <tr>
                <td><table width="100%"  border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td width="40%" class="titulo3">ESTADO ACTUAL </td>
<?
if (!$flujo_nombre and $radi_depe_actu == 999)
    $flujo_nombre = "Finalizado";
else {
    if (!$flujo_nombre)
        $flujo_nombre = "En Tramite";
}
?>
                            <td class="listado2"> 
                            <?
                            $isql = "select a.SGD_FLD_CODIGO,
		 a.SGD_FLD_DESC
		 , b.SGD_TPR_TERMINO
		 ,a.SGD_FLD_IMAGEN
		 ,a.SGD_FLD_GRUPOWEB
		 FROM SGD_FLD_FLUJODOC a, SGD_TPR_TPDCUMENTO B
		 where
		 a.sgd_tpr_codigo=b.SGD_TPR_CODIGO
		 AND a.sgd_tpr_codigo='$tdoc'
		 AND a.sgd_fld_codigo=a.sgd_fld_grupoweb
		 order by a.SGD_FLD_CODIGO";
                            $rs = $db->query($isql);
                            $iFld = 0;
                            if (!$rs->EOF) {
                                $flujo = $rs->fields["SGD_TPR_TERMINO"];
                                //$flujo_nombre = $rs->fields["SGD_FLD_DESC"];			
                            }
                            echo $flujo_nombre
                            ?> -</td>
                        </tr>
                    </table></td>
            </tr>
        </table></td>
</tr>
<tr>
    <td colspan="2"><table width="99%"  border="0" cellpadding="0" cellspacing="0" class="borde_tab">
            <tr>
                <td>
<?
include "$ruta_raiz/flujo/flujoGrafico.php";
$isql = "select RADI_NUME_SALIDA from anexos a where a.anex_radi_nume='$verrad'";
$rs = $db->query($isql);
$radicado_d = "";
while (!$rs->EOF) {
    $valor = $rs->fields["RADI_NUME_SALIDA"];
    if (trim($valor)) {
        $radicado_d .= "'" . trim($valor) . "', ";
    }
    $rs->MoveNext();
}
$radicado_d .= "$verrad";
// Finaliza Historicos
?>
                </td>
            </tr>
        </table></td>
</tr>
<tr>
    <td colspan="2">
<tr>
    <td></td>
</tr>
</table></td>
</tr>
</table>
<?
$isql = "select RADI_NUME_SALIDA from anexos a where a.anex_radi_nume='$verrad'";
$rs = $db->query($isql);
$radicado_d = "";
while (!$rs->EOF) {
    $valor = $rs->fields["RADI_NUME_SALIDA"];
    if (trim($valor)) {
        $radicado_d .= "'" . trim($valor) . "', ";
    }
    $rs->MoveNext();
}
$radicado_d .= "$verrad";
?>
</table>

<?
$isql = "select 
		r.RA_ASUN,
		r.RADI_FECH_RADI,
		r.RADI_NUME_RADI,
		r.RADI_PATH,
		r.sgd_rad_codigoverificacion
		from radicado r
		where
		r.radi_nume_deri  in($radicado_d)
		AND (cast(r.radi_nume_radi as varchar(20)) like '%5' or cast(r.radi_nume_radi as varchar(20)) like '%1' or cast( r.radi_nume_radi as varchar(20)) like '%2')
		AND r.radi_tipo_deri = 0
		";
$rs = $db->query($isql);
$i = 1;
if (!$rs->EOF) {
    ?>
    <table><tr><td><p></p></td></tr></table>
    <table width="99%" class="borde_tab" align="center">
        <tr>
            <td height="25" class="titulo1">DOCUMENTOS ANEXOS</td>
        </tr>
    </table>
    <CENTER>
        <table  class="borde_tab"  width="99%" align="center">
            <tr  class="titulo1" align="center">
                <td width=10% height="24">
                    Tipo</td>
                <td width=10% height="24">
                    RADICADO</td>
                <td  width=15%  height="24">
                    FECHA </td>
                <td  width=15% height="24" >
                    Asunto</td>
                <td  width=15% height="24" >
                </td> 
            </tr>
    <?
    while (!$rs->EOF) {
        $radEnviado = $rs->fields["RADI_NUME_RADI"];
        switch (substr($radEnviado, -1)) {
            case 1;
                $tipoDocumentoAnexo = "Salida";
                break;
            case 2;
                $tipoDocumentoAnexo = "Entrada";
                break;
            case 5:
                $tipoDocumentoAnexo = "Resolucion";
                break;
        }
        $verImagen = "";
        $radEnviado = $rs->fields["RADI_NUME_RADI"];
        $radFecha = $rs->fields["RADI_FECH_RADI"];
        $radiPath = trim($rs->fields["RADI_PATH"]);
        $ra_asun = $rs->fields["RA_ASUN"];
        $radi_veri = $rs->fields["SGD_RAD_CODIGOVERIFICACION"];
        $pathImagen = $ruta_raiz . "/bodega/$radiPath";
        $pathImagen = str_replace("//", "/", $pathImagen);
        $pathImagen = str_replace("\\", "/", $pathImagen);
        if (strtoupper(substr($radiPath, -3)) == "TIF" || strtoupper(substr($radiPath, -3)) == "PDF") {
            //$verImagen = "<a href='$pathImagen' Target='ImagenOrfeo_$radEnviado'>Ver Imagen</a>";
            //$verImagen .= "<br><a href='#' onclick=\"funlinkArchivo('$radEnviado','..');\">Ver Imagen</a>";
            $verImagen = "<br><a href='#' onclick=\"window.open('../externalFileController.php?nurad=$radEnviado&radiveri=" . $radi_veri . "')\">Ver Imagen</a>";
        } else {
            $verImagen = "En proceso de Cargue del Documento";
        }
        $pathImagen = "";
        /* if($radDev)
          {
          $imgRadDev = "<img src='$ruta_raiz/imagenes/devueltos.gif' alt='Documento Devuelto por empresa de Mensajeria' title='Documento Devuelto por empresa de Mensajeria'>";
          }else
          {
          $imgRadDev = "";
          } */
        if ($i == 1) {
            ?>
                    <tr class='listado2'> 
                    <?
                    $i = 1;
                }
                ?>
                    <td>
                <?= $tipoDocumentoAnexo ?>
                    </td>
                    <td>
                <?= $imgRadDev ?>
                <?= $radEnviado ?>
                    </td>
                    <td>
                    <?= $rs->fields["RADI_FECH_RADI"] ?>
                    </td>
                    <td  >
                    <?= $rs->fields["RA_ASUN"] ?> </td>
                    <td  >
                        <?= $verImagen ?> </td>
                </tr>
        <?
        $rs->MoveNext();
    }
}
?>
    </table>
    <tr align="center"><td class=borde_tab align="center">
<?
$isql = "select a.SGD_RENV_FECH,
		a.DEPE_CODI,
		a.USUA_DOC,
		a.RADI_NUME_SAL,
		a.SGD_RENV_NOMBRE,
		a.SGD_RENV_DIR,
		a.SGD_RENV_MPIO,
		a.SGD_RENV_DEPTO,
		a.SGD_RENV_PLANILLA,
		a.SGD_RENV_FECH,
		b.DEPE_NOMB,
		c.SGD_FENV_DESCRIP,
		a.SGD_RENV_OBSERVA,
		a.SGD_DEVE_CODIGO,
		r.RADI_PATH
		from sgd_renv_regenvio a, dependencia b, sgd_fenv_frmenvio c, radicado r
		where
		a.radi_nume_sal in($radicado_d)
		AND a.depe_codi=b.depe_codi
		AND a.sgd_fenv_codigo = c.sgd_fenv_codigo
		AND a.radi_nume_sal=r.radi_nume_radi
		order by a.SGD_RENV_FECH desc ";
$rs = $db->query($isql);
$i = 1;
if (!$rs->EOF) {
    ?>
                <table><tr><td><br></td></tr></table>
                <table width="99%" class="borde_tab">
                    <tr>
                        <td height="25" class="titulo1">DATOS DE ENVIOS REALIZADOS</td>
                    </tr>
                </table>
                <table  width="99%" class="borde_tab" align="center"  >
                    <tr class='titulo1' align="center">
                        <td width=10%  height="24">
                            RADICADO</td>
                          <!--<td  width=15%  height="24">
                            FECHA </td>-->
                        <td  width=15% height="24">
                            Destinatario</td>      
                      <!--    <td  width=15%  height="24" >
                            DIRECCION</td>-->
                        <td  width=15% height="24" >
                            DEPARTAMENTO </td>
                        <td  width=15% height="24" >
                            MUNICIPIO</td>
                        <td  width=15%  height="24" >
                            TIPO DE ENVIO</td>
                        <td  width=5% height="24">
                            No. PLANILLA</td>
                        <td  width=15% height="24">
                            OBSERVACIONES</td>      
                    </tr>
    <?
    while (!$rs->EOF) {
        $radDev = $rs->fields["SGD_DEVE_CODIGO"];
        $radEnviado = $rs->fields["RADI_NUME_SAL"];
        $radiPath = $rs->fields["RADI_PATH"];
        $pathImagen = $ruta_raiz . "/bodega/$radiPath";
        str_replace("//", "/", $pathImagen);
        str_replace("\\", "/", $pathImagen);
        $pathImagen = "";
        /* 	if($radDev)
          {
          $imgRadDev = "<img src='$ruta_raiz/imagenes/devueltos.gif' alt='Documento Devuelto por empresa de Mensajeria' title='Documento Devuelto por empresa de Mensajeria'>";
          }else
          {
          $imgRadDev = "";
          } */
        if ($i == 1) {
            ?>
                            <tr class='listado2'> 
                            <?
                            $i = 1;
                        }
                        ?>
                            <td  >
                        <?= $imgRadDev ?>
                        <?= $radEnviado ?>
                            </td>
                <!--<td >
                        <? $rs->fields["SGD_RENV_FECH"] ?>
                    </td>-->
                            <td >
                        <?= $rs->fields["SGD_RENV_NOMBRE"]
                        ?> </td>
                            <!--<td >
                            <? $rs->fields["SGD_RENV_DIR"] ?> </td>-->
                            <td >
                            <?= $rs->fields["SGD_RENV_DEPTO"] ?> </td>
                            <td >
                            <?= $rs->fields["SGD_RENV_MPIO"] ?> </td>
                            <td >
                                <?= $rs->fields["SGD_FENV_DESCRIP"] ?> </td>
                            <td >
        <?= $rs->fields["SGD_RENV_PLANILLA"] ?> </td>
                            <td >
                            <?= $rs->fields["SGD_RENV_OBSERVA"] ?> </td>
                        </tr>
                                <?
                                $rs->MoveNext();
                            }
                            ?>
                    <tr class='listado1'>
                    </tr>
            <!--- <tr class='listado1'>
                    <td TD class="borde_tab" colspan=3><img src='<?= $ruta_raiz ?>/imagenes/devueltos.gif'>Documento Devuelto por empresa de Mensajeria</td>
            </tr>-->
                            <?
                        } else {
                            ?>
                    <tr><td colspan="10">
                        </td></tr>
                            <?
                        }
                        ?>
            </table>
        </td></tr>
</table>
</CENTER>
</body>
</html>
