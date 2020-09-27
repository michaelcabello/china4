<?php

class Conexion{

	static public function conectar(){

		//$link = new PDO("mysql:host=localhost;dbname=portalmedico",
		//				"root",
		//				""
		//				);
		$link = new PDO("mysql:host=localhost;dbname=maxibigs_portalmedico",
						"maxibigs_karin",
						"xm9ikedlRT2020"
						);

		return $link;

	}


}
