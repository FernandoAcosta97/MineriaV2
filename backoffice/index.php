<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/general.controlador.php";

require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";

require_once "controladores/campanas.controlador.php";
require_once "modelos/campanas.modelo.php";

require_once "controladores/cuentas.controlador.php";
require_once "modelos/cuentas.modelo.php";

require_once "controladores/comprobantes.controlador.php";
require_once "modelos/comprobantes.modelo.php";

require_once "controladores/pagos.controlador.php";
require_once "modelos/pagos.modelo.php";

require_once "controladores/academia.controlador.php";
require_once "modelos/academia.modelo.php";

require_once "controladores/multinivel.controlador.php";
require_once "modelos/multinivel.modelo.php";

require_once "controladores/soporte.controlador.php";
require_once "modelos/soporte.modelo.php";

require_once "controladores/notificaciones.controlador.php";
require_once "modelos/notificaciones.modelo.php";

// require_once "controladores/excel.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();