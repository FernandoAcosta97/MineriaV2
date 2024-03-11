<?php

class ControladorComprobantes
{


    /*=============================================
    Comprobantes generados
    =============================================*/

    public static function ctrGenerarComprobante()
    {

	# Incluyendo librerias necesarias #
    require "facturas/code128.php";

	$pdf = new PDF_Code128('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$pdf->Image(dirname(__FILE__).'\facturas\img\logo.png',165,12,35,35,'PNG');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(32,100,210);
	$pdf->Cell(150,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Nombre de empresa")),0,0,'L');

	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","RUC: 0000000000"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Direccion San Salvador, El Salvador"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Teléfono: 00000000"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Email: correo@ejemplo.com"),0,0,'L');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,7,iconv("UTF-8", "ISO-8859-1","Fecha de emisión:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1",date("d/m/Y", strtotime("13-09-2022"))." ".date("h:s A")),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",strtoupper("Factura Nro.")),0,0,'C');

	$pdf->Ln(7);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(12,7,iconv("UTF-8", "ISO-8859-1","Cajero:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(134,7,iconv("UTF-8", "ISO-8859-1","Carlos Alfaro"),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",strtoupper("1")),0,0,'C');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(13,7,iconv("UTF-8", "ISO-8859-1","Cliente:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","Carlos Alfaro"),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(8,7,iconv("UTF-8", "ISO-8859-1","Doc: "),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","DNI: 00000000"),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(7,7,iconv("UTF-8", "ISO-8859-1","Tel:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1","00000000"),0,0);
	$pdf->SetTextColor(39,39,51);

	$pdf->Ln(7);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(6,7,iconv("UTF-8", "ISO-8859-1","Dir:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(109,7,iconv("UTF-8", "ISO-8859-1","San Salvador, El Salvador, Centro America"),0,0);

	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(90,8,iconv("UTF-8", "ISO-8859-1","Descripción"),1,0,'C',true);
	$pdf->Cell(15,8,iconv("UTF-8", "ISO-8859-1","Cant."),1,0,'C',true);
	$pdf->Cell(25,8,iconv("UTF-8", "ISO-8859-1","Precio"),1,0,'C',true);
	$pdf->Cell(19,8,iconv("UTF-8", "ISO-8859-1","Desc."),1,0,'C',true);
	$pdf->Cell(32,8,iconv("UTF-8", "ISO-8859-1","Subtotal"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(39,39,51);



	/*----------  Detalles de la tabla  ----------*/
	$pdf->Cell(90,7,iconv("UTF-8", "ISO-8859-1","Nombre de producto a vender"),'L',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1","7"),'L',0,'C');
	$pdf->Cell(25,7,iconv("UTF-8", "ISO-8859-1","$10 USD"),'L',0,'C');
	$pdf->Cell(19,7,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),'L',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","$70.00 USD"),'LR',0,'C');
	$pdf->Ln(7);
	/*----------  Fin Detalles de la tabla  ----------*/


	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),'T',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","+ $70.00 USD"),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","IVA (13%)"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","+ $0.00 USD"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');


	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),'T',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","$70.00 USD"),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","TOTAL PAGADO"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","$100.00 USD"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","CAMBIO"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","$30.00 USD"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","USTED AHORRA"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),'',0,'C');

	$pdf->Ln(12);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,9,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar esta factura ***"),0,'C',false);

	$pdf->Ln(9);

	# Codigo de barras #
	$pdf->SetFillColor(39,39,51);
	$pdf->SetDrawColor(23,83,201);
	$pdf->Code128(72,$pdf->GetY(),"COD000001V0001",70,20);
	$pdf->SetXY(12,$pdf->GetY()+21);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD000001V0001"),0,'C',false);

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_1.pdf",true);

    }


    /*=============================================
    Registro de comprobantes
    =============================================*/

    public function ctrRegistrarComprobantes($saldo_cop,$saldo_crypto)
    {

        if (isset($_POST["id_campana"])) {

            if($_POST["billeteras"]==1 && $saldo_cop<$_POST["registrarValor"] || $_POST["billeteras"]==2 && $saldo_crypto<$_POST["registrarValor"]){

                echo "<script>

                swal.fire({
                    type:'warning',
                    html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-light fa-brake-warning text-orange-100\"></i><h2 class=\"text-4xl\">¡Valor incorrecto!</h2></div></div>',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    buttonsStyling: false,
                    customClass: {
                        popup: 'border-orange-100 border-2 p-4 rounded-3xl',
                        confirmButton: 'text-white bg-orange-100 hover:bg-orange-300 hover:text-white px-4 py-1 border-0 rounded-lg',
                    }
                    }).then(function(result){
                        if (result.value) {

                        }
                    })
        
                </script>";

            }else{

        $usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $_POST["doc_usuario"]);

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


                        echo "<script>

							swal.fire({
                                type:'success',
                                html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">¡COMPROBANTE REGISTRADO CORRECTAMENTE!</h2></div></div>',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                buttonsStyling: false,
                                customClass: {
                                    popup: 'border-primario border-2 p-4 rounded-3xl',
                                    confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
                                }

							}).then(function(result){

								if(result.value){

                                   window.location = \"'.$dir.'\";
								}


							});

						</script>";
           

                }

            } else {

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
        $respuesta=null;

       // $respuesta = ModeloComprobantes::mdlMostrarComprobantesxEstadoSinLimit($tabla, $item, $valor,$item2, $valor2);

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

                    echo "<script>

                        swal.fire({
                            type:'success',
                            html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">El comprobantes ha sido editado correctamente</h2></div></div>',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            buttonsStyling: false,
                            customClass: {
                                popup: 'border-primario border-2 p-4 rounded-3xl',
                                confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
                            }
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = \"'.$dir.'\";
    
                                        }
                                    })
    
                        </script>";

            
                }else{
                    echo "<script>

                    swal.fire({
                        type:'error',
                        html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">Ha ocurrido un error</h2></div></div>',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar',
                        buttonsStyling: false,
                        customClass: {
                            popup: 'border-red-500 border-2 p-4 rounded-3xl',
                            confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
                        }
                        }).then(function(result){
                                    if (result.value) {

                                    

                                    }
                                })

                    </script>";
                }

            } else {

                echo "<script>

					swal.fire({
                        type:'error',
                        html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡El nombre no puede ir vacío o llevar caracteres especiales!</h2></div></div>',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar',
                        buttonsStyling: false,
                        customClass: {
                            popup: 'border-red-500 border-2 p-4 rounded-3xl',
                            confirmButton: 'text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg',
                        }
						}).then(function(result){
							if (result.value) {

							

							}
						})

			    </script>";

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

                        echo "<script>

							swal.fire({
                                type:'error',
                                html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡ERROR!</h2></div><p class=\"text-red-500 text-2xl\">¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta, o contáctese con nuestro soporte admin@trading.com!</p></div>',
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

                        return;

                    } else if ($respuesta["estado"] == 0) {

                        echo "<script>

						    swal.fire({
                                type:'error',
                                html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡Advertencia!</h2></div><p class=\"text-red-500 text-2xl\">¡Su cuenta se encuentra desactivada, contáctese con nuestro soporte admin@trading.com!</p></div>',
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

                    echo "<script>

						swal.fire({
                            type:'error',
                            html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡ERROR!</h2></div><p class=\"text-red-500 text-2xl\">¡El email o contraseña no coinciden!</p></div>',
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

            } else {

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

                    echo "<script>

						swal.fire({
                            type:'error',
                            html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡No se permiten formatos diferentes a JPG y/o PNG!</p></div>',
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

            // final condicion

            $tabla = "usuarios";
            $id = $_POST["idUsuarioFoto"];
            $item = "foto";
            $valor = $ruta;

            $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

            if ($respuesta == "ok") {

                echo "<script>

					swal.fire({
                        type:'success',
                        html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">¡CORRECTO!</h2></div><p class=\"text-primario text-2xl\">¡La foto de perfil ha sido actualizada!</p></div>',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar',
                        buttonsStyling: false,
                        customClass: {
                            popup: 'border-primario border-2 p-4 rounded-3xl',
                            confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
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

                    echo "<script>

						swal.fire({
                            type:'success',
                            html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">¡CORRECTO!</h2></div><p class=\"text-primario text-2xl\">¡La contraseña ha sido actualizada!</p></div>',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            buttonsStyling: false,
                            customClass: {
                                popup: 'border-primario border-2 p-4 rounded-3xl',
                                confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
                            }

						}).then(function(result){

								if(result.value){
								    history.back();
								}
						});

					</script>";

                }

            } else {

                echo "<script>

					swal.fire({
                        type:'error',
                        html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡No se permiten caracteres especiales en la contraseña!</p></div>',
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
                                swal.fire({
                                    type: "error",
                                    html: "<div class=\'flex flex-col gap-4\'><div><i class=\'fa-solid fa-triangle-exclamation text-red-500 text-6xl\'></i><h2 class=\'text-4xl\'>¡ERROR!</h2></div><p class=\'text-red-500 text-2xl\'>¡¡Ha ocurrido un problema enviando verificación de correo electrónico a ' . $traerUsuario['email'] . ' ' . $mail->ErrorInfo . ', por favor inténtelo nuevamente!!</p></div>",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    buttonsStyling: false,
                                    customClass: {
                                        popup: "border-red-500 border-2 p-4 rounded-3xl",
                                        confirmButton: "text-white bg-red-500 hover:bg-red-600 hover:text-white px-4 py-1 border-0 rounded-lg",
                                    }
                                }).then(function(result){
                                    if(result.value){
                                        history.back();
                                    }
                                });    
                            </script>';

                        } else {

                            echo "<script>

								swal.fire({
                                    type:'success',
                                    html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-duotone fa-thumbs-up\" style=\"--fa-primary-color: #0066ff; --fa-secondary-color: #00a1ff;\"></i><h2 class=\"text-4xl\">¡SU NUEVA CONTRASEÑA HA SIDO ENVIADA!</h2></div><p class=\"text-primario text-2xl\">¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para tomar la nueva contraseña!</p></div>',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                    buttonsStyling: false,
                                    customClass: {
                                        popup: 'border-primario border-2 p-4 rounded-3xl',
                                        confirmButton: 'text-white bg-primario hover:bg-blue-600 hover:text-white px-4 py-1 border-0 rounded-lg',
                                    }

								}).then(function(result){

									if(result.value){

										window.location = \"' . $ruta . 'ingreso\";

									}


								});

							</script>";

                        }

                    }

                } else {

                    echo "<script>

						swal.fire({
                            type:'error',
                            html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡ERROR!</h2></div><p class=\"text-red-500 text-2xl\">¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!</p></div>',
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

            } else {

                echo "<script>

					swal.fire({
                        type:'error',
                        html: '<div class=\"flex flex-col gap-4\"><div><i class=\"fa-solid fa-triangle-exclamation text-red-500 text-6xl\"></i><h2 class=\"text-4xl\">¡CORREGIR!</h2></div><p class=\"text-red-500 text-2xl\">¡Error al escribir el correo!</p></div>',
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

}
