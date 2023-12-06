<?php

if (isset($_GET["pagina"])) {
	if ($_GET["pagina"] == "reporte-campana"){
		include "paginas/" . $_GET["pagina"] . ".php";
	}
}

if (isset($_GET["pagina"])) {
	if ($_GET["pagina"] == "reporte-usuarios"){
		include "paginas/" . $_GET["pagina"] . ".php";
	}
}

session_start();

$ruta = ControladorGeneral::ctrRuta();
$patrocinador = ControladorGeneral::ctrPatrocinador();


if (!isset($_SESSION["validarSesion"])) {

    echo '<script>

		window.location = "'.$ruta.'ingreso";

	</script>';

    return;

}

$item = "id_usuario";
$valor = $_SESSION["id"];

$usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

?>

<!DOCTYPE html>

<html>

<head>

  	<meta charset="utf-8">

  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

  	<title>Backoffice | Inversiones</title>

  	<link rel="icon" href="vistas/img/plantilla/icono.png">

  	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--=====================================
	Vínculos CSS
	======================================-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

 	<!-- Google Font: Source Sans Pro -->
  	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  	<!-- Theme style -->
  	<link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">

  	<!-- overlayScrollbars -->
  	<link rel="stylesheet" href="vistas/css/plugins/OverlayScrollbars.min.css">

  	<!-- jdSlider -->
	<link rel="stylesheet" href="vistas/css/plugins/jdSlider.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="vistas/css/plugins/select2.min.css">

	<!-- DataTables -->
	<link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">

	<!-- JQVMap -->
	<link rel="stylesheet" href="vistas/css/plugins/jquery-jvectormap-1.2.2.css">

	<!-- jQuery jOrg Chart -->
  	<link rel="stylesheet" href="vistas/css/plugins/jquery.jOrgChart.css">

	<!-- Morris chart -->
	<link rel="stylesheet" href="vistas/css/plugins/morris.min.css">

	<!-- iCheck -->
	<link rel="stylesheet" href="vistas/css/plugins/iCheck-flat-blue.css">

     <!-- Daterange picker -->
	 <link rel="stylesheet" href="vistas/css/plugins/daterangepicker.css">

  	<!-- estilo personalizado -->
  	<link rel="stylesheet" href="vistas/css/style.css">

  	<!--=====================================
	Vínculos JS
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<!-- AdminLTE App -->
	<script src="vistas/js/plugins/adminlte.min.js"></script>

	<!-- overlayScrollbars -->
	<script src="vistas/js/plugins/jquery.overlayScrollbars.min.js"></script>

	<!-- jdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<script src="vistas/js/plugins/jdSlider.js"></script>

	<!-- Select2 -->
	<!-- https://github.com/select2/select2 -->
	<script src="vistas/js/plugins/select2.full.min.js"></script>

	<!-- InputMask -->
	<!-- https://github.com/RobinHerbots/Inputmask -->
	<script src="vistas/js/plugins/jquery.inputmask.js"></script>

	<!-- jSignature -->
	<!-- https://www.jqueryscript.net/other/Signature-Field-Plugin-jQuery-jSignature.html -->
	<script src="vistas/js/plugins/jSignature.js"></script>
	<script src="vistas/js/plugins/jSignature.CompressorSVG.js"></script>

	<!-- SWEET ALERT 2 -->
	<!-- https://sweetalert2.github.io/ -->
	<script src="vistas/js/plugins/sweetalert2.all.js"></script>

	<!-- DataTables
	https://datatables.net/-->
  	<script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
  	<script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script>
	<script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
  	<script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>

	<!-- HLS -->
	<!-- https://poanchen.github.io/blog/2016/11/17/how-to-play-mp4-video-using-hls -->
	<script src="vistas/js/plugins/hls.min.js"></script>

	<!-- Pinterest Grid -->
	<!-- https://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html -->
	<script src="vistas/js/plugins/pinterest_grid.js"></script>

	<!-- JQVMap -->
	<!-- https://www.10bestdesign.com/jqvmap/ -->
	<script src="vistas/js/plugins/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="vistas/js/plugins/jquery-jvectormap-world-mill-en.js"></script>

	<!-- jQuery Knob Chart -->
	<!-- http://anthonyterrien.com/demo/knob/ -->
	<script src="vistas/js/plugins/jquery.knob.js"></script>

	<!-- jQuery jOrg Chart -->
	<!-- https://github.com/wesnolte/jOrgChart-->
    <script src="vistas/js/plugins/jquery.jOrgChart.js"></script>

	<!-- Org Chart Js-->
	<!-- https://balkan.app/OrgChartJS/-->
    <!-- <script src="vistas/js/plugins/orgchart.js"></script> -->

    <!-- jQuery Number-->
    <!-- https://plugins.jquery.com/df-number-format/ -->
	<script src="vistas/js/plugins/jquerynumber.min.js"></script>

	<!-- Preload-->
	<!-- https://www.jqueryscript.net/loading/Handle-Loading-Progress-jQuery-Nite-Preloader.html -->
	<script src="vistas/js/plugins/jquery.nite.preloader.js"></script>

	<!-- Morris.js charts -->
	<!-- https://morrisjs.github.io/morris.js/ -->
	<script src="vistas/js/plugins/raphael-min.js"></script>
	<script src="vistas/js/plugins/morris.min.js"></script>

		<!-- Chart.js charts -->
	<!-- https://www.chartjs.org/ -->
	<script src="vistas/js/plugins/chart.min.js"></script>

	<!-- https://ckeditor.com/ckeditor-5/#classic -->
	<script src="vistas/js/plugins/ckeditor.js"></script>

	<!-- iCheck -->
	<!-- https://github.com/fronteed/iCheck/ -->
	<script src="vistas/js/plugins/icheck.min.js"></script>

	<!-- daterangepicker http://www.daterangepicker.com/-->
    <script src="vistas/js/plugins/moment.min.js"></script>
    <script src="vistas/js/plugins/daterangepicker.js"></script>


