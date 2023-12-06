<?php

require_once "../controladores/comprobantes.controlador.php";
require_once "../modelos/comprobantes.modelo.php";
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";
require_once "../controladores/campanas.controlador.php";
require_once "../modelos/campanas.modelo.php";

class AjaxPagos{

	/*=============================================
	Validar email existente
	=============================================*/

	public $validarEmail;
	
	public function ajaxValidarEmail(){

		$item = "email";
		$valor = $this->validarEmail;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	Cambiar estado pago inversion
	=============================================*/	

	public $idPagoInversion;

	public function ajaxEstadoPagoInversion(){

		$estado = 1;

		$id = $this->idPagoInversion;

		$pago = ControladorPagos::ctrMostrarPagos("id", $id);

		if($pago["estado"]==0){

		$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $pago["id_comprobante"]);

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

		$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

		$id_cuenta = $cuenta["id"];

		$datos = array("id" => $id,
		"estado" => $estado,
		"id_cuenta" => $cuenta["id"]);

		return $respuesta = ControladorPagos::ctrActualizarPagoInversion($datos);

		}else{
			echo "pagado";
		}

	}



	/*=============================================
	Cambiar estado pago retiro
	=============================================*/	

	public $idPagoRetiro;

	public function ajaxEstadoPagoRetiro(){

		$estado = 1;

		$id = $this->idPagoRetiro;

		$pago = ControladorPagos::ctrMostrarSolicitudesRetiro("id", $id, null, null);

		if($pago[0]["estado"]!=1){

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $pago[0]["usuario"]);

		$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

		$id_cuenta = $cuenta["id"];

		$datos = array("id" => $id,
		"estado" => $estado,
		"id_cuenta" => $cuenta["id"]);

		return $respuesta = ControladorPagos::ctrActualizarPagoRetiro($datos);

		}else{
			echo "pagado";
		}

	}



	/*=============================================
	Cambiar estado pago Recurrencia
	=============================================*/	

	public $idPagoRecurrencia;

	public function ajaxEstadoPagoRecurrencia(){

		$estado = 1;

		$id = $this->idPagoRecurrencia;

		$pago = ControladorPagos::ctrMostrarPagosRecurrencia("id", $id);

		

		if($pago["estado"]==0){

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $pago["id_usuario"]);

		$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

		$id_cuenta = $cuenta["id"];

		$campana=ControladorCampanas::ctrMostrarCampanas("id", $pago["id_campana"]);

		$listaRecurrencia = json_decode($campana["nombre"], true);

		$total=0;

		foreach ($listaRecurrencia as $key2 => $value2) {
			if($pago["inversiones"]==$value2["inversiones"]){
			 $total=$total+$value2["retorno"];
			 break;
			}
		}

		$datos = array("id" => $id,
		"estado" => $estado,
		"id_cuenta" => $cuenta["id"],
	    "total" => $total);

		return $respuesta = ControladorPagos::ctrActualizarPagoRecurrencia($datos);

		}else{
			echo "pagado";
		}

	}



	/*=============================================
	Cambiar estado pago publicidad
	=============================================*/	

	public $idPagoPublicidad;

	public function ajaxEstadoPagoPublicidad(){

		$estado = 1;

		$id = $this->idPagoPublicidad;

		$pago = ControladorPagos::ctrMostrarPagosPublicidad("id", $id);

		if($pago["estado"]==0){

		$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $pago["id_comprobante"]);

		$campana = ControladorCampanas::ctrMostrarCampanas("id", $comprobante[0]["campana"]);

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

		$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

		$id_cuenta = $cuenta["id"];

		$total=$campana["retorno"];

		$datos = array("id" => $id,
		"estado" => $estado,
		"valor" => $total,
		"id_cuenta" => $cuenta["id"]);

		return $respuesta = ControladorPagos::ctrActualizarPagoPublicidad($datos);

		}else{
			echo "pagado";
		}

	}


	/*=============================================
	Cambiar estado pago Comision
	=============================================*/	

	public $idPagoComision;

	public function ajaxEstadoPagoComision(){

		$estado = 1;
		$id = $this->idPagoComision;
		
		$pago = ControladorPagos::ctrMostrarPagosComisiones("id", $id);

		if($pago["estado"]==0){

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $pago["id_usuario"]);

		$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$usuario["id_usuario"],"estado",1);

		$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision",$pago["id"]);

		$total = 0;
		foreach($comisiones as $key => $value){
	   
			$porcentaje=0;
			$ganancia=0;
			if($value["nivel"]==1){
				$porcentaje=5;
			}
			if($value["nivel"]==2){
				$porcentaje=4;
			}
			if($value["nivel"]==3){
				$porcentaje=3;
			}
			if($value["nivel"]==4){
				$porcentaje=2;
			}
			if($value["nivel"]==5){
				$porcentaje=1;
			}
			$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);

			$ganancia = ($comprobante[0]["valor"]*$porcentaje)/100;
			$total=$total+$ganancia;
		}

		$datos = array("id" => $id,
	                   "estado" => $estado,
					   "valor" => $total,
					   "id_cuenta" => $cuenta["id"]);

		return $respuesta = ControladorPagos::ctrActualizarPagoComision($datos);

	}else{
		echo "pagado";
	}

	}


	/*=============================================
	Cambiar estado varios pagos
	=============================================*/	

	public $idsPagos;
	public $tipoPago;

	public function ajaxEstadoPagos(){

		$estado = 1;
		$tipoPago=$this->tipoPago;
		$total = 0;
		$referidos_obtenidos = 0;

		$arrayPagos = explode(",", $this->idsPagos);

		for($i=0; $i<count($arrayPagos); $i++){

			if($tipoPago=="comisiones"){
				$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision",$arrayPagos[$i]);

				$pago = ControladorPagos::ctrMostrarPagosComisiones("id", $arrayPagos[$i]);
	
				foreach($comisiones as $key => $value){
			   
					$porcentaje=0;
					$ganancia=0;
					if($value["nivel"]==1){
						$porcentaje=5;
					}
					if($value["nivel"]==2){
						$porcentaje=4;
					}
					if($value["nivel"]==3){
						$porcentaje=3;
					}
					if($value["nivel"]==4){
						$porcentaje=2;
					}
					if($value["nivel"]==5){
						$porcentaje=1;
					}
					$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);
		
					$ganancia = ($comprobante[0]["valor"]*$porcentaje)/100;
					$total=$total+$ganancia;
				}
				$id_usuario=$pago["id_usuario"];

			}else if($tipoPago=="inversiones"){
				$pago = ControladorPagos::ctrMostrarPagos("id",$arrayPagos[$i]);

				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$pago["id_comprobante"]);

				$usuario=ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

				$id_usuario=$usuario["id_usuario"];
				
			}else if($tipoPago=="publicidad"){
				$pago = ControladorPagos::ctrMostrarPagosPublicidad("id",$arrayPagos[$i]);

				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$pago["id_comprobante"]);

				$usuario=ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

				$id_usuario=$usuario["id_usuario"];
		}else if($tipoPago=="bonos"){	

				$pago = ControladorPagos::ctrMostrarPagosExtras("id", $arrayPagos[$i]);

				$bonos = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra",$arrayPagos[$i]);

				foreach($bonos as $key => $value){

					$campana = ControladorCampanas::ctrMostrarCampanas("id", $value["id_campana"]);
		
					$total=$total+$campana["retorno"];
				}

				$id_usuario=$pago["id_usuario"];
				$referidos_obtenidos=count($bonos);

			}else if($tipoPago=="retiros"){

				$pago = ControladorPagos::ctrMostrarSolicitudesRetiro("id", $arrayPagos[$i],null,null);
				$total=$pago[0]["valor"];

				$id_usuario=$pago[0]["usuario"];
			}

			$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$id_usuario,"estado",1);
	
			$datos = array("id" => $arrayPagos[$i],
						   "estado" => $estado,
						   "valor" => $total,
						   "id_cuenta" => $cuenta["id"],
						   "tipoPago" => $tipoPago,
						   "referidos_obtenidos" => $referidos_obtenidos);

			$respuesta = ControladorPagos::ctrActualizarPagos($datos);
			$total=0;
		}

		return $respuesta;

	}



	/*=============================================
	Cambiar estado pago Extra
	=============================================*/	

	public $idPagoExtra;

	public function ajaxEstadoPagoExtra(){

		$estado = 1;
		$id = $this->idPagoExtra;
		$total=0;

		$pago = ControladorPagos::ctrMostrarPagosExtras("id", $id);

	if($pago["estado"]==0){

			$cuentaActiva = ControladorCuentas::ctrMostrarCuentasxEstado("usuario", $pago["id_usuario"], "estado", 1);

		if($cuentaActiva!=""){

		$bonos = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra",$id);

			foreach($bonos as $key => $value){

				$campana = ControladorCampanas::ctrMostrarCampanas("id", $value["id_campana"]);
		
				$total=$total+$campana["retorno"];
			}

			$id_usuario=$pago["id_usuario"];
			$referidos_obtenidos=count($bonos);

			$cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario",$id_usuario,"estado",1);

		$datos = array("id" => $id,
		"estado" => $estado,
		"valor" => $total,
		"id_cuenta" => $cuenta["id"],
		"referidos_obtenidos" => $referidos_obtenidos);

		return $respuesta = ControladorPagos::ctrActualizarPagoExtra($datos);

		}else{
			echo "cuenta-bancaria-inactiva";
		}

		}else{
			echo "pagado";
		}

	}



    /*=============================================
	EDITAR COMPROBANTE
	=============================================*/	

	public $idComprobanteEditar;

	public function ajaxEditarComprobante(){

		$item = "id";
		$valor = $this->idComprobanteEditar;

		$respuesta = ControladorComprobantes::ctrMostrarComprobantes($item, $valor);

		echo json_encode($respuesta);

	}




}



