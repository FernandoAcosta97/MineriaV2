<?php

require_once "../controladores/general.controlador.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/notificaciones.controlador.php";
require_once "../modelos/notificaciones.modelo.php";
require_once "../controladores/multinivel.controlador.php";
require_once "../modelos/multinivel.modelo.php";

class AjaxUsuarios
{

    /*=============================================
    Validar email existente
    =============================================*/

    public $validarEmail;

    public function ajaxValidarEmail()
    {

        $item = "email";
        $valor = $this->validarEmail;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }


     /*=============================================
    Validar usuario existente
    =============================================*/

    public $validarUsuario;

    public function ajaxValidarUsuario()
    {

        $item = "usuario";
        $valor = $this->validarUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }


    /*=============================================
    Validar documento existente
    =============================================*/

    public $validarDocumento;

    public function ajaxValidarDocumento()
    {

        $item = "doc_usuario";
        $valor = $this->validarDocumento;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }


     /*=============================================
    Validar codigo patrocinador
    =============================================*/

    public $validarPatrocinador;

    public function ajaxValidarPatrocinador()
    {

        $item = "enlace_afiliado";
        $valor = $this->validarPatrocinador;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
    ACTIVAR USUARIO
    =============================================*/

    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario()
    {

        $tabla = "usuarios";

        $item = "estado";
        $valor = $this->activarUsuario;

        $id = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

    }

    /*=============================================
    OPERAR USUARIO
    =============================================*/

    public $operarUsuario;
    public $operarId;

    public function ajaxOperarUsuario()
    {

        $tabla = "usuarios";

        $item = "operando";
        $valor = $this->operarUsuario;

        $id = $this->operarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

    }

    /*=============================================
    VERIFICAR USUARIO
    =============================================*/

    public $verificacionUsuario;
    public $verificacionId;

    public function ajaxVerificarUsuario()
    {

        $tabla = "usuarios";

        $item = "verificacion";
        $valor = $this->verificacionUsuario;

        $id = $this->verificacionId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

    }

    /*=============================================
    Contrato
    =============================================*/
    public $aceptar;
    public $id_usuario;
    public $doc_usuario;
    public $telefono_movil;
    public $codigo_pais;
    public $pais;
    public $enlace_afiliado;
    public $firma;
    public $patrocinador;

    public function ajaxSuscripcion()
    {
        $patrocinador=$this->patrocinador;

        $usuarioPatrocinador = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $patrocinador);

        $respuesta="error";

        if($usuarioPatrocinador!=""){

        $validarPatrocinador = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $patrocinador);

        if (!$validarPatrocinador) {

            $confimarPatrocinador = $patrocinador;

        } else {

            if ($validarPatrocinador["fecha_contrato"] != null) {

                $confimarPatrocinador = $validarPatrocinador["enlace_afiliado"];

            } else {

                $confimarPatrocinador = $patrocinador;

            }
        }

        date_default_timezone_set("America/Bogota");
        $f = getdate();
        $fecha = $f["year"] . "-" . $f["mon"] . "-" . $f["mday"];

        $datos = array("aceptar" => $this->aceptar,
            "id_usuario" => $this->id_usuario,
            "doc_usuario" => $this->doc_usuario,
            "telefono_movil" => $this->telefono_movil,
            "codigo_pais" => $this->codigo_pais,
            "pais" => $this->pais,
            "enlace_afiliado" => $this->enlace_afiliado,
            "firma" => $this->firma,
            "fecha_contrato" => $fecha);

        $respuesta = "error";

        $suscripcion=ControladorUsuarios::ctrIniciarSuscripcion($datos);

        if($suscripcion=="ok"){

        $datosUninivel = array("usuario_red" => $this->id_usuario,
            "patrocinador_red" => $confimarPatrocinador);

        $datosArbol = array("usuario_red" => $this->id_usuario,
            "patrocinador_red" => $confimarPatrocinador);

        $registroUninivel = ControladorMultinivel::ctrRegistroUninivel($datosUninivel);
        $registroArbol = ControladorMultinivel::ctrRegistroBinaria($datosArbol);
        $registroPatrocinador = ControladorUsuarios::ctrActualizarUsuario($this->id_usuario, "patrocinador", $confimarPatrocinador);

        if($registroUninivel == "ok" && $registroArbol == "ok"){
            
            $respuesta = "ok";
        }

        }

        // $ruta = ControladorGeneral::ctrRuta();
        //$valorSuscripcion = ControladorGeneral::ctrValorSuscripcion();
        // $fecha = substr(date("c"), 0, -6)."Z";
        // $valor = $this->documento;
        // $url = "http://localhost/www/trading/backoffice/index.php?pagina=perfil&id=".urlencode($valor);

        // echo $url;
    }
        echo $respuesta;

    }

    /*=============================================
    Registro Manual
    =============================================*/
    // public $aceptarRegistroManual;
    // public $nombre;
    // public $email;
    // public $password;

    // public function ajaxRegistroManual()
    // {
    //     $patrocinador=$this->patrocinador;

    //     $f = getdate();
    //     $fecha = $f["year"] . "-" . $f["mon"] . "-" . $f["wday"];

    //     $datos = array("aceptarRegistroManual" => $this->aceptar,
    //         "doc_usuario" => $this->doc_usuario,
    //         "nombre" => $this->nombre,
    //         "correo" => $this->email,
    //         "password" => $this->password,
    //         "telefono_movil" => $this->telefono_movil,
    //         "codigo_pais" => $this->codigo_pais,
    //         "pais" => $this->pais,
    //         "fecha_contrato" => $fecha);

    //     $respuesta = ControladorUsuarios::ctrRegistroUsuarioManual($datos);
                
    //     if($respuesta == "ok"){

    //         $usuario_registrado = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $this->doc_usuario);

    //         if($usuario_registrado){

    //             $datosUninivel = array("usuario_red" => $usuario_registrado["id_usuario"],
    //                 "patrocinador_red" => $patrocinador,
    //                 "periodo_venta" => 10);
            
    //             $datosArbol = array("usuario_red" => $usuario_registrado["id_usuario"],
    //                 "patrocinador_red" => $patrocinador);

    //             $registroUninivel = ControladorMultinivel::ctrRegistroUninivel($datosUninivel);
    //             $registroArbol = ControladorMultinivel::ctrRegistroBinaria($datosArbol);

    //             if($registroUninivel == "ok" && $registroArbol == "ok"){
    //                 $respuesta = "ok";
    //             }else{
    //                 $respuesta = "error";
    //             }

    //         }
                

    // }

    //     echo $respuesta;

    // }



    /*=============================================
    Cancelar Suscripción
    =============================================*/
    public $idUsuario;

    public function ajaxCancelarSuscripcion()
    {

        $valor = $this->idUsuario;

        $respuesta = ControladorUsuarios::ctrCancelarSuscripcion($valor);

        echo $respuesta;

    }

    /*=============================================
    EDITAR USUARIO
    =============================================*/

    public $idUsuarioEditar;

    public function ajaxEditarUsuario()
    {

        $item = "id_usuario";
        $valor = $this->idUsuarioEditar;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
    Eliminar Usuario
    =============================================*/

    public $idUsuarioEliminar;

    public function ajaxEliminarUsuario()
    {

        $valor = $this->idUsuarioEliminar;

        $admin = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", 1);

        $derrameAdmin = 1;

        $usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $valor);

        $usuario_binaria = ControladorMultinivel::ctrMostrarBinaria("usuario_red", $valor);

        $redBinariaNivelUno = ControladorMultinivel::ctrMostrarBinariaxDerrame("derrame_binaria", $usuario_binaria["orden_binaria"]);

        foreach($redBinariaNivelUno as $key => $value){

            $actualizar_red_binaria = ControladorMultinivel::ctrActualizarBinaria("id_binaria",$value["id_binaria"], $derrameAdmin, $admin["enlace_afiliado"]);

        }

        $redUninivel = ControladorMultinivel::ctrMostrarRedUninivel("red_uninivel", "patrocinador_red", $usuario["enlace_afiliado"]);

        foreach($redUninivel as $key => $value){

            $actualizar_red_uninivel = ControladorMultinivel::ctrActualizarUninivel("id_uninivel",$value["id_uninivel"], $admin["enlace_afiliado"]);

            $actualizar_usuario=ControladorUsuarios::ctrActualizarUsuario($value["usuario_red"], "patrocinador", $admin["enlace_afiliado"]);

        }


        $eliminar_binaria=ControladorMultinivel::ctrEliminarUsuarioRed("red_binaria", $valor);

        $eliminar_uninivel=ControladorMultinivel::ctrEliminarUsuarioRed("red_uninivel", $valor);

        $eliminar_usuario = ControladorUsuarios::ctrActualizarUsuario($valor, "eliminado", 1);

        $respuesta="";

        if($eliminar_binaria=="ok" && $eliminar_uninivel=="ok" && $eliminar_usuario=="ok"){
            $respuesta="ok";
        }else{
            $respuesta="error";
        }

        echo $respuesta;

    }

}

