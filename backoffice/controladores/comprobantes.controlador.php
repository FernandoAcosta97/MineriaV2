<?php

class ControladorComprobantes
{

    /*=============================================
    Registro de comprobantes
    =============================================*/

    public function ctrRegistrarComprobantes()
    {

        if (isset($_POST["id_campana"])) {

        // $usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $_POST["doc_usuario"]);

        // $cuenta = ControladorCuentas::ctrMostrarCuentasxEstado("usuario", $usu["id_usuario"], "estado", 1);

        // $cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario", $usu["id_usuario"]);

        if(isset($_POST["registrarValor"])){
            $valor_comprobante = $_POST["registrarValor"];
        }else{
            $valor_comprobante=0;
        }

    
            if (preg_match('/^[0-9]+$/', $valor_comprobante)) {

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/

                $ruta = "";

                if (isset($_FILES["registrarFotoComprobante"]["tmp_name"]) && $_FILES["registrarFotoComprobante"]["tmp_name"]) {

                    list($ancho, $alto) = getimagesize($_FILES["registrarFotoComprobante"]["tmp_name"]);

                    /*=============================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL COMPROBANTE
                    =============================================*/

                    $directorio = "vistas/img/comprobantes/" . $_POST["doc_usuario"];

                    if(!file_exists($directorio)){
						mkdir($directorio, 0755);
					}
					
                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if ($_FILES["registrarFotoComprobante"]["type"] == "image/jpeg") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/comprobantes/" . $_POST["doc_usuario"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["registrarFotoComprobante"]["tmp_name"]);

                        $destino = imagecreatetruecolor($ancho, $alto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if ($_FILES["registrarFotoComprobante"]["type"] == "image/png") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/comprobantes/" . $_POST["doc_usuario"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["registrarFotoComprobante"]["tmp_name"]);

                        $destino = imagecreatetruecolor($ancho, $alto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }
		
					
				}


                $tabla = "comprobantes";
                $datos = array("valor" => $valor_comprobante,
                    "estado" => $_POST["registrarEstado"],
                    "foto" => $ruta,
                    "doc_usuario" => $_POST["doc_usuario"],
                    "campana" => $_POST["id_campana"],
                    "billetera" => $_POST["billeteras"]);

                $respuesta = ModeloComprobantes::mdlRegistrarComprobantes($tabla, $datos);

                if ($respuesta == "ok") {

                    $usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $_POST["doc_usuario"]);

                    $cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario", $usuario["id_usuario"]);

                    $campana = ControladorCampanas::ctrMostrarCampanas("id", $_POST["id_campana"]);

                    $dir = "comprobantes";

                    if(count($cuentas)==0){

                        $dir = "cuentas-bancarias";

                    }else if($campana["tipo"]==3){
                         
                        $dir = "comprobantes-publicidad";
                    }


                        echo '<script>

							swal({

								type:"success",
								title: "¡COMPROBANTE REGISTRADO CORRECTAMENTE!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

                                   window.location = "'.$dir.'";
								}


							});

						</script>';
           

                }

            } else {

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
    Mostrar Comprobantes
    =============================================*/

    public static function ctrMostrarComprobantes($item, $valor)
    {

        $tabla = "comprobantes";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantes($tabla, $item, $valor);

        return $respuesta;

    }

     /*=============================================
    Mostrar Comprobantes x Tipo
    =============================================*/

    public static function ctrMostrarComprobantesxTipo($item, $valor, $item2, $valor2)
    {

        $tabla = "comprobantes";
        $tabla2 = "campanas";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxTipo($tabla, $tabla2, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


    /*=============================================
    Mostrar Comprobantes x Tipo x estado
    =============================================*/

    public static function ctrMostrarComprobantesxTipoxEstado($item, $valor, $item2, $valor2, $item3, $valor3)
    {

        $tabla = "comprobantes";
        $tabla2 = "campanas";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxTipoxEstado($tabla, $tabla2, $item, $valor, $item2, $valor2, $item3, $valor3);

        return $respuesta;

    }


    /*=============================================
    Mostrar Comprobantes x Tipo x estado x campana estado
    =============================================*/

    public static function ctrMostrarComprobantesxTipoxEstadoxCampanaEstado($doc_usuario, $estado_comprobante, $tipo_campana, $estado_campana)
    {

        $tabla = "comprobantes";
        $tabla2 = "campanas";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxTipoxEstadoxCampanaEstado($tabla, $tabla2, $doc_usuario, $estado_comprobante, $tipo_campana, $estado_campana);

        return $respuesta;

    }

    /*=============================================
    Mostrar Comprobantes x Estado
    =============================================*/

    public static function ctrMostrarComprobantesxEstado($item, $valor, $item2, $valor2)
    {

        $tabla = "comprobantes";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstado($tabla, $item, $valor,$item2, $valor2);

        return $respuesta;

    }

    /*=============================================
    Mostrar Comprobantes x Estado SIN limit
    =============================================*/

    public static function ctrMostrarComprobantesxEstadoSinLimit($item, $valor, $item2, $valor2)
    {

        $tabla = "comprobantes";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstadoSinLimit($tabla, $item, $valor,$item2, $valor2);

        return $respuesta;

    }

    /*=============================================
	Eliminar Comprobante
	=============================================*/

	static public function ctrEliminarComprobante($id){

        $tabla="comprobantes";

		$respuesta = ModeloComprobantes::mdlEliminarComprobante($tabla, $id);

		return $respuesta;

	}


    /*=============================================
    Mostrar Comprobantes x Estado excluyendo tipo publicidad
    =============================================*/

    public static function ctrMostrarComprobantesxEstadoNoPublicidad($item, $valor, $item2, $valor2)
    {

        $tabla = "comprobantes";
        $tabla2 = "campanas";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstadoNoPublicidad($tabla, $tabla2, $item, $valor,$item2, $valor2);

        return $respuesta;

    }


    /*=============================================
    Mostrar Comprobantes x Estado x Estado campaña
    =============================================*/

    public static function ctrMostrarComprobantesxEstadoxCampana($item, $valor, $item2, $valor2, $item3, $valor3)
    {

        $tabla = "comprobantes";
        $tabla2 = "campanas";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstadoxCampana($tabla, $tabla2, $item, $valor,$item2, $valor2, $item3, $valor3);

        return $respuesta;

    }


    /*=============================================
    Mostrar Comprobantes x Estado Y Fecha
    =============================================*/

    public static function ctrMostrarComprobantesxEstadoyFecha($item, $valor, $item2, $valor2, $fechaInicial, $fechaFinal)
    {

        $tabla = "comprobantes";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstadoyFecha($tabla, $item, $valor,$item2, $valor2, $fechaInicial, $fechaFinal);

        return $respuesta;

    }


    /*=============================================
    Mostrar Comprobantes x Estado Y Fecha Campaña
    =============================================*/

    public static function ctrMostrarComprobantesxEstadoyFechaBono($item, $valor, $fechaInicio, $fechaFin)
    {

        $tabla = "comprobantes";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstadoyFechaBono($tabla, $item, $valor, $fechaInicio, $fechaFin);

        return $respuesta;

    }


     /*=============================================
    Mostrar Comprobantes x Usuario Y Fecha Campaña
    =============================================*/

    public static function ctrMostrarComprobantesxUsuarioyFechaBonoAll($item, $valor, $fechaInicio, $fechaFin)
    {

        $tabla = "comprobantes";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxUsuarioyFechaBonoAll($tabla, $item, $valor, $fechaInicio, $fechaFin);

        return $respuesta;

    }


    /*=============================================
    Mostrar Comprobantes x Estado Y Fecha Campaña
    =============================================*/

    public static function ctrMostrarComprobantesxEstadoyFechaBonoUsuario($item, $valor, $item2, $valor2, $fechaInicio, $fechaFin)
    {

        $tabla = "comprobantes";

        $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstadoyFechaBonoUsuario($tabla, $item, $valor, $item2, $valor2, $fechaInicio, $fechaFin);

        return $respuesta;

    }

    /*=============================================
    Total Usuarios
    =============================================*/

    public static function ctrTotalUsuarios()
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlTotalUsuarios($tabla);

        return $respuesta;

    }

    /*=============================================
    MOSTRAR USUARIOS X FILTRO O ACTIVIDAD ----- FUNCIONAL FERNANDO
    =============================================*/

    public static function ctrTotalUsuariosXfiltro($item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlTotalUsuariosXfiltro($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    Actualizar Usuario
    =============================================*/

    public static function ctrActualizarUsuario($id, $item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    EDITAR COMPROBANTES
    =============================================*/

    public static function ctrEditarComprobantes()
    {

        if (isset($_POST["editarComprobante"])) {

            if (preg_match('/^[0-9]+$/', $_POST["editarValor"])) {

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/

                $ruta = "";
				$validar=true;
				if(!$_FILES["editarFotoComprobante"]["tmp_name"]){
					$validar=false;
				}

                $rutaFotoActual = $_POST["fotoActualComprobante"];

                if (isset($_FILES["editarFotoComprobante"]["tmp_name"]) && $validar) {

                    list($ancho, $alto) = getimagesize($_FILES["editarFotoComprobante"]["tmp_name"]);

                    /*=============================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    =============================================*/

                    $directorio = "vistas/img/comprobantes/" . $_POST["doc_usuario"];


					if(!file_exists($directorio)){
						mkdir($directorio, 0755);
					}
					
                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if ($_FILES["editarFotoComprobante"]["type"] == "image/jpeg") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/comprobantes/" . $_POST["doc_usuario"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFotoComprobante"]["tmp_name"]);

                        $destino = imagecreatetruecolor($ancho, $alto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if ($_FILES["editarFotoComprobante"]["type"] == "image/png") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/comprobantes/" . $_POST["doc_usuario"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarFotoComprobante"]["tmp_name"]);

                        $destino = imagecreatetruecolor($ancho, $alto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }

                }

                $tabla = "comprobantes";

                $datos = array("valor" => $_POST["editarValor"],
                    "foto" => $ruta,
                    "id" => $_POST["editarComprobante"]);

                $respuesta = ModeloComprobantes::mdlEditarComprobantes($tabla, $datos);

                if ($respuesta == "ok") {

                    if($_FILES["editarFotoComprobante"]["tmp_name"]){
                        unlink($rutaFotoActual);
					}

                    $usuario = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $_POST["doc_usuario"]);

                    $cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario", $usuario["id_usuario"]);

                    $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $_POST["editarComprobante"]);

                    $campana = ControladorCampanas::ctrMostrarCampanas("id", $comprobante[0]["campana"]);

                    $dir = "comprobantes";

                    if(count($cuentas)==0){

                        $dir = "cuentas-bancarias";

                    }else if($campana["tipo"]==3){
                         
                        $dir = "comprobantes-publicidad";
                    }

                    echo '<script>

                        swal({
                              type: "success",
                              title: "El comprobantes ha sido editado correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "'.$dir.'";
    
                                        }
                                    })
    
                        </script>';

            
                }else{
                    echo '<script>

                    swal({
                          type: "error",
                          title: "Ha ocurrido un error",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    

                                    }
                                })

                    </script>';
                }

            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
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
    Eliminar Usuario
    =============================================*/

    public static function ctrEliminarUsuario($id)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $id);

        return $respuesta;

    }

