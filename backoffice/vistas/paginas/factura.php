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

$html.='
<div style="
        background-color:#0596f2;
        padding:5px 15px 5px 15px;
        border-radius:20px;
    "
>
    <table style="width: 100%;border: 0;">
        <tr>
            <td style="width: 10%;border: 0;">
                <img
                    style="
                        height: 60px;
                        width: auto;
                    "
                id="logo" src="../img/logocube.jpg" alt="Logo">
            </td>
            <td style="width: 60%;border: 0;">
                <h1 style="color: white;">Comprobante de Pago</h1>
            </td>
            <td style="width: 30%;border: 0;color: white;">
                <h2>MIN'.$respuesta[0]["id"].'</h2>
            </td>
        </tr>
    </table>
';

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$usuario=ControladorUsuarios::ctrMostrarUsuarios("doc_usuario",$respuesta[0]["doc_usuario"]);

$campana=ControladorCampanas::ctrMostrarCampanas("id", $respuesta[0]["campana"]);
// $total=ControllerSalidas::ctrSumarSalidasFiltro($item,$valor);

// $html.='<div style="text-align:lefth">';
// $html.='<strong>DESCRIPCI脫N: </strong><span>d</span></div>';
// $html.='<strong>FECHA IMPRESI脫N: </strong><span>'.$fecha.'</span><br><br>';

$html.='<section>
<div 
    style="
        background-color:white;
        padding:5px 15px 15px 15px;
        border-radius:20px;
    "
>
<h2>Detalles del Cliente</h2>
<p><strong>Nombre:</strong> '.$usuario["nombre"].'</p>
<p><strong>Documento:</strong> '.$usuario["doc_usuario"].'</p>
</div>
</section></div>';


$html.='<section>
<h2>Detalles de la Transacci贸n</h2>
<div style="
        background-color:#0596f2;
        padding:0 15px 15px 15px;
        border-radius:20px;
    "
>
    
    <div style="border-radius: 20px; overflow: hidden;">
        <table style="width: 100%;border: white;">
            <thead style="background-color:white;border: white;">
            <tr style="border: white;">
                <th style="background-color:white; color:#0596f2;border: white;">Descripci贸n</th>
                <th style="background-color:#003b95; color:white;border: white;">Valor</th>
                <th style="background-color:white; color:#0596f2;border: white;">Billetera</th>
                <th style="background-color:white; color:#0596f2;border: white;">fecha</th>
            </tr>
        </thead>
            <tbody style="color: white;border: white;">
                <tr>
                    <td style="color: white;border: white;">Plan de minado '.$campana["nombre"].'</td>';
    
    $html.='<td style="background-color:white;color: #003b95;border: white;">'.number_format($respuesta[0]["valor"],0).'</td>';
    
    if($respuesta[0]["billetera"]==1){
        $html.='<td style="color: white;border: white;">COP</td>';
    }else if($respuesta[0]["billetera"]==2){
        $html.='<td style="color: white;border: white;">CRYPTO</td>';
    }else{
        $html.='<td style="color: white;border: white;">TRANSFERENCIA</td>';
    }
    
    $html.='<td style="color: white;border: white;">'.$respuesta[0]["fecha"].'</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
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