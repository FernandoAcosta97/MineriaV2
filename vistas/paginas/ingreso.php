<div class="back">
</div>

<div class="ladoUsuarios">
	<div class="left-side-login w-0 lg:w-3/5"></div>
	<div class='right-side-login w-full lg:w-2/5'>
		<span class='text-white'>.</span>
		<div class="w-full p-2 lg:p-4 overflow-y-scroll flex flex-col gap-4 h-screen">
			<form method="post" class="mt-5 m-auto">

				<div class="social-login">
					<div class="circle-logo">
						<img src="https://image.flaticon.com/icons/png/512/145/145802.png">
					</div>
				</div>
				<h1>Ingreso al sistema</h1>
				<p style="margin-bottom: 40px;">¿No tienes una cuenta? &nbsp;&nbsp; <a href="<?php echo $ruta ?>registro" class="register" style="margin-left: 10px;">Regístrate</a></p>
				<input type="email" name="ingresoEmail" placeholder="Correo electrónico" required>
				<input type="password" name="ingresoPassword" placeholder="Contraseña" required>
				<button type="submit" class="submit-button">Ingresar</button>
				<?php

				$ingreso = new ControladorUsuarios();
				$ingreso->ctrIngresoUsuario();

				?>
				<div class="line-container">
					<div class="line"></div>
					<p>O continúa con</p>
					<div class="line"></div>
				</div>
				<div class="social-login">
					<div class="circle-logo">
						<img src="https://image.flaticon.com/icons/png/512/145/145802.png">
					</div>
					<div class="circle-logo">
						<img src="https://image.flaticon.com/icons/png/512/145/145804.png">
					</div>
				</div>
				<br>

				<p class="text-center pt-1"><a href="#modalRecuperarPassword" data-toggle="modal" data-dismiss="modal">¿Olvidó su contraseña?</a></p>
			</form>
		</div>
	</div>
</div>

<!--=====================================
VENTANA MODAL RECUPERAR CONTRASEÑA
======================================-->

<div class="modal" id="modalRecuperarPassword">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header custom-color text-white">

				<h4 class="modal-title">Recuperar contraseña</h4>

				<button type="button" class="close text-white" data-dismiss="modal">&times;</button>

			</div>

			<div class="modal-body">

				<form method="post">

					<p class="text-muted">Escriba su correo electrónico con el que está registrado y allí le enviaremos una nueva contraseña:</p>

					<div class="input-group mb-3">

						<div class="input-group-prepend">

							<span class="input-group-text">

								<i class="far fa-envelope"></i>

							</span>

						</div>

						<input type="email" class="form-control" placeholder="Email" name="emailRecuperarPassword" required>

					</div>

					
					<button type="submit" class="submit-button">Enviar</button>

					<?php

					$recuperarPassword = new ControladorUsuarios();
					$recuperarPassword->ctrRecuperarPassword();

					?>

				</form>

			</div>

		</div>

	</div>

</div>