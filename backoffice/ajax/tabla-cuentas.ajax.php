<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaCuentas
{

    public function mostrarTabla()
    {

        $item = null;
        $valor = null;
        $usuario = null;

        if (isset($_GET["id"])) {
            $item = "id_usuario";
            $valor = $_GET["id"];
            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
            if($usuario["perfil"]=="admin"){
                $item = null;
                $valor = null;
                $usuario = null;
            }
        }


        $cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario", $valor);
        if(is_array($cuentas)){

            if (count($cuentas) == 0) {

                echo '{ "data":[]}';
    
                return;
    
            }

        }


        $datosJson = '{"data":[';

        if($usuario!=null){

                  //ESTADO CUENTAS

        foreach ($cuentas as $key => $value) {

            if ($value["estado"] == 0) {

                $estado = "<button type='button' class='btn btn-danger btn-sm btnActivar' idUsuarioCuenta='" . $value["titular"] . "' estadoCuentaUsuario='1'>RECHAZADA</button>";

            } else if($value["estado"] == 1){

                $estado = "<button type='button' class='btn btn-success btn-sm btnActivar' idUsuarioCuenta='" . $value["titular"] . "' estadoCuentaUsuario='0'>ACTIVADA</button>";
            }else if($value["estado"] == 2){
                $estado = "<button type='button' class='btn btn-warning btn-sm btnActivar' idUsuarioCuenta='" . $value["titular"] . "' estadoCuentaUsuario='0'>PENDIENTE</button>";
            }

            $acciones="<button type='button' class='btn btn-primary btn-xs btnSoporte'><i class='fa fa-envelope'></i></button>";

            $datosJson .= '[
                "' . $acciones . '",
                "' . $value["numero"] . '",
                "' . $usuario["nombre"] . '",
                "' . $usuario["doc_usuario"] . '",
                "' . $value["titular"] . '",
                "' . $estado . '",
                "' . $value["entidad"] . '",
                "' . $value["tipo"] . '",
                "' . $value["fecha"] . '"
         ],';

        }

              }else{

                foreach ($cuentas as $key => $value) {

                //ESTADO CUENTAS

                $usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["usuario"]);
    
                if ( $value["estado"] == 1 ) {
    
                    $estado = "<select class='form-control selectAprobado' idCuenta='".$value["id"]."'><option value='1' selected>Aprobada</option><option value='0'>Rechazada</option><option value='2'>Pendiente</option></select>";
    
                } else if($value["estado"] == 0){
    
                    $estado = "<select class='form-control selectAprobado' idCuenta='".$value["id"]."'><option value='1'>Aprobada</option><option value='0' selected>Rechazada</option><option value='2'>Pendiente</option></select>";
    
                }else if($value["estado"] == 2){
    
                    $estado = "<select class='form-control selectAprobado' idCuenta='".$value["id"]."'><option value='1'>Aprobada</option><option value='0'>Rechazada</option><option value='2' selected>Pendiente</option></select>";
    
                }
                
                $acciones = "<div class='btn-group'><button class='btn btn-warning btn-xs btnEditarCuenta' idCuenta= '" . $value["id"] . "' idUsuarioCuenta='" . $value["titular"] . "' data-toggle='modal' data-target='#modalEditarCuenta'><i class='fa fa-pen' style='color:white'></i></button><button class='btn btn-danger btn-xs btnEliminarCuenta' idCuenta='".$value["id"]."'><i class='fa fa-times' style='color:white'></i></button></div>";

                $datosJson .= '[
                  "' . $acciones . '",
                  "' . $value["numero"] . '",
                  "' . $value["nombre"] . '",
                  "' . $value["doc_usuario"] . '",
                  "' . $value["titular"] . '",
                  "' . $estado . '",
                  "' . $value["entidad"] . '",
                  "' . $value["tipo"] . '",
                  "' . $value["fecha"] . '"
           ],';
              }
            }



        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']}';

        echo $datosJson;

    }
    // cierre metodo

}
// cierre clase

$activarTabla = new TablaCuentas();
$activarTabla->mostrarTabla();
