<?php

class ControladorPagos
{
 
    /*=============================================
    Registro de Pagos
    =============================================*/

    public static function ctrRegistrarPagos($id_usuario, $id_comprobante, $id_apalancamiento)
    {

        $tabla = "pagos_inversiones";
        $datos = array("id_usuario" => $id_usuario,
        "id_comprobante" => $id_comprobante,
        "id_apalancamiento" => $id_apalancamiento,
        "estado" => 0);

        $respuesta = ModeloPagos::mdlRegistrarPagos($tabla, $datos);   

    }


     /*=============================================
    Registro de Pagos Publicidad
    =============================================*/

    public static function ctrRegistrarPagosPublicidad($id_usuario, $id_comprobante)
    {

        $tabla = "pagos_publicidad";
        $datos = array("id_usuario" => $id_usuario,
        "id_comprobante" => $id_comprobante,
        "estado" => 0);

        $respuesta = ModeloPagos::mdlRegistrarPagosPublicidad($tabla, $datos);   

    }


    /*=============================================
    Registro de Pagos Comisiones
    =============================================*/

    public static function ctrRegistrarPagosComisiones($id_usuario)
    {

        $tabla = "pagos_comisiones";
        $datos = array("id_usuario" => $id_usuario,
        "estado" => 0);

        return $respuesta = ModeloPagos::mdlRegistrarPagosComisiones($tabla, $datos);   

    }


     /*=============================================
    Registro de Comisiones
    =============================================*/

    public static function ctrRegistrarComisiones($id_pago_comision, $id_comprobante, $nivel)
    {

        $tabla = "comisiones";
        $datos = array("id_pago_comision" => $id_pago_comision,
        "id_comprobante" => $id_comprobante,
        "nivel" => $nivel);

        $respuesta = ModeloPagos::mdlRegistrarComisiones($tabla, $datos);   

    }


    /*=============================================
    Eliminar comisiones arbol del anterior patrocinador
    =============================================*/

