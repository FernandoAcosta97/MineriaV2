<?php

require_once "../controladores/campanas.controlador.php";
require_once "../modelos/campanas.modelo.php";
require_once "../controladores/comprobantes.controlador.php";
require_once "../modelos/comprobantes.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/ia.controlador.php";
require_once "../modelos/ia.modelo.php";

class AjaxCampanas{



	/*=============================================
	ACTIVAR COMPROBANTES
	=============================================*/	

	public $aprobadoIdComprobante;
	public $aprobadoComprobante;

	public function ajaxAprobadoComprobante(){

		$tabla = "comprobantes";

		$item = "estado";
		$valor = $this->aprobadoComprobante;

		$id = $this->aprobadoIdComprobante;

		$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$id);

		$campana_comprobante = ControladorCampanas::ctrMostrarCampanas("id", $comprobante[0]["campana"]);

		if($campana_comprobante["tipo"]==3){

			$publicidad_pagada = ControladorPagos::ctrMostrarPagosPublicidadxEstado("id_comprobante",$id,"estado",1);

		if($publicidad_pagada==""){

        //Actualizar estado del comprobante
		$respuesta = ModeloComprobantes::mdlActualizarComprobante($tabla, $id, $item, $valor);
		$doc_usuario = $comprobante[0]["doc_usuario"];

		//Registrar pago publicidad
		if($valor==1){
			$usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$comprobante[0]["doc_usuario"]);
			$pago=ControladorPagos::ctrRegistrarPagosPublicidad($usu["id_usuario"],$comprobante[0]["id"]);
		}else{
			$pago=ControladorPagos::ctrMostrarPagosPublicidad("id_comprobante",$comprobante[0]["id"]);
			if($pago!=""){
            $eliminar=ControladorPagos::ctrEliminarPagosPublicidad($pago["id"]);
			}
		}


	     }
		}else{

		$inversion_pagada = ControladorPagos::ctrMostrarPagosInversionesxEstado("id_comprobante",$id,"estado",1);

		$comision_pagada = ControladorPagos::ctrMostrarPagosComisionesxComprobante("id_comprobante",$id,"estado",1);

		$bono_pagado = ControladorPagos::ctrMostrarPagosExtrasxComprobante("id_comprobante",$id,"estado",1);

		if($inversion_pagada=="" && $bono_pagado=="" && $comision_pagada=="" && $comprobante[0]["estado"]!=$valor){

        //Actualizar estado del comprobante
		$respuesta = ModeloComprobantes::mdlActualizarComprobante($tabla, $id, $item, $valor);

		//Registrar pago inversión, apalancamiento y recurrencia
		if($valor==1){
			$t=0;
			$campana_apalancamiento=ControladorCampanas::ctrMostrarCampanasxEstado("tipo", 4, "estado", 1);

			$id_campana_apalancamiento=0;
	
			if($campana_apalancamiento!=""){
	
				$comprobanteFechaBonoApalancamiento = ControladorComprobantes::ctrMostrarComprobantesxEstadoyFechaBono("id", $id,$campana_apalancamiento["fecha_inicio"],$campana_apalancamiento["fecha_fin"]);

				if($comprobanteFechaBonoApalancamiento!=""){
					$id_campana_apalancamiento=$campana_apalancamiento["id"];
				}
			} 

			$usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$comprobante[0]["doc_usuario"]);

			//Registrar pagos afiliados
			$pagos_afiliados=ControladorPagos::ctrRegistrarPagoAfiliados($usu, $valor, $comprobante);

			//registrar pagos inversiones
			$pago=ControladorPagos::ctrRegistrarPagos($usu["id_usuario"],$comprobante[0]["id"], $id_campana_apalancamiento);


			$campana_recurrencia=ControladorCampanas::ctrMostrarCampanasxEstado("tipo", 5, "estado", 1);

			if($campana_recurrencia!=""){
				$t=0;

				$comprobantesFechaBonoRecurrencia = ControladorComprobantes::ctrMostrarComprobantesxUsuarioyFechaBonoAll("doc_usuario",$usu["doc_usuario"],$campana_recurrencia["fecha_inicio"],$campana_recurrencia["fecha_fin"]);

				$listaRecurrencia = json_decode($campana_recurrencia["nombre"], true);

				$t=count($comprobantesFechaBonoRecurrencia);
				$aprobado=false;
				if($listaRecurrencia!=null){

				foreach ($listaRecurrencia as $key2 => $value2) {
					if($t==$value2["inversiones"]){
					 $aprobado=true;
					 break;
					}
				}
			}

				if($aprobado){

					$pago_recurrente=ControladorPagos::ctrMostrarPagosRecurrentesxEstado("id_usuario",$usu["id_usuario"], "estado", 0);
					if($pago_recurrente==""){

						ControladorPagos::ctrRegistrarPagosBonosRecurrencia($usu["id_usuario"],$t,$campana_recurrencia["id"]);

					}else{
						ControladorPagos::ctrActualizarPagoRecurrencia2("inversiones", ($pago_recurrente["inversiones"]+1), $pago_recurrente["id"]);
					}

				}
			}

		}else{
			$pago=ControladorPagos::ctrMostrarPagos("id_comprobante",$comprobante[0]["id"]);
			if($pago!=""){
            $eliminar=ControladorPagos::ctrEliminarPagos($pago["id"]);
			}

			$usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$comprobante[0]["doc_usuario"]);

			//Registrar pagos afiliados
			$pagos_afiliados=ControladorPagos::ctrRegistrarPagoAfiliados($usu, $valor, $comprobante);

			$pago_recurrente=ControladorPagos::ctrMostrarPagosRecurrentesxEstado("id_usuario",$usu["id_usuario"], "estado", 0);

			$campana_recurrencia=ControladorCampanas::ctrMostrarCampanas("id", $pago_recurrente["id_campana"]);

			$listaRecurrencia=null;

			if($campana_recurrencia!=""){

			$listaRecurrencia = json_decode($campana_recurrencia["nombre"], true);
			}

			$t=$pago_recurrente["inversiones"]-1;
			$aprobado=false;

			if($listaRecurrencia!=null){

			foreach ($listaRecurrencia as $key2 => $value2) {
				if($t==$value2["inversiones"]){
				 $aprobado=true;
				 break;
				}
			}
		}

			if($pago_recurrente!=""){
				if(!$aprobado){
            	$eliminar=ControladorPagos::ctrEliminarPagosRecurrentes($pago_recurrente["id"]);
				}else{
					ControladorPagos::ctrActualizarPagoRecurrencia2("inversiones", ($pago_recurrente["inversiones"]-1), $pago_recurrente["id"]);
				}
			}
		}
	
		$doc_usuario = $comprobante[0]["doc_usuario"];

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$doc_usuario);

		$comprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantesxEstadoNoPublicidad("doc_usuario",$doc_usuario,"estado",1);

		//Cambiar estado operando usuario
		if($usuario["operando"]==0 && count($comprobantesUsuario)>0){
			$operando = ControladorUsuarios::ctrActualizarUsuario($usuario["id_usuario"],"operando",1);
		}else if($usuario["operando"]==1 && count($comprobantesUsuario)==0){
			$operando = ControladorUsuarios::ctrActualizarUsuario($usuario["id_usuario"],"operando",0);
		}

		//Registrar pago bienvenida
		$pago_bienvenida=ControladorPagos::ctrRegistrarPagoBienvenida($usuario,$valor,$id);

    // Registrar pago bono extra    
	if($valor==1){
		$bono_extra = ControladorCampanas::ctrMostrarCampanasxEstado("nombre","Bono Extra","estado","1");

	   if($bono_extra!=""){
			$totalComprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantesxEstado("doc_usuario",$doc_usuario,"estado",1);
			$total = count($totalComprobantesUsuario);

			$comprobanteFechaBono = ControladorComprobantes::ctrMostrarComprobantesxEstadoyFechaBono("id", $id,$bono_extra["fecha_inicio"],$bono_extra["fecha_fin"]);

			// print_r($comprobanteFechaBono);
			// print_r($total);
		if($total==1 && $comprobanteFechaBono!=""){

			$patrocinador=ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado",$usuario["patrocinador"]);

			if($patrocinador["perfil"]!="admin"){

				$existe_pago_extra=ControladorPagos::ctrMostrarPagosExtras2("id_usuario",$patrocinador["id_usuario"],"estado",0);

				if($existe_pago_extra==""){
					$pago_extra=ControladorPagos::ctrRegistrarPagosExtras($patrocinador["id_usuario"]);

					ControladorPagos::ctrRegistrarBonosExtras($pago_extra, $usuario["id_usuario"], $comprobante[0]["id"], $bono_extra["id"]);
				}else{
					
					ControladorPagos::ctrRegistrarBonosExtras($existe_pago_extra["id"], $usuario["id_usuario"], $comprobante[0]["id"], $bono_extra["id"]);

				}

				}
			}
		}
	  }else{
        //Eliminar Bono extra

		$campana = ControladorCampanas::ctrMostrarCampanasxEstado("nombre","Bono Extra","estado","1");

		if($campana!=""){

		$comprobantesFechaBono = ControladorComprobantes::ctrMostrarComprobantesxEstadoyFechaBonoUsuario("doc_usuario", $usuario["doc_usuario"],"estado",1,$campana["fecha_inicio"],$campana["fecha_fin"]);

		$patrocinador=ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado",$usuario["patrocinador"]);

		$pago_extra=ControladorPagos::ctrMostrarPagosExtras2("id_usuario",$patrocinador["id_usuario"],"estado",0);

		if($pago_extra!=""){

        $bonos_extras = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra",$pago_extra["id"]);	

		if(count($bonos_extras)==1 && count($comprobantesFechaBono)==0){

		ControladorPagos::ctrEliminarBonoExtra("id", $bonos_extras[0]["id"]);
		ControladorPagos::ctrEliminarPagoExtra($pago_extra["id"]);
    
		}
		if(count($comprobantesFechaBono)==0){

			ControladorPagos::ctrEliminarPagoExtra("id", $pago_extra["id"]);

		}
	}
	}
		
	  }


	//Registrar pago comisión de acuerdo a los niveles del árbol
	if($valor==1){

		$hijo = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $doc_usuario);

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);

		$niveles=5;
		$n=1;

		while($n<=$niveles){

		if($padre["perfil"]=="admin") break;

		$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

		if($existe_pago!=""){

			$comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$comprobante[0]["id"],$n);

		}else{

			$pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($padre["id_usuario"]);
	
			$comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$n);
		}

          $n=$n+1;
		  $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $padre["id_usuario"]);

		  $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);
		}

	}else{
        //Borrar pagos comisiones de acuerdo al arbol cuando se rechaza el comprobante
		$hijo = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $doc_usuario);

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);

		$niveles=5;
		$n=1;

		while($n<=$niveles){

		if($padre["perfil"]=="admin") break;

		$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

		if($existe_pago!=""){

			$comision = ControladorPagos::ctrEliminarComisiones($existe_pago["id"],$comprobante[0]["id"]);

			$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

			if(count($comisiones)==0){

				$pago_comision = ControladorPagos::ctrEliminarPagosComisiones($existe_pago["id"]);

			}

		}

          $n=$n+1;
		  $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $padre["id_usuario"]);

		  $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);
		}
       

	}

   }else{
	echo '<script>

	swal.fire({
		  icon: "error",
		  title: "El comprobante tiene pagos asociados",
		  showConfirmButton: true,
		  confirmButtonText: "Cerrar"
		  }).then(function(result){
					if (result.value) {

					}
		})

	</script>';	
   }
}

	}


	/*=============================================
	Extraccion de datos google cloud vision
	=============================================*/

	public $valorIa;
	public $fotoIa;
	public $doc_usuarioia;
	public $id_campanaia;
	public $tipoImg;
	
	public function ajaxExtraer(){

		$img = $this->fotoIa;
		$valor = $this->valorIa;
		$doc_usuario = $this->doc_usuarioia;
		$id_campana = $this->id_campanaia;
		$tipoImg = $this->tipoImg;

		$respuesta = ControladorIa::ctrExtraer($img, $valor, $doc_usuario, $id_campana, $tipoImg);

		if($respuesta[1]==1){

		$p=new AjaxCampanas();
		$p -> aprobadoIdComprobante = $respuesta[0];
		$p -> aprobadoComprobante = $respuesta[1];
		$p->ajaxAprobadoComprobante();
		}

		echo $respuesta[2];

	}

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
Extraccion de datos google cloud vision
=============================================*/

if(isset($_POST["iavalor"])){

	$val = new AjaxCampanas();
	$val -> valorIa = $_POST["iavalor"];
	$val -> fotoIa = $_FILES['iafoto']['tmp_name'];
	$val -> doc_usuarioia = $_POST["iadoc_usuario"];
	$val -> id_campanaia = $_POST["iaid_campana"];
	$val -> tipoImg = $_POST["tipoImg"];
	$val -> ajaxExtraer();

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


