<aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-x:hidden">
  <!-- Brand Logo -->
  <a href="inicio" class="brand-link">
    <img src="vistas/img/plantilla/mineria.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">MINERIA</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- FERNANDO - ESTA ES LA FOTO DEL USUARIO -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">

      <?php $inhabilitado_sin_cuenta = false; ?>

        <?php if ($usuario["foto"] == "") : ?>

          <img src="vistas/img/usuarios/default/default.png" class="img-circle elevation-2" alt="User Image">

        <?php else : ?>

          <img src="<?php echo $usuario["foto"] ?>" class="img-circle elevation-2" alt="User Image">

        <?php endif ?>
 -->


    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php if ($usuario["fecha_contrato"] != null) : ?>

          <?php

          $cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario", $usuario["id_usuario"]);

          if (count($cuentas) == 0) {
            $comprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantes("doc_usuario", $usuario["doc_usuario"]);
            if (count($comprobantesUsuario) > 0) {
              $inhabilitado_sin_cuenta = true;
            }
          }
          ?>

     <!--=====================================
      Botón Inicio
      ======================================-->
          <?php if (!$inhabilitado_sin_cuenta) : ?>

            <li class="nav-item">
              <a href="inicio" class="nav-link">
                <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/hogar.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Inicio</span>
                </button>
              </a>
            </li>
          <?php endif ?>
        <?php endif ?>

        <!--=====================================
      Botón Usuarios
      ======================================-->

        <?php if ($usuario["perfil"] == "admin") : ?>

          <li class="nav-item">
            <a href="usuarios" class="nav-link">
            <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/personas.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Usuarios</span>
                </button>
            </a>
          </li>

        <?php endif ?>

        <?php if ($usuario["fecha_contrato"] != null) : ?>

          <!--=====================================
      Botón Campañas
      ======================================-->

          <?php if ($usuario["perfil"] != "admin") : ?>

            <?php if (!$inhabilitado_sin_cuenta) : ?>


            <?php endif ?>

          <?php else : ?>


            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
              <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/mina.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Campañas</span>
                    <i class="right fas fa-angle-left"></i>
              </button>
                <!-- <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  Campañas
                  <i class="right fas fa-angle-left"></i>
                </p> -->
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="campanas" class="nav-link">
                    <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Planes de inversión</span>
                    </button>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bonos-extras" class="nav-link">
                  <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Bonos extra</span>
                  </button>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="campanas-publicidad" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Publicidad</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bonos-apalancamiento" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bonos apalancamiento</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bonos-recurrencia" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bonos recurrencia</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bonos-afiliados" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bonos afiliados</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="bonos-bienvenida" class="nav-link">
                  <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Bonos bienvenida</span>
                    </button>
                  </a>
                </li>
              </ul>
            </li>

          <?php endif ?>


          <?php if ($usuario["perfil"] != "admin") : ?>

            <?php if (!$inhabilitado_sin_cuenta) : ?>

              <!--=====================================
       Botón Inversiones
       ======================================-->
              <li class="nav-item">
                <a href="inversiones" class="nav-link">
                  <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/beneficios.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Suscripciones</span>
                  </button>
                </a>
              </li>

              <li class="nav-item">
                <a href="campanas" class="nav-link">
                  <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/mina.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Campañas</span>
                  </button>
                </a>
              </li>

            <?php endif ?>

          <?php endif ?>

          <!--=====================================
       Botón Cuentas
       ======================================-->

          <li class="nav-item">
            <a href="cuentas-bancarias" class="nav-link">
              <button class="btn btn-menu-mineria d-flex align-items-center">
                <img src="vistas/img/menu/banco.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                <span class="text-center">Canal de pago</span>
              </button>
            </a>
          </li>

          <?php if (!$inhabilitado_sin_cuenta) : ?>
            <!--=====================================
       Botón Comprobantes
       ======================================-->

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <button class="btn btn-menu-mineria d-flex align-items-center">
                  <img src="vistas/img/menu/comprobar.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                  <span class="text-center">Comprobantes</span>
                  <i class="right fas fa-angle-left"></i>
                </button>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="comprobantes" class="nav-link">
                  <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Suscripciones</span>
                    </button>
                  </a>
                </li>
              </ul>
            </li>

            <!--=====================================
       Botón Redes Multinivel
       ======================================-->

            <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Mi red
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="uninivel" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Red uninivel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="binaria" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Red binaria</p>
                </a>
              </li>
            </ul>
          </li> -->



            <!--=====================================
        Botón Ingresos
        ======================================-->
            <?php if ($usuario["perfil"] != "admin") : ?>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <!-- <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Ingresos
                <i class="right fas fa-angle-left"></i>
              </p> -->
                  <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/grafico.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Ingresos</span>
                    <i class="right fas fa-angle-left"></i>
                  </button>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="ingresos-uninivel" class="nav-link">
                    <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Ingresos minado</span>
                    </button>
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a href="ingresos-binaria" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingresos comisiones</p>
                    </a>
                  </li> -->
                  <li class="nav-item">
                    <a href="ingresos-extras" class="nav-link">
                    <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Ingresos extra</span>
                    </button>
                    </a>
                  </li>
                </ul>
              </li>

            <?php endif ?>
          <?php endif ?>

          <!--=====================================
        Botón Pagos
        ======================================-->
          <?php if ($usuario["perfil"] == "admin") : ?>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/obtener-dinero.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Pagos</span>
                    <i class="right fas fa-angle-left"></i>
                  </button>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="pagos-comisiones" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagar comisiones</p>
                  </a>
                </li> -->
                <li class="nav-item">
                <a href="pagos-inversiones" class="nav-link">
                <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Pagar suscripciones</span>
                    </button>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="pagos-extras" class="nav-link">
                  <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Pagar bonos extra</span>
                    </button>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="pagos-publicidad" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagar publicidad</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pagos-recurrencia" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagar recurrencia</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pagos-afiliados" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagar afiliados</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="pagos-bienvenida" class="nav-link">
                  <button class="btn btn-submenu-mineria d-flex align-items-center">
                    <i class="far fa-circle nav-icon"></i>
                     <span class="text-center">Pagar bonos bienvenida</span>
                    </button>
                  </a>
                </li>
              </ul>
            </li>


       <!--=====================================
        Botón Retiros
        ======================================-->

        <li class="nav-item">
              <a href="pagos-retiros" class="nav-link">
                <!-- <i class="nav-icon fas fa-wrench"></i>
                <p>Cambio patrocinador</p> -->
              <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/grafico.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Retiros</span>
              </button>
              </a>

            </li>

        <!--=====================================
        Botón Cambio patrocinador
        ======================================-->

            <li class="nav-item">
              <a href="cambiar-patrocinador" class="nav-link">
                <!-- <i class="nav-icon fas fa-wrench"></i>
                <p>Cambio patrocinador</p> -->
              <button class="btn btn-menu-mineria d-flex align-items-center">
                    <img src="vistas/img/menu/intercambiar.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                    <span class="text-center">Admin patrocinio</span>
              </button>
              </a>

            </li>


          <?php endif ?>

        <?php endif ?>

        <?php if (!$inhabilitado_sin_cuenta) : ?>

          <!--=====================================
        Botón Plan de compensación
        ======================================-->

          <li class="nav-item">
            <a href="plan-compensacion" class="nav-link">

              <!-- <p>Plan de compensación</p> -->
              <button class="btn btn-menu-mineria d-flex align-items-center">
                <!-- <i class="nav-icon fas fa-gem mr-2"></i> -->
                <img src="vistas/img/menu/equipo.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
                <span class="text-center">Compensación</span>
              </button>
            </a>
          </li>
        <?php endif ?>

        <!--=====================================
        Botón Salir
        ======================================-->

        <li class="nav-item">
          <a href="salir" class="nav-link">

            <!-- <p>Cerrar sesión</p> -->
            <button class="btn btn-menu-mineria d-flex align-items-center">
              <!-- <i class="nav-icon fas fa-sign-out-alt mr-2"></i> -->
              <img src="vistas/img/menu/subir.png" class="card-img-top" alt="Fissure in Sandstone" style="max-width: 18%;" />
              <span class="text-center">Cerrar sesión</span>
            </button>
          </a>
        </li>

      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>