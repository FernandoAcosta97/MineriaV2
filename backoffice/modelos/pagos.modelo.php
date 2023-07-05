<?php

require_once "conexion.php";

class ModeloPagos
{

    /*=============================================
    Registro de Pagos
    =============================================*/

    public static function mdlRegistrarPagos($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, id_comprobante, id_apalancamiento, estado) VALUES (:id_usuario, :id_comprobante, :id_apalancamiento, :estado)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":id_apalancamiento", $datos["id_apalancamiento"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }



      /*=============================================
    Registro de Pagos
    =============================================*/

    public static function mdlSolicitudRetiro($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, tipo, valor) VALUES (:usuario, :tipo, :valor)");

        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_INT);
        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    Mostrar Solicitudes Retiro
    =============================================*/

    public static function mdlMostrarSolicitudesRetiro($tabla, $item, $valor,$item2,$valor2)
    {

        if ($item != null && $valor !=null && $item2 != null && $valor2 !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 ORDER BY fecha DESC");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Registro de Pagos Publicidad
    =============================================*/

    public static function mdlRegistrarPagosPublicidad($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, id_comprobante, estado) VALUES (:id_usuario, :id_comprobante, :estado)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


     /*=============================================
    Registro de Pagos Comisiones
    =============================================*/

    public static function mdlRegistrarPagosComisiones($tabla, $datos)
    { 
        $con = Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(id_usuario, estado) VALUES (:id_usuario, :estado)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $con->lastInsertId();
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


     /*=============================================
    Registro de Comisiones
    =============================================*/

    public static function mdlRegistrarComisiones($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_pago_comision, id_comprobante, nivel) VALUES (:id_pago_comision, :id_comprobante, :nivel)");

        $stmt->bindParam(":id_pago_comision", $datos["id_pago_comision"], PDO::PARAM_INT);
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":nivel", $datos["nivel"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r($con->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


     /*=============================================
    Registro de Pagos Extras
    =============================================*/

    public static function mdlRegistrarPagosExtras($tabla, $datos)
    {
        $con = Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(id_usuario, estado) VALUES (:id_usuario, :estado)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $con->lastInsertId();
        } else {

            return print_r($con->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


     /*=============================================
    Registro de Pagos Bienvenida
    =============================================*/

    public static function mdlRegistrarPagosBienvenida($tabla, $datos)
    {
        $con = Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(id_usuario, id_campana, estado) VALUES (:id_usuario, :id_campana, :estado)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_campana", $datos["id_campana"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $con->lastInsertId();
        } else {

            return print_r($con->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }



     /*=============================================
    Registro de Bonos Extras
    =============================================*/

    public static function mdlRegistrarBonosExtras($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_pago_extra, id_usuario, id_comprobante, id_campana) VALUES (:id_pago_extra, :id_usuario, :id_comprobante, :id_campana)");

        $stmt->bindParam(":id_pago_extra", $datos["id_pago_extra"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":id_campana", $datos["id_campana"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }



    /*=============================================
    Registro de Pagos de Bonos Extras
    =============================================*/

    public static function mdlRegistrarPagosBonosRecurrencia($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, inversiones, id_campana) VALUES (:id_usuario, :inversiones, :id_campana)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":inversiones", $datos["inversiones"], PDO::PARAM_INT);
        $stmt->bindParam(":id_campana", $datos["id_campana"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }



    /*=============================================
    Registro de Pagos de Bonos Afiliados
    =============================================*/

    public static function mdlRegistrarPagosBonosRecurrenciaAfiliados($tabla, $datos)
    {
        $con = Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(id_usuario, afiliados, id_campana) VALUES (:id_usuario, :afiliados, :id_campana)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":afiliados", $datos["afiliados"], PDO::PARAM_INT);
        $stmt->bindParam(":id_campana", $datos["id_campana"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $con->lastInsertId();
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    Registro de Recurrencia afiliados
    =============================================*/

    public static function mdlRegistrarRecurrenciaAfiliados($tabla, $datos)
    {
        $con = Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(id_pago_afiliados, id_usuario, id_comprobante) VALUES (:id_pago_afiliados, :id_usuario, :id_comprobante)");

        $stmt->bindParam(":id_pago_afiliados", $datos["id_pago_afiliados"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }



    /*=============================================
    Mostrar Pagos Inversiones
    =============================================*/

    public static function mdlMostrarPagos($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Pagos Publicidad
    =============================================*/

    public static function mdlMostrarPagosPublicidad($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Pagos Comisiones
    =============================================*/

    public static function mdlMostrarPagosComisiones($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Comisiones x Comprobante
    =============================================*/

    public static function mdlMostrarPagosComisionesxComprobante($item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM comisiones as c INNER JOIN pagos_comisiones as pc ON c.id_pago_comision=pc.id WHERE c.$item = :$item AND pc.$item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
      

        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Pagos Inversiones x Estado
    =============================================*/

    public static function mdlMostrarPagosInversionesxEstado($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Inversiones x Usuario
    =============================================*/

    public static function mdlMostrarPagosInversionesxUsuario($tabla, $tabla2, $item, $valor, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id, $tabla2.valor, $tabla2.id as comprobante, $tabla2.doc_usuario, $tabla2.campana, $tabla.fecha as fecha_pago, $tabla2.fecha as fecha_inversion FROM $tabla INNER JOIN $tabla2 ON $tabla.id_comprobante = $tabla2.id WHERE $tabla.$item2 = :$item2 AND $tabla2.$item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Publicidad x Usuario
    =============================================*/

    public static function mdlMostrarPagosPublicidadxUsuario($tabla, $item, $valor, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = :$item2 AND $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Pagos Inversiones x Estado All
    =============================================*/

    public static function mdlMostrarPagosInversionesxEstadoAll($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Publicidad x Estado All
    =============================================*/

    public static function mdlMostrarPagosPublicidadxEstadoAll($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }



      /*=============================================
    Mostrar Pagos Publicidad x Estado
    =============================================*/

    public static function mdlMostrarPagosPublicidadxEstado($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Comisiones x Estado
    =============================================*/

    public static function mdlMostrarPagosComisionesxEstado($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Comisiones x Estado All
    =============================================*/

    public static function mdlMostrarPagosComisionesxEstadoAll($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar si ya hay un pago de comision relacionado con un comprobante y un usuario 
    =============================================*/

    public static function mdlMostrarPagosComisionComprobante($id_usuario, $id_comprobante)
    {
        $stmt = Conexion::conectar()->prepare("SELECT pc.id FROM comisiones as c INNER JOIN pagos_comisiones as pc ON pc.id=c.id_pago_comision WHERE pc.id_usuario=:$id_usuario AND c.id_comprobante=:$id_comprobante AND pc.estado=1");

        $stmt->bindParam(":".$id_usuario, $id_usuario, PDO::PARAM_STR);
        $stmt->bindParam(":".$id_comprobante, $id_comprobante, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Pagos Extras
    =============================================*/

    public static function mdlMostrarPagosExtras($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_usuario != 1 ");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario != 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Pagos Bienvenida
    =============================================*/

    public static function mdlMostrarPagosBienvenida($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_usuario != 1 ");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario != 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Extras 2 parametros
    =============================================*/

    public static function mdlMostrarPagosExtras2($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Bienvenida 2 parametros
    =============================================*/

    public static function mdlMostrarPagosBienvenida2($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos
    =============================================*/

    public static function mdlMostrarPagosAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM pagos_inversiones INNER join usuarios on pagos_inversiones.id_usuario=usuarios.id_usuario WHERE usuarios.eliminado=0 AND pagos_inversiones.$item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM pagos_inversiones INNER join usuarios on pagos_inversiones.id_usuario=usuarios.id_usuario WHERE usuarios.eliminado=0");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Pagos Recurrencia
    =============================================*/

    public static function mdlMostrarPagosRecurrencia($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Pagos Recurrencia Afiliados
    =============================================*/

    public static function mdlMostrarPagosRecurrenciaAfiliados($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Recurrencia
    =============================================*/

    public static function mdlMostrarPagosRecurrenciaAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }




      /*=============================================
    Mostrar Pagos Recurrencia Afiliados
    =============================================*/

    public static function mdlMostrarPagosRecurrenciaAfiliadosAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



      /*=============================================
    Mostrar Pagos Publicidad
    =============================================*/

    public static function mdlMostrarPagosPublicidadAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Pagos Comisiones All
    =============================================*/

    public static function mdlMostrarPagosComisionesAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Comisiones All
    =============================================*/

    public static function mdlMostrarComisionesAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Comisiones All
    =============================================*/

    public static function mdlMostrarPagosComisionesComprobante($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Extras All
    =============================================*/

    public static function mdlMostrarPagosExtrasAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_usuario != 1 ");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Pagos Bienvenida All
    =============================================*/

    public static function mdlMostrarPagosBienvenidaAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Extras x Estado
    =============================================*/

    public static function mdlMostrarPagosExtrasxEstado($tabla, $item, $valor, $item2, $valor2)
    {

        if ($item != null && $valor !=null && $item2 != null && $valor2 !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Pagos Extras x Comprobante
    =============================================*/

    public static function mdlMostrarPagosExtrasxComprobante($item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM bonos_extras as b INNER JOIN pagos_extras as pe ON b.id_pago_extra=pe.id WHERE b.$item = :$item AND pe.$item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
      

        $stmt->close();

        $stmt = null;
    }




    /*=============================================
    Mostrar Pagos Extras x Estado All
    =============================================*/

    public static function mdlMostrarPagosExtrasxEstadoAll($tabla, $item, $valor, $item2, $valor2)
    {

        if ($item != null && $valor !=null && $item2 != null && $valor2 !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Bonos Extras All
    =============================================*/

    public static function mdlMostrarBonosExtrasAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Afiliados recurrentes
    =============================================*/

    public static function mdlMostrarAfiliadosRecurrentesAll($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Recurrentes
    =============================================*/

    public static function mdlMostrarPagosRecurrentes($tabla, $item, $valor)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Mostrar Pagos Recurrentes
    =============================================*/

    public static function mdlMostrarPagosRecurrentesxEstado($tabla, $item, $valor, $item2, $valor2)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Pagos Recurrentes Afiliados
    =============================================*/

    public static function mdlMostrarPagosRecurrentesAfiliadosxEstado($tabla, $item, $valor, $item2, $valor2)
    {

        if ($item != null && $valor !=null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxEstado($tabla, $item, $valor,$item2, $valor2)
    {

        if ($item != null && $valor != null && $item2 != null && $valor2 != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            
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
    Mostrar Comprobantes
    =============================================*/

    public static function mdlMostrarComprobantesxEstadoyFecha($tabla, $item, $valor,$item2, $valor2, $fechaInicial, $fechaFinal)
    {

        if ($item != null && $valor != null && $item2 != null && $valor2 != null && $fechaInicial != null && $fechaFinal != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND (fecha BETWEEN :fechaInicial AND :fechaFinal) ");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else if($item2 != null && $valor2 != null && $fechaInicial != null && $fechaFinal != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = :$item2 AND fecha BETWEEN :fechaInicial AND :fechaFinal");

            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal,  PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        }else if($item != null && $valor != null && $fechaInicial != null && $fechaFinal != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND (fecha BETWEEN :fechaInicial AND :fechaFinal)");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal,  PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
           
        }else if($fechaInicial != null && $fechaFinal != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE (fecha BETWEEN :fechaInicial AND :fechaFinal)");

            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal,  PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }else if($item != null && $valor != null && $item2 != null && $valor2){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 ORDER BY fecha");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }

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
    Actualizar Estado Pago Inversion
    =============================================*/

    public static function mdlActualizarPagoInversion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
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
    Actualizar Pago Recurrencia
    =============================================*/

    public static function mdlActualizarPagoRecurrencia($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, valor = :valor, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":valor", $datos["total"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
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
    Actualizar Pago Recurrencia Parametros
    =============================================*/

    public static function mdlActualizarPagoRecurrencia2($tabla, $item, $valor, $id)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
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
    Actualizar Pago Recurrencia Afiliados Parametros
    =============================================*/

    public static function mdlActualizarPagoRecurrenciaAfiliados2($tabla, $item, $valor, $id)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
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
    Actualizar Estado Pago Publicidad
    =============================================*/

    public static function mdlActualizarPagoPublicidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, valor = :valor, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
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
    Actualizar Estado y Cuenta Pago Inversion
    =============================================*/

    public static function mdlActualizarPagoInversionCuenta($tabla, $id, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item, $item2 = :$item2 WHERE id = :id");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);
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
    Actualizar Estado Pago Comision
    =============================================*/

    public static function mdlActualizarPagoComision($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, valor = :valor, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
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
    Actualizar Estado de varios pagos de comisiones
    =============================================*/

    public static function mdlActualizarPagosComisiones($tabla, $id, $item, $valor)
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
    Actualizar Estado de varios pagos
    =============================================*/

    public static function mdlActualizarPagos($tabla, $datos)
    {

        if($datos["tipoPago"]=="comisiones" || $datos["tipoPago"]=="publicidad" ){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor = :valor, estado = :estado, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        }else if($datos["tipoPago"]=="inversiones"){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

     }else if($datos["tipoPago"]=="bonos"){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor = :valor, estado = :estado, referidos_obtenidos = :referidos_obtenidos, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":referidos_obtenidos", $datos["referidos_obtenidos"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

     }

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Actualizar Estado Pago Extra
    =============================================*/

    public static function mdlActualizarPagoExtra($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, valor = :valor, referidos_obtenidos = :referidos_obtenidos, id_cuenta = :id_cuenta WHERE id = :id");

        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_INT);
        $stmt->bindParam(":referidos_obtenidos", $datos["referidos_obtenidos"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cuenta", $datos["id_cuenta"], PDO::PARAM_INT);
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
    Eliminar pago
    =============================================*/

    public static function mdlEliminarPagos($tabla, $id)
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
    Eliminar pago recurrente
    =============================================*/

    public static function mdlEliminarPagosRecurrentes($tabla, $id)
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
    Eliminar pagos puclicidad
    =============================================*/

    public static function mdlEliminarPagosPublicidad($tabla, $id)
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
    Eliminar pago comisiones
    =============================================*/

    public static function mdlEliminarPagosComisiones($tabla, $id)
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
    Eliminar comisiones
    =============================================*/

    public static function mdlEliminarComisiones($tabla, $id_pago_comision, $id_comprobante)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_pago_comision = :$id_pago_comision AND id_comprobante = :$id_comprobante");

        $stmt->bindParam(":".$id_pago_comision, $id_pago_comision, PDO::PARAM_INT);
        $stmt->bindParam(":".$id_comprobante, $id_comprobante, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }



     /*=============================================
    Eliminar pago extra
    =============================================*/

    public static function mdlEliminarPagoExtra($tabla, $id)
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
    Eliminar pago afiliados recurrentes
    =============================================*/

    public static function mdlEliminarPagoAfiliados($tabla, $id)
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
    Eliminar pago bienvenida
    =============================================*/

    public static function mdlEliminarPagoBienvenida($tabla, $id)
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
    Eliminar bono extra
    =============================================*/

    public static function mdlEliminarBonoExtra($tabla, $item, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":".$item, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Eliminar afiliados recurrentes
    =============================================*/

    public static function mdlEliminarAfiliadosRecurrentes($tabla, $item, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":".$item, $id, PDO::PARAM_INT);

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
