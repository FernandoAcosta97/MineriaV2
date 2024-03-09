<?php if ($usuario["fecha_contrato"] == null): ?>

	<?php  $ruta = ControladorGeneral::ctrRuta();  ?>

<div class="col-12 col-md-8">

	<div class="card card-primary card-outline">

		<div class="card-header">

			<h5 class="m-0 text-uppercase text-secondary">

				<strong>Comience a operar $</strong>

			</h5>

		</div>

		<div class="card-body">

			<h6 class="card-title">¡Obtenga acceso a todos los beneficios de nuestra red multinivel!</h6>

			<br>

			<p class="card-text">Al activar su cuenta ingresa en nuestro programa de afiliados, el cual podrá generar ingresos extras de forma consecutiva gracias a la red multinivel que puede hacer con nosotros, más información ingrese a la página <a href="plan-compensacion">Plan de compensanción.</a></p>

			<input type="hidden" class="form-control" id="inputRuta" value="<?php echo $ruta ?>">

			<div class="form-group">

             <label for="inputDoc" class="control-label">Numero documento</label>

              <div>

	               <input type="number" class="form-control" id="inputDoc" required>

				   <input type="hidden" class="form-control" id="inputId" name="id_usuario" value="<?php echo $usuario["id_usuario"] ?>">

              </div>

            </div>

			<div class="form-group">

			<label for="inputUsuario" class="control-label">Usuario</label>

			<div>

				<input type="text" class="form-control" id="inputUsuario" value="<?php echo $usuario["usuario"] ?>" readonly>

			</div>

			</div>

			<div class="form-group">

				<label for="inputName" class="control-label">Nombre completo</label>

				<div>

					<input type="text" class="form-control" id="inputName" value="<?php echo $usuario["nombre"] ?>" readonly>

				</div>

			</div>

			<div class="form-group">

				<label for="inputEmail" class="control-label">Correo electrónico</label>

				<div>

					<input type="text" class="form-control" id="inputEmail" value="<?php echo $usuario["email"] ?>" readonly>

				</div>

			</div>

			<div class="form-group">

				<label for="inputPatrocinador" class="control-label">Código Patrocinador</label>

				<?php 
				$p="";
				if(isset($_COOKIE["patrocinador"]))
					{
						$p = $_COOKIE["patrocinador"];
						echo '				<div>

						<input type="text" class="form-control" id="inputPatrocinador" value="'.$p.'" readonly required>
	
					</div>';
					}else{
						echo '				<div>

						<input type="text" class="form-control" id="inputPatrocinador" value="" required>
	
					</div>';
					} 
				?>


			</div>

			<div class="form-group">

				<label for="inputAfiliado" class="control-label">Enlace de afiliado</label>
				<span>(Compartiendo este enlace podrá ganar comisiones, más información: <a href="plan-compensacion">Plan de compensanción</a>)</span>

				<div class="input-group">
					<div class="input-group-prepend">
						<span class="p-2 bg-info rounded-left"><?php echo $ruta; ?></span>
					</div>
					<input type="text" class="form-control" id="inputAfiliado" value="<?php echo strtolower($usuario["usuario"])?>" readonly>
				</div>

			</div>

			<div class="form-group">

				<label for="inputPais" class="control-label">País</label>

				<div>
					<select class="form-control select2 py-4" id="inputPais">

						<option value="">Seleccione su país</option>

					</select>

				</div>

			</div> 



			<div class="form-group">

				<label for="inputMovil" class="control-label">Teléfono Móvil</label>

				<div class="input-group">

					<div class="input-group-prepend">
						<span class="p-2 bg-info rounded-left dialCode"></span>
					</div>

					<input type="text" class="form-control" id="inputMovil" data-inputmask="'mask':'(999) 999-9999'" data-mask>

				</div>

			</div>

			<div class="form-group pb-4">

				<div class="col-sm-offset-2">

					<div class="checkbox">

						<input type="checkbox" id="aceptarTerminos">

						<label for="aceptarTerminos">
							<span></span> Yo acepto los <a href="#terminos" data-toggle="collapse">términos y condiciones</a>
						</label>

						<a href="#terminos" data-toggle="collapse"><span class="float-left float-xl-right text-info"><b>Ver términos y condiciones</b></span>
						</a>

					</div>

				</div>

			</div>

			<!--=====================================
			CONTRATO
			======================================-->

			<div class="clearfix"></div>

			<div id="terminos" class="collapse pb-4">

				<div class="card">

					<div class="card-body">

						Los suscritos a saber: ACADEMY OF LIFE, sociedad comercial debidamente constituida por documento privado de Julio 1 de 2018, registrado en Cámara de Comercio el 1 de Julio de 2018, en libro 9, bajo el número 18147, con domicilio principal en la ciudad de Medellín, país Colombia, identificada con número de NIT.900.661.621-4, representada legalmente por PEPITO PEREZ, mayor de edad, vecino de Medellín, identificado con cédula de ciudadanía número 8.161.865, quien adelante y para todos los efectos del presente contrato se denominará EL FABRICANTE, y Alexander Pierce, persona que acepta estos términos y condiciones, mayor de edad, actuando en nombre propio, quien en adelante y para todos los efectos del presente contrato se denominará EL DISTRIBUIDOR O VENDEDOR, hemos acordado celebrar el presente contrato de DISTRIBUCIÓN AL DETAL DE PRODUCTOS Y SERVICIOS, que se regirá por las siguientes partes y cláusulas:

					</div>

					<div class="card-header">

						<a class="card-link" data-toggle="collapse" href="#collapse1">
					 		DEFINICIONES Y ALCANCE DEL CONTRATO
					 	</a>

					</div>

					<div id="collapse1" class="collapse show" data-parent="#accordion">

						<div class="card-body">

							Para efectos de la interpretación del presente contrato de DISTRIBUCIÓN, los términos relevante usados en el mismo
							están definidos en el documento de Términos y Condiciones el cual usted aceptó y estuvo de acuerdo al registrarse en
							la página web www.academyoflife.com; los términos y palabras no definidas en el documento de Términos y
							Condiciones serán interpretadas pos su significado legal y técnico conforme a lo preceptuado en las leyes de cada
							país.

						</div>

					</div>

					<div class="card-header">

				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse2">
				 			ESTIPULACIONES Y ACUERDOS
				 		</a>

				 	</div>

				 	<div id="collapse2" class="collapse" data-parent="#accordion">

				 		<div class="card-body">
				 			El DISTRIBUIDOR O VENDEDOR se obliga con el FABRICANTE a comprarle directamente los productos y servicios que comercializa el FABRICANTE según su objeto social, tales como videos, capacitación virtual, elementos tecnológicos, entre otros; para una vez adquiridos proceder por su propia cuenta, riesgo y responsabilidad, a realizar de forma directa, independiente, profesional y eficiente, la venta y distribución de productos del FABRICANTE.
				 		</div>

				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
					 		OBLIGACIONES DEL DISTRIBUIDOR
				 		</a>
				 	</div>

				 	<div id="collapse3" class="collapse" data-parent="#accordion">
				 		<div class="card-body">
				 			Para el cumplimiento y adecuado desarrollo del presente contrato, EL DISTRIBUIDOR tendrá a su cargo las siguientes obligaciones so pena de la terminación automática del presente contrato y el cobro de los prejuicios por parte del FABRICANTE:
				 			<ol>
								<li>Promover la compra automática de los productos del FABRICANTE que se realiza a través de la oficina virtual de la página web www.academyoflife.com/backoffice</li>
								<li>Llevar contabilidad de los negocios que celebre en nombre del FABRICANTE, para lo cual velará por el cumplimiento de todas las normas y deberes fiscales correspondiente a su país, siendo de su absoluta responsabilidad cualquier evasión, incumplimiento o actividad ilícita que se detectare.</li>
							</ol>
				 		</div>
				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse4">
				 			OBLIGACIONES DEL FABRICANTE
				 		</a>
				 	</div>
				 	<div id="collapse4" class="collapse" data-parent="#accordion">
				 		<div class="card-body">
				 			Para el cumplimiento y adecuado desarrollo del presente contrato, EL FABRICANTE tendrá a su cargo las siguientes obligaciones so pena de la terminación automática del presente contrato y el cobro de los prejuicios por parte del DISTRIBUIDOR O VENDEDOR:
				 			<ol>
								<li>Activar al DISTRIBUIDOR O VENDEDOR todos los productos al momento de su primer abono de compra y suscripción en la página web www.academyoflife.com/backoffice</li>
								<li>Garantizar el uso de la oficina virtual BACKOFFICE en los términos y condiciones del presente contrato.</li>
								<li>Capacitar al DISTRIBUIDOR O VENDEDOR en las características y especificaciones técnicas de los productos objeto de distribución, así como del sistema de distribución, ya sea por medio físico, digital o virtual.</li>
								<li>Pagar oportunamente y en un término no superior a tres (3) días hábiles, al DISTRIBUIDOR O VENDEDOR su COMISIÓN el día que cumpla el mes vencido a su anterior suscripción a través de su cuenta de PayPal.</li>
								<li>Permitir al VENDEDOR abonar con los ingresos de ventas el total de la compra desde el BACKOFFICE durante la validez y duración de este contrato.</li>

							</ol>
				 		</div>
				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse5">
				 			VALOR Y FORMA DE PAGO
				 		</a>
				 	</div>
				 	<div id="collapse5" class="collapse" data-parent="#accordion">
				 		<div class="card-body">
				 			El valor del presente contrato dependerá de la cantidad de compensaciones que logre adquirir el DISTRIBUIDOR O VENDEDOR en las COMISIONES dentro de la oficina virtual BACKOFFICE. La forma de pago se realizará de acuerdo a las instrucciones dadas en la oficina virtual BACKOFFICE a través de la cuenta de PayPal con la que realiza el primer pago de la suscripción el DISTRIBUIDOR O VENDEDOR.
				 		</div>
				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse6">
				 			VALIDEZ Y DURACIÓN DEL CONTRATO
				 		</a>
				 	</div>
				 	<div id="collapse6" class="collapse" data-parent="#accordion">
				 		<div class="card-body">
				 			El presente contrato tendrá validez durante el periodo que el DISTRIBUIDOR O VENDEDOR esté suscrito al sistema, una vez que el DISTRIBUIDOR O VENDEDOR cancele o no pague la suscripción mensual este contrato se eliminará automáticamente con la red que haya generado en el programa multinivel hasta entonces.
				 		</div>
				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse7">
				 			PROPIEDAD INTELECTUAL
				 		</a>
				 	</div>
				 	<div id="collapse7" class="collapse" data-parent="#accordion">
				 		<div class="card-body">
				 			El DISTRIBUIDOR O VENDEDOR reconoce expresamente los derechos de autor y la propiedad intelectual del FABRICANTE sobre los productos y servicios ofrecidos en la página web www.academyoflife.com y www.academyoflife.com/backoffice, el sistema de distribución, los diseños virtuales, las marcas, nombres y enseñas comerciales, material publicitario, y cualquier otra clase de propiedad intelectual que pertenece al FABRICANTE.
				 		</div>
				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse8">
				 			LEY APLICABLE, JURISDICCIÓN
				 		</a>
				 	</div>
				 	<div id="collapse8" class="collapse" data-parent="#accordion">
				 		<div class="card-body">
				 			Este contrato será regido e interpretado de conformidad con la constitución y la ley de cada país al que pertenezca el DISTRIBUIDOR O VENDEDOR.
				 		</div>
				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse9">
				 			GLOSARIO
				 		</a>
				 	</div>
				 	<div id="collapse9" class="collapse" data-parent="#accordion">
				 		<div class="card-body">

				 		<ul>
							<li><b>NIVELES:</b> Es la posición en la que usted se encuentra de acuerdo al Plan de Compensación.</li>
							<li><b>LÍNEA DESCENDIENTE:</b> Es la ubicación que toman las personas que usted o su equipo de trabajo han ingresado al sistema de Academy of Life. Estás líneas descendientes se organizan en una matriz de múltiplos de 4, es decir, la primera línea descendiente tiene 4 personas, la segunda línea descendiente tiene 16 personas, la tercera línea descendiente tiene 64 personas y la última línea tiene 256 personas.</li>
							<li><b>BACKOFFICE:</b> Es la plataforma virtual que Academy of Life le ofrece para poder visualizar los productos que usted adquiere, administrar y cobrar sus comisiones, resolver inquietudes e informarse acerca del crecimiento de su equipo de trabajo.</li>
							<li><b>EQUIPO DE TRABAJO:</b> Son las personas que ingresan a su línea descendiente de manera directa o indirecta.</li>
							<li><b>INGRESO DIRECTO:</b> Es la venta que usted realiza a las personas para que se suscriban a Academy of Life</li>
							<li><b>INGRESO POR DERRAME:</b> Este sucede cuando las personas que están en su línea descendiente venden la suscripción a Academy of Life</li>
							<li><b>PATROCINADOR:</b> Es cuando una persona lo ingresa al sistema directamente, y en caso tal que no suceda así la empresa pasa a ser el patrocinador.</li>
							<li><b>BALANCE GENERAL:</b> Es el total de ingresos económicos de las ventas que usted realiza como promotor de la empresa.</li>
							<li><b>COMISIÓN:</b> Es el dinero que usted podrá cobrar por lo acordado en el plan de compensación mensualmente.</li>
							<li><b>DÉBITO AUTOMÁTICO:</b> Es el dinero que será debitado automáticamente de su cuenta de PayPal para continuar con la suscripción mensual.</li>
				 		</ul>

				 		</div>
				 	</div>

				 	<div class="card-header">
				 		<a class="collapsed card-link" data-toggle="collapse" href="#collapse10">
				 			FECHA DEL CONTRATO
				 		</a>
				 	</div>

				 	<div id="collapse10" class="collapse" data-parent="#accordion">

				 		<div class="card-body">

				 			Si el DISTRIBUIDOR O VENDEDOR está de acuerdo con todas las partes este contrato se acepta el <?php echo date('d/m/Y'); ?>

				 		</div>

				 	</div>

				</div>

			</div>


			<div class="form-group">
				<div class="col-sm-offset-2">
					<button type="submit" class="btn btn-dark suscribirse">Activar</button>
				</div>
			</div>


		</div>

	</div>

