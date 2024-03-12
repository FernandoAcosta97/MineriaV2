<?php

require_once "../controladores/campanas.controlador.php";
require_once "../modelos/campanas.modelo.php";
require_once "../controladores/comprobantes.controlador.php";
require_once "../modelos/comprobantes.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxCampanas{

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
	CAMBIAR ESTADO CAMPAÑA
	=============================================*/	

	public $activarIdCampana;
	public $activarCampana;

	public function ajaxActivarCampana(){

		$tabla = "campanas";

		$item = "estado";
		$valor = $this->activarCampana;

		$id = $this->activarIdCampana;

		$campanas = ControladorCampanas::ctrMostrarCampanasLimitActivas();

		foreach($campanas as $key => $value){

		if((count($campanas)==1 && $valor==0 && $value["id"]==$id) || (count($campanas)==3) && $valor==1){

		echo "error";
		break;

		}else{
		
		// $inversiones = ControladorCampanas::ctrMostrarComprobantesCampanaDoc("id", $id);
		// print_r($inversiones); 

		$respuesta = ModeloCampanas::mdlActualizarCampana($tabla, $id, $item, $valor);

		echo "ok";

		// foreach($inversiones as $key => $value){

		// 	$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$value["doc_usuario"]);
		// 	// print_r($usuario); 
		// 	$comprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantesxEstadoxCampana("doc_usuario",$value["doc_usuario"],"estado",1,"estado",1);


			// if($usuario["operando"]==0 && count($comprobantesUsuario)>0){
			// 	$operando = ControladorUsuarios::ctrActualizarUsuario($usuario["id_usuario"],"operando",1);
			// }else if($usuario["operando"]==1 && count($comprobantesUsuario)==0){
			// 	$operando = ControladorUsuarios::ctrActualizarUsuario($usuario["id_usuario"],"operando",0);
			// }

		// }

	}
}

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
	Cancelar Suscripción
	=============================================*/	
	public $idUsuario;

	public function ajaxCancelarSuscripcion(){

		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrCancelarSuscripcion($valor);

		echo $respuesta;

	}

	/*=============================================
	EDITAR CAMPAÑA
	=============================================*/	

	public $idCampanaEditar;

	public function ajaxEditarCampana(){

		$item = "id";
		$valor = $this->idCampanaEditar;

		$respuesta = ControladorCampanas::ctrMostrarCampanas($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
    Eliminar Campana Inversion
    =============================================*/	

	public $idCampanaEliminar;

	public function ajaxEliminarCampana(){

		$valor = $this->idCampanaEliminar;

		$respuesta = ControladorCampanas::ctrEliminarCampana($valor);

		echo $respuesta;

	}



	/*=============================================
    Eliminar Campana Publicidad
    =============================================*/	

	public $idCampanaEliminarPublicidad;

	public function ajaxEliminarCampanaPublicidad(){

		$valor = $this->idCampanaEliminarPublicidad;

		$respuesta = ControladorCampanas::ctrEliminarCampana($valor);

		echo $respuesta;

	}


	/*=============================================
    Eliminar Campana Bono Extra
    =============================================*/	

	public $idCampanaEliminarBono;

	public function ajaxEliminarCampanaBono(){

		$valor = $this->idCampanaEliminarBono;

		$respuesta = ControladorCampanas::ctrEliminarCampanaBono($valor);

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
ACTIVAR CAMPAÑA
=============================================*/	

if(isset($_POST["activarIdCampana"])){

	$activarIdCampana = new AjaxCampanas();
	$activarIdCampana -> activarIdCampana = $_POST["activarIdCampana"];
	$activarIdCampana -> activarCampana = $_POST["activarCampana"];
	$activarIdCampana -> ajaxActivarCampana();

}


/*=============================================
OPERAR USUARIO
=============================================*/	

if(isset($_POST["operarUsuario"])){

	$operarUsuario = new AjaxUsuarios();
	$operarUsuario -> operarUsuario = $_POST["operarUsuario"];
	$operarUsuario -> operarId = $_POST["operarId"];
	$operarUsuario -> ajaxOperarUsuario();

}

/*=============================================
Suscripción con Paypal
=============================================*/	

if(isset($_POST["suscripcion"]) && $_POST["suscripcion"] == "ok"){

	$paypal = new AjaxUsuarios();
	$paypal -> nombre = $_POST["nombre"];
	$paypal -> email = $_POST["email"];
	$paypal -> documento = $_POST["documento"];
	$paypal -> ajaxSuscripcion();

}

/*=============================================
Cancelar Suscrpción
=============================================*/	

if(isset($_POST["idUsuario"])){

	$cancelarSuscripcion = new AjaxUsuarios();
	$cancelarSuscripcion -> idUsuario = $_POST["idUsuario"];
	$cancelarSuscripcion -> ajaxCancelarSuscripcion();

}

/*=============================================
EDITAR CAMPANA
=============================================*/
if(isset($_POST["idCampanaEditar"])){

	$editar = new AjaxCampanas();
	$editar -> idCampanaEditar = $_POST["idCampanaEditar"];
	$editar -> ajaxEditarCampana();

}

/*=============================================
Eliminar Campaña Bono
=============================================*/	

if(isset($_POST["idCampanaEliminarBono"])){

	$eliminarCampana = new AjaxCampanas();
	$eliminarCampana -> idCampanaEliminarBono = $_POST["idCampanaEliminarBono"];
	$eliminarCampana -> ajaxEliminarCampanaBono();

}

/*=============================================
Eliminar Campaña Inversion
=============================================*/	

if(isset($_POST["idCampanaEliminar"])){

	$eliminarCampana = new AjaxCampanas();
	$eliminarCampana -> idCampanaEliminar = $_POST["idCampanaEliminar"];
	$eliminarCampana -> ajaxEliminarCampana();

}



/*=============================================
Eliminar Campaña Publicidad
=============================================*/	

if(isset($_POST["idCampanaEliminarPublicidad"])){

	$eliminarCampana = new AjaxCampanas();
	$eliminarCampana -> idCampanaEliminarPublicidad = $_POST["idCampanaEliminarPublicidad"];
	$eliminarCampana -> ajaxEliminarCampanaPublicidad();

}


