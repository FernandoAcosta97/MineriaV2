<?php

require_once "conexion.php";

class ModeloMultinivel{

	/*=============================================
	REGISTRO UNINIVEL
	=============================================*/

	static public function mdlRegistroUninivel($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario_red, patrocinador_red) VALUES (:usuario_red, :patrocinador_red)");

		$stmt -> bindParam(":usuario_red", $datos["usuario_red"], PDO::PARAM_STR);
		$stmt -> bindParam(":patrocinador_red", $datos["patrocinador_red"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

    		return print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR RED INNER JOIN
	=============================================*/
	
	static public function mdlMostrarRed($tabla1, $tabla2, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.patrocinador = $tabla2.patrocinador_red WHERE $item = :$item AND $tabla1.eliminado=0");	

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.enlace_afiliado = $tabla2.patrocinador_red WHERE $tabla1.eliminado=0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR RED BINARIA
	=============================================*/

	static public function mdlMostrarBinaria($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");	

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}



		/*=============================================
	MOSTRAR RED BINARIA
	=============================================*/

	static public function mdlMostrarBinariaxDerrame($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");	

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	 /*=============================================
    Eliminar usuario red
    =============================================*/

    public static function mdlEliminarUsuarioRed($tabla, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE usuario_red = :usuario_red");

        $stmt->bindParam(":usuario_red", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();

        $stmt = null;
    }


	/*=============================================
	MOSTRAR RED SIN INNER JOIN
	=============================================*/

	static public function mdlMostrarRedUninivel($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");	

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR TORAL OPERANDO RED INNER JOIN
	=============================================*/

	static public function mdlMostrarRedOperandoTotal($tabla1, $tabla2, $item, $valor, $item2, $valor2){

		if($item != null && $valor != null){

			if($item2 != null && $valor2 != null){
 
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.patrocinador = $tabla2.patrocinador_red WHERE $item = :$item AND $item2 = :$item2");	

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.enlace_afiliado = $tabla2.patrocinador_red WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

		}



	}

	/*=============================================
	MOSTRAR USUARIO RED
	=============================================*/

	static public function mdlMostrarUsuarioRed($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO z
	=============================================*/

	static public function mdlRegistroBinaria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario_red, orden_binaria,  derrame_binaria,  patrocinador_red) VALUES (:usuario_red, :orden_binaria, :derrame_binaria, :patrocinador_red)");

		
		$stmt -> bindParam(":usuario_red", $datos["usuario_red"], PDO::PARAM_STR);
		$stmt -> bindParam(":orden_binaria", $datos["orden_binaria"], PDO::PARAM_STR);
		$stmt -> bindParam(":derrame_binaria", $datos["derrame_binaria"], PDO::PARAM_STR);	
		$stmt -> bindParam(":patrocinador_red", $datos["patrocinador_red"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";

		}else{

    		return print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR RED BINARIA
	=============================================*/

	static public function mdlMostrarRedBinaria($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR BINARIA
	=============================================*/

	static public function mdlActualizarBinaria($tabla, $item, $valor, $derrame, $patrocinador){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET derrame_binaria =:derrame_binaria, patrocinador_red = :patrocinador_red WHERE $item = :$item");

		$stmt -> bindParam(":derrame_binaria", $derrame, PDO::PARAM_STR);
		$stmt -> bindParam(":patrocinador_red", $patrocinador, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

    		return print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR UNINIVEL
	=============================================*/

	static public function mdlActualizarUninivel($tabla, $item, $valor, $patrocinador){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET patrocinador_red = :patrocinador_red WHERE $item = :$item");

		$stmt -> bindParam(":patrocinador_red", $patrocinador, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

    		return print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO MATRIZ
	=============================================*/

	static public function mdlRegistroMatriz($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario_red, orden_matriz,  derrame_matriz, posicion_matriz, patrocinador_red) VALUES (:usuario_red, :orden_matriz, :derrame_matriz, :posicion_matriz, :patrocinador_red)");

		
		$stmt -> bindParam(":usuario_red", $datos["usuario_red"], PDO::PARAM_STR);
		$stmt -> bindParam(":orden_matriz", $datos["orden_matriz"], PDO::PARAM_STR);
		$stmt -> bindParam(":derrame_matriz", $datos["derrame_matriz"], PDO::PARAM_STR);	
		$stmt -> bindParam(":posicion_matriz", $datos["posicion_matriz"], PDO::PARAM_STR);
		$stmt -> bindParam(":patrocinador_red", $datos["patrocinador_red"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";

		}else{

    		return print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PAGOS RED
	=============================================*/

	static public function mdlMostrarPagosRed($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt-> close();

		$stmt = null;

	}


	
}