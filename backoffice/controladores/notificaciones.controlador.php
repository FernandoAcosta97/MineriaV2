<?php

Class ControladorNotificaciones{

	/*=============================================
	Registro de notificaciones
	=============================================*/

	static public function ctrRegistroNotificaciones($tipo, $id_usuario, $id_detalle){

		$tabla = "notificaciones";
		$datos = array("tipo" => $tipo,
				       "id_usuario" => $id_usuario,
					   "id_detalle" => $id_detalle); 

		$respuesta = ModeloNotificaciones::mdlRegistroNotificaciones($tabla, $datos);
				
		return $respuesta;

	}


	/*=============================================
	Mostrar Notificaciones
	=============================================*/

	static public function ctrMostrarNotificaciones($item, $valor){
	
		$tabla = "notificaciones";

		$respuesta = ModeloNotificaciones::mdlMostrarNotificaciones($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	Mostrar Notificaciones x visualizacion
	=============================================*/

	static public function ctrMostrarNotificacionesVisualizacion($item, $valor, $item2, $valor2){
	
		$tabla = "notificaciones";

		$respuesta = ModeloNotificaciones::mdlMostrarNotificacionesVisualizacion($tabla, $item, $valor, $item2, $valor2);

		return $respuesta;

	}


	/*=============================================
	Mostrar Notificaciones x visualizacion x tipo
	=============================================*/

	static public function ctrMostrarNotificacionesVisTipo($item, $valor, $item2, $valor2, $item3, $valor3){
	
		$tabla = "notificaciones";

		$respuesta = ModeloNotificaciones::mdlMostrarNotificacionesVisTipo($tabla, $item, $valor, $item2, $valor2, $item3, $valor3);

		return $respuesta;

	}


	/*=============================================
	Mostrar Notificaciones Limite
	=============================================*/

	static public function ctrMostrarNotificacionesLimite($item, $valor, $limite){
	
		$tabla = "notificaciones";

		$respuesta = ModeloNotificaciones::mdlMostrarNotificacionesLimite($tabla, $item, $valor, $limite);

		return $respuesta;

	}


	static public function ctrTiempoNotificacion($df) {

		$str = '';
		$str .= ($df->invert == 1) ? ' - ' : '';
		if ($df->y > 0) {
			// años
			$str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
		} else if ($df->m > 0) {
			// meses
			$str .= ($df->m > 1) ? $df->m . ' Meses' : $df->m . ' Mes ';
		} else if ($df->d > 0) {
			// dias
			$str .= ($df->d > 1) ? $df->d . ' Días ' : $df->d . ' Día ';
		} else if ($df->h > 0) {
			// horas
			$str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
		} else if ($df->i > 0) {
			// minutos
			$str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
		} else if ($df->s > 0) {
			// segundos
			$str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
		}
	
		return $str;
	}



}

