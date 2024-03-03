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