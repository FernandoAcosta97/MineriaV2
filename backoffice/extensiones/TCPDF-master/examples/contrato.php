<?php

require_once "../../../controladores/general.controlador.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

class imprimirContrato{

public $usuario;

public function impresionContrato(){

$ruta = ControladorGeneral::ctrRuta();	

$item = "id_usuario";
$valor = $this->usuario;

$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

if($respuesta["fecha_contrato"] == null){

	echo '<script>
		window.location = "'.$ruta.'/backoffice/perfil";
	</script>';

	return;
}


require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->SetFont('helvetica', '', 10);

$pdf->AddPage();

$html = <<<EOD

<div style="text-align:justify">
<h3>CONTRATO DE DISTRIBUCIÓN DE SERVICIOS DE TRADING COLOMBIA</h3>
<p>
Los suscritos a saber: TRADING COLOMBIA, sociedad comercial debidamente constituida por documento privado de Julio 1 de 2018, registrado en Cámara de Comercio el 1 de Julio de 2018, en libro 9, bajo el número 18147, con domicilio principal en la ciudad de Medellín, país Colombia, identificada con número de NIT.900.661.621-4, representada legalmente por PEPITO PEREZ, mayor de edad, vecino de Medellín, identificado con cédula de ciudadanía número 8.161.865, quien adelante y para todos los efectos del presente contrato se denominará EL FABRICANTE, y $respuesta[nombre], persona que acepta estos términos y condiciones, mayor de edad, actuando en nombre propio, quien en adelante y para todos los efectos del presente contrato se denominará EL DISTRIBUIDOR O VENDEDOR, hemos acordado celebrar el presente contrato de DISTRIBUCIÓN AL DETAL DE PRODUCTOS Y SERVICIOS, que se regirá por las siguientes partes y cláusulas:
</p>
<h4>DEFINICIONES Y ALCANCE DEL CONTRATO</h4>
<p>
Para efectos de la interpretación del presente contrato de DISTRIBUCIÓN, los términos relevante usados en el mismo están definidos en el documento de Términos y Condiciones el cual usted aceptó y estuvo de acuerdo al registrarse en la página web <a href="$ruta">https://www.sportbit.com.co/backoffice/</a>; los términos y palabras no definidas en el documento de Términos y Condiciones serán interpretadas pos su significado legal y técnico conforme a lo preceptuado en las leyes de cada país.
</p>
<h4>ESTIPULACIONES Y ACUERDOS</h4>
<p>
El DISTRIBUIDOR O VENDEDOR se obliga con el FABRICANTE a comprarle directamente los productos y servicios que comercializa el FABRICANTE según su objeto social, tales como videos, capacitación virtual, elementos tecnológicos, entre otros; para una vez adquiridos proceder por su propia cuenta, riesgo y responsabilidad, a realizar de forma directa, independiente, profesional y eficiente, la venta y distribución de productos del FABRICANTE.
</p>
<h4>OBLIGACIONES DEL DISTRIBUIDOR</h4>
<p>
Para el cumplimiento y adecuado desarrollo del presente contrato, EL DISTRIBUIDOR tendrá a su cargo las siguientes obligaciones so pena de la terminación automática del presente contrato y el cobro de los prejuicios por parte del FABRICANTE:
<ol>						
	<li>
	Promover la compra automática de los productos del FABRICANTE que se realiza a través de la oficina virtual de la página web <a href="$ruta/backoffice">https://www.sportbit.com.co/backoffice</a>
	</li>
	<li>
	Llevar contabilidad de los negocios que celebre en nombre del FABRICANTE, para lo cual velará por el cumplimiento de todas las normas y deberes fiscales correspondiente a su país, siendo de su absoluta responsabilidad cualquier evasión, incumplimiento o actividad ilícita que se detectare.
	</li>
</ol>

<h4>OBLIGACIONES DEL FABRICANTE</h4>

Para el cumplimiento y adecuado desarrollo del presente contrato, EL FABRICANTE tendrá a su cargo las siguientes obligaciones so pena de la terminación automática del presente contrato y el cobro de los prejuicios por parte del DISTRIBUIDOR O VENDEDOR:
<ol>						
	<li>Activar al DISTRIBUIDOR O VENDEDOR al momento de firmar el contrato en la página web <a href="$ruta/backoffice">www.sportbit.com.co/backoffice</a></li>
	<li>Garantizar el uso de la oficina virtual BACKOFFICE en los términos y condiciones del presente contrato.</li>
	<li>Capacitar al DISTRIBUIDOR O VENDEDOR en las características y especificaciones técnicas de los productos objeto de distribución, así como del sistema de distribución, ya sea por medio físico, digital o virtual.</li>
	<li>Pagar oportunamente y en un término no superior a tres (3) días hábiles, al DISTRIBUIDOR O VENDEDOR su COMISIÓN el día que cumpla la fecha de las campañas finalizadas a través de su cuenta registrada.</li>
	<li>Permitir al VENDEDOR abonar con los ingresos de ventas el total de la compra desde el BACKOFFICE durante la validez y duración de este contrato.</li>
</ol>
</p>
<h4>VALOR Y FORMA DE PAGO</h4>
<p>
El valor del presente contrato dependerá de la cantidad de compensaciones que logre adquirir el DISTRIBUIDOR O VENDEDOR en las COMISIONES dentro de la oficina virtual BACKOFFICE. La forma de pago se realizará de acuerdo a las instrucciones dadas en la oficina virtual BACKOFFICE a través de la cuenta registrada del DISTRIBUIDOR O VENDEDOR.
</p>
<h4>VALIDEZ Y DURACIÓN DEL CONTRATO</h4>
<p>
El presente contrato tendrá validez durante el periodo que el DISTRIBUIDOR O VENDEDOR esté activo al sistema, una vez que el DISTRIBUIDOR O VENDEDOR cancele o incumpla el contrato, este se eliminará automáticamente con la red que haya generado en el programa multinivel hasta entonces.
</p>
<h4>PROPIEDAD INTELECTUAL</h4>
<p>
El DISTRIBUIDOR O VENDEDOR reconoce expresamente los derechos de autor y la propiedad intelectual del FABRICANTE sobre los productos y servicios ofrecidos en la página web <a href="$ruta">www.academyoflife.com</a> y <a href="$ruta/backoffice">https://www.sportbit.com.co/backoffice</a>, el sistema de distribución, los diseños virtuales, las marcas, nombres y enseñas comerciales, material publicitario, y cualquier otra clase de propiedad intelectual que pertenece al FABRICANTE.
</p>
<h4>LEY APLICABLE, JURISDICCIÓN</h4>
<p>
Este contrato será regido e interpretado de conformidad con la constitución y la ley de cada país al que pertenezca el DISTRIBUIDOR O VENDEDOR.
</p>
<h4>GLOSARIO</h4>
<p>
<ul>
	<li><b>NIVELES:</b> Es la posición en la que usted se encuentra de acuerdo al Plan de Compensación.</li>
	<li><b>LÍNEA DESCENDIENTE:</b> Es la ubicación que toman las personas que usted o su equipo de trabajo han ingresado al sistema de TRADING COLOMBIA. Estás líneas descendientes se organizan en un árbol binario</li>
	<li><b>BACKOFFICE:</b> Es la plataforma virtual que TRADING COLOMBIA le ofrece para poder visualizar, administrar y cobrar sus comisiones, resolver inquietudes e informarse acerca del crecimiento de su equipo de trabajo.</li>
	<li><b>EQUIPO DE TRABAJO:</b> Son las personas que ingresan a su línea descendiente de manera directa o indirecta.</li>
	<li><b>INGRESO DIRECTO:</b> Este sucede cuando las personas se registran mediante su enlace de afiliado en TRADING COLOMBIA</li>
	<li><b>INGRESO POR DERRAME:</b> Este sucede cuando las personas que están en su línea descendiente se registran en TRADING COLOMBIA</li>
	<li><b>PATROCINADOR:</b> Es cuando una persona lo ingresa al sistema directamente, y en caso tal que no suceda así la empresa pasa a ser el patrocinador.</li>
	<li><b>BALANCE GENERAL:</b> Es el total de ingresos económicos de las ventas que usted realiza como promotor de la empresa.</li> 
	<li><b>COMISIÓN:</b> Es el dinero que usted podrá cobrar por lo acordado en el plan de compensación.</li>						
</ul>

<h4>FIRMA Y FECHA DEL CONTRATO</h4>

Este contrato se firma el $respuesta[fecha_contrato]:
<br><br><br><br><br><br><br><br><br><br><br><br>$respuesta[nombre]</br>
</p>

</div>

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->ImageSVG('@'.$respuesta["doc_usuario"], $x=15, $y=240, $w=50, $h='', $link='', $align='', $palign='', $border=0, $fitonpage=false);

$pdf->Output('contrato.pdf', 'I');

}

}

if(isset($_GET["usuario"])){

$contrato = new imprimirContrato();
$contrato -> usuario = $_GET["usuario"];
$contrato -> impresionContrato();

}else{

	$ruta = ControladorGeneral::ctrRuta();

	echo '<script>
		window.location = "'.$ruta.'/backoffice/perfil";
	</script>';

	return;
}