</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

<div class="wrapper">

<?php

include "paginas/modulos/header.php";

include "paginas/modulos/menu.php";

/*=============================================
Páginas del sitio
=============================================*/

if($usuario["fecha_contrato"]!=null){
	
	$cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario", $usuario["id_usuario"]);

	if(count($cuentas)==0){
		$comprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantes("doc_usuario", $usuario["doc_usuario"]);
		if(count($comprobantesUsuario)>0){

			if (isset($_GET["pagina"])) {

				if ($_GET["pagina"] == "cuentas-bancarias" ||
					$_GET["pagina"] == "salir") {
			
					include "paginas/" . $_GET["pagina"] . ".php";
			
				}  else {

					if($_GET["pagina"] == "perfil"){
						include "paginas/cuentas-bancarias.php";
					}else{
						include "paginas/error404.php";
					}
			
				}
			
			
			
			} else {
			
					include "paginas/inicio.php";
				
			}

		}else{
			if (isset($_GET["pagina"])) {

				if ($_GET["pagina"] == "inicio" ||
					$_GET["pagina"] == "perfil" ||
					$_GET["pagina"] == "usuarios" ||
					$_GET["pagina"] == "usuario" ||
					$_GET["pagina"] == "campanas" ||
					$_GET["pagina"] == "bonos-extras" ||
					$_GET["pagina"] == "campanas-publicidad" ||
					$_GET["pagina"] == "bonos-apalancamiento" ||
					$_GET["pagina"] == "bonos-recurrencia" ||
					$_GET["pagina"] == "bonos-afiliados" ||
					$_GET["pagina"] == "bonos-bienvenida" ||
					$_GET["pagina"] == "cuentas-bancarias" ||
					$_GET["pagina"] == "comprobantes" ||
					$_GET["pagina"] == "comprobantes-publicidad" ||
					$_GET["pagina"] == "comprobantes-campana" ||
					$_GET["pagina"] == "inversiones" ||
					$_GET["pagina"] == "uninivel" ||
					$_GET["pagina"] == "binaria" ||
					$_GET["pagina"] == "matriz" ||
					$_GET["pagina"] == "pagos-comisiones" ||
					$_GET["pagina"] == "comisiones-pagadas" ||
					$_GET["pagina"] == "pagos-inversiones" ||
					$_GET["pagina"] == "pagos-recurrencia" ||
					$_GET["pagina"] == "recurrencia-pagada" ||
					$_GET["pagina"] == "afiliados-pagado" ||
					$_GET["pagina"] == "bienvenida-pagados" ||
					$_GET["pagina"] == "pagos-publicidad" ||
					$_GET["pagina"] == "pagos-afiliados" ||
					$_GET["pagina"] == "pagos-bienvenida" ||
					$_GET["pagina"] == "pagos-retiros" ||
					$_GET["pagina"] == "inversiones-pagadas" ||
					$_GET["pagina"] == "publicidad-pagada" ||
					$_GET["pagina"] == "pagos-extras" ||
					$_GET["pagina"] == "extras-pagados" ||
					$_GET["pagina"] == "ingresos-uninivel" ||
					$_GET["pagina"] == "inversiones-sin-liquidar" ||
					$_GET["pagina"] == "ingresos-binaria" ||
					$_GET["pagina"] == "ingresos-extras" ||
					$_GET["pagina"] == "extras-sin-liquidar" ||
					$_GET["pagina"] == "comisiones-sin-liquidar" ||
					$_GET["pagina"] == "ingresos-matriz" ||
					$_GET["pagina"] == "cambiar-patrocinador" ||
					$_GET["pagina"] == "plan-compensacion" ||
					$_GET["pagina"] == "soporte" ||
					$_GET["pagina"] == "billeteras" ||
					$_GET["pagina"] == "billeteras-crypto" ||
					$_GET["pagina"] == "salir") {
			
					include "paginas/" . $_GET["pagina"] . ".php";
			
				}  else {
			
					include "paginas/error404.php";
				}
			
			
			
			} else {
			
					include "paginas/inicio.php";
				
			}
		}
	}else{

		if (isset($_GET["pagina"])) {

			if ($_GET["pagina"] == "inicio" ||
				$_GET["pagina"] == "perfil" ||
				$_GET["pagina"] == "usuarios" ||
				$_GET["pagina"] == "usuario" ||
				$_GET["pagina"] == "campanas" ||
				$_GET["pagina"] == "bonos-extras" ||
				$_GET["pagina"] == "campanas-publicidad" ||
				$_GET["pagina"] == "bonos-apalancamiento" ||
				$_GET["pagina"] == "bonos-recurrencia" ||
				$_GET["pagina"] == "bonos-afiliados" ||
				$_GET["pagina"] == "bonos-bienvenida" ||
				$_GET["pagina"] == "cuentas-bancarias" ||
				$_GET["pagina"] == "comprobantes" ||
				$_GET["pagina"] == "comprobantes-publicidad" ||
				$_GET["pagina"] == "comprobantes-campana" ||
				$_GET["pagina"] == "inversiones" ||
				$_GET["pagina"] == "uninivel" ||
				$_GET["pagina"] == "binaria" ||
				$_GET["pagina"] == "matriz" ||
				$_GET["pagina"] == "pagos-comisiones" ||
				$_GET["pagina"] == "comisiones-pagadas" ||
				$_GET["pagina"] == "pagos-inversiones" ||
				$_GET["pagina"] == "pagos-recurrencia" ||
				$_GET["pagina"] == "pagos-afiliados" ||
				$_GET["pagina"] == "pagos-bienvenida" ||
				$_GET["pagina"] == "pagos-retiros" ||
				$_GET["pagina"] == "inversiones-pagadas" ||
				$_GET["pagina"] == "recurrencia-pagada" ||
				$_GET["pagina"] == "afiliados-pagado" ||
				$_GET["pagina"] == "bienvenida-pagados" ||
				$_GET["pagina"] == "pagos-extras" ||
				$_GET["pagina"] == "extras-pagados" ||
				$_GET["pagina"] == "ingresos-uninivel" ||
				$_GET["pagina"] == "inversiones-sin-liquidar" ||
				$_GET["pagina"] == "publicidad-sin-liquidar" ||
				$_GET["pagina"] == "ingresos-publicidad" ||
				$_GET["pagina"] == "ingresos-binaria" ||
				$_GET["pagina"] == "ingresos-extras" ||
				$_GET["pagina"] == "extras-sin-liquidar" ||
				$_GET["pagina"] == "comisiones-sin-liquidar" ||
				$_GET["pagina"] == "ingresos-matriz" ||
				$_GET["pagina"] == "cambiar-patrocinador" ||
				$_GET["pagina"] == "plan-compensacion" ||
				$_GET["pagina"] == "soporte" ||
				$_GET["pagina"] == "billeteras" ||
				$_GET["pagina"] == "billeteras-crypto" ||
				$_GET["pagina"] == "salir") {
		
				include "paginas/" . $_GET["pagina"] . ".php";
		
			}  else {
		
				include "paginas/error404.php";
			}
		
		
		
		} else {
		
				include "paginas/inicio.php";
			
		}

	}


}else{
	if (isset($_GET["pagina"])){
	if ($_GET["pagina"] == "perfil" || $_GET["pagina"] == "plan-compensacion" || $_GET["pagina"] == "salir"){
		include "paginas/" . $_GET["pagina"] . ".php";
	}else {

        include "paginas/perfil.php";
    }
}else{
	include "paginas/perfil.php";
}
}


include "paginas/modulos/footer.php";

?>

</div>

<script src="vistas/js/inicio.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/comprobantes.js"></script>
<script src="vistas/js/campanas.js"></script>
<script src="vistas/js/cuentas.js"></script>
<script src="vistas/js/multinivel.js"></script>
<script src="vistas/js/pagos.js"></script>
<script src="vistas/js/ingresos.js"></script>
<script src="vistas/js/soporte.js"></script>
<script src="vistas/js/notificaciones.js"></script>

</body>

</html>