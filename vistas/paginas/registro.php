<div class="back">
</div>
<div class="ladoUsuarios">
	
	<div class='right-side-login w-full lg:w-2/5'>
		<span class='text-white'>.</span>
		<div class="w-full p-2 lg:p-4 overflow-y-scroll flex flex-col gap-4 h-screen">
			<!-- <a href="<?php echo $ruta; ?>inicio"><img src="img/logo-positivo.png" class="img-fluid px-5"></a> -->
			<form method="post" class="login-form m-auto" onsubmit="return validarPoliticas()">

				<?php if (isset($_COOKIE["patrocinador"])) : ?>

					<input type="hidden" value="<?php echo $_COOKIE["patrocinador"]; ?>" name="patrocinador">

				<?php else : ?>

					<input type="hidden" value="admin-mineria" name="patrocinador">

				<?php endif ?>
				<div class="social-login">
					<div class="circle-logo">
						<img src="https://image.flaticon.com/icons/png/512/145/145802.png">
					</div>
				</div>
				<h1>Registrarse</h1>
				<p style="margin-bottom: 15px;">¿Ya tienes una cuenta? &nbsp;&nbsp; <a href="<?php echo $ruta ?>ingreso" class="register" style="margin-left: 10px;">Iniciar sesión</a></p>

				<div class="Group-Register">
					<input type="text" name="registroUsuario" placeholder="Usuario" required>
					<input type="text" name="registroNombre" placeholder="Nombres" required>
				</div>
				<input type="email" name="registroEmail" placeholder="Correo electrónico" required>
				<div class="Group-Register">
					<input type="password" name=registroPassword placeholder="Contraseña" required>
					<input type="password" name="registroPassword2" id="registroPassword2" placeholder="Repetir Contraseña" required>
				</div>
				<div class="form-check-inline text-right">

					<input type="checkbox" id="politicas" class="form-check-input">

					<label class="form-check-label" for="politicas">
						Para registrarse debe aceptar nuestras <a href="<?php echo $ruta ?>politicas-de-privacidad.pdf" target="_blank">políticas de privacidad</a> <span></span>
					</label>
				</div>
				<!-- <label><input type="checkbox" id="politicas" class="form-check-input"> Recordarme</label> -->
				<br>
				<div class="form-group">
					<br>


					<?php
					$registro = new ControladorUsuarios();
					$registro->ctrRegistroUsuario();
					?>
					<!-- <input type="submit" class="submit-button" value="Registrarse"> -->
					<button type="submit" class="submit-button">Registrarme</button>

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
				</div>
			</form>
		</div>
	</div>
	<div class="right-side w-0 lg:w-3/5"></div>
</div>