<?php

require_once '../../extensiones/vendor/autoload.php';
require_once '../../controladores/comprobantes.controlador.php';
require_once '../../modelos/comprobantes.modelo.php';
require_once '../../controladores/usuarios.controlador.php';
require_once '../../modelos/usuarios.modelo.php';
require_once '../../controladores/campanas.controlador.php';
require_once '../../modelos/campanas.modelo.php';

use \Mpdf\Mpdf;

$item="id";
$valor=$_GET["id"];
$total=0;

$respuesta=ControladorComprobantes::ctrMostrarComprobantes("id",$valor);


$html="";

$html.='<header>
<img id="logo" src="../img/logocube.jpg" alt="Logo">
<h1>Comprobante de Pago</h1>
<h2>MIN'.$respuesta[0]["id"].'</h2>
</header>';

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$usuario=ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$respuesta[0]["doc_usuario"]);

$campana=ControladorCampanas::ctrMostrarCampanas("id", $respuesta[0]["campana"]);
// $total=ControllerSalidas::ctrSumarSalidasFiltro($item,$valor);

// $html.='<div style="text-align:lefth">';
// $html.='<strong>DESCRIPCIÓN: </strong><span>d</span></div>';
// $html.='<strong>FECHA IMPRESIÓN: </strong><span>'.$fecha.'</span><br><br>';

$html.='<section>
<h2>Detalles del Cliente</h2>
<p><strong>Nombre:</strong> '.$usuario["nombre"].'</p>
<p><strong>Documento:</strong> '.$usuario["doc_usuario"].'</p>
</section>';


$html.='<section>
<h2>Detalles de la Transacción</h2>
<table>
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Billetera</th>
            <th>fecha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Plan de minado '.$campana["nombre"].'</td>';

            $html.='<td>'.number_format($respuesta[0]["valor"],0).'</td>';

            if($respuesta[0]["billetera"]==1){
                $html.='<td>COP</td>';
            }else if($respuesta[0]["billetera"]==2){
                $html.='<td>CRYPTO</td>';
            }else{
                $html.='<td>TRANSFERENCIA</td>';
            }

            $html.='<td>'.$respuesta[0]["fecha"].'</td>
        </tr>
        
    </tbody>
</table>
</section>';

// <section>
// <h2>Total</h2>
// <p><strong></strong></p>
// </section>';

// '<footer>
// <p>Gracias</p>
// </footer>';

$mpdf=new Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 25,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10,
	'showBarcodeNumbers' => FALSE
]);
$mpdf->SetDisplayMode('fullpage');
// $estilos=file_get_contents('../css/plugins/bootstrap/dist/css/bootstrap.min.css');
$estilos=file_get_contents('../css/factura.css');
$mpdf->SetProtection(array('copy','print'));
$mpdf->setFooter('{PAGENO}');
$mpdf->SetTitle('Reporte');
$mpdf->WriteHTML($estilos,1);
$mpdf->WriteHTML($html);
$mpdf->Output('reporte'.$valor.'_'.$fecha.'.pdf','I');