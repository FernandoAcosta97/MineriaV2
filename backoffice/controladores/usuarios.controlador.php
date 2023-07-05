<?php

// https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

require_once 'vendor/autoload.php';


Class ControladorUsuarios{

	public function ctrDescargarReporte(){

        if(isset($_GET["excel"]) && $_GET["excel"]==1){

        $usuarios=ControladorUsuarios::ctrMostrarUsuarios(null, null);

        $excel = new Spreadsheet();
		$excel->getDefaultStyle()->getFont()->setName('Arial');
		$excel->getDefaultStyle()->getFont()->setSize(12);
        $hoja = $excel->getActiveSheet();
        $hoja->setTitle("Usuarios");

		$hoja->getColumnDimension("A")->setWidth(20);
		$hoja->getStyle("A")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
        $hoja->setCellValue("A1", "Documento");
		$hoja->getColumnDimension("B")->setWidth(30);
        $hoja->setCellValue("B1", "Usuario");
		$hoja->getColumnDimension("C")->setWidth(30);
        $hoja->setCellValue("C1", "Nombre");
		$hoja->getColumnDimension("D")->setWidth(30);
        $hoja->setCellValue("D1", "Correo");
		$hoja->getColumnDimension("E")->setWidth(30);
        $hoja->setCellValue("E1", "Pais");
		$hoja->getColumnDimension("F")->setWidth(20);
        $hoja->setCellValue("F1", "Télefono");
		$hoja->getColumnDimension("G")->setWidth(30);
        $hoja->setCellValue("G1", "Código Afiliado");

        $fila = 2;

        foreach($usuarios as $key => $value){

            $hoja->setCellValue('A'.$fila, $value["doc_usuario"]);
            $hoja->setCellValue('B'.$fila, $value["usuario"]);
            $hoja->setCellValue('C'.$fila, $value["nombre"]);
			$hoja->setCellValue('D'.$fila, $value["email"]);
			$hoja->setCellValue('E'.$fila, $value["pais"]);
			$hoja->setCellValue('F'.$fila, $value["telefono_movil"]);
			$hoja->setCellValue('G'.$fila, $value["enlace_afiliado"]);

            $fila++;

        }

		ob_end_clean();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="usuarios.xlsx"');
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
        exit;
    }


    }

	/*=============================================
	Registro de usuarios
	=============================================*/

	public function ctrRegistroUsuario(){

		if(isset($_POST["registroUsuario"])){

			$existe_usuario=ModeloUsuarios::mdlMostrarUsuarios("usuarios","usuario",trim($_POST["registroUsuario"]));

			if($existe_usuario==""){

			$ruta = ControladorRuta::ctrRuta();

			if(preg_match('/^[-_a-zA-ZñÑáéíóúÁÉÍÓÚ0-9._ ]+$/', $_POST["registroUsuario"]) && preg_match('/^[-_a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', $_POST["registroNombre"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
			    preg_match('/^[a-zA-Z0-9-@.]+$/', $_POST["registroPassword"])){

				$encriptar = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$encriptarEmail = md5($_POST["registroEmail"]);
				$aleatorio = mt_rand(2, 999999999999);
				$u=trim($_POST["registroUsuario"])."-".substr($aleatorio, -4);

				$tabla = "usuarios";
				$datos = array("perfil" => "usuario",
				               "doc_usuario" => $aleatorio,
							   "usuario" => $u,
							   "nombre" => $_POST["registroNombre"],
							   "email" => $_POST["registroEmail"],
							   "password" => $encriptar,
							   "estado" => 1,
							   "verificacion" => 1,
							   "email_encriptado" => $encriptarEmail,
							   "patrocinador" => $_POST["patrocinador"]); 



				$respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);
				

				if($respuesta == "ok"){

					/*=============================================
					Verificación Correo Electrónico
					=============================================*/

					date_default_timezone_set("America/Bogota");

					$mail = new PHPMailer;

					$mail->Charset = "UTF-8";

					$mail->isMail();

					$mail->setFrom("admin@trading.com", "Admin Trading");

					$mail->addReplyTo("admin@trading.com", "Admin Trading");

					$mail->Subject  = "Por favor verifique su dirección de correo electrónico";

					$mail->addAddress($_POST["registroEmail"]);

					$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
						<center>
								
							<img style="padding:20px; width:10%" src="'.$ruta.'vistas/img/logo.png">

						</center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
							<center>

								<img style="padding:20px; width:15%" src="'.$ruta.'vistas/img/email.png">

								<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>

								<a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
									
									<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

								</a>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico.</h5>

							</center>	

						</div>

					</div>');
							
					$envio = $mail->Send();

					if(!$envio){

						echo '<script>

							swal({

								type:"error",
								title: "¡ERROR!",
								text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["registroEmail"].' '.$mail->ErrorInfo.', por favor inténtelo nuevamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									history.back();

								}


							});	

						</script>';


					}else{


						echo '<script>

							swal({

								type:"success",
								title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
								text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "'.$ruta.'ingreso";

								}


							});	

						</script>';


					}
					
				}

			}else{

				echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});	

				</script>';


			}

		}

		}

	}


	/*=============================================
	Registro de usuarios manual
	=============================================*/

	public function ctrRegistroUsuarioManual(){

		if(isset($_POST["registroUsuario"])){

			if(preg_match('/^[-_a-zA-ZñÑáéíóúÁÉÍÓÚ0-9._ ]+$/', $_POST["registroUsuario"]) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
			    preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"]) &&
			    preg_match('/^[0-9]+$/', $_POST["registroDoc"])){

				$encriptar = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$encriptarEmail = md5($_POST["registroEmail"]);
				$firma = "firma";
				$datos_pais = explode(",", $_POST["registroPais"]);
				$pais = $datos_pais[0];
				$codigo_pais = $datos_pais[1];
				$telefono_movil = $datos_pais[2]." ".$_POST["registroTelefono"];
				date_default_timezone_set("America/Bogota");
				$fecha  = getdate();
				$fecha_contrato = $fecha["year"] . "-" . $fecha["mon"] . "-" . $fecha["mday"];
				$aleatorio = mt_rand(2, 999999999999);
				$u=trim($_POST["registroUsuario"])."-".substr($aleatorio, -4);

				$tabla = "usuarios";
				$datos = array("perfil" => "usuario",
				               "doc_usuario" => $_POST["registroDoc"],
							   "usuario" => $u,
							   "nombre" => $_POST["registroNombre"],
							   "email" => $_POST["registroEmail"],
							   "password" => $encriptar,
							   "estado" => 1,
							   "verificacion" => 1,
							   "email_encriptado" => $encriptarEmail,
							   "pais" => $pais,
							   "telefono_movil" => $telefono_movil,
							   "codigo_pais" => $codigo_pais,
							   "patrocinador" => $_POST["registroPatrocinador"],
							   "fecha_contrato" => $fecha_contrato,
							   "firma" => $firma); 


			$respuesta = ModeloUsuarios::mdlRegistroUsuarioManual($tabla, $datos);	
			
			if($respuesta == "ok"){

				$usuario_registrado = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $_POST["registroDoc"]);

				$enlace_afiliado = strtolower(str_replace(" ", "-", $_POST["registroUsuario"])) . "-" . substr($usuario_registrado["doc_usuario"], -4);

				$actualizar_enlace_afiliado = ControladorUsuarios::ctrActualizarUsuario($usuario_registrado["id_usuario"],"enlace_afiliado",$enlace_afiliado);

				$datosUninivel = array("usuario_red" => $usuario_registrado["id_usuario"],
					"patrocinador_red" => $_POST["registroPatrocinador"],
					"periodo_venta" => 10);
		
				$datosArbol = array("usuario_red" => $usuario_registrado["id_usuario"],
					"patrocinador_red" => $_POST["registroPatrocinador"]);
		
				$registroUninivel = ControladorMultinivel::ctrRegistroUninivel($datosUninivel);
				$registroArbol = ControladorMultinivel::ctrRegistroBinaria($datosArbol);

				if($registroArbol == "ok" && $registroUninivel == "ok"){

					echo '<script>

						swal({

							type:"success",
							title: "¡LA CUENTA HA SIDO CREADA CORRECTAMENTE!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){

								window.location="usuarios";

							}


						});	

					</script>';

				}else{

					echo '<script>

					swal({

						type:"error",
						title: "¡ERROR!",
						text: "¡¡Ha ocurrido un problema, por favor inténtelo nuevamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});	

				</script>';
			

				}
			}
				

			}else{

				echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});	

				</script>';


			}

		}

	}


	/*=============================================
	Mostrar Usuarios
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){
	
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Mostrar Usuarios x Patrocinador x estado  -- FERNANDO 
	=============================================*/

	static public function ctrMostrarUsuariosxPatrocinadorxEstado($item1, $valor1,$item2, $valor2,$item3, $valor3){
	
		$tabla1 = $tabla2 = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuariosxPatrocinadorxEstado($tabla1,$tabla2, $item1, $item2, $item3, $valor1, $valor2, $valor3);

		return $respuesta;

	}

	/*=============================================
	Mostrar Ultimos Usuarios Registrados con contrato
	=============================================*/

	static public function ctrMostrarUltimosUsuariosRegistrados(){
	
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarMostrarUltimosUsuariosRegistrados($tabla);

		return $respuesta;

	}

	/*=============================================
	Buscar Usuarios
	=============================================*/

	static public function ctrBuscarUsuarios($valor){
	
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlBuscarUsuarios($tabla, $valor);

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
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[0-9]+$/', $_POST["editarDocumento"]) && preg_match('/^[-_a-zA-ZñÑáéíóúÁÉÍÓÚ0-9._ ]+$/', $_POST["editarUsuario"]) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9._ ]+$/', $_POST["editarNombre"]) &&
			preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"])){

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$p = explode(",", $_POST["inputPaisEditar"]);
				$pais = $p[0];
				$codigo_pais = $p[1];

				$telefono = $p[2]." ".$_POST["editarMovil"];

				$datos = array("doc_usuario" => $_POST["editarDocumento"],
							   "usuario" => $_POST["editarUsuario"],
							   "nombre" => $_POST["editarNombre"],
							   "email" => $_POST["editarEmail"],
							   "password" => $encriptar,
							   "telefono" => $telefono,
							   "perfil" => $_POST["editarPerfil"],
							   "pais" => $pais,
							   "codigo_pais" => $codigo_pais,
							   "id_usuario" => $_POST["id_usuario"]);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}


	/*=============================================
	Eliminar Usuario
	=============================================*/

	static public function ctrEliminarUsuario($id){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $id);

		return $respuesta;

	}


	static public function binance(){
		$key="L6nIDXZkbfcvQ59LKvWhbgBIpE6VfH3y07QYvfKAa153YAKppro7gnY2V2V7ix07";
		$secret="JnKnQqq4iOZm2wjml56aHQhLnWFYzPcBtA4swVWeghj8XbPWDhqVnIU4YWF4OTdY";

		$client = new \Binance\Spot(['key' => $key, 'secret' => $secret]);
		$tiempo = $client->time();
		// echo json_encode($tiempo);
		$response = $client->account();
		// echo json_encode($response);

		$estimate=0;

if (isset($response['balances'])) {
    foreach ($response['balances'] as $balance) {
        $symbol = $balance['asset'];
        $free = $balance['free'];
        $locked = $balance['locked'];

        if($symbol!="USDT" && ($free>0 || $locked>0)){
            
        $usdtValue = $client->avgPrice($symbol . 'USDT');
        // echo $usdtValue["price"];

        // echo $symbol." ".$free."=".$usdtValue["price"];
        
        $freeUsdt = number_format(floatval($free)*floatval($usdtValue["price"]),10);
        $lockedUsdt = number_format(floatval($locked)*floatval($usdtValue["price"]),10);

        // echo $symbol;
        // echo "freeusdt ".$freeUsdt;

        // Calcular el valor estimado del saldo
        $estimate = $estimate+($freeUsdt + $lockedUsdt);
        // echo " estimate".number_format(floatval($estimate),10);

        }else if(($free>0 || $locked>0)){
            $estimate =$estimate+ (number_format(floatval($free),10) + number_format(floatval($locked),10));
            // echo $symbol;
        }
        

    }
}

return $estimate;
	}

	/*=============================================
	Ingreso Usuario
	=============================================*/

	public function ctrIngresoUsuario(){

		if(isset($_POST["ingresoEmail"])){

			 if(preg_match('/^[^0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) && preg_match('/^[a-zA-Z0-9-.]+$/', $_POST["ingresoPassword"])){

			 	$encriptar = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			 	$tabla = "usuarios";
			 	$item = "email";
			 	$valor = $_POST["ingresoEmail"];

			 	$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

			 	if($respuesta && $respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptar){

			 		if($respuesta["verificacion"] == 0){

			 			echo'<script>

							swal({
									type:"error",
								  	title: "¡ERROR!",
								  	text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta, o contáctese con nosotros soporte@sportbit.com.co",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

						return;

			 		}else if($respuesta["estado"] == 0){

						echo'<script>

						   swal({
								   type:"warning",
									 title: "¡Advertencia!",
									 text: "¡Su cuenta se encuentra desactivada , contáctese con nosotros soporte@sportbit.com.co",
									 showConfirmButton: true,
								   confirmButtonText: "Cerrar"
								 
						   }).then(function(result){

								   if(result.value){   
									   history.back();
									 } 
						   });

					   </script>';

					   return;

					}else{

			 			$_SESSION["validarSesion"] = "ok";
			 			$_SESSION["id"] = $respuesta["id_usuario"];
						
			 			$ruta = ControladorRuta::ctrRuta();

			 			echo '<script>
					
							window.location = "'.$ruta.'backoffice/";				

						</script>';

			 		}

			 	}else{

			 		echo'<script>

						swal({
								type:"error",
							  	title: "¡ERROR!",
							  	text: "¡El email o contraseña no coinciden!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

			 	}


			 }else{

			 	echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';

			 }

		}

	}

	/*=============================================
	Cambiar foto perfil
	=============================================*/

	public function ctrCambiarFotoPerfil(){

		if(isset($_POST["idUsuarioFoto"])){

			$ruta = $_POST["fotoActual"];

			if(isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/

				$directorio = "vistas/img/usuarios/".$_POST["idUsuarioFoto"];

				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD Y EL CARPETA
				=============================================*/

				if($ruta != ""){

					unlink($ruta);

				}else{

					if(!file_exists($directorio)){	

						mkdir($directorio, 0755);

					}

				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["cambiarImagen"]["type"] == "image/jpeg"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);	


				}else if($_FILES["cambiarImagen"]["type"] == "image/png"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);	

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

					imagealphablending($destino, FALSE);
		
					imagesavealpha($destino, TRUE);		

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);		

					imagepng($destino, $ruta);

				}else{

					echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}
			
			}

			// final condicion

			$tabla = "usuarios";
			$id = $_POST["idUsuarioFoto"];
			$item = "foto";
			$valor = $ruta;

			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

			if($respuesta == "ok"){

				echo '<script>

					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡La foto de perfil ha sido actualizada!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';


			}

		}

	}

	/*=============================================
	Cambiar contraseña
	=============================================*/

	public function ctrCambiarPassword(){

		if(isset($_POST["idUsuarioPassword"])){	

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$id = $_POST["idUsuarioPassword"];
				$item = "password";
				$valor = $encriptar;

				$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡La contraseña ha sido actualizada!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';


				}

			}else{

			 	echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en la contraseña!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';

			 }


		}

	}

	/*=============================================
	Recuperar contraseña
	=============================================*/

	public function ctrRecuperarPassword(){

		if(isset($_POST["emailRecuperarPassword"])){

			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])){

				/*=============================================
				GENERAR CONTRASEÑA ALEATORIA
				=============================================*/

				function generarPassword($longitud){

					$password = "";
					$patron = "1234567890abcdefghijklmnopqrstuvwxyz";

					$max = strlen($patron)-1;

					for($i = 0; $i < $longitud; $i++){

						$password .= $patron[mt_rand(0,$max)];

					}

					return $password;

				}

				$nuevoPassword = generarPassword(11);

				$encriptar = crypt($nuevoPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$item = "email";
				$valor = $_POST["emailRecuperarPassword"];

				$traerUsuario = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

				if($traerUsuario){

					$id = $traerUsuario["id_usuario"];
					$item = "password";
					$valor = $encriptar;

					$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

					if($actualizarPassword  == "ok"){

						/*=============================================
						Verificación Correo Electrónico
						=============================================*/

						$ruta = ControladorRuta::ctrRuta();

						date_default_timezone_set("America/Bogota");

						$mail = new PHPMailer;

						$mail->Charset = "UTF-8";

						$mail->isMail();

						$mail->setFrom("admin@trading.com", "Admin Trading");

						$mail->addReplyTo("admin@trading.com", "Admin Trading");

						$mail->Subject  = "Solicitud nueva contraseña";

						$mail->addAddress($traerUsuario["email"]);

						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
							<center>
								
								<img style="padding:20px; width:10%" src="'.$ruta.'vistas/img/logo.png">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
								<center>
								
								<img style="padding:20px; width:15%" src="'.$ruta.'vistas/img/email.png">

								<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevoPassword.'</h4>

								<a href="'.$ruta.'ingreso" target="_blank" style="text-decoration:none">

								<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">			
									Haz click aquí
								</div>

								</a>

								<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico.</h5>

								</center>

							</div>

						</div>');
								
						$envio = $mail->Send();

						if(!$envio){

							echo '<script>

								swal({

									type:"error",
									title: "¡ERROR!",
									text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$traerUsuario["email"].' '.$mail->ErrorInfo.', por favor inténtelo nuevamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										history.back();

									}


								});	

							</script>';


						}else{


							echo '<script>

								swal({

									type:"success",
									title: "¡SU NUEVA CONTRASEÑA HA SIDO ENVIADA!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para tomar la nueva contraseña!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										window.location = "'.$ruta.'ingreso";

									}


								});	

							</script>';


						}
					
					}


				}else{

					echo '<script>

						swal({
							type:"error",
						  	title: "¡ERROR!",
						  	text: "¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}

			}else{


				echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡Error al escribir el correo!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';

			}


		}


	}


	/*=============================================
	Actualizar nombre y número de télefono usuario
	=============================================*/

	public function ctrActualizarDatos(){

		if(isset($_POST["editarNombre"])){	

			if(preg_match('/^[-_a-zA-ZñÑáéíóúÁÉÍÓÚ0-9. ]+$/', $_POST["editarNombre"]) && preg_match('/^[0-9-() ]+$/', $_POST["editarMovil"])){

				$telefono = $_POST["indicativo"]." ".$_POST["editarMovil"];

				$tabla = "usuarios";
				$id = $_POST["idUsuario"];
				$item = "telefono_movil";
				$valor = $telefono;
				$item2 = "nombre";
				$valor2 = $_POST["editarNombre"];

				$respuesta = ModeloUsuarios::mdlActualizarDatos($tabla, $id, $item, $valor, $item2, $valor2);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡Los datos han sido actualizados!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';


				}

			}else{

			 	echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';

			 }


		}

	}

	/*=============================================
	Iniciar Suscripción
	=============================================*/

	static public function ctrIniciarSuscripcion($datos){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlIniciarSuscripcion($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	Cancelar Suscripción
	=============================================*/

	static public function ctrCancelarSuscripcion($valor){

		$tabla = "usuarios";

		$datos = array(	"id_usuario" => $valor,
						"estado" => 0,
						"ciclo_pago" => null,
						"firma" => null,
						"fecha_contrato" => null);


		$respuesta = ModeloUsuarios::mdlCancelarSuscripcion($tabla, $datos);

		return $respuesta;

	}

	// /*=============================================
	// registrar cuenta bancaria
	// =============================================*/

	// public function ctrRegistrarCuentaBancaria(){

	// 	$tabla = "cuentas_bancarias";

	// 	if(isset($_POST["idUsuarioCuentaRegistrar"])){

	// 		if(preg_match('/^[0-9]+$/', $_POST["registrarNumeroCuenta"])&&
	// 		preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registrarNombreTitular"])
	// 		 && preg_match('/^[0-9]+$/', $_POST["registrarNumeroTitular"]) &&
	// 		preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registrarEntidadCuenta"]) ){

	// 			$datos = array(	"titular" => $_POST["registrarNumeroTitular"],
	// 			"nombreTitular" => $_POST["registrarNombreTitular"],
	// 			"usuario" => $_POST["idUsuarioCuentaRegistrar"],
	// 			"estado" => 1,
	// 			"tipo" => $_POST["registrarTipoCuenta"],
	// 			"entidad" => $_POST["registrarEntidadCuenta"],
	// 			"numero" => $_POST["registrarNumeroCuenta"]);
				
				
	// 	$respuesta = ModeloUsuarios::mdlRegistrarCuentaBancaria($tabla, $datos);

	// 	if($respuesta == "ok"){
	// 		echo '<script>

	// 						swal({

	// 							type:"success",
	// 							title: "REGISTRO EXITOSO",
	// 							text: "¡SU CUENTA BANCARIA HA SIDO CREADA CORRECTAMENTE!",
	// 							showConfirmButton: true,
	// 							confirmButtonText: "Cerrar"

	// 						}).then(function(result){

	// 							if(result.value){

	// 								window.location = "cuentas-bancarias";

	// 							}


	// 						});	

	// 					</script>';
	// 	}

	// 			}
	// 		}



	// }



	/*=============================================
	Cambiar Patrocinador
	=============================================*/

	static public function ctrCambiarPatrocinador2(){

		if(isset($_POST["cambioPatrocinador"])){

			if($_POST["cambioPatrocinador"] ==  $_POST["nuevoPatrocinador"] || $_POST["cambioPatrocinador"]==1){
				echo '<script>

							swal({

								type:"warning",
								title: "Atención",
								text: "¡Ha seleccionado erroneamente, vuelve a intentarlo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "cambiar-patrocinador";

								}


							});	

						</script>';
			}else{


			$niveles_arbol=5;
			$n=1;
			$padre=ControladorUsuarios::ctrMostrarUsuarios("id_usuario",$_POST["cambioPatrocinador"]);

			$antiguo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("patrocinador",$padre["enlace_afiliado"]);

			$prueba_bonos = ControladorPagos::ctrPruebaBonos($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);

			while($n <= $niveles_arbol &&  $padre!=""){
            
				$prueba_eliminar = ControladorPagos::ctrPruebaComisiones($padre["id_usuario"], $_POST["nuevoPatrocinador"], 5);

				$hijo = ControladorUsuarios::ctrMostrarUsuarios("patrocinador",$padre["enlace_afiliado"]);

				$padre=$hijo;
				$n=$n+1;

			}

			$cambiar_patrocinador_binaria = ControladorPagos::ctrCambiarPatrocinadorBinaria($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);

			$padre=ControladorUsuarios::ctrMostrarUsuarios("id_usuario",$_POST["cambioPatrocinador"]);

			$n=1;
			$padre=$antiguo_patrocinador;

			while($n <= $niveles_arbol &&  $padre!=""){


				$prueba_registrar = ControladorPagos::ctrPruebaRegistrarDespues($padre["id_usuario"], $_POST["nuevoPatrocinador"], 5);

				$hijo = ControladorUsuarios::ctrMostrarUsuarios("patrocinador",$padre["enlace_afiliado"]);

				$padre=$hijo;
				$n=$n+1;
			

			}

			// $prueba_registrar_comisiones = ControladorPagos::ctrPruebaComisionesRegistrarNuevosPatrocinadores($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"], 5);

			// $cambiar_patrocinador="ok";

			if($cambiar_patrocinador_binaria=="ok"){

				echo '<script>

							swal({

								type:"success",
								title: "CAMBIO EXITOSO",
								text: "¡EL PATROCINADOR SE HA CAMBIADO CORRECTAMENTE!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "cambiar-patrocinador";

								}


							});	

						</script>';

			}
		}
	
		}

	}


	/*=============================================
	Cambiar Patrocinador
	=============================================*/

	static public function ctrCambiarPatrocinador(){

		if(isset($_POST["cambioPatrocinador"])){

			if($_POST["cambioPatrocinador"] ==  $_POST["nuevoPatrocinador"] || $_POST["cambioPatrocinador"]==1){
				echo '<script>

							swal({

								type:"warning",
								title: "Atención",
								text: "¡Ha seleccionado erroneamente, vuelve a intentarlo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "cambiar-patrocinador";

								}


							});	

						</script>';
			}else{

			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["cambioPatrocinador"]);

			$patrocinador_antiguo = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $usuario["patrocinador"]);

			$nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["nuevoPatrocinador"]);

			//Cuando el antiguo patrocinador es el administrador

			if($patrocinador_antiguo["perfil"]=="admin"){

				$comprobantes_usuario = ControladorComprobantes::ctrMostrarComprobantesxTipoxEstadoxCampanaEstado($usuario["doc_usuario"], 1, 1, 1);

				if(count($comprobantes_usuario)>0){

					$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $nuevo_patrocinador["id_usuario"], "estado",0);

					foreach($comprobantes_usuario as $key => $value){

						$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["comprobanteId"]);

						if($existe_pago!=""){
							
							$comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$comprobante[0]["id"],1);
								
					
							}else{
					
								$pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($nuevo_patrocinador["id_usuario"]);
						
								$comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],1);
							}

					}


				}

				$pago_usuario = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $usuario["id_usuario"], "estado", 0);

				if($pago_usuario!=""){

					$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_usuario["id"]);

					foreach($comisiones as $key => $value){
						$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
						$usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

						$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $nuevo_patrocinador["id_usuario"], "estado",0);
						$niveles=5;
						$n=$value["nivel"]+1;

						if($n<=$niveles){

						if($existe_pago!=""){
							
							$comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$comprobante[0]["id"],$n);
								
					
							}else{
					
								$pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($nuevo_patrocinador["id_usuario"]);
						
								$comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$n);
							}
						}
						
					}

				}


			//Cuando el nuevo patrocinador es el administrador

			}else if($nuevo_patrocinador["perfil"]=="admin"){

				$prueba_bonos = ControladorPagos::ctrPruebaBonos($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);

				$pago_usuario = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $usuario["id_usuario"], "estado", 0);

				$pago_antiguo_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $patrocinador_antiguo["id_usuario"], "estado", 0);

				if($pago_usuario!="" && $pago_antiguo_patrocinador!=""){

					$comisiones_usuario = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_usuario["id"]);

					$comisiones_antiguo_patrocinador = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_antiguo_patrocinador["id"]);

					$comisiones_id_usario=array();

					foreach($comisiones_usuario as $key => $value){
						array_push($comisiones_id_usario, $value["id_comprobante"]);
					}
					

					foreach($comisiones_antiguo_patrocinador as $key => $value){

						$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

						if(in_array($value["id_comprobante"], $comisiones_id_usario) || $comprobante[0]["doc_usuario"]==$usuario["doc_usuario"]){

							$comisionEliminar = ControladorPagos::ctrEliminarComisiones($pago_antiguo_patrocinador["id"],$comprobante[0]["id"]);

						}
					}

					$comisiones_antiguo_patrocinador = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_antiguo_patrocinador["id"]);

					if(count($comisiones_antiguo_patrocinador)==0){

						$pago_comision_eliminar = ControladorPagos::ctrEliminarPagosComisiones($pago_antiguo_patrocinador["id"]);
			
					}

				}


			}else{

			$prueba_bonos = ControladorPagos::ctrPruebaBonos($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);

			$nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["nuevoPatrocinador"]);

			$pago_patrocinador_antiguo = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $patrocinador_antiguo["id_usuario"], "estado", 0);

			$ids_comprobantes = array();

			if($pago_patrocinador_antiguo!=""){

			$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);
			foreach($comisiones as $key => $value){
				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
				$usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

				array_push($ids_comprobantes, $value["id_comprobante"]);

				if($usuario["id_usuario"]==$usu["id_usuario"]){

					$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $nuevo_patrocinador["id_usuario"], "estado",0);
					if($existe_pago!=""){
					
						$comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$comprobante[0]["id"],$value["nivel"]);
			
					}else{
			
						$pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($nuevo_patrocinador["id_usuario"]);
				
						$comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$value["nivel"]);
					}

					// ControladorPagos::ctrEliminarComisionesPadre($usuario, $patrocinador_antiguo);
					

					// $pat=ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $patrocinador_antiguo["patrocinador"]);

					// ControladorPagos::ctrEliminarComisionesPadre($pat, $patrocinador_antiguo);


					$comisionEliminar = ControladorPagos::ctrEliminarComisiones($pago_patrocinador_antiguo["id"],$comprobante[0]["id"]);

					$comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);

					if(count($comisiones)==0){

						$pago_comision_eliminar = ControladorPagos::ctrEliminarPagosComisiones($pago_patrocinador_antiguo["id"]);
				
					}
				
				}
			}


		}

			$red = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "usuario_red", $usuario["id_usuario"]);

            $ordenBinaria = $red[0]["orden_binaria"];

			// $red_binaria = ControladorMultinivel::ctrMostrarUsuarioRed("red_binaria", "derrame_binaria", $ordenBinaria);
			// print_r($patrocinador_antiguo);
			// 
			
			ControladorMultinivel::generarLineasDescendientes($ordenBinaria, 0, 6, $patrocinador_antiguo["id_usuario"], $nuevo_patrocinador["id_usuario"]);
	}

			$cambiar_patrocinador_binaria = ControladorPagos::ctrCambiarPatrocinadorBinaria($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);
			// $cambiar_patrocinador_binaria="ok";

			$n=1;
			$niveles=5;

			$padre_patrocinador_antiguo=ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $patrocinador_antiguo["patrocinador"]);

			while($n<=$niveles){

				if($padre_patrocinador_antiguo["perfil"]=="admin") break;

				$eliminar_comisiones_padres = ControladorPagos::ctrEliminarComisionesPadreArbol($padre_patrocinador_antiguo, $ids_comprobantes, $patrocinador_antiguo);

				$p = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $padre_patrocinador_antiguo["patrocinador"]);

				$padre_patrocinador_antiguo=$p;

				$n=$n+1;

			}


			$n=1;
			$niveles=5;

			$usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["cambioPatrocinador"]);

			$usuario_hijo = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $usuario["patrocinador"]);
			$patrocinador_hijo = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $usuario_hijo["patrocinador"]);

			while($n<=$niveles){

				if($patrocinador_hijo["perfil"]=="admin") break;

				$registrar_comisiones_padres = ControladorPagos::ctrRegistrarComisionesPadreArbol($usuario_hijo, $patrocinador_hijo);

				$p = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $patrocinador_hijo["patrocinador"]);

				$patrocinador_hijo=$p;

				$n=$n+1;

			}

			if($cambiar_patrocinador_binaria=="ok"){

				echo '<script>

							swal({

								type:"success",
								title: "CAMBIO EXITOSO",
								text: "¡EL PATROCINADOR SE HA CAMBIADO CORRECTAMENTE!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "cambiar-patrocinador";

								}


							});	

						</script>';

			}
		}
	
		}

	}







	/*=============================================
	Cambiar Patrocinador
	=============================================*/

	static public function ctrCambiarPatrocinadorPrueba(){

		if(isset($_POST["cambioPatrocinador"])){

			if($_POST["cambioPatrocinador"] ==  $_POST["nuevoPatrocinador"] || $_POST["cambioPatrocinador"]==1){
				echo '<script>

							swal({

								type:"warning",
								title: "Atención",
								text: "¡Ha seleccionado erroneamente, vuelve a intentarlo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "cambiar-patrocinador";

								}


							});	

						</script>';

			}else{

				$usuario_cambio = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["cambioPatrocinador"]);

				$patrocinador_antiguo = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $usuario_cambio["patrocinador"]);
	
				$nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["nuevoPatrocinador"]);


			//Primero se eliminan las comisiones del antiguo patrocinador y hacia arriba en el árbol

			$niveles = 5;
			$n = 0;

			if($patrocinador_antiguo["perfil"]!="admin"){

				$prueba_bonos = ControladorPagos::ctrPruebaBonos($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);

			while(is_array($patrocinador_antiguo) && $patrocinador_antiguo["perfil"]!="admin" && $n < $niveles){

			ControladorUsuarios::eliminarComisionesCambioPatrocinador($usuario_cambio, $patrocinador_antiguo);

			$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $patrocinador_antiguo["patrocinador"]);

			$patrocinador_antiguo = $padre;
			$n=$n+1;

			}
		}
	

			//Segundo cambiamos el patrocinador en la red binaria para que se refleje en el árbol
			$cambiar_patrocinador_binaria = ControladorPagos::ctrCambiarPatrocinadorBinaria($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);

			//Tercero pasamos las comisiones al nuevo patrocinador y hacia arriba en el árbol 
             if(is_array($nuevo_patrocinador)){

			if($nuevo_patrocinador["perfil"]!="admin"){

				$prueba_bonos = ControladorPagos::ctrPruebaBonos($_POST["cambioPatrocinador"], $_POST["nuevoPatrocinador"]);

			$usuario_cambio = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["cambioPatrocinador"]);

			$n = 0;

			while(is_array($patrocinador_antiguo) && $nuevo_patrocinador["perfil"]!="admin" && $n < $niveles){

			ControladorUsuarios::registrarComisionesCambioPatrocinador($usuario_cambio, $nuevo_patrocinador, $n+1);

			$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $nuevo_patrocinador["patrocinador"]);

			$nuevo_patrocinador = $padre;
			$n=$n+1;

			}
		}
	}

			// $cambiar_patrocinador_binaria="ok";


			if($cambiar_patrocinador_binaria=="ok"){

				echo '<script>

							swal({

								type:"success",
								title: "CAMBIO EXITOSO",
								text: "¡EL PATROCINADOR SE HA CAMBIADO CORRECTAMENTE!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location="cambiar-patrocinador";

								}


							});	

						</script>';

			}
		}
		}
	
		}



		static public function eliminarComisionesCambioPatrocinador($usuario_cambio, $patrocinador_antiguo){

			$pago_usuario = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $usuario_cambio["id_usuario"], "estado", 0);

			$pago_patrocinador_antiguo = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $patrocinador_antiguo["id_usuario"], "estado", 0);

			if($pago_usuario!="" && $pago_patrocinador_antiguo!=""){

			$comisiones_usuario = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_usuario["id"]);	
			
			$comisiones_id_usario=array();

			foreach($comisiones_usuario as $key => $value){
				array_push($comisiones_id_usario, $value["id_comprobante"]);
			}

			$comisiones_antiguo_patrocinador = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);		

			foreach($comisiones_antiguo_patrocinador as $key => $value){

					$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

					if(in_array($value["id_comprobante"], $comisiones_id_usario) || $comprobante[0]["doc_usuario"]==$usuario_cambio["doc_usuario"]){

						$comisionEliminar = ControladorPagos::ctrEliminarComisiones($pago_patrocinador_antiguo["id"],$comprobante[0]["id"]);

						}
					}

					$comisiones_antiguo_patrocinador = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);

					if(count($comisiones_antiguo_patrocinador)==0){

						$pago_comision_eliminar = ControladorPagos::ctrEliminarPagosComisiones($pago_patrocinador_antiguo["id"]);
			
					}

		}

		}




	static public function registrarComisionesCambioPatrocinador($usuario_cambio, $nuevo_patrocinador, $n){

		if($nuevo_patrocinador){

			$pago_inversiones_usuario = ControladorPagos::ctrMostrarPagosInversionesxEstadoAll("id_usuario", $usuario_cambio["id_usuario"], "estado", 0);

			$pago_usuario = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $usuario_cambio["id_usuario"], "estado", 0);

			$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $nuevo_patrocinador["id_usuario"], "estado",0);

			if($pago_usuario!=""){

				$comisiones_usuario = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_usuario["id"]);	

			if($existe_pago!=""){

			if($pago_inversiones_usuario!=""){

				foreach($pago_inversiones_usuario as $key => $value){
					$comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$value["id_comprobante"], $n);
				}

			}
				
			foreach($comisiones_usuario as $key => $value){
				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
				$comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$comprobante[0]["id"],$value["nivel"]+$n);
			}
			
			}else{
			
				$pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($nuevo_patrocinador["id_usuario"]);

				if($pago_inversiones_usuario!=""){

					foreach($pago_inversiones_usuario as $key => $value){
						$comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$value["id_comprobante"], $n);
					}
	
				}
				
				foreach($comisiones_usuario as $key => $value){
					$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
					$comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$value["nivel"]+$n);
				}
			}
		}
	}

		}

	

	



}

