<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";

class AjaxCuentas{

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
	ACTIVAR CUENTAS
	=============================================*/	

	public $aprobadoIdCuenta;
	public $aprobadoCuenta;

	public function ajaxAprobadoCuentas(){

		$tabla = "cuentas_bancarias";

		$item = "estado";
		$valor = $this->aprobadoCuenta;

		$id = $this->aprobadoIdCuenta;

		$respuesta = ModeloCuentas::mdlActualizarCuenta($tabla, $id, $item, $valor);

	}

	/*=============================================
	OPERAR USUARIO
	=============================================*/	

	public $operarUsuario;
	public $operarId;


	public function ajaxOperarUsuario(){

		$tabla = "usuarios";

		$item = "operando";
		$valor = $this->operarUsuario;

		$id = $this->operarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

	}


	/*=============================================
	EDITAR CUENTA
	=============================================*/	

	public $idCuentaEditar;

	public function ajaxEditarCuenta(){

		$item = "id";
		$valor = $this->idCuentaEditar;

		$respuesta = ControladorCuentas::ctrMostrarCuentas($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
    Eliminar Cuenta bancaria
    =============================================*/	

	public $idCuentaEliminar;

	public function ajaxEliminarCuenta(){

		$valor = $this->idCuentaEliminar;

		$respuesta = ControladorCuentas::ctrEliminarCuenta($valor);

		echo $respuesta;

	}

}

/*=============================================
Validar email existente
=============================================*/

if(isset($_POST["validarEmail"])){

	$valEmail = new AjaxUsuarios();
	$valEmail -> validarEmail = $_POST["validarEmail"];
	$valEmail -> ajaxValidarEmail();

}

/*=============================================
ACTIVAR CUENTA
=============================================*/	

if(isset($_POST["aprobadoIdCuenta"])){

	$aprobadoIdCuenta = new AjaxCuentas();
	$aprobadoIdCuenta -> aprobadoIdCuenta = $_POST["aprobadoIdCuenta"];
	$aprobadoIdCuenta -> aprobadoCuenta = $_POST["aprobadoCuenta"];
	$aprobadoIdCuenta -> ajaxAprobadoCuentas();

}


/*=============================================
EDITAR CUENTA
=============================================*/
if(isset($_POST["idCuentaEditar"])){

	$editar = new AjaxCuentas();
	$editar -> idCuentaEditar = $_POST["idCuentaEditar"];
	$editar -> ajaxEditarCuenta();

}

/*=============================================
Eliminar Campaña
=============================================*/	

if(isset($_POST["idCuentaEliminar"])){

	$eliminarCuenta = new AjaxCuentas();
	$eliminarCuenta -> idCuentaEliminar = $_POST["idCuentaEliminar"];
	$eliminarCuenta -> ajaxEliminarCuenta();

}