/*=============================================
Validar email existente
=============================================*/

if (isset($_POST["validarEmail"])) {

    $valEmail = new AjaxUsuarios();
    $valEmail->validarEmail = $_POST["validarEmail"];
    $valEmail->ajaxValidarEmail();

}

/*=============================================
Validar usuario existente
=============================================*/

if (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();

}


/*=============================================
Validar numero de documento existente
=============================================*/

if (isset($_POST["validarDocumento"])) {

    $valDocumento = new AjaxUsuarios();
    $valDocumento->validarDocumento = $_POST["validarDocumento"];
    $valDocumento->ajaxValidarDocumento();

}


/*=============================================
Validar codigo de patrocinador
=============================================*/

if (isset($_POST["validarPatrocinador"])) {

    $valPatrocinador = new AjaxUsuarios();
    $valPatrocinador->validarPatrocinador = $_POST["validarPatrocinador"];
    $valPatrocinador->ajaxValidarPatrocinador();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/

if (isset($_POST["activarUsuario"])) {

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();

}

/*=============================================
OPERAR USUARIO
=============================================*/

if (isset($_POST["operarUsuario"])) {

    $operarUsuario = new AjaxUsuarios();
    $operarUsuario->operarUsuario = $_POST["operarUsuario"];
    $operarUsuario->operarId = $_POST["operarId"];
    $operarUsuario->ajaxOperarUsuario();

}


/*=============================================
VERIFICAR USUARIO
=============================================*/

if (isset($_POST["verificacionUsuario"])) {

    $verificacionUsuario = new AjaxUsuarios();
    $verificacionUsuario->verificacionUsuario = $_POST["verificacionUsuario"];
    $verificacionUsuario->verificacionId = $_POST["verificacionId"];
    $verificacionUsuario->ajaxVerificarUsuario();

}

/*=============================================
Contrato
=============================================*/

if (isset($_POST["aceptar"])) {

    $activoRegistro = new AjaxUsuarios();
    $activoRegistro->aceptar = $_POST["aceptar"];
    $activoRegistro->id_usuario = $_POST["id_usuario"];
    $activoRegistro->doc_usuario = $_POST["doc_usuario"];
    $activoRegistro->enlace_afiliado = $_POST["enlace_afiliado"];
    $activoRegistro->pais = $_POST["pais"];
    $activoRegistro->codigo_pais = $_POST["codigo_pais"];
    $activoRegistro->telefono_movil = $_POST["telefono_movil"];
    $activoRegistro->patrocinador = $_POST["patrocinador"];
    $activoRegistro->ajaxSuscripcion();

}


// /*=============================================
// Registro manual
// =============================================*/

// if (isset($_POST["aceptarRegistroManual"])) {

//     $registroManual = new AjaxUsuarios();
//     $registroManual->aceptarRegistroManual = $_POST["aceptarRegistroManual"];
//     $registroManual->doc_usuario = $_POST["doc_usuario"];
//     $registroManual->nombre = $_POST["nombre"];
//     $registroManual->email = $_POST["email"];
//     $registroManual->password = $_POST["password"];
//     $registroManual->pais = $_POST["pais"];
//     $registroManual->codigo_pais = $_POST["codigo_pais"];
//     $registroManual->telefono_movil = $_POST["telefono_movil"];
//     $registroManual->patrocinador = $_POST["patrocinador"];
//     $registroManual->ajaxRegistroManual();

// }

/*=============================================
Cancelar Suscrpción
=============================================*/

if (isset($_POST["idUsuario"])) {

    $cancelarSuscripcion = new AjaxUsuarios();
    $cancelarSuscripcion->idUsuario = $_POST["idUsuario"];
    $cancelarSuscripcion->ajaxCancelarSuscripcion();

}

/*=============================================
EDITAR USUARIO
=============================================*/
if (isset($_POST["idUsuarioEditar"])) {

    $editar = new AjaxUsuarios();
    $editar->idUsuarioEditar = $_POST["idUsuarioEditar"];
    $editar->ajaxEditarUsuario();

}

/*=============================================
Eliminar Usuario
=============================================*/

if (isset($_POST["idUsuarioEliminar"])) {

    $eliminarUsuario = new AjaxUsuarios();
    $eliminarUsuario->idUsuarioEliminar = $_POST["idUsuarioEliminar"];
    $eliminarUsuario->ajaxEliminarUsuario();

}
