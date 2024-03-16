<?php

require dirname(__DIR__).'\extensiones\vendor\autoload.php';

use Google\Cloud\Vision\VisionClient;

class ModeloIa{

	static public function mdlExtraer($img){

		$extraccion="";

		$vision = new VisionClient([
			'keyFile' => json_decode(file_get_contents(__DIR__.'/comprobantes-388617-72205c17e9ba.json'), true)
		]);
		
		$image = $vision->image(file_get_contents($img), ['TEXT_DETECTION']);
		
		$result = $vision->annotate($image);

		if ($result->text()) {

			foreach ($result->text() as $text) {
				$extraccion .= $text->description();
			}
		} else {
			return $extraccion;
		}

		return $extraccion;

	}

}