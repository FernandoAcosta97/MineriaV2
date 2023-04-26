<?php

require_once "../controladores/general.controlador.php";
require_once "../controladores/notificaciones.controlador.php";
require_once "../modelos/notificaciones.modelo.php";

class AjaxNotificaciones
{

    /*=============================================
    Visualizar mensaje
    =============================================*/
    public $visualizar;

    public function ajaxVisualizarMensaje()
    {

        $tabla = "notificaciones";

        $item = "visualizacion";
        $valor = 1;

        $id = $this->visualizar;

        $respuesta = ModeloNotificaciones::mdlActualizarNotificacion($tabla, $id, $item, $valor);

    }

  

}


/*=============================================
VISULAIZAR MENSAJE
=============================================*/

if (isset($_POST["mensajeVisualizar"])) {

    $mensaje = new AjaxNotificaciones();
    $mensaje->visualizar = $_POST["mensajeVisualizar"];
    $mensaje->ajaxVisualizarMensaje();

}
