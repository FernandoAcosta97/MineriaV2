<?php 

$retiro = new ControladorPagos();

$retiro -> ctrVerificarCodigoIngresadoSms()

?>

<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="relative inline-block text-left w-3/4" id="dropdown">
              <button type="button"
              class="inline-flex justify-between items-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                  id="options-menu" aria-haspopup="true" aria-expanded="true">
                  <img class="h-8" src="vistas/img/billetera-electronica.png" alt="icono billetera">
                  <h1 class="text-primario font-bold" style="font-size: 1.25rem; line-height: 1.75rem;">Movimientos Billetera Crypto</h1>
                  <span class="font-bold text-xl p-0 m-0 rotate text-primario">></span>
              </button>
          
              <div class="origin-top-right absolute mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden transition"
                  id="menu">
                  <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                      <a href="billeteras-crypto" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Movimientos Billetera Crypto</a>
                      <a href="billeteras" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Movimientos Billetera</a>
                  </div>
              </div>
          </div>

        <!-- Esto podria romper algo, si lo hace, me avisan att. Sebastian <3 -->
        <!-- Intente ponerlo en la platilla, no ejecutaba -->
        <script>
            document.getElementById('options-menu').addEventListener('click', function () {
                document.getElementById('menu').classList.toggle('hidden');
            });
        </script>

      </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Movimientos</li>
          </ol>
        </div>
        
        <!-- <div class="col-sm-6">        
          <a href="billeteras-crypto" class="nav-link">
							<button class="btn btn-menu-mineria  d-flex align-items-center">
								<span class="text-center">Billetera Crypto</span>
							</button>
					</a>
        </div> -->

      </div>
    </div>
    <!-- /.container-fluid -->

  </section>

  <section class="content">

  <div class="container-fluid">
      <?php  

      include "modulos/billetera/cajas-pagos-y-retiros.php"; 

      include "modulos/uninivel/tabla-ingresos-uninivel.php"; 

      ?>

</div>

  </section>

</div>
    