</div>

<?php else:

    if ($usuario) {
		if($usuario["perfil"]!="admin"){

        $cuenta = ControladorCuentas::ctrMostrarCuentasAll("usuario", $usuario["id_usuario"]);

        // $total_cuentas = count($cuentas_bancarias);
        // $cuenta_bancaria = "";
		// 	if($cuenta!=""){
        //             $cuenta_bancaria = $cuenta["numero"];   
		// 	}
		$cuenta_bancaria = "Cuenta no registrada";

		if(count($cuenta)>0){

        foreach ($cuenta as $key => $value) {
                if ($value["estado"] == 1) {
                    $cuenta_bancaria = $value["numero"];
                    break;
                }
            }
		}
        } 
    }

    // if (count($cuenta) == 0) {
    //     $cuenta_bancaria = "Cuenta no registrada";
    // }
// }
// }
?>

<div class="col-12 col-md-8">

	<div class="card card-primary card-outline">

		<div class="card-header">

			<h5 class="m-0 text-uppercase text-secondary float-left"><b>Estado: Activo</b></h5>

			<!--<span class="m-0 text-secondary float-right">Renovación automática el <?php echo $usuario["vencimiento"]; ?></span>-->

		</div>

		<div class="card-body">

			<h6 class="pb-2">Comparte tu enlace de afiliado:</h6>
			
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="p-2 bg-info rounded-left copiarLink" style="cursor:pointer">Copiar</span>
				</div>
				<input type="text" class="form-control" id="linkAfiliado" value="<?php echo $ruta . $usuario["enlace_afiliado"]; ?>" readonly>
			</div>

			<?php

