<?php

require_once "conexion.php";

class ModeloCuentas{

	/*=============================================
	Mostrar cuentas
	=============================================*/

	static public function mdlMostrarCuentas($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN usuarios ON $tabla.usuario=usuarios.id_usuario WHERE usuarios.eliminado=0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


    /*=============================================
	Mostrar cuentas
	=============================================*/

	static public function mdlMostrarCuentasxEstado($tabla, $item, $valor, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}



    /*=============================================
	Mostrar cuentas
	=============================================*/

	static public function mdlMostrarCuentasAll($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM cuentas_bancarias INNER JOIN usuarios ON cuentas_bancarias.usuario=usuarios.id_usuario WHERE usuarios.eliminado=0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


    public static function mdlRegistrarCuentaBancaria($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, numero, titular, tipo_documento, nombre_titular, entidad, estado, tipo) VALUES (:usuario, :numero, :titular, :tipo_documento, :nombre_titular, :entidad, :estado, :tipo)");

        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
        $stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_documento", $datos["tipoDocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_titular", $datos["nombreTitular"], PDO::PARAM_STR);
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


	/*=============================================
    Editar cuenta
    =============================================*/

    public static function mdlEditarCuenta($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero = :numero, nombre_titular = :nombre_titular, entidad = :entidad, tipo = :tipo, tipo_documento = :tipo_documento, titular = :titular WHERE id = :id");

        $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_titular", $datos["nombre_titular"], PDO::PARAM_STR);
        $stmt->bindParam(":entidad", $datos["entidad"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_INT); 
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
    Actualizar cuenta
    =============================================*/

    public static function mdlActualizarCuenta($tabla, $id, $item, $valor)
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
	Mostrar pagos cuentas
	=============================================*/

	static public function mdlMostrarPagosCuentas($tabla, $tabla2, $id){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as c INNER JOIN $tabla2 as p ON c.id=p.id_cuenta WHERE p.estado=1 AND c.id= :id LIMIT 1");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}




    /*=============================================
    Eliminar Cuenta cuenta bancaria
    =============================================*/

    public static function mdlEliminarCuenta($tabla, $id)
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




}