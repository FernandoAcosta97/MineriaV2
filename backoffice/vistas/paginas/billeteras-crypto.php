<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Movimientos Billetera Crypto</h1>

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Movimientos</li>
          </ol>
        </div>

        <div class="col-sm-6">        
          <a href="billeteras" class="nav-link">
							<button class="btn btn-menu-mineria d-flex align-items-center">
								<span class="text-center">Billetera Local</span>
							</button>
					</a>
        </div>

      </div>
    </div><!-- /.container-fluid -->

  </section>

  <section class="content">
    
    <div class="container-fluid">

      <?php  

      include "modulos/billetera/cajas-pagos-y-retiros2.php"; 

      include "modulos/uninivel/tabla-ingresos-uninivel2.php"; 

      ?>

    </div>

  </section>

</div>