    /*=============================================
    Ingreso Usuario
    =============================================*/

    public function ctrIngresoUsuario()
    {

        if (isset($_POST["ingresoEmail"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])) {

                $encriptar = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item = "email";
                $valor = $_POST["ingresoEmail"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptar) {

                    if ($respuesta["verificacion"] == 0) {

                        echo '<script>

							swal({
									type:"error",
								  	title: "¡ERROR!",
								  	text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta, o contáctese con nuestro soporte admin@trading.com!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"

							}).then(function(result){

									if(result.value){
									    history.back();
									  }
							});

						</script>';

                        return;

                    } else if ($respuesta["estado"] == 0) {

                        echo '<script>

						   swal({
								   type:"warning",
									 title: "¡Advertencia!",
									 text: "¡Su cuenta se encuentra desactivada, contáctese con nuestro soporte admin@trading.com!",
									 showConfirmButton: true,
								   confirmButtonText: "Cerrar"

						   }).then(function(result){

								   if(result.value){
									   history.back();
									 }
						   });

					   </script>';

                        return;

                    } else {

                        $_SESSION["validarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id_usuario"];

                        $ruta = ControladorRuta::ctrRuta();

                        echo '<script>

							window.location = "' . $ruta . 'backoffice";

						</script>';

                    }

                } else {

                    echo '<script>

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

            } else {

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

    public function ctrCambiarFotoPerfil()
    {

        if (isset($_POST["idUsuarioFoto"])) {

            $ruta = $_POST["fotoActual"];

            if (isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])) {

                list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

                $nuevoAncho = 500;
                $nuevoAlto = 500;

                /*=============================================
                CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                =============================================*/

                $directorio = "vistas/img/usuarios/" . $_POST["idUsuarioFoto"];

                /*=============================================
                PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD Y EL CARPETA
                =============================================*/

                if ($ruta != "") {

                    unlink($ruta);

                } else {

                    if (!file_exists($directorio)) {

                        mkdir($directorio, 0755);

                    }

                }

                /*=============================================
                DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                =============================================*/

                if ($_FILES["cambiarImagen"]["type"] == "image/jpeg") {

                    $aleatorio = mt_rand(100, 999);

                    $ruta = $directorio . "/" . $aleatorio . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);

                } else if ($_FILES["cambiarImagen"]["type"] == "image/png") {

                    $aleatorio = mt_rand(100, 999);

                    $ruta = $directorio . "/" . $aleatorio . ".png";

                    $origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagealphablending($destino, false);

                    imagesavealpha($destino, true);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);

                } else {

                    echo '<script>

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

            if ($respuesta == "ok") {

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

    public function ctrCambiarPassword()
    {

        if (isset($_POST["idUsuarioPassword"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

                $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $id = $_POST["idUsuarioPassword"];
                $item = "password";
                $valor = $encriptar;

                $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

                if ($respuesta == "ok") {

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

            } else {

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

    public function ctrRecuperarPassword()
    {

        if (isset($_POST["emailRecuperarPassword"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])) {

                /*=============================================
                GENERAR CONTRASEÑA ALEATORIA
                =============================================*/

                function generarPassword($longitud)
                {

                    $password = "";
                    $patron = "1234567890abcdefghijklmnopqrstuvwxyz";

                    $max = strlen($patron) - 1;

                    for ($i = 0; $i < $longitud; $i++) {

                        $password .= $patron[mt_rand(0, $max)];

                    }

                    return $password;

                }

                $nuevoPassword = generarPassword(11);

                $encriptar = crypt($nuevoPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item = "email";
                $valor = $_POST["emailRecuperarPassword"];

                $traerUsuario = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($traerUsuario) {

                    $id = $traerUsuario["id_usuario"];
                    $item = "password";
                    $valor = $encriptar;

                    $actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

                    if ($actualizarPassword == "ok") {

                        /*=============================================
                        Verificación Correo Electrónico
                        =============================================*/

                        $ruta = ControladorRuta::ctrRuta();

                        date_default_timezone_set("America/Bogota");

                        $mail = new PHPMailer;

                        $mail->Charset = "UTF-8";

                        $mail->isMail();

                        $mail->setFrom("info@academyoflife.com", "Academy of Life");

                        $mail->addReplyTo("info@academyoflife.com", "Academy of Life");

                        $mail->Subject = "Solicitud nueva contraseña";

                        $mail->addAddress($traerUsuario["email"]);

                        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

							<center>

								<img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

								<center>

								<img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-pass.png">

								<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>' . $nuevoPassword . '</h4>

								<a href="' . $ruta . 'ingreso" target="_blank" style="text-decoration:none">

								<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">
									Haz click aquí
								</div>

								</a>

								<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

								</center>

							</div>

						</div>');

                        $envio = $mail->Send();

                        if (!$envio) {

                            echo '<script>

								swal({

									type:"error",
									title: "¡ERROR!",
									text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a ' . $traerUsuario["email"] . ' ' . $mail->ErrorInfo . ', por favor inténtelo nuevamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										history.back();

									}


								});

							</script>';

                        } else {

                            echo '<script>

								swal({

									type:"success",
									title: "¡SU NUEVA CONTRASEÑA HA SIDO ENVIADA!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para tomar la nueva contraseña!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										window.location = "' . $ruta . 'ingreso";

									}


								});

							</script>';

                        }

                    }

                } else {

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

            } else {

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
    Iniciar Suscripción
    =============================================*/

    public static function ctrIniciarSuscripcion($datos)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlIniciarSuscripcion($tabla, $datos);

        return $respuesta;

    }

    /*=============================================
    Cancelar Suscripción
    =============================================*/

    public static function ctrCancelarSuscripcion($valor)
    {

        $tabla = "usuarios";

        $datos = array("id_usuario" => $valor,
            "estado" => 0,
            "ciclo_pago" => null,
            "firma" => null,
            "fecha_contrato" => null);

        $respuesta = ModeloUsuarios::mdlCancelarSuscripcion($tabla, $datos);

        return $respuesta;

    }

    /*=============================================
    registrar cuenta bancaria
    =============================================*/

    public function ctrRegistrarCuentaBancaria()
    {

        $tabla = "cuentas_bancarias";

        if (isset($_POST["idUsuarioCuentaRegistrar"])) {

            if (preg_match('/^[0-9]+$/', $_POST["registrarNumeroCuenta"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registrarEntidadCuenta"])) {

                $datos = array("titular" => $_POST["idUsuarioCuentaRegistrar"],
                    "estado" => 1,
                    "tipo" => $_POST["registrarTipoCuenta"],
                    "entidad" => $_POST["registrarEntidadCuenta"],
                    "numero" => $_POST["registrarNumeroCuenta"]);

                $respuesta = ModeloUsuarios::mdlRegistrarCuentaBancaria($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

							swal({

								type:"success",
								title: "REGISTRO EXITOSO",
								text: "¡SU CUENTA BANCARIA HA SIDO CREADA CORRECTAMENTE!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "perfil";

								}


							});

						</script>';
                }

            }
        }

    }

}