if ($usuario["perfil"] != "admin") {

    ?>

			<h6 class="pt-3 pb-2">Cuenta bancaria donde recibirá los pagos de comisiones:</h6>

			<div class="input-group">

				<div class="input-group-prepend">
					<span class="p-2 bg-primary rounded-left"><i class="fa fa-university"></i></span>
				</div>

				<input type="text" class="form-control" id="correoPaypal" value="<?php echo $cuenta_bancaria; ?>" readonly>


				<?php if ($cuenta_bancaria == "Cuenta no registrada") {?>

				<div class="input-group-prepend">
					<button class="btn btn-primary rounded-left" data-toggle="modal" data-target="#registrarCuenta"><i class="fa fa-plus"></i></button>
				</div>

				<?php } else {?>

				<div class="input-group-prepend">
					<button class="btn btn-primary rounded-left btnCuentas"><i class="fa fa-plus"></i></button>
				</div>

				<?php }?>

			</div>

			<?php }?>


		</div>
		<?php if($usuario["perfil"] != "admin"): ?>

		<div class="card-footer">

			<a href="<?php echo $ruta ?>backoffice/extensiones/TCPDF-master/examples/contrato.php?usuario=<?php echo $usuario["id_usuario"] ?>" class="btn btn-dark float-left" target="_blank">Descargar Contrato</a>

			<!--<button class="btn btn-danger float-right cancelarSuscripcion" idUsuario="<?php echo $usuario["id_usuario"] ?>" idSuscripcion="<?php echo $usuario["id_suscripcion"] ?>">Cancelar suscripción</button>-->

		</div>

		<?php endif ?>

	</div>

