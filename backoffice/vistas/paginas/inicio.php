<?php
$cuentas = ControladorCuentas::ctrMostrarCuentasAll("usuario", $usuario["id_usuario"]);
if (count($cuentas) == 0) {
  $comprobantesUsuario = ControladorComprobantes::ctrMostrarComprobantes("doc_usuario", $usuario["doc_usuario"]);
  if (count($comprobantesUsuario) > 0) {
    echo '<script>
              window.location = "cuentas-bancarias";
              </script>';
    return;
  }
}
?>

<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tablero</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Tablero</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <?php

      //$totalRed = ControladorMultinivel::ctrMostrarRedOperandoTotal("usuarios","red_uninivel","patrocinador_red",$usuario["enlace_afiliado"],null,null);

      //$totalRedOperando = ControladorMultinivel::ctrMostrarRedOperandoTotal("usuarios","red_uninivel","patrocinador_red",$usuario["enlace_afiliado"],"operando",1);
      $afiliadosNecesarios = 0;
      $operando = 0;
      $sinOperar = 0;
      $totalRed = 0;

      if ($usuario["fecha_contrato"] != "") {

        $red = ControladorMultinivel::ctrMostrarRed("usuarios", "red_uninivel", "patrocinador_red", $usuario["enlace_afiliado"]);

        $inversiones = ControladorComprobantes::ctrMostrarComprobantesxEstadoxCampana("doc_usuario", $usuario["doc_usuario"], "estado", "1", "estado", "1");

        $totalInversiones = count($inversiones);

        /*=============================================
    Limpinado el array de tipo Objeto de valores repetidos
    =============================================*/

        $resultado = array();

        foreach ($red as $value) {

          $resultado[$value["id_usuario"]] = $value;
        }

        $red = array_values($resultado);
        $activos = 0;
        if (count($red) > 0) {

          foreach ($red as $key => $value) {

            if ($value["perfil"] != "admin") {


              if ($value["operando"] == 1) {

                ++$operando;
              } else {

                ++$sinOperar;
              }
            }
          }
        } else {

          $operando = 0;
          $sinOperar = 0;
        }

        $totalRed = $operando + $sinOperar;

        if ($totalInversiones > 1) {

          $afiliadosNecesarios = $totalInversiones - 1;
        }




        // print_r($afiliadosNecesarios);

        $bono_extra = ControladorCampanas::ctrMostrarCampanasxEstado("nombre", "Bono Extra", "estado", 1);

        if ($usuario["perfil"] != "admin" && $bono_extra) {

          echo '<div class="alert alert-info alert-info">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
  Invita a mas personas con tu link de referido entre el ' . $bono_extra["fecha_inicio"] . ' y el ' . $bono_extra["fecha_fin"] . ' y recibiras un bono extra de $ ' . number_format($bono_extra["retorno"]) . ' COP por cada persona que se registre e invierta. No dejes pasar esta oportunidad, que esperas para ganar.
  </div>';
        }

        if ($totalInversiones > 1) {

          if ($usuario["perfil"] != "admin") {

            if ($totalInversiones >= 6 && $operando < 6) {

              echo '<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
    Recuerda que para recibir tu rendimiento necesitas tener por lo menos [6] afiliados con una inversión activa, en estos momentos tienes [' . $operando . '] afiliados con una inversión activa, invita a tus demas referidos a inverir o trae un nuevo referido para que este realice su primer inversión.
    </div>';
            } else {

              if ($operando < $afiliadosNecesarios) {

                echo '<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
    Recuerda que para recibir tu rendimiento necesitas tener por lo menos [' . $afiliadosNecesarios . '] afiliados con una inversión activa, en estos momentos tienes [' . $operando . '] afiliados con una inversión activa, invita a tus demas referidos a inverir o trae un nuevo referido para que este realice su primer inversión.
    </div>';
              }
            }
          }
        }
      }

      ?>

      <?php

      include "modulos/inicio/recuadros-superiores.php";

      if ($usuario["perfil"] == "admin") {
        include "modulos/inicio/tabla-ultimos-registrados.php";
      } else {

        include "modulos/inicio/graficos-inicio.php";
      }

      ?>

    </div>

  </section>
  <!-- /.content -->

</div>