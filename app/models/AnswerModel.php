<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnswerModel
 *
 * @author Ing. Neider Avendano
 * @empresa DADEP
 * @año 2020
 */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class AnswerModel {

    private $numero_radicado, $data, $dataRadicado, $dataGraphic, $db;
    private $ruta_raiz, $fecha_ini, $fecha_fin;

    public function getAnswer($numRadicado) {
        $this->numero_radicado = $numRadicado;
        # datos del radicado
        $this->dataRadicado = $this->getDatosRadicado($this->numero_radicado);

        //$str_fech_Rad = $this->dataRadicado['fechaRadicado'];
        $fechaRadicado = $this->dataRadicado['fechaRadicado'];
        $depe_actual = $this->dataRadicado['depeActual'];
        if (strlen($this->dataRadicado['asunto']) <= 52) {
            $asunto = $this->dataRadicado['asunto'];
        } else {
            $asunto = substr($this->dataRadicado['asunto'], 0, 52) . '...';
        }
        $tipo_documental = $this->dataRadicado['tipoDocumental'];
        if (is_null($this->dataRadicado['termino'])) {
            $termino = 0;
        } else {
            $termino = $this->dataRadicado['termino'];
        }

        $fecha_actual = date('d-m-Y');
        $dias_transcurridos = $this->getDiasTranscurridos($this->numero_radicado, $fechaRadicado, $termino);
        $this->data = array('radicado' => $this->numero_radicado
            , 'radicado_fecha' => $fechaRadicado
            , 'cod_dependencia_actual' => $depe_actual
            , 'asunto' => $asunto
            , 'tdoc' => $tipo_documental
            , 'termino' => $termino
            , 'fecha_actual' => $fecha_actual
            , 'dias_transcurridos' => $dias_transcurridos
        );
        
        $this->dataGraphic = $this->getGraficoFlujo($this->data);
        return $this->dataGraphic;
    }

    private function getDatosRadicado($numRadicado) {
        $this->numero_radicado = $numRadicado;
        $sqlDataRad = "select RADI_FECH_RADI, RADI_DEPE_ACTU, RA_ASUN
                            , TDOC_CODI, TERMINO
                        from RADICADO
                        where RADI_NUME_RADI = $this->numero_radicado";

        require_once 'Persistencia.php';
        $this->persistenciaClass = new Persistencia();
        $this->db = $this->persistenciaClass->connDB();

        if (!$this->db) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        if ($this->db) {
            $consultaOracle = oci_parse($this->db, $sqlDataRad);
            oci_execute($consultaOracle);
            // Existencia del radicado
            while (($row = oci_fetch_object($consultaOracle)) != false) {
                // Use nombres de atributo en mayúsculas para cada columna estándar de Oracle
                $fechaRadicado = $row->RADI_FECH_RADI;
                $depeActual = $row->RADI_DEPE_ACTU;
                $asunto = $row->RA_ASUN;
                $tipoDoc = $row->TDOC_CODI;
                $termino = $row->TERMINO;

                /* $radicado = $row->RADI_NUME_RADI;
                  $codigo = $row->SGD_RAD_CODIGOVERIFICACION;
                  $tiporad = $row->SGD_TRAD_CODIGO; */
            }
            // cierre de la conexion Oracle
            oci_free_statement($consultaOracle);
            oci_close($this->db);

            $this->dataRadicado = array('fechaRadicado' => $fechaRadicado
                , 'depeActual' => $depeActual
                , 'asunto' => $asunto
                , 'tipoDocumental' => $tipoDoc
                , 'termino' => $termino);
        }
        return $this->dataRadicado;
    }

    private function getDependenciaActual($numRadicado) {
        $isql = "select d.DEPE_NOMB
            from RADICADO r 
            left join DEPENDENCIA d on (d.DEPE_CODI = r.RADI_DEPE_ACTU)
            where r.RADI_NUME_RADI = $numRadicado";

        require_once 'Persistencia.php';
        $this->persistenciaClass = new Persistencia();
        $this->db = $this->persistenciaClass->connDB();

        if (!$this->db) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        if ($this->db) {
            $consultaOracle = oci_parse($this->db, $isql);
            oci_execute($consultaOracle);
            while (($row = oci_fetch_object($consultaOracle)) != false) {
                $depe_nomb = $row->DEPE_NOMB;
            }
            // cierre de la conexion Oracle
            oci_free_statement($consultaOracle);
            oci_close($this->db);
        }
        return $depe_nomb;
    }

    public function getDiasDiferencia($fecha_inicio, $fecha_final) {
        $this->fecha_ini = $fecha_inicio;
        $this->fecha_fin = $fecha_final;

        $explode_fecha_ini = explode('-', $this->fecha_ini);
        $dia_fecha_ini = $explode_fecha_ini[0];
        $mes_fecha_ini = $explode_fecha_ini[1];
        $anio_fecha_ini = $explode_fecha_ini[2];

        $explode_fecha_fin = explode('-', $this->fecha_fin);
        $dia_fecha_fin = $explode_fecha_fin[0];
        $mes_fecha_fin = $explode_fecha_fin[1];
        $anio_fecha_fin = $explode_fecha_fin[2];

        // Se obtienen Timestamp

        $timestamp1 = mktime(0, 0, 0, $mes_fecha_ini, $dia_fecha_ini, $anio_fecha_ini);
        $timestamp2 = mktime(0, 0, 0, $mes_fecha_fin, $dia_fecha_fin, $anio_fecha_fin);

        //resto a una fecha la otra
        $segundos_diferencia = $timestamp1 - $timestamp2;
        //convierto segundos en días
        $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
        //obtengo el valor absoulto de los días (quito el posible signo negativo)
        $dias_diferencia = abs($dias_diferencia);
        //quito los decimales a los días de diferencia
        $dias_diferencia = floor($dias_diferencia);
        return $dias_diferencia;
    }

    private function getDiasTranscurridos($numRadicado, $fechaRadicado, $termino) {
        $this->numero_radicado = $numRadicado;
        $fecha_actual = date('d-m-Y');

        // Se obiene el numero de dias transcurridos a la fecha
        $dias_a_la_fecha = $this->getDiasDiferencia($fechaRadicado, $fecha_actual);
        return $dias_a_la_fecha;
    }

    private function getGraficoFlujo($datos) {
        $this->data = $datos;
        $this->ruta_raiz = $_SERVER["DOCUMENT_ROOT"]; // aqui es http://XXX/consultaWeb/
        include $this->ruta_raiz . '/consultaWeb/app/config/config.php';
        $this->data['path'] = $path;
        if ($this->data['cod_dependencia_actual'] == 999) {
            $this->data['estado_actual'] = "FINALIZADO";
            $this->data['nombre_depe_actual'] = "ARCHIVO DADEP";
            $this->data['imagen_inicio'] = $path . "public/img/radicado.png";
            $this->data['imagen_central'] = $path . "public/img/revision.png";
            $this->data['imagen_final'] = $path . "public/img/archivado.png";
            $this->data['aqui_inicio'] = "";
            $this->data['aqui_central'] = "";
            $this->data['aqui_final'] = $path . "public/img/tramite_aqui.png";
        } else {
            $this->data['estado_actual'] = "EN TRÁMITE";
            $this->data['nombre_depe_actual'] = $this->getDependenciaActual($this->data['radicado']);
            $this->data['imagen_inicio'] = $path . "public/img/radicado.png";
            $this->data['imagen_central'] = $path . "public/img/revision.png";
            $this->data['imagen_final'] = $path . "public/img/archivado.png";
            $this->data['aqui_inicio'] = "";
            $this->data['aqui_central'] = $path . "public/img/tramite_aqui.png";
            $this->data['aqui_final'] = "";
        }
        
        // Datos para convenciones
        $this->data['plazo1'] = $path . "public/img/plazo1.png";
        $this->data['plazo2'] = $path . "public/img/plazo2.png";
        //$dias = $this->getDiasTranscurridos($this->data['radicado']);
        $this->data['dias_total'] = 0;
        $this->data['nueva_consulta'] = $path . 'public';
        
        return $this->data;
    }
    
            
    
}