<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">

  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <a class="nav-link copiarLinkInicio" href="#">
        <i class="fa fa-link"> Mi link de afiliado</i>
        <input type="hidden" id="linkAfiliado" value="<?php echo $ruta . $usuario["enlace_afiliado"]; ?>" readonly>
        <span class="badge badge-info navbar-badge"></span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link copiarCodigoInicio" href="#">
        <i class="fa fa-link"> Mi código de afiliado: <?php echo $usuario["enlace_afiliado"]; ?></i>
        <input type="hidden" id="codigoAfiliado" value="<?php echo $usuario["enlace_afiliado"]; ?>" readonly>
        <span class="badge badge-info navbar-badge"></span>
      </a>
    </li>

    <?php
    $ticketRecibidos = ControladorNotificaciones::ctrMostrarNotificacionesVisTipo("id_usuario", $usuario["id_usuario"], "visualizacion", 0, "tipo", "soporte");

    $totalTicketsRecibidos = count($ticketRecibidos);

    $referidosNuevos = ControladorNotificaciones::ctrMostrarNotificacionesVisTipo("id_usuario", $usuario["id_usuario"], "visualizacion", 0, "tipo", "red");

    $totalReferidosNuevos = count($referidosNuevos);

    $pagosLiquidados = ControladorNotificaciones::ctrMostrarNotificacionesVisTipo("id_usuario", $usuario["id_usuario"], "visualizacion", 0, "tipo", "pago");

    $totalPagosLiquidados = count($pagosLiquidados);

    ?>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-info navbar-badge"><?php echo $totalTicketsRecibidos ?></span>
      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php

        if ($totalTicketsRecibidos > 0) {
          $mensaje = "";
          $tiempo = "";
          date_default_timezone_set('America/Bogota');
          foreach ($ticketRecibidos as $key => $value) {
            $date1 = new DateTime($value["fecha"]);
            $date2 = new DateTime("now");
            $diff = $date1->diff($date2);
            $tiempo = ControladorNotificaciones::ctrTiempoNotificacion($diff);

            $ticket = ControladorSoporte::ctrMostrarTickets("id_soporte", $value["id_detalle"]);
            $usu = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $ticket[0]["remitente"]);
            $mensaje = $ticket[0]["asunto"];
            // else{
            //   $usu = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $value["id_detalle"]);
            // }
        ?>
            <div class="mensaje" idMensaje="<?php echo $value["id_detalle"] ?>">
              <a href="index.php?pagina=soporte&soporte=lectura-ticket&tipo=recibidos&id_ticket=<?php echo $value["id_detalle"] ?>" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="<?php echo $usu["foto"] ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      <?php echo $usu["usuario"] ?>
                      <?php if ($usu["perfil"] = "admin") : ?>
                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                      <?php endif ?>
                    </h3>
                    <p class="text-sm"><?php echo $mensaje ?></p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace <?php echo $tiempo ?></p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
            </div>
            <div class="dropdown-divider"></div>

          <?php
          }
          ?>

          <div class="dropdown-divider"></div>
          <a href="index.php?pagina=soporte&soporte=recibidos" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
      </div>

    <?php
        } else {
    ?>

      <a href="#" class="dropdown-item dropdown-footer">No tiene mensajes</a>
      </div>

    <?php  } ?>

    </li>

    <?php
    $total_notificaciones = 0;
    if ($totalReferidosNuevos > 0) {
      $total_notificaciones = $total_notificaciones + 1;
    }
    if ($totalTicketsRecibidos > 0) {
      $total_notificaciones = $total_notificaciones + 1;
    }
    if ($totalPagosLiquidados > 0) {
      $total_notificaciones = $total_notificaciones + 1;
    }
    ?>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-dark navbar-badge"><?php echo $total_notificaciones ?></span>
      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header"><?php echo $totalReferidosNuevos ?> Notificaciones</span>
        <div class="dropdown-divider"></div>
        <a href="index.php?pagina=soporte&soporte=recibidos" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> <?php echo $totalTicketsRecibidos ?> mensajes nuevos
          <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="uninivel" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> <?php echo $totalReferidosNuevos ?> referidos nuevos
          <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="inicio" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> <?php echo $totalPagosLiquidados ?> pagos liquidados
          <!-- <span class="float-right text-muted text-sm">2 days</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
      </div>

    </li>

    <li class="nav-item">
      <a class="nav-link" href="salir">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li>

  </ul>

</nav>