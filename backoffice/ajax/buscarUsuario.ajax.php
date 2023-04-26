<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class BuscarUsuario
{

    public function buscarU()
    {

        $valor = $_POST["buscarUsuario"];

        $usuarios = ControladorUsuarios::ctrBuscarUsuarios($valor);
 
        if (count($usuarios) == 0) {

            echo '{"items":[]}';
    
            return;
    
        }

        $datosJson = '{"items":[';

        foreach ($usuarios as $key => $value) {

            $datosJson .='{
                "id":"' . $value["id_usuario"] . '",
                "text":"' . $value["nombre"] . ' - '. $value["doc_usuario"] .'"
            },';

        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']}';

        echo $datosJson;

    }
    // cierre metodo

}
// cierre clase

$buscar = new BuscarUsuario();
$buscar -> buscarU();