/*=============================================
Cambiar estado pago inversion
=============================================*/	

if(isset($_POST["idPagoInversion"])){

	$pagoInversion = new AjaxPagos();
	$pagoInversion -> idPagoInversion = $_POST["idPagoInversion"];
	$pagoInversion -> ajaxEstadoPagoInversion();

}


/*=============================================
Cambiar estado pago retiro
=============================================*/	

if(isset($_POST["idPagoRetiro"])){

	$pagoRetiro = new AjaxPagos();
	$pagoRetiro -> idPagoRetiro = $_POST["idPagoRetiro"];
	$pagoRetiro -> ajaxEstadoPagoRetiro();

}


/*=============================================
Cambiar estado pago recurrencia
=============================================*/	

if(isset($_POST["idPagoRecurrencia"])){

	$pagoRecurrencia = new AjaxPagos();
	$pagoRecurrencia -> idPagoRecurrencia = $_POST["idPagoRecurrencia"];
	$pagoRecurrencia -> ajaxEstadoPagoRecurrencia();

}


/*=============================================
Cambiar estado pago publicidad
=============================================*/	

if(isset($_POST["idPagoPublicidad"])){

	$pagoPublicidad = new AjaxPagos();
	$pagoPublicidad -> idPagoPublicidad = $_POST["idPagoPublicidad"];
	$pagoPublicidad -> ajaxEstadoPagoPublicidad();

}


