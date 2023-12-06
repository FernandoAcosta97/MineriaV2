<?php

require_once "conexion.php";

class ModeloComprobantes
{

    /*=============================================
    Registro de COMPROBANTES
    =============================================*/

    public static function mdlRegistrarComprobantes($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(valor, foto, fecha, estado, doc_usuario, campana) VALUES (:valor, :foto, :fecha, :estado, :doc_usuario, :campana)");

        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_INT);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":doc_usuario", $datos["doc_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":campana", $datos["campana"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }

      /*=============================================
    Mostrar Comprobantes x tipo x usuario x campaña
    =============================================*/

    public static function mdlMostrarComprobantesPublicidadxUsuario($valor, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id 
        INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.doc_usuario = :$valor AND ca.id=:$valor2");

        $stmt->bindParam(":" . $valor, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $valor2, $valor2, PDO::PARAM_INT);
            
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Registro de COMPROBANTES Inversiones con ia
    =============================================*/

    public static function mdlRegistrarComprobantesInversion($tabla, $datos)
    {

        $con=Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(valor, foto, fecha, estado, doc_usuario, campana) VALUES (:valor, :foto, :fecha, :estado, :doc_usuario, :campana)");

        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_INT);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":doc_usuario", $datos["doc_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":campana", $datos["campana"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $con->lastInsertId();
        } else {

            return "error";
            // return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }



     /*=============================================
    Registro de datos ia COMPROBANTES
    =============================================*/

    public static function mdlRegistrarDatosComprobantes($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(n_recibo, n_aprobado, n_cuenta, n_valor, fecha, id_comprobante, detalles) VALUES (:n_recibo, :n_aprobado, :n_cuenta, :n_valor, :fecha, :id_comprobante, :detalles)");

        $stmt->bindParam(":n_recibo", $datos["n_recibo"], PDO::PARAM_STR);
        $stmt->bindParam(":n_aprobado", $datos["n_aprobado"], PDO::PARAM_INT);
        $stmt->bindParam(":n_cuenta", $datos["n_cuenta"], PDO::PARAM_INT);
        $stmt->bindParam(":n_valor", $datos["n_valor"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    Registro de datos ia COMPROBANTES Publicidad
    =============================================*/

    public static function mdlRegistrarDatosComprobantesPublicidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(vistas, mi_estado, fecha, id_comprobante, detalles) VALUES (:vistas, :mi_estado, :fecha, :id_comprobante, :detalles)");

        $stmt->bindParam(":vistas", $datos["vistas"], PDO::PARAM_INT);
        $stmt->bindParam(":mi_estado", $datos["mi_estado"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantes($tabla, $item, $valor)
    {

        if ($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.foto, co.campana, co.billetera, us.id_usuario, us.doc_usuario, us.estado as usu_estado FROM comprobantes as co INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE co.$item = :$item AND us.eliminado=0 ORDER BY 'fecha'");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.foto, co.campana, co.billetera, us.id_usuario, us.doc_usuario, us.estado as usu_estado FROM comprobantes as co INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.eliminado=0 ORDER BY 'fecha'");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarDatosComprobantes($tabla, $item, $valor)
    {

        if ($item == null && $valor == null) {

        $stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();
    
            return $stmt->fetch();

        }
 

        $stmt->close();

        $stmt = null;
    }



      /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarDatosComprobantesFiltro($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * from rec_comprobantes as rc INNER JOIN comprobantes as c ON rc.id_comprobante=c.id WHERE c.$item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

            $stmt->execute();
    
            return $stmt->fetchAll();
 

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarDatosComprobantesPublicidad($tabla, $item, $valor)
    {

        if ($item == null && $valor == null) {

        $stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();
    
            return $stmt->fetch();

        }
 

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarDatosComprobantesFiltroPublicidad($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * from rec_comprobantes_publicidad as rc INNER JOIN comprobantes as c ON rc.id_comprobante=c.id WHERE c.$item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

            $stmt->execute();
    
            return $stmt->fetchAll();
 

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Comprobantes x Tipo
    =============================================*/

    public static function mdlMostrarComprobantesxTipo($tabla, $tabla2, $item, $valor, $item2, $valor2)
    {

        if ($item != null && $valor != null) {
            
        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, co.billetera, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.eliminado=0 AND co.$item = :$item AND ca.$item2 = :$item2 ORDER BY 'fecha'");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        }else{
            
            $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, co.billetera, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.eliminado=0 AND ca.$item2 = :$item2 ORDER BY 'fecha'");
        
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
        
            $stmt->execute();
        
            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Comprobantes x Tipo x Campana
    =============================================*/

    public static function mdlMostrarComprobantesxTipoxCampana($tabla, $tabla2, $item, $valor, $item2, $valor2, $campana)
    {

        if ($item != null && $valor != null) {
            
        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.eliminado=0 AND co.$item = :$item AND ca.$item2 = :$item2 ORDER BY 'fecha'");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        }else{
            
            $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.eliminado=0 AND ca.$item2 = :$item2 AND ca.id = :$campana ORDER BY 'fecha'");
        
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

            $stmt->bindParam(":" . $campana, $campana, PDO::PARAM_STR);
        
            $stmt->execute();
        
            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }



      /*=============================================
    Mostrar Datos Ia Comprobantes x Tipo x Campana
    =============================================*/

    public static function mdlMostrarDatosComprobantesxTipoxCampana($tabla, $tabla2, $tabla3, $item, $valor, $item2, $valor2, $campana)
    {

        if ($item != null && $valor != null) {
            
        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana, rc.id, rc.id_comprobante, rc.n_recibo, rc.n_cuenta, rc.n_aprobado, rc.n_valor, rc.fecha, rc.detalles FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN $tabla3 as rc ON rc.id_comprobante=co.id INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.eliminado=0 AND co.$item = :$item AND ca.$item2 = :$item2 ORDER BY 'fecha'");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        }else{
            
            $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana, rc.id, rc.id_comprobante, rc.n_recibo, rc.n_cuenta, rc.n_aprobado, rc.n_valor, rc.fecha, rc.detalles FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN $tabla3 as rc ON rc.id_comprobante=co.id INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE us.eliminado=0 AND ca.$item2 = :$item2 AND ca.id = :$campana ORDER BY 'fecha'");
        
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

            $stmt->bindParam(":" . $campana, $campana, PDO::PARAM_STR);
        
            $stmt->execute();
        
            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Comprobantes x tipo x estado
    =============================================*/

    public static function mdlMostrarComprobantesxTipoxEstado($tabla, $tabla2, $item, $valor, $item2, $valor2, $item3, $valor3)
    {

        if ($item != null && $valor != null) {
            
        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, co.billetera, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id WHERE $item = :$item AND $item2 = :$item2 AND co.$item3 = :$item3 ORDER BY 'fecha'");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, co.billetera, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id WHERE $item2 = :$item2 AND co.$item3 = :$item3 ORDER BY 'fecha'");
    
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
    
            $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Comprobantes x tipo x estado x usuario
    =============================================*/

    public static function mdlMostrarComprobantesxTipoxEstadoxUsuario($tipo, $estado, $doc_usuario)
    {
        
        if ($estado != null) {

        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, co.fecha 
        FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id
        INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE ca.tipo = :$tipo AND co.estado = :$estado AND us.doc_usuario = :$doc_usuario ORDER BY 'fecha'");

        $stmt->bindParam(":" . $tipo, $tipo, PDO::PARAM_STR);

        $stmt->bindParam(":" . $estado, $estado, PDO::PARAM_STR);

        $stmt->bindParam(":" . $doc_usuario, $doc_usuario, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }else{

        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, co.fecha 
        FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id
        INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE ca.tipo = :$tipo AND us.doc_usuario = :$doc_usuario ORDER BY 'fecha'");

        $stmt->bindParam(":" . $tipo, $tipo, PDO::PARAM_STR);

        $stmt->bindParam(":" . $doc_usuario, $doc_usuario, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
        
    }

        $stmt->close();

        $stmt = null;

}
    



    /*=============================================
    Mostrar Comprobantes x tipo x estado x campana
    =============================================*/

    public static function mdlMostrarComprobantesxTipoxEstadoxCampana($tabla, $tabla2, $item, $valor, $item2, $valor2, $item3, $valor3, $campana)
    {

        if ($item != null && $valor != null) {
            
        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id WHERE $item = :$item AND $item2 = :$item2 AND co.$item3 = :$item3 ORDER BY 'fecha'");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id WHERE $item2 = :$item2 AND co.$item3 = :$item3 AND ca.id = :$campana ORDER BY 'fecha'");
    
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
    
            $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);

            $stmt->bindParam(":" . $campana, $campana, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Datos Ia Comprobantes x tipo x estado x campana
    =============================================*/

    public static function mdlMostrarDatosComprobantesxTipoxEstadoxCampana($tabla, $tabla2, $tabla3, $item, $valor, $item2, $valor2, $item3, $valor3, $campana)
    {

        if ($item != null && $valor != null) {
            
        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana, rc.id, rc.id_comprobante, rc.n_recibo, rc.n_cuenta, rc.n_aprobado, rc.n_valor, rc.fecha, rc.detalles FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN $tabla3 as rc ON rc.id_comprobante=co.id WHERE $item = :$item AND $item2 = :$item2 AND co.$item3 = :$item3 ORDER BY 'fecha'");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.foto, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana, rc.id, rc.id_comprobante, rc.n_recibo, rc.n_cuenta, rc.n_aprobado, rc.n_valor, rc.fecha, rc.detalles FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id INNER JOIN $tabla3 as rc ON rc.id_comprobante=co.id WHERE $item2 = :$item2 AND co.$item3 = :$item3 AND ca.id = :$campana ORDER BY 'fecha'");
    
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
    
            $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);

            $stmt->bindParam(":" . $campana, $campana, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Comprobantes x tipo x estado x campana estado
    =============================================*/

    public static function mdlMostrarComprobantesxTipoxEstadoxCampanaEstado($tabla, $tabla2, $doc_usuario, $estado_comprobante, $tipo_campana, $estado_campana)
    {
            
        $stmt = Conexion::conectar()->prepare("SELECT co.id as comprobanteId, co.fecha, co.estado as estadoComprobante, co.valor, co.doc_usuario, co.campana, ca.id as campanaId, ca.retorno, ca.nombre, ca.tipo, ca.estado as estadoCampana FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id WHERE co.doc_usuario = :$doc_usuario AND co.estado = :$estado_comprobante AND ca.tipo = :$tipo_campana AND ca.estado = :$estado_campana");

        $stmt->bindParam(":" . $doc_usuario, $doc_usuario, PDO::PARAM_INT);

        $stmt->bindParam(":" . $estado_comprobante, $estado_comprobante, PDO::PARAM_INT);

        $stmt->bindParam(":" . $tipo_campana, $tipo_campana, PDO::PARAM_INT);

        $stmt->bindParam(":" . $estado_campana, $estado_campana, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxEstado($tabla, $item, $valor,$item2, $valor2)
    {
        if ($item != null && $valor != null && $item2 != null && $valor2 != null) {

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.doc_usuario, co.campana, co.foto FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id WHERE co.$item = :$item AND co.$item2 = :$item2 AND ca.tipo=1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            
        $stmt->execute();

        return $stmt->fetchAll();

        } else if($item2 != null && $valor2 != null){

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.doc_usuario, co.campana, co.foto FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id WHERE co.$item2 = :$item2 AND ca.tipo=1");

            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
        
            $stmt->execute();

            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxEstadoxTipo($tabla, $item, $valor,$item2, $valor2, $item3, $valor3)
    {

        if ($item != null && $valor != null && $item2 != null && $valor2 != null && $item3 != null && $valor3 != null) {

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.valor, co.fecha, co.estado, co.doc_usuario, co.foto FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id WHERE co.$item = :$item AND co.$item2 = :$item2 AND ca.$item3 = :$item3");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);
            
        $stmt->execute();

        return $stmt->fetchAll();

        } else if($item2 != null && $valor2 != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = :$item2");

            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
        
            $stmt->execute();

            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Comprobantes x estado excluyendo tipo publicidad
    =============================================*/

    public static function mdlMostrarComprobantesxEstadoNoPublicidad($tabla, $tabla2, $item, $valor,$item2, $valor2)
    {

        if ($item != null && $valor != null && $item2 != null && $valor2 != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as co INNER JOIN $tabla2 as ca ON co.campana=ca.id WHERE co.$item = :$item AND co.$item2 = :$item2 AND ca.tipo != 3");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            
        $stmt->execute();

        return $stmt->fetchAll();

        } else if($item2 != null && $valor2 != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = :$item2 AND tipo != 3");

            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
        
            $stmt->execute();

            return $stmt->fetchAll();

        }


        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Comprobantes x Estado x Estado campaña
    =============================================*/

    public static function mdlMostrarComprobantesxEstadoxCampana($tabla, $tabla2, $item, $valor,$item2, $valor2, $item3, $valor3)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN $tabla2 ON $tabla.campana=$tabla2.id AND $tabla.estado=:$item2 AND $tabla2.estado=:$item3 WHERE $tabla.doc_usuario = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);
            
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;
    }



     /*=============================================
    Mostrar Comprobantes Inversiones x Estado Comprobante x Estado campaña x Condicion inversiones
    =============================================*/

    public static function mdlMostrarInversionesxEstadoxCampanaxCondicion($doc_usuario, $condicion)
    {

        $stmt = Conexion::conectar()->prepare("SELECT count(*) as inversiones FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id INNER JOIN usuarios as us ON co.doc_usuario=us.doc_usuario WHERE ca.tipo=1 AND ca.condicion = :$condicion AND co.estado=1 AND us.doc_usuario = :$doc_usuario");

        $stmt->bindParam(":" . $doc_usuario, $doc_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":" . $condicion, $condicion, PDO::PARAM_INT);
            
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxEstadoyFecha($tabla, $item, $valor,$item2, $valor2, $fechaInicial, $fechaFinal)
    {

        if ($item != null && $valor != null && $item2 != null && $valor2 != null && $fechaInicial != null && $fechaFinal != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND fecha >= :fechaInicial AND fecha <= :fechaFinal");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else if($item2 != null && $valor2 != null && $fechaInicial != null && $fechaFinal != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = :$item2 AND fecha >= :fechaInicial AND fecha <= :fechaFinal");

            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal,  PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");
    
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }

     /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxEstadoyFechaBono($tabla, $item, $valor, $fechaInicio, $fechaFin)
    {

        if ($item != null && $valor != null && $fechaInicio != null && $fechaFin != null) {

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.doc_usuario, co.campana, co.foto FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id WHERE co.$item = :$item AND co.fecha >= :fechaInicio AND co.fecha <= :fechaFin AND ca.tipo=1 AND co.estado=1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->bindParam(":fechaInicio",$fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFin",$fechaFin, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else if($fechaInicio != null && $fechaFin != null){

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.doc_usuario, co.campana, co.foto FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id WHERE co.fecha >= :fechaInicio AND co.fecha <= :fechaFin AND ca.tipo=1 AND co.estado=1");

            $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFin", $fechaFin,  PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxUsuarioyFechaBonoAll($tabla, $item, $valor, $fechaInicio, $fechaFin)
    {

        if ($item != null && $valor != null && $fechaInicio != null && $fechaFin != null) {

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.doc_usuario, co.campana, co.foto FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id WHERE co.$item = :$item AND co.fecha >= :fechaInicio AND co.fecha <= :fechaFin AND ca.tipo=1 AND co.estado=1 AND ca.estado=1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->bindParam(":fechaInicio",$fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFin",$fechaFin, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else if($fechaInicio != null && $fechaFin != null){

            $stmt = Conexion::conectar()->prepare("SELECT co.id, co.estado, co.valor, co.fecha, co.doc_usuario, co.campana, co.foto FROM comprobantes as co INNER JOIN campanas as ca ON co.campana=ca.id WHERE co.fecha >= :fechaInicio AND co.fecha <= :fechaFin AND ca.tipo=1 AND co.estado=1 AND ca.estado=1");

            $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFin", $fechaFin,  PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


      /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxEstadoyFechaBonoUsuario($tabla, $item, $valor, $item2, $valor2, $fechaInicio, $fechaFin)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND fecha >= :fechaInicio AND fecha <= :fechaFin");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);
        $stmt->bindParam(":fechaInicio",$fechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(":fechaFin",$fechaFin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();   

        $stmt->close();

        $stmt = null;
    }

    /*=============================================
    Total Usuarios
    =============================================*/

    public static function mdlTotalUsuarios($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE perfil!='admin'");
        $stmt->execute();
        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR USUARIOS X FILTRO O ACTIVIDAD ----- FUNCIONAL FERNANDO
    =============================================*/
    public static function mdlTotalUsuariosXfiltro($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT count(*) as total FROM $tabla WHERE $item = trim(:$item) AND perfil!='admin'");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    Actualizar Comprobante
    =============================================*/

    public static function mdlActualizarComprobante($tabla, $id, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }

    /*=============================================
    Editar comprobantes
    =============================================*/

    public static function mdlEditarComprobantes($tabla, $datos)
    {

        if($datos["foto"]!=""){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor = :valor, foto = :foto WHERE id = :id");
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
    }else{
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor = :valor WHERE id = :id");
    }

        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


      /*=============================================
    Editar comprobantes
    =============================================*/

    public static function mdlEditarComprobanteValor($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor = :valor WHERE id = :id");


        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Eliminar Datos Comprobante Ia
    =============================================*/

    public static function mdlEliminarDatosComprobante($tabla, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_comprobante = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


      /*=============================================
    Eliminar Datos Comprobante Ia Publicidad
    =============================================*/

    public static function mdlEliminarDatosComprobantePublicidad($tabla, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_comprobante = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


         /*=============================================
    Editar comprobantes
    =============================================*/

    public static function mdlEditarComprobanteValorDatos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET n_valor = :valor WHERE id = :id");


        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


          /*=============================================
    Editar comprobantes
    =============================================*/

    public static function mdlEditarComprobanteValorDatosPublicidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET vistas = :valor WHERE id = :id");


        $stmt->bindParam(":valor", $datos["vistas"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Eliminar usuario
    =============================================*/

    public static function mdlEliminarUsuario($tabla, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":id_usuario", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }

    public static function mdlRegistroReferido($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(patrocinador, referido) VALUES (:patrocinador, :referido)");

        $stmt->bindParam(":patrocinador", $datos["patrocinador"], PDO::PARAM_INT);
        $stmt->bindParam(":referido", $datos["referido"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    Iniciar Suscripción
    =============================================*/

    public static function mdlIniciarSuscripcion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET doc_usuario = :doc_usuario, enlace_afiliado = :enlace_afiliado, patrocinador = :patrocinador, pais = :pais, codigo_pais = :codigo_pais, telefono_movil = :telefono_movil, fecha_contrato = :fecha_contrato  WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":doc_usuario", $datos["doc_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":enlace_afiliado", $datos["enlace_afiliado"], PDO::PARAM_STR);
        $stmt->bindParam(":patrocinador", $datos["patrocinador"], PDO::PARAM_STR);
        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo_pais", $datos["codigo_pais"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_movil", $datos["telefono_movil"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_contrato", $datos["fecha_contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }

    /*=============================================
    Cancelar Suscripción
    =============================================*/

    public static function mdlCancelarSuscripcion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  suscripcion = :suscripcion, ciclo_pago = :ciclo_pago, fecha_contrato = :fecha_contrato WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":suscripcion", $datos["suscripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":ciclo_pago", $datos["ciclo_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_contrato", $datos["fecha_contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Eliminar Comprobante
    =============================================*/

    public static function mdlEliminarComprobante($tabla, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    registrar cuenta
    =============================================*/

    public static function mdlRegistrarCuentaBancaria($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numero, titular, entidad, estado, tipo) VALUES (:numero, :titular, :entidad, :estado, :tipo)");

        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_INT);
        $stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_INT);
        $stmt->bindParam(":entidad", $datos["entidad"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }

    


}
