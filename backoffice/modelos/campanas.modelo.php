<?php

require_once "conexion.php";

class ModeloCampanas
{

    /*=============================================
    Registro de Campanas
    =============================================*/

    public static function mdlRegistroCampana($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, retorno, cupos, tipo,  fecha_inicio, fecha_fin, fecha_retorno, estado) VALUES (:nombre, :retorno, :cupos, :tipo, :fecha_inicio, :fecha_fin, :fecha_retorno, :estado)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":retorno", $datos["retorno"], PDO::PARAM_STR);
        $stmt->bindParam(":cupos", $datos["cupos"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_retorno", $datos["fecha_retorno"], PDO::PARAM_STR);
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
    Mostrar Campanas
    =============================================*/

    public static function mdlMostrarCampanas($tabla, $item, $valor)
    {

        if ($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY 'fecha_inicio' ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Solo 3 Campañas Activas
    =============================================*/

    public static function mdlMostrarCampanasLimitActivas($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado=1 AND tipo=1 ORDER BY 'fecha_inicio' ASC LIMIT 3");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }



    /*=============================================
    Mostrar Campanas x Estado
    =============================================*/

    public static function mdlMostrarCampanasxEstado($tabla, $item, $valor, $item2, $valor2)
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
    Mostrar Campanas x Estado All
    =============================================*/

    public static function mdlMostrarCampanasxEstadoAll($tabla, $item, $valor, $item2, $valor2)
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
    Mostrar Campanas x Tipo xEstado All
    =============================================*/

    public static function mdlMostrarCampanasxTipoxEstadoAll($tabla, $item, $valor, $item2, $valor2)
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
	Mostrar Campañas Activas e Inactivas pero no finalizadas
	=============================================*/

    public static function mdlMostrarCampanasNoFinalizadas($tabla, $valor, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = :$valor OR estado = :$valor2");

        $stmt->bindParam(":" . $valor, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $valor2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt->close();

        $stmt = null;
    }



    public static function mdlMostrarCampanasAll($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt->close();

        $stmt = null;
    }


    /*=============================================
    Mostrar los comprobantes de una campaña sin repetir documento de usuario
    =============================================*/

    public static function mdlMostrarComprobantesCampanaDoc($tabla, $tabla2, $item, $valor)
    {

        if ($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT DISTINCT $tabla2.doc_usuario FROM $tabla INNER JOIN $tabla2 ON $tabla.id=$tabla2.campana WHERE $tabla.id = :$item AND $tabla2.estado=1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY 'id_usuario' ASC");

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
    Actualizar campaña
    =============================================*/

    public static function mdlActualizarCampana($tabla, $id, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
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
    Editar campaña
    =============================================*/

    public static function mdlEditarCampana($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, retorno = :retorno, cupos = :cupos, fecha_inicio = :fecha_inicio , fecha_fin = :fecha_fin, fecha_retorno = :fecha_retorno WHERE id = :id");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":cupos", $datos["cupos"], PDO::PARAM_INT);
        $stmt->bindParam(":retorno", $datos["retorno"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_retorno", $datos["fecha_retorno"], PDO::PARAM_STR);
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
    total de comprobantes x campaña bono
    =============================================*/

    public static function mdlTotalComprobantesxCampanaBono($tabla, $tabla2,$valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla INNER JOIN $tabla2 ON $tabla.id=$tabla2.id_campana WHERE $tabla.id=:id");

        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }


     /*=============================================
    total de comprobantes x campaña inversion
    =============================================*/

    public static function mdlTotalComprobantesxCampana($tabla, $tabla2,$valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla INNER JOIN $tabla2 ON $tabla.id=$tabla2.campana WHERE $tabla.id=:id");

        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }



    /*=============================================
    Eliminar Campana
    =============================================*/

    public static function mdlEliminarCampana($tabla, $id)
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

    // public static function mdlIniciarSuscripcion($tabla, $datos)
    // {

    //     $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET doc_usuario = :doc_usuario, enlace_afiliado = :enlace_afiliado, patrocinador = :patrocinador, pais = :pais, codigo_pais = :codigo_pais, telefono_movil = :telefono_movil, firma = :firma, fecha_contrato = :fecha_contrato  WHERE id_usuario = :id_usuario");

    //     $stmt->bindParam(":doc_usuario", $datos["doc_usuario"], PDO::PARAM_INT);
    //     $stmt->bindParam(":enlace_afiliado", $datos["enlace_afiliado"], PDO::PARAM_STR);
    //     $stmt->bindParam(":patrocinador", $datos["patrocinador"], PDO::PARAM_STR);
    //     $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
    //     $stmt->bindParam(":codigo_pais", $datos["codigo_pais"], PDO::PARAM_STR);
    //     $stmt->bindParam(":telefono_movil", $datos["telefono_movil"], PDO::PARAM_STR);
    //     $stmt->bindParam(":firma", $datos["firma"], PDO::PARAM_STR);
    //     $stmt->bindParam(":fecha_contrato", $datos["fecha_contrato"], PDO::PARAM_STR);
    //     $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

    //     if ($stmt->execute()) {

    //         return "ok";
    //     } else {

    //         return print_r(Conexion::conectar()->errorInfo());
    //     }

    //     $stmt->close();

    //     $stmt = null;
    // }

     /*=============================================
    Iniciar Suscripción
    =============================================*/

    public static function mdlIniciarSuscripcion($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET doc_usuario = :doc_usuario, enlace_afiliado = :enlace_afiliado, pais = :pais, codigo_pais = :codigo_pais, telefono_movil = :telefono_movil, fecha_contrato = :fecha_contrato  WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":doc_usuario", $datos["doc_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":enlace_afiliado", $datos["enlace_afiliado"], PDO::PARAM_STR);
        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo_pais", $datos["codigo_pais"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_movil", $datos["telefono_movil"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_contrato", $datos["fecha_contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            //echo print_r(Conexion::conectar()->errorInfo());
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