/*=============================================
Cambiar estado pago Comision
=============================================*/	

if(isset($_POST["idPagoComision"])){

	$pagoComision = new AjaxPagos();
	$pagoComision -> idPagoComision = $_POST["idPagoComision"];
	$pagoComision -> ajaxEstadoPagoComision();

}



/*=============================================
Cambiar estado de varios pagos
=============================================*/	

if(isset($_POST["idsPagos"])){

	$pago = new AjaxPagos();
	$pago -> idsPagos = $_POST["idsPagos"];
	$pago -> tipoPago = $_POST["tipoPago"];
	$pago -> ajaxEstadoPagos();

}


/*=============================================
Cambiar estado pago Extra
=============================================*/	

if(isset($_POST["idPagoExtra"])){

	$pagoExtra = new AjaxPagos();
	$pagoExtra -> idPagoExtra = $_POST["idPagoExtra"];
	$pagoExtra -> ajaxEstadoPagoExtra();

}


/*=============================================
CAMBIAR CAMPAÑA COMPROBANTE SELECT
=============================================*/	

if(isset($_POST["cambiarCampanaComprobante"])){

	$cambiarCampanaComprobante = new AjaxComprobantes();
	$cambiarCampanaComprobante -> idComprobateCampana = $_POST["cambiarCampanaComprobante"];
	$cambiarCampanaComprobante -> idCampana = $_POST["idCampana"];
	$cambiarCampanaComprobante -> ajaxCambiarCampanaComprobante();

}





/*=============================================
EDITAR COMPROBANTE
=============================================*/
if(isset($_POST["idComprobanteEditar"])){

	$editar = new AjaxComprobantes();
	$editar -> idComprobanteEditar = $_POST["idComprobanteEditar"];
	$editar -> ajaxEditarComprobante();

}

/*=============================================
Eliminar Usuario
=============================================*/	

if(isset($_POST["idUsuarioEliminar"])){

	$eliminarUsuario = new AjaxUsuarios();
	$eliminarUsuario -> idUsuarioEliminar = $_POST["idUsuarioEliminar"];
	$eliminarUsuario -> ajaxEliminarUsuario();

}


