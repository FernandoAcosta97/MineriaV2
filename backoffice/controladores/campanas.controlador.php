<?php

// https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class ControladorCampanas{

	/*=============================================
	Registro de campanas
	=============================================*/

	public function ctrRegistroCampana(){

		if(isset($_POST["tipoCampana"])){
			if($_POST["tipoCampana"]==1 || $_POST["tipoCampana"]==3){

			if(preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST["registroNombreCampana"]) &&
			    preg_match('/^[0-9]+$/', $_POST["registroCupos"]) &&
			    preg_match('/^[0-9]+$/', $_POST["registroRetorno"])){

				$tabla = "campanas";
				$datos = array("nombre" => $_POST["registroNombreCampana"],
				               "retorno" => $_POST["registroRetorno"],
							   "cupos" => $_POST["registroCupos"],
							   "tipo" => $_POST["tipoCampana"],
							   "fecha_inicio" => $_POST["registroFechaInicio"],
							   "fecha_fin" => $_POST["registroFechaFinal"],
							   "fecha_retorno" => $_POST["registroFechaRetorno"],
							   "estado" => 0); 


				$respuesta = ModeloCampanas::mdlRegistroCampana($tabla, $datos);
				$pagina = "campanas";
				if($_POST["tipoCampana"]==3){
					$pagina = "campanas-publicidad";
				}

				if($respuesta == "ok"){


					echo "<script>

							swal.fire({
								type:'success',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">¡CAMPAÑA CREADA CORRECTAMENTE!</h2></div></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-primario border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									window.location = \"'.$pagina.'\";

								}


							});	

						</script>";

					
				}else{
					echo "<script>

							swal.fire({
								type:'error',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡ERROR!</h2></div><p class=\"text-red-500 text-2xl\">¡¡Ha ocurrido un problema, por favor inténtelo nuevamente!!</p></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-red-500 border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									history.back();

								}


							});	

						</script>";

				}

			}else{

				echo "<script>

					swal.fire({
						type:'error',
						html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡No se permiten caracteres especiales en ninguno de los campos!</p></div>',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',
						buttonsStyling: false,
						customClass: {
							popup: 'border-red-500 border-2 p-4 rounded-3xl',
							confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
						}

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});	

				</script>";


			}

		}else if($_POST["tipoCampana"]==2 || $_POST["tipoCampana"]==4 || $_POST["tipoCampana"]==5 || $_POST["tipoCampana"]==6 || $_POST["tipoCampana"]==7){

			$n="Bono Extra";
			$direccion="bonos-extras";
			$retorno=0;
			if(isset($_POST["registroRetorno"])){
				$retorno=$_POST["registroRetorno"];
			}
			if($_POST["tipoCampana"]==4){

				$n="Bono Apalancamiento";
				$direccion="bonos-apalancamiento";
			}else if($_POST["tipoCampana"]==5 || $_POST["tipoCampana"]==6){
				if(!isset($_POST["listaRecurrencias"]) || $_POST["listaRecurrencias"]=="" || $_POST["listaRecurrencias"]=="[]"){
 
					echo"<script>

						swal.fire({
							type:'error',
							html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">No hay recurrencias creadas</h2></div></div>',
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',
							buttonsStyling: false,
							customClass: {
								popup: 'border-red-500 border-2 p-4 rounded-3xl',
								confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
							}
						}).then(function(result){
									if (result.value) {
	
									window.location = 'bonos-recurrencia';
	
									}
								})
	
					</script>";
	
					return;
				}
				$n=$_POST["listaRecurrencias"];
				$direccion="bonos-recurrencia";

				if($_POST["tipoCampana"]==6) $direccion="bonos-afiliados";


			} 

			if($_POST["tipoCampana"]==7){

				$n="Bono Bienvenida";
				$direccion="bonos-bienvenida";

			} 

			if(preg_match('/^[0-9.]+$/', $retorno)){

				$tabla = "campanas";
				$datos = array("nombre" => $n,
				               "retorno" => $retorno,
							   "cupos" => "0",
							   "tipo" => $_POST["tipoCampana"],
							   "fecha_inicio" => $_POST["registroFechaInicio"],
							   "fecha_fin" => $_POST["registroFechaFinal"],
							   "fecha_retorno" => $_POST["registroFechaRetorno"],
							   "estado" => 0); 


				$respuesta = ModeloCampanas::mdlRegistroCampana($tabla, $datos);
				

				if($respuesta == "ok"){


					echo "<script>

							swal.fire({
								type:'success',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">¡BONO CREADO CORRECTAMENTE!</h2></div></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-primario border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									window.location = \"'.$direccion.'\";

								}


							});	

						</script>";

					
				}else{
					echo "<script>

							swal.fire({
								type:'error',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡ERROR!</h2></div><p class=\"text-red-500 text-2xl\">¡¡Ha ocurrido un problema, por favor inténtelo nuevamente!!</p></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-red-500 border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									history.back();

								}


							});	

						</script>";

				}

			}else{

				echo "<script>

					swal.fire({
						type:'error',
						html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡No se permiten caracteres especiales en ninguno de los campos!</p></div>',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',
						buttonsStyling: false,
						customClass: {
							popup: 'border-red-500 border-2 p-4 rounded-3xl',
							confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
						}

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});	

				</script>";


			}


		}
	}

	}



	/*=============================================
	Mostrar Campanas
	=============================================*/

	static public function ctrMostrarCampanas($item, $valor){
	
		$tabla = "campanas";

		$respuesta = ModeloCampanas::mdlMostrarCampanas($tabla, $item, $valor);

		return $respuesta;
		
	}



	/*=============================================
	Mostrar Solo 3 Campañas activas
	=============================================*/

	static public function ctrMostrarCampanasLimitActivas(){
	
		$tabla = "campanas";

		$respuesta = ModeloCampanas::mdlMostrarCampanasLimitActivas($tabla);

		return $respuesta;
		
	}


	/*=============================================
	Mostrar Campanas x Estado
	=============================================*/

	static public function ctrMostrarCampanasxEstado($item, $valor, $item2, $valor2){
	
		$tabla = "campanas";

		$respuesta = ModeloCampanas::mdlMostrarCampanasxEstado($tabla, $item, $valor, $item2, $valor2);

		return $respuesta;
		
	}


	/*=============================================
	Mostrar Campanas x Estado All
	=============================================*/

	static public function ctrMostrarCampanasxEstadoAll($item, $valor, $item2, $valor2){
	
		$tabla = "campanas";

		$respuesta = ModeloCampanas::mdlMostrarCampanasxEstadoAll($tabla, $item, $valor, $item2, $valor2);

		return $respuesta;
		
	}


	/*=============================================
	Mostrar Campanas x Tipo x Estado All
	=============================================*/

	static public function ctrMostrarCampanasxTipoxEstadoAll($item, $valor, $item2, $valor2){
	
		$tabla = "campanas";

		$respuesta = ModeloCampanas::mdlMostrarCampanasxEstadoAll($tabla, $item, $valor, $item2, $valor2);

		return $respuesta;
		
	}


	/*=============================================
	Mostrar Campañas Activas e Inactivas pero no finalizadas
	=============================================*/

	static public function ctrMostrarCampanasNoFinalizadas(){

		$tabla = "campanas";
        $valor = 1;
        $valor2 = 0;

		$respuesta = ModeloCampanas::mdlMostrarCampanasNoFinalizadas($tabla, $valor, $valor2);

		return $respuesta;
	}

	static public function ctrMostrarCampanasAll($item, $valor){
	
		$tabla = "campanas";

		$respuesta = ModeloCampanas::mdlMostrarCampanasAll($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Mostrar los comprobantes de una campaña sin repetir documento de usuario
	=============================================*/

	static public function ctrMostrarComprobantesCampanaDoc($item, $valor){
	
		$tabla = "campanas";
		$tabla2 = "comprobantes";

		$respuesta = ModeloCampanas::mdlMostrarComprobantesCampanaDoc($tabla, $tabla2, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	Mostrar Usuarios FetchAll
	=============================================*/

	static public function ctrMostrarUsuariosFetchAll($item, $valor){
	
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuariosFetchAll($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Total Usuarios
	=============================================*/

	static public function ctrTotalUsuarios(){
	
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlTotalUsuarios($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR USUARIOS X FILTRO O ACTIVIDAD ----- FUNCIONAL FERNANDO
	=============================================*/

	static public function ctrTotalUsuariosXfiltro($item, $valor){
	
		$tabla = "usuarios"; 

		$respuesta = ModeloUsuarios::mdlTotalUsuariosXfiltro($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	Actualizar Usuario
	=============================================*/

	static public function ctrActualizarUsuario($id, $item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	editar campaña
	=============================================*/

	public function ctrEditarCampana(){

		$tabla = "campanas";

		if(isset($_POST["idCampanaEditar"])){

			if($_POST["tipoCampanaEditar"]==1 || $_POST["tipoCampanaEditar"]==3){

			if(preg_match('/^[0-9]+$/', $_POST["editarCupos"]) &&
			preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			preg_match('/^[0-9.]+$/', $_POST["editarRetorno"])){

				$datos = array(	"nombre" => $_POST["editarNombre"],
				"retorno" => $_POST["editarRetorno"],
				"cupos" => $_POST["editarCupos"],
				"fecha_inicio" => $_POST["editarFechaInicio"],
				"fecha_fin" => $_POST["editarFechaFinal"],
				"fecha_retorno" => $_POST["editarFechaRetorno"],
				"id" => $_POST["idCampanaEditar"]);

				
		$respuesta = ModeloCampanas::mdlEditarCampana($tabla, $datos);

		$pagina = "campanas";
		if($_POST["tipoCampanaEditar"]==3){
			$pagina = "campanas-publicidad";
		}

		if($respuesta == "ok"){
			echo "<script>

							swal.fire({
								type:'success',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">ACTUALIZACIÓN EXITOSA</h2></div><p class=\"text-primario text-2xl\">¡LA CAMPAÑA HA SIDO ACTUALIZADA CORRECTAMENTE!</p></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-primario border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									window.location = \"'.$pagina.'\";

								}


							});	

						</script>";
		}

				}else{

					echo "<script>
	
						swal.fire({
							type:'error',
							html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡No se permiten caracteres especiales en ninguno de los campos!</p></div>',
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',
							buttonsStyling: false,
							customClass: {
								popup: 'border-red-500 border-2 p-4 rounded-3xl',
								confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
							}
	
						}).then(function(result){
	
							if(result.value){
	
								history.back();
	
							}
	
	
						});	
	
					</script>";
	
	
				}
				
			}else if($_POST["tipoCampanaEditar"]==2 || $_POST["tipoCampanaEditar"]==4 || $_POST["tipoCampanaEditar"]==5){

				$n="Bono Extra";
				$direccion="bonos-extras";

				if($_POST["tipoCampanaEditar"]==4){

					$n="Bono Apalancamiento";
					$direccion="bonos-apalancamiento";
				} 

				if($_POST["tipoCampanaEditar"]==5){

					$n=$_POST["listaRecurrenciasEditar"];
					$direccion="bonos-recurrencia";
				} 

				if(isset($_POST["editarRetorno"])){
					$editarRetorno=$_POST["editarRetorno"];
				}else{
					$editarRetorno=0;
				}
					

			if(preg_match('/^[0-9]+$/', $editarRetorno)){

				$datos = array(	"nombre" => $n,
				"retorno" => $editarRetorno,
				"cupos" => "0",
				"fecha_inicio" => $_POST["editarFechaInicio"],
				"fecha_fin" => $_POST["editarFechaFinal"],
				"fecha_retorno" => $_POST["editarFechaRetorno"],
				"id" => $_POST["idCampanaEditar"]);

				
		$respuesta = ModeloCampanas::mdlEditarCampana($tabla, $datos);

		if($respuesta == "ok"){
			echo "<script>

							swal.fire({
								type:'success',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">ACTUALIZACIÓN EXITOSA</h2></div><p class=\"text-primario text-2xl\">¡EL BONO HA SIDO ACTUALIZADO CORRECTAMENTE!</p></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-primario border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									window.location = \"'.$direccion.'\";

								}


							});	

						</script>";
		}

				}else{

					echo "<script>
	
						swal.fire({
							type:'error',
							html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡No se permiten caracteres especiales en ninguno de los campos!</p></div>',
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',
							buttonsStyling: false,
							customClass: {
								popup: 'border-red-500 border-2 p-4 rounded-3xl',
								confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
							}
	
						}).then(function(result){
	
							if(result.value){
	
								history.back();
	
							}
	
	
						});	
	
					</script>";
	
	
				}

			}

		}



	}


	/*=============================================
	Tolta comprobantes campaña
	=============================================*/

	static public function ctrTotalComprobantesxCampana($id){

		$tabla = "campanas";
		$tabla2 = "comprobantes";

		$respuesta = ModeloCampanas::mdlTotalComprobantesxCampana($tabla, $tabla2, $id);

		return $respuesta;

	}


	/*=============================================
	Eliminar Campana Inversion
	=============================================*/

	static public function ctrEliminarCampana($id){

		$tabla = "campanas";
		$tabla2 = "comprobantes";

		$totalComprobantes = ModeloCampanas::mdlTotalComprobantesxCampana($tabla, $tabla2, $id);

		if($totalComprobantes["total"] > 0) return $totalComprobantes["total"];

		$respuesta = ModeloCampanas::mdlEliminarCampana($tabla, $id);

		return $respuesta;

	}



	/*=============================================
	Eliminar Campana Bono
	=============================================*/

	static public function ctrEliminarCampanaBono($id){

		$tabla = "campanas";
		$tabla2 = "bonos_extras";

		$totalComprobantes = ModeloCampanas::mdlTotalComprobantesxCampanaBono($tabla, $tabla2, $id);
		
		if($totalComprobantes["total"] > 0) return $totalComprobantes["total"];

		$respuesta = ModeloCampanas::mdlEliminarCampana($tabla, $id);

		return $respuesta;

	}



	/*=============================================
	registrar cuenta bancaria
	=============================================*/

	public function ctrRegistrarCuentaBancaria(){

		$tabla = "cuentas_bancarias";

		if(isset($_POST["idUsuarioCuentaRegistrar"])){

			if(preg_match('/^[0-9]+$/', $_POST["registrarNumeroCuenta"]) &&
			preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registrarEntidadCuenta"]) ){

				$datos = array(	"titular" => $_POST["idUsuarioCuentaRegistrar"],
				"estado" => 1,
				"tipo" => $_POST["registrarTipoCuenta"],
				"entidad" => $_POST["registrarEntidadCuenta"],
				"numero" => $_POST["registrarNumeroCuenta"]);

				
		$respuesta = ModeloUsuarios::mdlRegistrarCuentaBancaria($tabla, $datos);

		if($respuesta == "ok"){
			echo "<script>

							swal.fire({
								type:'success',
								html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">REGISTRO EXITOSO</h2></div><p class=\"text-primario text-2xl\">¡SU CUENTA BANCARIA HA SIDO CREADA CORRECTAMENTE!</p></div>',
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								buttonsStyling: false,
								customClass: {
									popup: 'border-primario border-2 p-4 rounded-3xl',
									confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
								}

							}).then(function(result){

								if(result.value){

									window.location = 'perfil';

								}


							});	

						</script>";
		}

				}
			}



	}




	/*=============================================
	DESCARGAR EXCEL
	=============================================*/
	public function ctrDescargarReporte(){

		if(isset($_GET["campana"])){
			
			$item = "id";
            $valor = $_GET["campana"];
            $campana=ControladorCampanas::ctrMostrarCampanas("id", $valor);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'Comprobantes campaña '.$campana["nombre"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
		
			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>C.C.</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL INVERTIDO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL RETORNO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>			
					</tr>");

			$comprobantes = ControladorComprobantes::ctrMostrarComprobantes("campana", $campana["id"]);
			$ganancia=0;

			foreach ($comprobantes as $row => $item){

            $usuario=ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $item["doc_usuario"]);

            $ganancia = ($item['valor']*$campana['retorno'])/100;

            $total = $item['valor']+$ganancia;
			$estado="";

			if($item["estado"]==1){
				$estado="Aprobado";
			}
			if($item["estado"]==2){
				$estado="Pendiente";
			}
			if($item["estado"]==0){
				$estado="Rechazado";
			}

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["id"]."</td> 
			 			<td style='border:1px solid #eee;'>".$item["doc_usuario"]."</td>
			 			<td style='border:1px solid #eee;'>".$usuario["nombre"]."</td>
						<td style='border:1px solid #eee;'>".$item["valor"]."</td>
						<td style='border:1px solid #eee;'>".$total."</td>
						<td style='border:1px solid #eee;'>".$estado."</td>
						<td style='border:1px solid #eee;'>".$item["fecha"]."</td></tr>");	

			}


			echo "</table>";

		}

	}


	



}

