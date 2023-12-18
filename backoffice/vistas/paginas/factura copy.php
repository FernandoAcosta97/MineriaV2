<?php

require_once '../../extensiones/vendor/autoload.php';
require_once '../../controladores/comprobantes.controlador.php';
require_once '../../modelos/comprobantes.modelo.php';

use \Mpdf\Mpdf;

$html="";

$html.='<h2 style="text-align:center">REPORTE</h2><br>';

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');

$item="id";
$valor=$_GET["id"];

$respuesta=ControladorComprobantes::ctrMostrarComprobantes("id",$valor);
// $total=ControllerSalidas::ctrSumarSalidasFiltro($item,$valor);

$html.='<div style="text-align:lefth">';
$html.='<strong>DESCRIPCIÓN: </strong><span>d</span></div>';
$html.='<strong>FECHA IMPRESIÓN: </strong><span>'.$fecha.'</span><br><br>';


$html.='<table class="table table-bordered">';

$html.='<thead>
         
         <tr>
           
           <th style="width:25px;text-align:center">#</th>
           <th style="text-align:center">CÓDIGO</th>
           <th style="text-align:center">VALOR</th>
           <th style="text-align:center">FECHA</th>

         </tr> 

        </thead>';

        $html.='<tbody>';


 foreach ($respuesta as $key => $value) {
 	$html.='<tr>
                 
                 <td style="text-align:center">'.($key+1).'</td>
                 <td style="text-align:center">'.$value["id"].'</td>
                 <td style="text-align:center">$ '.number_format($value["valor"]).'</td>
                 <td style="text-align:center">'.$value["fecha"].'</td>

            </tr>';
 }

 $html.='</tbody>';

 $html.='</table>';

 $html.='<div class="container">
  <h2>Información</h2>
  <div class="panel panel-default">
    <div class="panel-footer">TOTAL - $ 908</div>
  </div>
</div>';


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
$estilos=file_get_contents('../css/plugins/bootstrap/dist/css/bootstrap.min.css');
$mpdf->SetProtection(array('copy','print'));
$mpdf->setFooter('{PAGENO}');
$mpdf->SetTitle('Reporte');
$mpdf->WriteHTML($estilos,1);
$mpdf->WriteHTML($html);
$mpdf->Output('reporte'.$valor.'_'.$fecha.'.pdf','I');