    public static function ctrTrasladarComisionesUsuarioArbol2($id_usuario, $id_nuevo_patrocinador, $niveles_arbol)
    {
        
        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario);

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);

		$niveles=$niveles_arbol;
		$n=1;

        while($n<=$niveles){

            if($padre["perfil"]=="admin") break;
    
            $existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);
    
            if($existe_pago!=""){
    
                $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

                foreach($comisiones as $key => $value){

                    $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
                    
                    if($comprobante[0]["doc_usuario"]==$hijo["doc_usuario"]){

                        $comision = ControladorPagos::ctrEliminarComisiones($existe_pago["id"],$comprobante[0]["id"],$n);

                    }

                        $existe_pago_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $id_nuevo_patrocinador, "estado",0); 
                        if($existe_pago_patrocinador!=""){

                            $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago_patrocinador["id"],$comprobante[0]["id"],$n);

                        }else{

                            $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($id_nuevo_patrocinador);

                            $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$n);

                        }

                    

                }
                $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);
                if(count($comisiones)==0){
    
                    $pago_comision = ControladorPagos::ctrEliminarPagosComisiones($existe_pago["id"]);
    
                }

    
            }
    
              $n=$n+1;
              $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $padre["id_usuario"]);
    
              $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);
            }

    }


    /*=============================================
    prueba comisiones registrar
    =============================================*/

    public static function ctrPruebaComisionesRegistrar($id_usuario, $id_nuevo_patrocinador)
    {

        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]); //Mateo 26

        $nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

        //Registrar comision nuevo patrocinador.
        $pagos_comisiones = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"],"estado",0);

        if($pagos_comisiones!=""){
            $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pagos_comisiones["id"]);

            foreach($comisiones as $key => $value){
                $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);
               if($comprobante[0]["doc_usuario"]==$hijo["doc_usuario"]){

                $existe_pago_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $id_nuevo_patrocinador, "estado",0);

                if($existe_pago_patrocinador!=""){

                    $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago_patrocinador["id"],$comprobante[0]["id"],1);

                }else{

                    $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($id_nuevo_patrocinador);

                    $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],1);

                }

               }
            }
        }

    }

    /*=============================================
    prueba comisiones eliminar
    =============================================*/

    public static function ctrPruebaComisiones($id_usuario, $id_nuevo_patrocinador, $niveles_arbol)
    {

        $niveles=$niveles_arbol;
		$n=1;

        $objetivo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]); //Mateo 26

        $nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

    //Borrar comisiones del antiguo patrocinador y todos los patrocinadores hacia arriba de acuerdo a los niveles del arbol.
    while($n <= $niveles_arbol && $padre["perfil"]!="admin"){

        $pagos_comisiones = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"],"estado",0);

        if($pagos_comisiones!=""){
            $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pagos_comisiones["id"]);

            foreach($comisiones as $key => $value){
                $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);
               if($comprobante[0]["doc_usuario"]==$hijo["doc_usuario"]){

                $comision = ControladorPagos::ctrEliminarComisiones($pagos_comisiones["id"],$comprobante[0]["id"]);

               }
            }
            $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pagos_comisiones["id"]);
            if(count($comisiones)==0){

                $pago_comision = ControladorPagos::ctrEliminarPagosComisiones($pagos_comisiones["id"]);

            }
        }

        $n=$n+1;
        $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $padre["patrocinador"]); 
    }


    }



     /*=============================================
    prueba comisiones eliminar
    =============================================*/

    public static function ctrPruebaComisiones2($id_usuario, $id_nuevo_patrocinador, $niveles_arbol, $array_id_comprobantes)
    {

        $niveles=$niveles_arbol;
		$n=1;

        $objetivo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]); //Mateo 26

        $nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

    //Borrar comisiones del antiguo patrocinador y todos los patrocinadores hacia arriba de acuerdo a los niveles del arbol.
    while($n <= $niveles_arbol && $padre["perfil"]!="admin"){

        $pagos_comisiones = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"],"estado",0);

        if($pagos_comisiones!=""){
            $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pagos_comisiones["id"]);

            foreach($comisiones as $key => $value){
                $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);

               if(in_array($comprobante[0]["id"], $array_id_comprobantes)){

                $comision = ControladorPagos::ctrEliminarComisiones($pagos_comisiones["id"],$comprobante[0]["id"]);

               }
            }
            $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pagos_comisiones["id"]);
            if(count($comisiones)==0){

                $pago_comision = ControladorPagos::ctrEliminarPagosComisiones($pagos_comisiones["id"]);

            }
        }

        $n=$n+1;
        $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $padre["patrocinador"]); 
    }


    }


    public static function ctrEliminarComisionesPadre($usuario, $patrocinador_antiguo){

        $pago_patrocinador_antiguo = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $patrocinador_antiguo["id_usuario"], "estado", 0);

        if($pago_patrocinador_antiguo!=""){

        $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);
        foreach($comisiones as $key => $value){
            $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
            $usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

            if($usuario["id_usuario"]==$usu["id_usuario"]){

                $comisionEliminar = ControladorPagos::ctrEliminarComisiones($pago_patrocinador_antiguo["id"],$comprobante[0]["id"]);

                $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);

                if(count($comisiones)==0){

                    $pago_comision_eliminar = ControladorPagos::ctrEliminarPagosComisiones($pago_patrocinador_antiguo["id"]);
            
                }
            
            }
        }

        

    }

    }



    public static function ctrEliminarComisionesPadreArbol($usuario, $ids_comprobantes, $patrocinador_antiguo_base){

        $pago_patrocinador_antiguo = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $usuario["id_usuario"], "estado", 0);

        if($pago_patrocinador_antiguo!=""){

        $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);
        foreach($comisiones as $key => $value){
            $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);
            $usu = ControladorUsuarios::ctrMostrarUsuarios("doc_usuario", $comprobante[0]["doc_usuario"]);

            if(in_array($value["id_comprobante"], $ids_comprobantes)){

                if($patrocinador_antiguo_base["enlace_afiliado"]!=$usu["patrocinador"]){
                    
                $comisionEliminar = ControladorPagos::ctrEliminarComisiones($pago_patrocinador_antiguo["id"],$comprobante[0]["id"]);

                $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pago_patrocinador_antiguo["id"]);

                if(count($comisiones)==0){

                    $pago_comision_eliminar = ControladorPagos::ctrEliminarPagosComisiones($pago_patrocinador_antiguo["id"]);
            
                }

                }

            
            }
        }

        

    }

    }

    public static function ctrRegistrarComisionesPadreArbol($usuario, $nuevo_patrocinador){

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

    }

    /*=============================================
    prueba bonos eliminar del antiguo patrocinador y registrar al nuevo patrocinador
    =============================================*/

    public static function ctrPruebaBonos($id_usuario, $id_nuevo_patrocinador)
    {

        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario);

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);

        $nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

        $pago_bono_extra = ControladorPagos::ctrMostrarPagosExtras2("id_usuario", $padre["id_usuario"], "estado", 0);

        if($pago_bono_extra!=""){

           $pago_bono_nuevo = ControladorPagos::ctrMostrarPagosExtras2("id_usuario", $id_nuevo_patrocinador, "estado", 0);

           $bonos = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra", $pago_bono_extra["id"]);

           foreach($bonos as $key => $value){

            if($value["id_usuario"]==$hijo["id_usuario"]){

                if($pago_bono_nuevo!=""){
                    $registrar_bono = ControladorPagos::ctrRegistrarBonosExtras($pago_bono_nuevo["id"], $hijo["id_usuario"], $value["id_comprobante"], $value["id_campana"]);
                }else{
           
                    $registrar_pago_nuevo = ControladorPagos::ctrRegistrarPagosExtras($id_nuevo_patrocinador);
                    $registrar_bono = ControladorPagos::ctrRegistrarBonosExtras($registrar_pago_nuevo, $hijo["id_usuario"], $value["id_comprobante"], $value["id_campana"]);
                }
            
                $eliminar_bono_extra = ControladorPagos::ctrEliminarBonoExtra("id", $value["id"]);
            }

           }

           $bonos = ControladorPagos::ctrMostrarBonosExtrasAll("id_pago_extra", $pago_bono_extra["id"]);

           if(count($bonos)==0){
            $eliminar_pago_extra = ControladorPagos::ctrEliminarPagoExtra($pago_bono_extra["id"]);
           }

        }

    }



    /*=============================================
    prueba registrar despues del cambio
    =============================================*/

    public static function ctrPruebaRegistrarDespues($id_usuario, $id_nuevo_patrocinador, $niveles_arbol)
    {

        $niveles=$niveles_arbol;
		$n=1;

        $objetivo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]); //Mateo 26

        $nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

        $pagos_comisiones = ControladorPagos::ctrMostrarPagosComisionesxEstadoAll("id_usuario", $padre["id_usuario"], "estado", 0);

        if($pagos_comisiones!=""){
            

    //Registrar comisiones al nuevo  patrocinador y todos los patrocinadores hacia arriba de acuerdo a los niveles del arbol.
    while($n <= $niveles_arbol && $padre["perfil"]!="admin"){

        $inversiones_hijo = ControladorPagos::ctrMostrarPagosInversionesxUsuario("doc_usuario", $hijo["doc_usuario"],"estado",0);

        if(count($inversiones_hijo)>0){

            foreach($inversiones_hijo as $key => $value){
                $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["comprobante"]);

                $existe_comision_pagada = ControladorPagos::ctrMostrarPagosComisionComprobante($padre["id_usuario"], $value["comprobante"]);

                if($existe_comision_pagada==""){

                $existe_pago_padre = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

                if($existe_pago_padre!=""){

                    $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago_padre["id"],$comprobante[0]["id"],$n);

                }else{

                    $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($padre["id_usuario"]);

                    $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$n);

                }
            }

         
            }
            
        }

        $n=$n+1;
        $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $padre["patrocinador"]); 
    }
}



    }




     /*=============================================
    Registrar comisiones nuevos patrocinadores hacia arriba en el árbol de acuerdo a los niveles.
    =============================================*/

    public static function ctrPruebaComisionesRegistrarNuevosPatrocinadores($id_usuario, $id_nuevo_patrocinador, $niveles_arbol)
    {

        $niveles=$niveles_arbol;
		$n=1;

        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario);

		$padre = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

        $pagos_comisiones_hijo = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $hijo["id_usuario"],"estado",0);

        if($pagos_comisiones_hijo!=""){

            $comisiones_hijo = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $pagos_comisiones_hijo["id"]);

        }

    //Registrar comisiones del nuevo patrocinador y todos los patrocinadores hacia arriba de acuerdo a los niveles del arbol.
    while($n <= $niveles_arbol && $padre["perfil"]!="admin"){

        if($pagos_comisiones_hijo=="") break;

        $pagos_comisiones = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"],"estado",0);

        if($pagos_comisiones!=""){

            foreach($comisiones_hijo as $key => $value){
                $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);

                $comision = ControladorPagos::ctrRegistrarComisiones($pagos_comisiones["id"],$comprobante[0]["id"], $n);
               
            }

        }else{

            $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($padre["id_usuario"]);

            foreach($comisiones_hijo as $key => $value){

            $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id",$value["id_comprobante"]);

            $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],$n);

            }

        }
        $n=$n+1;
        $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $padre["patrocinador"]); 
    }



    }




    /*=============================================
    comisiones arbol del padre de acuerdo al hijo
    =============================================*/

    public static function ctrPasarComisionesPadreArbol($id_usuario, $id_nuevo_patrocinador, $niveles_arbol)
    {

        $niveles=$niveles_arbol;
		$n=1;

        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30


		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]); //Mateo 26

        $nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

        $existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

        if($existe_pago!=""){

        $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

        foreach($comisiones as $key => $value){

            $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);  

            if($comprobante[0]["doc_usuario"]==$hijo["doc_usuario"]){

                $comision = ControladorPagos::ctrEliminarComisiones($existe_pago["id"],$comprobante[0]["id"]);

                $existe_pago_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $id_nuevo_patrocinador, "estado",0);
 
                $existe_comision_pagada = ControladorPagos::ctrMostrarPagosComisionComprobante($padre["id_usuario"], $value["id_comprobante"]);

                $existe_comision_pagada2 = ControladorPagos::ctrMostrarPagosComisionComprobante($id_nuevo_patrocinador, $value["id_comprobante"]);

                if($existe_comision_pagada=="" && $existe_comision_pagada2 == "" && $nuevo_patrocinador["perfil"] != "admin"){

                if($existe_pago_patrocinador!=""){

                    $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago_patrocinador["id"],$comprobante[0]["id"],1);

                }else{

                    $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($id_nuevo_patrocinador);

                    $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],1);

                }
            }
            

            }
        

        }
        $existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

        if($existe_pago){

        $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

        if(count($comisiones)==0){

            $pago_comision = ControladorPagos::ctrEliminarPagosComisiones($existe_pago["id"]);

        }
     }

    }else if($padre["perfil"]=="admin"){

        $existe_pago_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $id_nuevo_patrocinador, "estado",0);

        $inversiones_hijo = ControladorPagos::ctrMostrarPagosInversionesxUsuario("doc_usuario",$hijo["doc_usuario"],"estado",0);


        if(count($inversiones_hijo)>0){

         foreach($inversiones_hijo as $key => $value){

            if($existe_pago_patrocinador!=""){

            $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago_patrocinador["id"],$value["comprobante"],1);

            }else{

            $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($id_nuevo_patrocinador);

            $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$value["comprobante"],1);

          }
         }
                
        }


    }

    }


    /*=============================================
    comisiones arbol del hijo
    =============================================*/

    public static function ctrPasarComisionesHijoArbol($id_usuario, $id_nuevo_patrocinador, $niveles_arbol)
    {

		$padre = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario); //Julian 30

        $patrocinador = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $padre["patrocinador"]);

        $nuevo_patrocinador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_nuevo_patrocinador);

        $existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

    if($existe_pago!=""){

        $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

        $existe_pago_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $id_nuevo_patrocinador, "estado",0);

        $existe_pago_antiguo_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $patrocinador["id_usuario"], "estado",0);

        foreach($comisiones as $key => $value){

            $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

         if($value["nivel"]<$niveles_arbol){

            if($existe_pago_antiguo_patrocinador!=""){
                $comision_p = ControladorPagos::ctrEliminarComisiones($existe_pago_antiguo_patrocinador["id"],$comprobante[0]["id"]);
            }

            $existe_comision_pagada = ControladorPagos::ctrMostrarPagosComisionComprobante($patrocinador["id_usuario"], $value["id_comprobante"]);

            $existe_comision_pagada2 = ControladorPagos::ctrMostrarPagosComisionComprobante($id_nuevo_patrocinador, $value["id_comprobante"]);

           if($existe_comision_pagada == "" && $existe_comision_pagada2 == "" && $nuevo_patrocinador["perfil"] != "admin"){
            if($existe_pago_patrocinador!=""){

                $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago_patrocinador["id"],$comprobante[0]["id"],($value["nivel"]+1));

            }else{

                $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($id_nuevo_patrocinador);

                $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],($value["nivel"]+1));

            }
        }
        
        
    }

        }
    }

    $existe_pago_antiguo_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $patrocinador["id_usuario"], "estado",0);

    if($existe_pago_antiguo_patrocinador!=""){
        $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago_antiguo_patrocinador["id"]);
        if(count($comisiones)==0){

            $pago_comision = ControladorPagos::ctrEliminarPagosComisiones($existe_pago_antiguo_patrocinador["id"]);

        }
    }



    }



      /*=============================================
    Pasar comisiones arbol del anterior patrocinador
    =============================================*/

    public static function ctrPasarComisionesUsuarioArbol($id_usuario, $id_nuevo_patrocinador, $niveles_arbol)
    {
        
        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario);//Julian 30

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]); //Mateo 26

        $niveles=$niveles_arbol;
		$n=1;

        $existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

        $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

        foreach($comisiones as $key => $value){

            $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

            if($comprobante[0]["doc_usuario"]==$hijo["doc_usuario"]){

                $comision = ControladorPagos::ctrEliminarComisiones($existe_pago["id"],$comprobante[0]["id"],$n);

                $existe_pago_patrocinador = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $id_nuevo_patrocinador, "estado",0);

                if($existe_pago_patrocinador!=""){

                    $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago_patrocinador["id"],$comprobante[0]["id"],1);

                }else{

                    $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($id_nuevo_patrocinador);

                    $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$comprobante[0]["id"],1);

                }

            }

        }

        $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $id_usuario);



    }


    /*=============================================
    Registrar comisiones arbol del nuevo patrocinador
    =============================================*/

    public static function ctrRegistrarComisionesUsuarioArbol($id_usuario, $niveles_arbol)
    {
        
        $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario);

		$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);

		$niveles=$niveles_arbol;
		$n=1;

        while($n<=$niveles){

            if($padre["perfil"]=="admin") break;
    
            $existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);
    
            if($existe_pago!=""){
    
                $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

                foreach($comisiones as $key => $value){

                    // $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

                    $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$value["id_comprobante"],$n);

                }
            }else{

                $comisiones = ControladorPagos::ctrMostrarComisionesAll("id_pago_comision", $existe_pago["id"]);

                foreach($comisiones as $key => $value){

                    // $comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

                    $pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($padre["id_usuario"]);

                    $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$value["id_comprobante"],$n);

                }

            }
    
              $n=$n+1;
              $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $padre["id_usuario"]);
    
              $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);
            }

          

    }


     /*=============================================
    Registrar comisiones arbol del nuevo patrocinador
    =============================================*/

    // public static function ctrRegistrarComisionesUsuarioArbol($id_usuario, $niveles_arbol)
    // {
        
    //     $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $id_usuario);

	// 	$padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);

	// 	$niveles=$niveles_arbol;
	// 	$n=1;

	// 	while($n<=$niveles){

	// 	if($padre["perfil"]=="admin") break;

	// 	$existe_pago = ControladorPagos::ctrMostrarPagosComisionesxEstado("id_usuario", $padre["id_usuario"], "estado",0);

	// 	if($existe_pago!=""){

    //         $inversiones_hijo = ControladorPagos::ctrMostrarPagosInversionesxUsuario("doc_usuario", $hijo["doc_usuario"], "estado", 0);

    //         foreach($inversiones_hijo as $key => $value){

    //             $comision = ControladorPagos::ctrRegistrarComisiones($existe_pago["id"],$value["comprobante"],$n);

    //         }

	// 	}else{

    //         $inversiones_hijo = ControladorPagos::ctrMostrarPagosInversionesxUsuario("doc_usuario", $hijo["doc_usuario"], "estado", 0);

    //         if(count($inversiones_hijo)>0){

	// 		$pago_comision = ControladorPagos::ctrRegistrarPagosComisiones($padre["id_usuario"]);

    //         foreach($inversiones_hijo as $key => $value){

    //             $comision = ControladorPagos::ctrRegistrarComisiones($pago_comision,$value["comprobante"],$n);

    //         }
    //     }
	
	// 	}

    //       $n=$n+1;
	// 	  $hijo = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $padre["id_usuario"]);

	// 	  $padre = ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $hijo["patrocinador"]);
	// 	}
          

    // }


    /*=============================================
    Cambiar patrocinador red binaria
    =============================================*/

    public static function ctrCambiarPatrocinadorBinaria($id_usuario, $id_nuevo_patrocinador)
    {
        $respuesta="";
        $usuario = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "id_usuario", $id_usuario);

		$patrocinador = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "enlace_afiliado", $usuario["patrocinador"]);

		$nuevoPatrocinador = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "id_usuario", $id_nuevo_patrocinador);

		$binaria_nuevo_patrocinador = ControladorMultinivel::ctrMostrarBinaria("usuario_red", $nuevoPatrocinador["id_usuario"]);

		//Actualización usuario
		$actualizar_usuario = ControladorUsuarios::ctrActualizarUsuario($usuario["id_usuario"], "patrocinador", $nuevoPatrocinador["enlace_afiliado"]);

        //Actualización red uninivel
        $actualizar_uninivel = ControladorMultinivel::ctrActualizarUninivel("usuario_red",$usuario["id_usuario"], $nuevoPatrocinador["enlace_afiliado"]);

		//Actualización árbol binario
		$actualizar_binaria = ControladorMultinivel::ctrActualizarBinaria("usuario_red", $usuario["id_usuario"], $binaria_nuevo_patrocinador["orden_binaria"],$nuevoPatrocinador["enlace_afiliado"]);

        if($actualizar_binaria=="ok" && $actualizar_uninivel) $respuesta="ok";

		return $respuesta;

    }


    /*=============================================
    Mostrar si ya hay un pago de comision relacionado con un comprobante y un usuario 
    =============================================*/
    public static function ctrMostrarPagosComisionComprobante($id_usuario, $id_comprobante)
    {
        $respuesta = ModeloPagos::mdlMostrarPagosComisionComprobante($id_usuario, $id_comprobante);

        return $respuesta;

    }

    

    /*=============================================
    Registro de Pagos Extras
    =============================================*/

    public static function ctrRegistrarPagosExtras($id_usuario)
    {

        $tabla = "pagos_extras";
        $datos = array("id_usuario" => $id_usuario,
        "estado" => 0);

        return $respuesta = ModeloPagos::mdlRegistrarPagosExtras($tabla, $datos);   

    }

     /*=============================================
    Registro de Pagos Bienvenida
    =============================================*/

    public static function ctrRegistrarPagosBienvenida($id_usuario, $id_campana)
    {

        $tabla = "pagos_bienvenida";
        $datos = array("id_usuario" => $id_usuario,
        "id_campana" => $id_campana,
        "estado" => 0);

        return $respuesta = ModeloPagos::mdlRegistrarPagosBienvenida($tabla, $datos);   

    }

     /*=============================================
    Registro de Bonos Extras
    =============================================*/

    public static function ctrRegistrarBonosExtras($id_pago_extra, $id_usuario, $id_comprobante, $id_campana)
    {

        $tabla = "bonos_extras";
        $datos = array("id_pago_extra" => $id_pago_extra,"id_usuario" => $id_usuario,
        "id_comprobante" => $id_comprobante,
        "id_campana" => $id_campana,
        "estado" => 0);

        $respuesta = ModeloPagos::mdlRegistrarBonosExtras($tabla, $datos);   

    }


    /*=============================================
    Registro de Bonos de Recurrencia
    =============================================*/

    public static function ctrRegistrarPagosBonosRecurrencia($id_usuario, $inversiones, $id_campana)
    {

        $tabla = "pagos_recurrencia";
        $datos = array("id_usuario" => $id_usuario,
        "inversiones" => $inversiones,
        "id_campana" => $id_campana);

        $respuesta = ModeloPagos::mdlRegistrarPagosBonosRecurrencia($tabla, $datos);   

    }



    /*=============================================
    Registro de Bonos Afiliados
    =============================================*/

    public static function ctrRegistrarPagosBonosRecurrenciaAfiliados($id_usuario, $afiliados, $id_campana)
    {

        $tabla = "pagos_afiliados";
        $datos = array("id_usuario" => $id_usuario,
        "afiliados" => $afiliados,
        "id_campana" => $id_campana);

        return $respuesta = ModeloPagos::mdlRegistrarPagosBonosRecurrenciaAfiliados($tabla, $datos);   

    }


    /*=============================================
    Registro de afiliados recurrentes
    =============================================*/

    public static function ctrRegistrarRecurrenciaAfiliados($id_pago_afiliados, $id_usuario, $id_comprobante)
    {

        $tabla = "afiliados_recurrentes";
        $datos = array("id_pago_afiliados" => $id_pago_afiliados,"id_usuario" => $id_usuario,
        "id_comprobante" => $id_comprobante);

        return $respuesta = ModeloPagos::mdlRegistrarRecurrenciaAfiliados($tabla, $datos);   

    }


    /*=============================================
    Mostrar Pagos Inversiones
    =============================================*/

    public static function ctrMostrarPagos($item, $valor)
    {

        $tabla = "pagos_inversiones";

        $respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

        return $respuesta;

    }


     /*=============================================
    Mostrar Pagos Publicidad
    =============================================*/

    public static function ctrMostrarPagosPublicidad($item, $valor)
    {

        $tabla = "pagos_publicidad";

        $respuesta = ModeloPagos::mdlMostrarPagosPublicidad($tabla, $item, $valor);

        return $respuesta;

    }


     /*=============================================
    Mostrar Pagos Comisiones
    =============================================*/

    public static function ctrMostrarPagosComisiones($item, $valor)
    {

        $tabla = "pagos_comisiones";

        $respuesta = ModeloPagos::mdlMostrarPagosComisiones($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    Mostrar Comisiones
    =============================================*/

    public static function ctrMostrarComisionesAll($item, $valor)
    {

        $tabla = "comisiones";

        $respuesta = ModeloPagos::mdlMostrarComisionesAll($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    Mostrar Pagos Comisiones x estado
    =============================================*/

    public static function ctrMostrarPagosComisionesxEstado($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_comisiones";

        $respuesta = ModeloPagos::mdlMostrarPagosComisionesxEstado($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }

     /*=============================================
    Mostrar Pagos Comisiones x estado All
    =============================================*/

    public static function ctrMostrarPagosComisionesxEstadoAll($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_comisiones";

        $respuesta = ModeloPagos::mdlMostrarPagosComisionesxEstadoAll($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


     /*=============================================
    Mostrar Pagos Inversiones x Usuario
    =============================================*/

    public static function ctrMostrarPagosInversionesxUsuario($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_inversiones";
        $tabla2 = "comprobantes";

        $respuesta = ModeloPagos::mdlMostrarPagosInversionesxUsuario($tabla, $tabla2, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Publicidad x Usuario
    =============================================*/

    public static function ctrMostrarPagosPublicidadxUsuario($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_publicidad";

        $respuesta = ModeloPagos::mdlMostrarPagosPublicidadxUsuario($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }



    /*=============================================
    Mostrar Pagos Inversiones x estado
    =============================================*/

    public static function ctrMostrarPagosInversionesxEstado($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_inversiones";

        $respuesta = ModeloPagos::mdlMostrarPagosInversionesxEstado($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


     /*=============================================
    Mostrar Pagos Inversiones x estado All
    =============================================*/

    public static function ctrMostrarPagosInversionesxEstadoAll($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_inversiones";

        $respuesta = ModeloPagos::mdlMostrarPagosInversionesxEstadoAll($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


     /*=============================================
    Mostrar Pagos Publicidad x estado All
    =============================================*/

    public static function ctrMostrarPagosPublicidadxEstadoAll($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_publicidad";

        $respuesta = ModeloPagos::mdlMostrarPagosPublicidadxEstadoAll($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }

     /*=============================================
    Mostrar Pagos Publicidad x estado
    =============================================*/

    public static function ctrMostrarPagosPublicidadxEstado($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_publicidad";

        $respuesta = ModeloPagos::mdlMostrarPagosPublicidadxEstado($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }

    /*=============================================
    Mostrar Pagos Extras
    =============================================*/

    public static function ctrMostrarPagosExtras($item, $valor)
    {

        $tabla = "pagos_extras";

        $respuesta = ModeloPagos::mdlMostrarPagosExtras($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Bienvenida
    =============================================*/

    public static function ctrMostrarPagosBienvenida($item, $valor)
    {

        $tabla = "pagos_bienvenida";

        $respuesta = ModeloPagos::mdlMostrarPagosBienvenida($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Extras x Comprobante
    =============================================*/

    public static function ctrMostrarPagosExtrasxComprobante($item, $valor, $item2, $valor2)
    {
        $respuesta = ModeloPagos::mdlMostrarPagosExtrasxComprobante($item, $valor, $item2, $valor2);

        return $respuesta;
    }


    /*=============================================
    Mostrar Pagos Extras x Estado
    =============================================*/

    public static function ctrMostrarPagosExtrasxEstado($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_extras";

        $respuesta = ModeloPagos::mdlMostrarPagosExtrasxEstado($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }
    


     /*=============================================
    Mostrar Pagos Extras x Estado All
    =============================================*/

    public static function ctrMostrarPagosExtrasxEstadoAll($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_extras";

        $respuesta = ModeloPagos::mdlMostrarPagosExtrasxEstadoAll($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


     /*=============================================
    Mostrar Pagos Extras 2 parametros
    =============================================*/

    public static function ctrMostrarPagosExtras2($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_extras";

        $respuesta = ModeloPagos::mdlMostrarPagosExtras2($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Bienvenida 2 parametros
    =============================================*/

    public static function ctrMostrarPagosBienvenida2($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_bienvenida";

        $respuesta = ModeloPagos::mdlMostrarPagosBienvenida2($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos
    =============================================*/

    public static function ctrMostrarPagosAll($item, $valor)
    {

        $tabla = "pagos_inversiones";

        $respuesta = ModeloPagos::mdlMostrarPagosAll($tabla, $item, $valor);

        return $respuesta;

    }
    

    /*=============================================
    Mostrar Pagos Recurrencia
    =============================================*/

    public static function ctrMostrarPagosRecurrenciaAll($item, $valor)
    {

        $tabla = "pagos_recurrencia";

        $respuesta = ModeloPagos::mdlMostrarPagosRecurrenciaAll($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Recurrencia
    =============================================*/

    public static function ctrMostrarPagosRecurrenciaAfiliadosAll($item, $valor)
    {

        $tabla = "pagos_afiliados";

        $respuesta = ModeloPagos::mdlMostrarPagosRecurrenciaAfiliadosAll($tabla, $item, $valor);

        return $respuesta;

    }


     /*=============================================
    Mostrar Pagos Recurrencia
    =============================================*/

    public static function ctrMostrarPagosRecurrencia($item, $valor)
    {

        $tabla = "pagos_recurrencia";

        $respuesta = ModeloPagos::mdlMostrarPagosRecurrencia($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Recurrencia Afiliados
    =============================================*/

    public static function ctrMostrarPagosRecurrenciaAfiliados($item, $valor)
    {

        $tabla = "pagos_afiliados";

        $respuesta = ModeloPagos::mdlMostrarPagosRecurrenciaAfiliados($tabla, $item, $valor);

        return $respuesta;

    }

     /*=============================================
    Mostrar Pagos Publicidad all
    =============================================*/

    public static function ctrMostrarPagosPublicidadAll($item, $valor)
    {

        $tabla = "pagos_publicidad";

        $respuesta = ModeloPagos::mdlMostrarPagosPublicidadAll($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Comisiones All
    =============================================*/

    public static function ctrMostrarPagosComisionesAll($item, $valor)
    {

        $tabla = "pagos_comisiones";

        $respuesta = ModeloPagos::mdlMostrarPagosComisionesAll($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Comisiones x Comprobante
    =============================================*/

    public static function ctrMostrarPagosComisionesxComprobante($item, $valor, $item2, $valor2)
    {
        $respuesta = ModeloPagos::mdlMostrarPagosComisionesxComprobante($item, $valor, $item2, $valor2);

        return $respuesta;
    }


    /*=============================================
    Mostrar Pagos Bienvenida All
    =============================================*/

    public static function ctrMostrarPagosBienvenidaAll($item, $valor)
    {

        $tabla = "pagos_bienvenida";

        $respuesta = ModeloPagos::mdlMostrarPagosExtrasAll($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Extras All
    =============================================*/

    public static function ctrMostrarPagosExtrasAll($item, $valor)
    {

        $tabla = "pagos_extras";

        $respuesta = ModeloPagos::mdlMostrarPagosExtrasAll($tabla, $item, $valor);

        return $respuesta;

    }


     /*=============================================
    Mostrar Bonos Extras All
    =============================================*/

    public static function ctrMostrarBonosExtrasAll($item, $valor)
    {

        $tabla = "bonos_extras";

        $respuesta = ModeloPagos::mdlMostrarBonosExtrasAll($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Afiliados recurrentes
    =============================================*/

    public static function ctrMostrarAfiliadosRecurrentesAll($item, $valor)
    {

        $tabla = "afiliados_recurrentes";

        $respuesta = ModeloPagos::mdlMostrarAfiliadosRecurrentesAll($tabla, $item, $valor);

        return $respuesta;

    }



    /*=============================================
    Mostrar Pagos Recurrentes
    =============================================*/

    public static function ctrMostrarPagosRecurrentes($item, $valor)
    {

        $tabla = "pagos_recurrencia";

        $respuesta = ModeloPagos::mdlMostrarPagosRecurrentes($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Recurrentes
    =============================================*/

    public static function ctrMostrarPagosRecurrentesxEstado($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_recurrencia";

        $respuesta = ModeloPagos::mdlMostrarPagosRecurrentesxEstado($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;

    }


    /*=============================================
    Mostrar Pagos Recurrentes Afiliados
    =============================================*/

    public static function ctrMostrarPagosRecurrentesAfiliadosxEstado($item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_afiliados";

        $respuesta = ModeloPagos::mdlMostrarPagosRecurrentesAfiliadosxEstado($tabla, $item, $valor, $item2, $valor2);

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
    Actualizar Estado Pago
    =============================================*/

    public static function ctrActualizarPagoInversion($datos)
    {

        $tabla = "pagos_inversiones";

        $respuesta = ModeloPagos::mdlActualizarPagoInversion($tabla, $datos);

        echo $respuesta;

    }


    /*=============================================
    Actualizar Pago Recurrencia
    =============================================*/

    public static function ctrActualizarPagoRecurrencia($datos)
    {

        $tabla = "pagos_recurrencia";

        $respuesta = ModeloPagos::mdlActualizarPagoRecurrencia($tabla, $datos);

        echo $respuesta;

    }


    /*=============================================
    Actualizar Pago Recurrencia Parametros
    =============================================*/

    public static function ctrActualizarPagoRecurrencia2($item, $valor, $id)
    {

        $tabla = "pagos_recurrencia";

        $respuesta = ModeloPagos::mdlActualizarPagoRecurrencia2($tabla, $item, $valor, $id);

        echo $respuesta;

    }


    public static function ctrRegistrarPagoAfiliados($usuario, $valor, $comprobante){

        $patrocinador=ControladorUsuarios::ctrMostrarUsuarios("enlace_afiliado", $usuario["patrocinador"]);

		$campana_recurrencia=ControladorCampanas::ctrMostrarCampanasxEstado("tipo", 6, "estado", 1);

        $n_afiliados=array();

        if($campana_recurrencia!="" && $patrocinador!="" && $patrocinador["perfil"]!="admin"){

            $listaRecurrencia = json_decode($campana_recurrencia["nombre"], true);

            $t=0;

            $comprobantesFechaBonoRecurrencia=ControladorComprobantes::ctrMostrarComprobantesxEstadoyFechaBono("id", $comprobante[0]["id"],$campana_recurrencia["fecha_inicio"],$campana_recurrencia["fecha_fin"]);

			// $comprobantesFechaBonoRecurrencia = ControladorComprobantes::ctrMostrarComprobantesxUsuarioyFechaBonoAll("doc_usuario",$usuario["doc_usuario"],$campana_recurrencia["fecha_inicio"],$campana_recurrencia["fecha_fin"]);

            $pago_recurrente=ControladorPagos::ctrMostrarPagosRecurrentesAfiliadosxEstado("id_usuario",$patrocinador["id_usuario"], "estado", 0);

            if($pago_recurrente!="") $t=$pago_recurrente["afiliados"];

            $afiliados = ControladorPagos::ctrMostrarAfiliadosRecurrentesAll("id_pago_afiliados",$pago_recurrente["id"]);

            $repetido=0;

            foreach ($afiliados as $key => $value) {
                if($value["id_usuario"]==$usuario["id_usuario"]){
                    $repetido=$repetido+1;               
                } 			
           }

           if($comprobantesFechaBonoRecurrencia!="" && $repetido==0) $t=$t+1;

        if($valor==1){
            
			if($pago_recurrente==""){

				$pago=ControladorPagos::ctrRegistrarPagosBonosRecurrenciaAfiliados($patrocinador["id_usuario"],$t,$campana_recurrencia["id"]);
                ControladorPagos::ctrRegistrarRecurrenciaAfiliados($pago, $usuario["id_usuario"], $comprobante[0]["id"]);

			}else{

				ControladorPagos::ctrActualizarPagoRecurrenciaAfiliados2("afiliados", ($t), $pago_recurrente["id"]);
                ControladorPagos::ctrRegistrarRecurrenciaAfiliados($pago_recurrente["id"], $usuario["id_usuario"], $comprobante[0]["id"]);
               
			}

		
        }else{
           
            if($pago_recurrente!=""){

                $afiliado = ControladorPagos::ctrMostrarAfiliadosRecurrentesAll("id_usuario",$usuario["id_usuario"]);	

                if($afiliado!=""){
        
                ControladorPagos::ctrEliminarAfiliadosRecurrentes("id", $afiliado[0]["id"]);

                if($repetido==1){
                ControladorPagos::ctrActualizarPagoRecurrenciaAfiliados2("afiliados", ($pago_recurrente["afiliados"]-1), $pago_recurrente["id"]);
                }
            
                }

                $afiliados = ControladorPagos::ctrMostrarAfiliadosRecurrentesAll("id_pago_afiliados",$pago_recurrente["id"]);

                if(count($afiliados)==0){
                    $e=ControladorPagos::ctrEliminarPagoAfiliados($pago_recurrente["id"]);
                }
    

			}
        }
    
    }

	}



    public static function ctrRegistrarPagoBienvenida($usuario, $valor, $id){

    $doc_usuario=$usuario["doc_usuario"];
    $bono_bienvenida= ControladorCampanas::ctrMostrarCampanasxEstado("tipo","7","estado","1");

    // Registrar pago bono bienvenida   
	if($valor==1){

	   if($bono_bienvenida!=""){
			$totalComprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantesxEstado("doc_usuario",$doc_usuario,"estado",1);
			$total = count($totalComprobantesUsuario);

			$comprobanteFechaBono = ControladorComprobantes::ctrMostrarComprobantesxEstadoyFechaBono("id", $id,$bono_bienvenida["fecha_inicio"],$bono_bienvenida["fecha_fin"]);

			// print_r($comprobanteFechaBono);
			// print_r($total);
		if($total==1 && $comprobanteFechaBono!=""){

			$existe_pago_bienvenida=ControladorPagos::ctrMostrarPagosBienvenida2("id_usuario",$usuario["id_usuario"],"estado",0);

			if($existe_pago_bienvenida==""){
				$pago_bienvenida=ControladorPagos::ctrRegistrarPagosBienvenida($usuario["id_usuario"], $bono_bienvenida["id"]);
			}
				
		}
	}
	  }else{
        //Eliminar Bono bienvenida

		$existe_pago_bienvenida=ControladorPagos::ctrMostrarPagosBienvenida2("id_usuario",$usuario["id_usuario"],"estado",0);

		if($existe_pago_bienvenida!=""){

		ControladorPagos::ctrEliminarPagoBienvenida($existe_pago_bienvenida["id"]);
		
	    }
		
	  }

    }


     /*=============================================
    Actualizar Pago Recurrencia Afiliados Parametros
    =============================================*/

    public static function ctrActualizarPagoRecurrenciaAfiliados2($item, $valor, $id)
    {

        $tabla = "pagos_afiliados";

        $respuesta = ModeloPagos::mdlActualizarPagoRecurrenciaAfiliados2($tabla, $item, $valor, $id);

        echo $respuesta;

    }


    /*=============================================
    Actualizar Estado Pago
    =============================================*/

    public static function ctrActualizarPagoPublicidad($datos)
    {

        $tabla = "pagos_publicidad";

        $respuesta = ModeloPagos::mdlActualizarPagoPublicidad($tabla, $datos);

        echo $respuesta;

    }


     /*=============================================
    Actualizar Estado y Cuenta Pago
    =============================================*/

    public static function ctrActualizarPagoInversionCuenta($id, $item, $valor, $item2, $valor2)
    {

        $tabla = "pagos_inversiones";

        $respuesta = ModeloPagos::mdlActualizarPagoInversionCuenta($tabla, $id, $item, $valor, $item2, $valor2);

        echo $respuesta;

    }


    /*=============================================
    Actualizar Estado Pago
    =============================================*/
    public static function ctrActualizarPagoComision($datos)
    {
        $tabla = "pagos_comisiones";

        $respuesta = ModeloPagos::mdlActualizarPagoComision($tabla, $datos);

        echo $respuesta;
    }


    /*=============================================
    Actualizar Estado de varios pagos de comisiones
    =============================================*/

    public static function ctrActualizarPagosComisiones($id, $item, $valor)
    {

        $tabla = "pagos_comisiones";

        $respuesta = ModeloPagos::mdlActualizarPagosComisiones($tabla, $id, $item, $valor);

        echo $respuesta;

    }


    /*=============================================
    Actualizar Estado Pago Extra
    =============================================*/

    public static function ctrActualizarPagoExtra($datos)
    {

        $tabla = "pagos_extras";

        $respuesta = ModeloPagos::mdlActualizarPagoExtra($tabla, $datos);

        echo $respuesta;

    }


    /*=============================================
    Actualizar Estado Varios Pagos
    =============================================*/

    public static function ctrActualizarPagos($datos)
    {

        if($datos["tipoPago"] == "comisiones"){
            $tabla = "pagos_comisiones";
        }
        if($datos["tipoPago"] == "inversiones"){
            $tabla = "pagos_inversiones";
        }
        if($datos["tipoPago"] == "bonos"){
            $tabla = "pagos_extras";
        }
        if($datos["tipoPago"] == "publicidad"){
            $tabla = "pagos_publicidad";
        }


        $respuesta = ModeloPagos::mdlActualizarPagos($tabla, $datos);

        echo $respuesta;

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

                    echo '<script>

                        swal({
                              type: "success",
                              title: "El comprobantes ha sido editado correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                        if (result.value) {
    
                                        
    
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
    Eliminar Pago
    =============================================*/

    public static function ctrEliminarPagos($id)
    {

        $tabla = "pagos_inversiones";

        $respuesta = ModeloPagos::mdlEliminarPagos($tabla, $id);

        return $respuesta;

    }



    /*=============================================
    Eliminar Pago Recurrente
    =============================================*/

    public static function ctrEliminarPagosRecurrentes($id)
    {

        $tabla = "pagos_recurrencia";

        $respuesta = ModeloPagos::mdlEliminarPagosRecurrentes($tabla, $id);

        return $respuesta;

    }



     /*=============================================
    Eliminar Pagos Publicidad
    =============================================*/

    public static function ctrEliminarPagosPublicidad($id)
    {

        $tabla = "pagos_publicidad";

        $respuesta = ModeloPagos::mdlEliminarPagosPublicidad($tabla, $id);

        return $respuesta;

    }



     /*=============================================
    Eliminar Pagos Comisiones
    =============================================*/

    public static function ctrEliminarPagosComisiones($id)
    {

        $tabla = "pagos_comisiones";

        $respuesta = ModeloPagos::mdlEliminarPagosComisiones($tabla, $id);

        return $respuesta;

    }


    
    /*=============================================
    Eliminar Comisiones
    =============================================*/

    public static function ctrEliminarComisiones($id_pago_comision, $id_comprobante)
    {

        $tabla = "comisiones";

        $respuesta = ModeloPagos::mdlEliminarComisiones($tabla, $id_pago_comision, $id_comprobante);

        return $respuesta;

    }


     /*=============================================
    Eliminar Pago Extra
    =============================================*/

    public static function ctrEliminarPagoExtra($id)
    {

        $tabla = "pagos_extras";

        $respuesta = ModeloPagos::mdlEliminarPagoExtra($tabla, $id);

        return $respuesta;

    }

    
    /*=============================================
    Eliminar Pago Afiliados recurrentes
    =============================================*/

    public static function ctrEliminarPagoAfiliados($id)
    {

        $tabla = "pagos_afiliados";

        $respuesta = ModeloPagos::mdlEliminarPagoAfiliados($tabla, $id);

        return $respuesta;

    }


      /*=============================================
    Eliminar Pago Bienvenida
    =============================================*/

    public static function ctrEliminarPagoBienvenida($id)
    {

        $tabla = "pagos_bienvenida";

        $respuesta = ModeloPagos::mdlEliminarPagoBienvenida($tabla, $id);

        return $respuesta;

    }


     /*=============================================
    Eliminar Pago Bono Extra
    =============================================*/

    public static function ctrEliminarBonoExtra($item,$id)
    {

        $tabla = "bonos_extras";

        $respuesta = ModeloPagos::mdlEliminarBonoExtra($tabla, $item, $id);

        return $respuesta;

    }



    /*=============================================
    Eliminar Afiliados Recurrentes
    =============================================*/

    public static function ctrEliminarAfiliadosRecurrentes($item,$id)
    {

        $tabla = "afiliados_recurrentes";

        $respuesta = ModeloPagos::mdlEliminarAfiliadosRecurrentes($tabla, $item, $id);

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
