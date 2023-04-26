<?php

require_once "controladores/campanas.controlador.php";
require_once "modelos/campanas.modelo.php";

require_once 'controladores/comprobantes.controlador.php';
require_once 'modelos/comprobantes.modelo.php';

$reporte = new ControladorCampanas();
$reporte -> ctrDescargarReporte();
