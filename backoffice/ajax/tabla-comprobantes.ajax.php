<?php

require_once '../controladores/comprobantes.controlador.php';
require_once '../modelos/comprobantes.modelo.php';
require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';
require_once '../controladores/campanas.controlador.php';
require_once '../modelos/campanas.modelo.php';
require_once '../controladores/pagos.controlador.php';
require_once '../modelos/pagos.modelo.php';

class TablaComprobantes {

    public function mostrarTabla() {

        $item = null;
        $valor = null;
        $usuario = null;
        $tipo = "1";

        $campanas = ControladorCampanas::ctrMostrarCampanasNoFinalizadas();

        if(isset($_GET["tipo"])){
            $tipo = $_GET["tipo"];
        }

        if(isset($_GET["doc_usuario"])){
            $item = "doc_usuario";
            $valor = $_GET["doc_usuario"];
            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
            if($usuario["perfil"]=="admin"){
                $item = null;
                $valor = null;
                $usuario = null;
            }
        }

        if(isset($_GET["estado"])){
            
            if($_GET["estado"]==3){

                $comprobantes = ControladorComprobantes::ctrMostrarComprobantesxTipo( $item, $valor, "tipo", $tipo); 
                
            }else{
                
            $item2="estado";
            $valor2=$_GET["estado"];
            $comprobantes = ControladorComprobantes::ctrMostrarComprobantesxTipoxEstado( $item, $valor, "tipo", $tipo, $item2, $valor2); 

            }

        }else{
            $comprobantes = ControladorComprobantes::ctrMostrarComprobantesxTipo( $item, $valor, "tipo", $tipo); 
        }


        if ( count( $comprobantes ) == 0 ) {

            echo '{ "data":[]}';

            return;

        }

        $datosJson = '{"data":[';

        foreach ( $comprobantes as $key => $value ) {

            $campana = ControladorCampanas::ctrMostrarCampanas("id",$value["campana"]);

            if($campana["tipo"]==3){
                $valor_total = $campana["retorno"];
            }else{
                $valor_total = $value["valor"];
            }

            if($value["billetera"]==2){
                $val=number_format($valor_total).' BTC';
            }else{
                $val='$ '.number_format($valor_total).' COP';
            }
            // print_r($campana);

            //FOTO COMPROBANTES

            if ( $value[ 'foto' ] == '' ) {

                $foto = "<button class='btn btnFactura' idFactura='".$value["comprobanteId"]."'><img src='vistas/img/comprobantes/default/default.jpg' class='img-thumbnail' width='60px'></button>";

            } else {

                $foto = "<button class='btn'><img src='".$value[ 'foto' ]."' class='img-thumbnail fotoComprobante' width='60px' data-toggle='modal' data-target='#modalVerFotoComprobante'></button>";

            }

            if($usuario!=null){

                if($value["estadoComprobante"]==1){
                    $estado = "<h5><span class='badge badge-success'>Aprobado</span></h5>";
                }else if($value["estadoComprobante"]==0){
                    $estado = "<h5><span class='badge badge-danger'>Rechazado</span></h5>";
                }else if($value["estadoComprobante"]==2){
                    $estado = "<h5><span class='badge badge-warning'>Pendiente</span></h5>";
                }

                $acciones="<button type='button' class='btn btn-primary btn-xs btnSoporte'><i class='fa fa-envelope'></i></button>";

                $datosJson .= '[
                    "'.$acciones.'",
                    "'.$foto.'",
                    "'.$estado.'",
                    "'.$val.'",
                    "'.$value[ 'fecha' ].'",
                    "'.$campana[ 'nombre' ].'"
             ],';

            }else{

                $usuarios = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$value["doc_usuario"]);

                $inversion_pagada = ControladorPagos::ctrMostrarPagosInversionesxEstado("id_comprobante",$value["comprobanteId"],"estado",1);

                $comision_pagada = ControladorPagos::ctrMostrarPagosComisionesxComprobante("id_comprobante",$value["comprobanteId"],"estado",1);

                $bono_pagado = ControladorPagos::ctrMostrarPagosExtrasxComprobante("id_comprobante",$value["comprobanteId"],"estado",1);

                if($inversion_pagada!="" || $bono_pagado!="" || $comision_pagada!=""){

                    $estado = "<h5><span class='badge badge-success'>Pagado</span></h5>";

                }else{

                    //ESTADO COMPROBANTES
        
                    if ( $value["estadoComprobante"] == 1 ) {
        
                        $estado = "<select class='form-control selectAprobado' estadoComprobante=0 idComprobante='".$value["comprobanteId"]."'><option value='1' selected>Aprobado</option><option value='0'>Rechazado</option><option value='2'>Pendiente</option></select>";
        
                    } else if($value["estadoComprobante"] == 0){
        
                        $estado = "<select class='form-control selectAprobado' estadoComprobante=1 idComprobante='".$value["comprobanteId"]."'><option value='1'>Aprobado</option><option value='0' selected>Rechazado</option><option value='2'>Pendiente</option></select>";
        
                    }else if($value["estadoComprobante"] == 2){
        
                        $estado = "<select class='form-control selectAprobado' estadoComprobante=2 idComprobante='".$value["comprobanteId"]."'><option value='1'>Aprobado</option><option value='0'>Rechazado</option><option value='2' selected>Pendiente</option></select>";
        
                    }
                }

// print_r($campanas);

            if($inversion_pagada==""){
                if($campana["estado"]==1 || $campana["estado"]==0){

                $selectCampanas="<div><select class='form-control select2 selectCampana' idComprobante='".$value['comprobanteId']."'>";

                foreach($campanas as $key => $value2){ 

                    if($value2["nombre"]!="Bono Extra" && $value2["tipo"]!=4 && $value2["tipo"]!=5 && $value2["tipo"]!=6 && $value2["tipo"]!=7){

                    if($campana["nombre"]==$value2["nombre"]){

                        $selectCampanas.="<option value='".$value2["id"]."' selected>".$value2["nombre"]."</option>";
                    }else{
 
                        $selectCampanas.="<option value='".$value2["id"]."'>".$value2["nombre"]."</option>";
                    }
                }

                }

                $selectCampanas.="</select></div>";
            }else{
                $selectCampanas = $campana["nombre"];
            }
        }else{
            $selectCampanas = $campana["nombre"];
        }

        $documento="xxx";
        $nombre="Usuario Eliminado";
        if(is_array($usuarios)){
            $documento=$usuarios[ 'doc_usuario' ];
            $nombre=$usuarios[ 'nombre' ];
        }
                
            $acciones = "<div class='btn-group'><button class='btn btn-warning btn-xs btnEditarComprobante' idComprobante='".$value["comprobanteId"]."' data-toggle='modal' data-target='#modalEditarComprobante'><i class='fa fa-pen' style='color:white'></i></button><button type='button' class='btn btn-danger btn-xs btnEliminarComprobante' idComprobante='".$value["comprobanteId"]."'><i class='fa fa-times'></i></button></div>";


            $datosJson .= '[
                "'.$acciones.'",
                "'.$foto.'",
                "'.$estado.'",
                "'.$val.'",
                "'.$documento.'",
                "'.$nombre.'",
                "'.$value[ 'fecha' ].'",
                "'.$selectCampanas.'"
         ],';


        }



        }

        $datosJson = substr( $datosJson, 0, -1 );

        $datosJson .= ']}';

        echo $datosJson;

    }
    // cierre metodo

}
// cierre clase

$activarTabla = new TablaComprobantes();
$activarTabla -> mostrarTabla();
