<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUltimosUsuariosRegistrados{

	public function mostrarTabla(){

			$usuarios = ControladorUsuarios::ctrMostrarUltimosUsuariosRegistrados();

			if(count($usuarios)== 0){

	 			$datosJson = '{"data": []}';

				echo $datosJson;

				return;

 			}

 			$datosJson = '{

		 	"data": [ ';

			foreach ($usuarios as $key => $value) {

				/*=============================================
				FOTO
				=============================================*/	

				if($value["foto"] != ""){

					$foto = "<img src='".$value["foto"]."' class='img-fluid' width='30px'>";

				}else{

					$foto = "<img src='vistas/img/usuarios/default/default.png' class='img-fluid' width='30px'>";
				}

				/*=============================================
				SUSCRIPCIÓN
				=============================================*/	

				if($value["operando"] != 0){	

					$estado = "<h5><span class='badge badge-success'>Operando</span></h5>";

				}else{

					$estado = "<h5><span class='badge badge-danger'>Sin Operar</span></h5>";
				}


				$datosJson	 .= '[
						
					"'.($key+1).'",
					"'.$foto.'",
					"'.$value["usuario"].'",
					"'.$value["nombre"].'",
					"'.$value["pais"].'",
					"'.$value["fecha_contrato"].'",
					"'.$estado.'"

				],';	
				
			
				
			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson.=  ']

			}';

			echo $datosJson;


	}

}

/*=============================================
ACTIVAR TABLA UNINIVEL
=============================================*/ 

$activar = new TablaUltimosUsuariosRegistrados();
$activar -> mostrarTabla();
