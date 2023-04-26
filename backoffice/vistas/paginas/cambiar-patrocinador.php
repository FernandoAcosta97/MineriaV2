<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cambio de patrocinador</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Cambio patrocinador</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

        <!-- Default box -->
        <div class="card">

          <div class="card-header">

            <h3 class="card-title">Cambio red árbol</h3>

            <div style="margin:1em auto auto auto">

            </div>


            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            </div>

          </div>

        <form method="post">

          <div class="card-body">

           <!-- <div class="form-group">

              <label for="cambioPatrocinador" class="control-label">USUARIO</label>

              <div>

                <input type="text" class="form-control" id="cambioPatrocinador" name="cambioPatrocinador" required>

              </div>

              </div> -->

              <div class="form-group">

                <label for="cambioPatrocinador" class="control-label">BUSCAR USUARIO (HIJO)</label>

                <div>
                  <select class="form-control py-4 selectBuscar" id="cambioPatrocinador" name="cambioPatrocinador" required>
                  </select>

                </div>

              </div> 

              <div class="form-group">

                <label for="nuevoPatrocinador" class="control-label">NUEVO PATROCINADOR (PADRE)</label>

                <div>

                <div>
                  <select class="form-control py-4 selectBuscar" id="nuevoPatrocinador" name="nuevoPatrocinador" required>
                  </select>

                </div>

                </div>

              </div>

              <button type="submit" class="btn-lg btn-primary btnCambiarPatrocinador">ACEPTAR</button>
            
          </div>
          <!-- /.card-body -->

      </form>
      

      <?php

      $cambio_patrocinador = ControladorUsuarios::ctrCambiarPatrocinadorPrueba();

      ?>

          <div class="card-footer">
            
          </div>
            <!-- /.card-footer-->

          </div>
          <!-- /.card -->

    </div>

  </section>
  <!-- /.content -->

</div>