</div>

<?php endif?>



<!--=====================================
Registar Cuenta
======================================-->

<!-- The Modal -->
<div class="modal" id="registrarCuenta">
  <div class="modal-dialog">
    <div class="modal-content">
      
    	<form method="post">

	      <!-- Modal Header -->
<div class="modal-header bg-primario text-white">	        <h4 class="modal-title">Registrar cuenta</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

	      	<input type="hidden" name="idUsuarioCuentaRegistrar" value="<?php echo $usuario["id_usuario"] ?>">


          <div class="form-group">

            <label for="entidad">Entidad:</label>

            <div>

            <select id="entidad" name="registrarEntidadCuenta" class="form-control py4 select2" style="width:100%" required>
              <option value="">Seleccione una entidad bancaria</option>
              <option value="davivienda">Davivienda</option>
              <option value="bancolombia">Bancolombia</option>
              <option value="bbva">BBVA</option>
              <option value="banco de bogota">Banco de Bogotá</option>
              <option value="Banco agrario">Banco agrario</option>
              <option value="Banco popular">Banco popular</option>
              <option value="efecty">Efecty</option>
              <option value="0">Otra entidad</option>
            </select>

            <div class="divCuentaCampo"></div>
              </div>

          </div>


			<div class="form-group">

      <label class="labelNumero" for="numero">Número cuenta bancaria:</label>

				<input type="number" id="numero" class="form-control" placeholder="Número cuenta" name="registrarNumeroCuenta" required>

			</div>

      <div class="form-group">

        <label for="nombreTitular">Nombre Titular:</label>

          <input type="text" class="form-control" id="nombreTitular" placeholder="Nombre titular" name="registrarNombreTitular" required>

        </div>

        <div class="form-group">

        <label for="tipoDocumento">Tipo de Documento Titular:</label>

        <select class="form-control" id="tipoDocumento" name="registrarTipoDocumento" required>

          <option value="">Seleccione tipo de documento</option>
          <option value="cedula de ciudadania">Cédula de ciudadanía</option>
          <option value="cedula de extranjeria">Cédula de extranjería</option>
          <option value="pasaporte">Pasaporte</option>

        </select>

        </div>

				<div class="form-group">

				<label for="titular">Documento Titular:</label>

				<input type="number" class="form-control" id="titular" placeholder="Número documento titular" name="registrarNumeroTitular" required>

			</div>

			<div class="form-group">

				<label for="tipoCuenta">Tipo de Cuenta:</label>

				<select class="form-control" id="tipoCuenta" name="registrarTipoCuenta" required>

					<option value="">Seleccione tipo de cuenta</option>
					<option value="ahorros">Ahorros</option>
					<option value="corriente">Corriente</option>
					<option value="otro">Otro</option>

				</select>

			</div>

	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>

	        	<button type="submit" class="btn bg-primario text-white">Enviar</button>
	        </div>

	      </div>

		<?php

            $ruta_pagina = "cuentas-bancarias";
			$registrarCuenta = new ControladorCuentas();
			$registrarCuenta->ctrRegistrarCuentaBancaria($ruta_pagina);

		?>


      </form>

    </div>
  </div>
</div>