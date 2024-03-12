<?php 

class ControladorSoporte{

	/*=============================================
	Nuevo Ticket
	=============================================*/

	public function ctrCrearTicket(){

		if(isset($_POST["mensaje"])){

			$url = ControladorGeneral::ctrRuta();

			if(preg_match('/^[0-9]+$/', $_POST["remitente"]) &&			
				preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["asunto"]) &&
				preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["mensaje"])
				){

				$adjuntosArray = array();

				if($_POST["adjuntos"] != ""){

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL TICKET
					=============================================*/

					$directorio = "vistas/img/tickets/".$_POST["remitente"];

					/*=============================================
					PREGUNTAMOS PRIMERO SI NO EXISTE EL DIRECTORIO PARA CREARLO
					=============================================*/

					if(!file_exists($directorio)){	

						mkdir($directorio, 0755);

					}


					$adjuntos = json_decode($_POST["adjuntos"], true);
					
					foreach ($adjuntos as $key => $value) {
						
						$separarAdjunto = explode(";", $value);
						
						$separarBase64 = explode(",", $separarAdjunto[1]);					
						if($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $separarAdjunto[0] == "data:application/vnd.ms-excel"){						
							$aleatorio = mt_rand(100,999);

							$ruta = $directorio."/".$aleatorio.".xlsx";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);

						}

						else if($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $separarAdjunto[0] == "data:application/msword"){
							
							$aleatorio = mt_rand(100,999);

							$ruta = $directorio."/".$aleatorio.".docx";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
							
						}

						else if($separarAdjunto[0] == "data:application/pdf"){

							$aleatorio = mt_rand(100,999);

							$ruta = $directorio."/".$aleatorio.".pdf";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
							
						}

						else if($separarAdjunto[0] == "data:image/jpeg"){

							$aleatorio = mt_rand(100,999);

							$ruta = $directorio."/".$aleatorio.".jpg";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
						
						}

						else if($separarAdjunto[0] == "data:image/png"){

							$aleatorio = mt_rand(100,999);

							$ruta = $directorio."/".$aleatorio.".png";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
					
						}

						else{

							echo"<script>

								swal.fire({
									icon:'error',
									html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡No se permiten formatos diferentes a JPG, PNG, EXCEL, WORD o PDF!</p></div>',
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									buttonsStyling: false,
									customClass: {
										popup: 'border-red-500 border-2 p-4 rounded-3xl',
										confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
									}
									
								}).then(function(result){

										if(result.value){   
										    window.location = '".$url."'backoffice/soporte';
										} 
								});

							</script>";

						}
						
					}//Finaliza el foreach de archivos adjuntos

				}//Finaliza condición cuando no hay adjuntos

				/*=============================================
				 Enviamos info del ticket al modelo
				=============================================*/

				$tabla = "soporte";

				if(is_array($_POST["receptor"])){

					/*=============================================
					Enviar ticket a todos los usuarios por parte del administrador
					=============================================*/

					if ($_POST["receptor"][0] == 0) {
						
						$listaUsuarios = ControladorUsuarios::ctrMostrarUsuarios(null,null);

						foreach ($listaUsuarios as $key => $value) {
							
							if($key != 0){

							$datos = array("remitente"=>$_POST["remitente"], 
							"receptor"=>$value["id_usuario"], 
							"asunto"=>$_POST["asunto"], 
							"mensaje"=>$_POST["mensaje"], 
							"adjuntos"=>json_encode($adjuntosArray), 
							"tipo"=>"enviado");

							$respuesta = ModeloSoporte::mdlCrearTicket($tabla, $datos);

							if($respuesta != "error"){

								$notificacion = ControladorNotificaciones::ctrRegistroNotificaciones("soporte", $value["id_usuario"], $respuesta);
		
							}

							}

						}

					}else{

						/*=============================================
						Enviar ticket a algunos usuarios por parte del administrador
						=============================================*/

						foreach ($_POST["receptor"] as $key => $value) {

							$datos = array("remitente"=>$_POST["remitente"], 
							"receptor"=>$_POST["receptor"][$key], 
							"asunto"=>$_POST["asunto"], 
							"mensaje"=>$_POST["mensaje"], 
							"adjuntos"=>json_encode($adjuntosArray), 
							"tipo"=>"enviado");

							$respuesta = ModeloSoporte::mdlCrearTicket($tabla, $datos);

							if($respuesta != "error"){

								$notificacion = ControladorNotificaciones::ctrRegistroNotificaciones("soporte", $_POST["receptor"][$key], $respuesta);
		
							}
					
						}

					}


				}else{

					/*=============================================
					Enviar ticket de usuario a administrador
					=============================================*/

					$datos = array("remitente"=>$_POST["remitente"], 
					"receptor"=>$_POST["receptor"], 
					"asunto"=>$_POST["asunto"], 
					"mensaje"=>$_POST["mensaje"], 
					"adjuntos"=>json_encode($adjuntosArray), 
					"tipo"=>"enviado");

					$respuesta = ModeloSoporte::mdlCrearTicket($tabla, $datos);

					if($respuesta != "error"){

						$notificacion = ControladorNotificaciones::ctrRegistroNotificaciones("soporte", $_POST["receptor"], $respuesta);

					}

				}

				if($respuesta != "error"){

					//notificaciones = "tipo:soporte", "id_user_not:$_POST["receptor"]"

					echo"<script>

						swal.fire({
							icon:'success',
							html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">¡SU TICKET HA SIDO CORRECTAMENTE ENVIADO!</h2></div><p class=\"text-primario text-2xl\">¡Muy pronto nos comunicaremos con usted!</p></div>',
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',
							buttonsStyling: false,
							customClass: {
								popup: 'border-primario border-2 p-4 rounded-3xl',
								confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
							}
						}).then(function(result){

								if(result.value){   
								    window.location = '".$url."'backoffice/soporte';
								} 
						});

					</script>";

				}				

			}else{

				echo"<script>

					swal.fire({
						icon:'error',
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
							    window.location = '".$url."'backoffice/soporte';
							} 
					});

				</script>";

			}

		}

	}

	/*=============================================
	Mostrar ticket
	=============================================*/

	public static function ctrMostrarTickets($item, $valor){

		$tabla = "soporte";

		$respuesta = ModeloSoporte::mdlMostrarTickets($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Actualizar ticket
	=============================================*/

	static public function ctrActualizarTicket($id, $item, $valor){

		$tabla = "soporte";

		$respuesta = ModeloSoporte::mdlActualizarTicket($tabla, $id, $item, $valor);

		return $respuesta;
		
	}


	/*=============================================
	Eliminar ticket
	=============================================*/

	static public function ctrEliminarTicket($id){

		$tabla = "soporte";

		$respuesta = ModeloSoporte::mdlEliminarTicket($tabla, $id);

		return $respuesta;
		
	}


	/*=============================================
	VACIAR PAPELERA
	=============================================*/

	static public function ctrVaciarPapelera($tipo){

		$tabla = "soporte";

		$respuesta = ModeloSoporte::mdlVaciarPapelera($tabla, $tipo);

		return $respuesta;
		
	}


}