<?php 

require_once "../controladores/general.controlador.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/comprobantes.controlador.php";
require_once "../modelos/comprobantes.modelo.php";
require_once "../controladores/multinivel.controlador.php";
require_once "../modelos/multinivel.modelo.php";

class TablaUsuarios{

	public function mostrarTabla(){

		$ruta = ControladorGeneral::ctrRuta();

		$item = null;
		$valor = null;
		$totalAfiliadosActivos=0;
		$valido = true;
		//REQ01 - SE INICIALIZA VARIABLE EN 0 PARA ALMACENAR LOS REFERIDOS INACTIVOS
		$totalAfiliadosInactivos=0;
		//REQ01 - FIN
		$totalC=0;
		$afiliadosNecesarios = 0;
		
		if(isset($_GET["filtro"])){

            if($_GET["filtro"]=="todos"){

				$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                
            }
			if($_GET["filtro"]=="operando"){
                
            $item2="operando";
            $valor2="1";
			$usuarios = ControladorUsuarios::ctrMostrarUsuariosFetchAll($item2, $valor2);

            }

			if($_GET["filtro"]=="activos"){
                
				$item2="estado";
				$valor2="1";
				$usuarios = ControladorUsuarios::ctrMostrarUsuariosFetchAll($item2, $valor2);
	
			}

			if($_GET["filtro"]=="inactivos"){
                
				$item2="estado";
				$valor2="0";
				$usuarios = ControladorUsuarios::ctrMostrarUsuariosFetchAll($item2, $valor2);
		
			}
			

			if($_GET["filtro"]=="sin-operar"){
                
				$item2="operando";
				$valor2="0";
				$usuarios = ControladorUsuarios::ctrMostrarUsuariosFetchAll($item2, $valor2);
	
			}

			if($_GET["filtro"]=="referidos" || $_GET["filtro"]=="sin-referidos"){
                
				$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
	
			}


        }else{
			$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
        }



		if(count($usuarios) == 0){

			echo '{ "data":[]}';

			return;

		}

		$datosJson = '{"data":[';

		foreach ($usuarios as $key => $value) {
			$valido = true;

			$totalComprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantesxEstado("doc_usuario",$value["doc_usuario"],"estado",1);
			$totalC= count($totalComprobantesUsuario);

			if($value["perfil"] != "admin"){

				$red = ControladorMultinivel::ctrMostrarRedUninivel("red_uninivel", "patrocinador_red", $value["enlace_afiliado"]);
	
				if(count($red)>0){
				foreach ($red as $key2 => $value2){
					$usuarioRedOperando = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value2["usuario_red"]);
	
					if($usuarioRedOperando["operando"]==1){
						++$totalAfiliadosActivos;
					}
					//REQ01 - INICIO - SE AGREGA ELSE PARA LLEVAR CONTADOR DE DE LOS AFILIADOS INACTIVOS - FERNANDO ACOSTA - 2023
					else{
						++$totalAfiliadosInactivos;
					}
					//REQ01 - FIN
	
				}
			}

			$totalRed = $totalAfiliadosActivos + $totalAfiliadosInactivos;

			if ($totalC > 1) {
		
			  $afiliadosNecesarios = $totalC - 1;
		
			}

			// if($afiliadosNecesarios>0){

			// 	if($_GET["filtro"]=="sin-referidos"){

			// 		if(($totalC >= 6 && $totalAfiliadosActivos < 6) ||  $totalAfiliadosActivos < $afiliadosNecesarios){
			// 			$valido = true;
			// 		}
						
			// 	}else{						

			// 		if($_GET["filtro"]=="referidos"){

			// 			$valido = true;
					
			// 		}

			// 	}

				
			// }else{

			// if($_GET["filtro"]=="referidos" && $totalAfiliadosActivos==0){

            //     $valido = false;
			
			// }else if($_GET["filtro"]=="sin-referidos" && $totalAfiliadosActivos>0){
			// 	$valido = false;
			// }

			// }

// print_r($afiliadosNecesarios);
			if($_GET["filtro"]=="referidos"){

				if($totalC<=1 || $totalAfiliadosActivos < $afiliadosNecesarios){
					$valido = false;
				}

			}else if($_GET["filtro"]=="sin-referidos"){

				if($totalAfiliadosActivos >= $afiliadosNecesarios){
					$valido = false;
				}

			}


			// if($_GET["filtro"]=="referidos" && $totalAfiliadosActivos==0){

            //     $valido = false;
			
			// }else if($_GET["filtro"]=="sin-referidos" && $totalAfiliadosActivos>0){
			// 	$valido = false;
			// }

			

			if($valido ){
				/*=============================================
				ESTADO Y OPERANDO
				=============================================*/	

				if($value["estado"] == 0){

					$estado = "<button type='button' class='btn btn-danger btn-sm btnActivar' idUsuario='".$value["id_usuario"]."' estadoUsuario='1'>Desactivado</button>";

				}else{

					$estado = "<button type='button' class='btn btn-success btn-sm btnActivar' idUsuario='".$value["id_usuario"]."' estadoUsuario='0'>Activado</button>";
				}


				/*=============================================
				VERIFICACION CORREO
				=============================================*/	

				if($value["verificacion"] == 0){

					$verificacion = "<button type='button' class='btn btn-danger btn-sm btnVerificar' idUsuario='".$value["id_usuario"]."' verificacionUsuario='1'>No</button>";

				}else{

					$verificacion = "<button type='button' class='btn btn-success btn-sm btnVerificar' idUsuario='".$value["id_usuario"]."' verificacionUsuario='0'>Si</button>";
				}

				if($value["operando"] == 0){

					$operando = "<button type='button' class='btn btn-danger btn-sm btnOperar' idUsuario='".$value["id_usuario"]."' estadoUsuario='1'>No</button>";

				}else{

					$operando = "<button type='button' class='btn btn-success btn-sm btnOperar' idUsuario='".$value["id_usuario"]."' estadoUsuario='0'>Si</button>";
				}

				$acciones = "<div class='btn-group'><button type='button' class='btn btn-primary btn-xs btnSoporte' idUsuario='".$value["id_usuario"]."'><i class='fa fa-envelope'></i></button><button class='btn btn-warning btn-xs btnEditarUsuario' idUsuario='".$value["id_usuario"]."' data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-pen' style='color:white'></i></button><button type='button' class='btn btn-info btn-xs btnVerUsuario' idUsuario='".$value["id_usuario"]."'><i class='fa fa-eye'></i></button><button type='button' class='btn btn-danger btn-xs btnEliminarUsuario' idUsuario='".$value["id_usuario"]."'><i class='fa fa-times'></i></button></div>";

				$botonInop = "<button type='button' class='btn btn-danger btn-xs btnVerInoperantes' data-toggle='modal' data-target='#modalEditarUsuario' sinOperar=" . $value["id_usuario"] . ">";
				$botonInop .= "<i class='fa fa-user'></i>&nbsp;&nbsp;&nbsp;" . $totalAfiliadosInactivos . "</button>";

				$botonOpe="<button type='button' class='btn btn-success btn-xs btnVerOperantes' data-toggle='modal' data-target='#modalMostrarOpe' Oper=".$value["id_usuario"].">";
				$botonOpe.="<i class='fa fa-user'></i>&nbsp;&nbsp;&nbsp;".$totalAfiliadosActivos."</button>";
				
				$docUsuario = "n/a";
				if($value["fecha_contrato"]!=null){

					$docUsuario = $value["doc_usuario"];

				}

				$pais = "n/a";
				if($value["pais"]!=""){

					$pais = $value["pais"];

				}
				
				$datosJson .= '[

					   "'.$acciones.'",
					   "'.$docUsuario.'",
					   "'.$value["usuario"].'",
				       "'.$value["nombre"].'",
				       "'.$value["email"].'",
					   "'.$verificacion.'",
				       "'.$pais.'",
				       "'.$estado.'",
				       "'.$operando.'",
					   "'.$value["patrocinador"].'", 
					   "'.$value["enlace_afiliado"].'", 
					   "'.$value["telefono_movil"].'",
					   "'.$value["fecha"].'",
					   "'.$botonInop.'",
					   "'.$botonOpe.'",
					   "'.($totalAfiliadosInactivos + $totalAfiliadosActivos).'",
					   "'.$totalC.'"

				],';

			}
		}
		$totalAfiliadosActivos=0;
		$totalAfiliadosInactivos=0;
		$totalC=0;
		$afiliadosNecesarios=0;

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']}';

		echo $datosJson;

	}
	// cierre metodo


}
// cierre clase

$activarTabla = new TablaUsuarios();
$activarTabla -> mostrarTabla();
