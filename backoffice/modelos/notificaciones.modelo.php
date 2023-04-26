<?php

require_once "conexion.php";

class ModeloNotificaciones
{

    /*=============================================
    Registro de Notificaciones
    =============================================*/

    public static function mdlRegistroNotificaciones($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo, id_usuario, id_detalle) VALUES (:tipo, :id_usuario, :id_detalle)");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_detalle", $datos["id_detalle"], PDO::PARAM_INT);


        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    Mostrar Notificaciones
    =============================================*/

    public static function mdlMostrarNotificaciones($tabla, $item, $valor)
    {

        if ($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY 'fecha'");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Notificaciones
    =============================================*/

    public static function mdlMostrarNotificacionesLimite($tabla, $item, $valor, $limite)
    {

        if ($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item LIMIT :$limite");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->bindParam(":" . $limite, $limite, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY 'fecha'");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar Notificaciones x visualizacion
    =============================================*/

    public static function mdlMostrarNotificacionesVisualizacion($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 ORDER BY 'fecha' DESC");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt->close();

        $stmt = null;
    }


     /*=============================================
    Mostrar Notificaciones x visualizacion
    =============================================*/

    public static function mdlMostrarNotificacionesVisTipo($tabla, $item, $valor, $item2, $valor2, $item3, $valor3)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3 ORDER BY fecha DESC");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Actualizar notificacion
    =============================================*/

    public static function mdlActualizarNotificacion($tabla, $id, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id_detalle = :id_detalle");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":id_detalle", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }




}
