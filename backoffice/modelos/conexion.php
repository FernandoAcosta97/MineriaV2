<?php

class Conexion{

	static public function conectar(){

		//$link = new PDO("mysql:host=localhost;dbname=trading",
						//"root",
						//"");
		$link = new PDO("mysql:host=localhost;dbname=cubelabc_pos",
					       "cubelabc_fernando",
				               "eJoe*O6uF~N5");
		$link->exec("set names utf8");

		return $link;

	}

}
