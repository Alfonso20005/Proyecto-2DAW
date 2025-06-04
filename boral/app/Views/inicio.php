
<?php include("templates/parte1.php");?>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<title>Boral | Dashboard</title>
<div class="row">
    <div class="col-12">
        <div class="row">
            
                <div class="col-lg-6 col-xl-3">
                <div class="card widget-box-one border border-success bg-soft-success">
                    <div class="card-body">
                        <div class="float-right avatar-lg rounded-circle mt-3">
                            <i class="mdi mdi-account-convert font-30 widget-icon rounded-circle avatar-title text-success"></i>
                        </div>
                        <div class="wigdet-one-content">
                            <p class="m-0 text-uppercase font-weight-bold text-muted">Usuarios Totales</p>
                            <h2>
                                <span data-plugin="counterup"><?= $total_usuarios ?></span>  <!-- Muestra el total de usuarios y le agrega el efecto de contador -->
                            </h2>
                            <!-- Aquí agregamos una línea adicional debajo para mejorar el diseño -->
                            <p class="text-muted m-0"><span class="font-weight-medium">Hoy:</span> <?= $usuarios_hoy ?> usuarios</p>  <!-- Agregar información adicional como los usuarios de hoy -->
                            
                        </div>
                    </div>
                </div>
            </div>

    
                  <div class="col-xl-3 col-md-6">
                    <div class="card widget-box-one border border-warning bg-soft-warning">
                        <div class="card-body">
                            <div class="float-right avatar-lg rounded-circle mt-3">
                                <i class="mdi mdi-package-variant font-30 widget-icon rounded-circle avatar-title text-warning"></i>
                            </div>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-weight-bold text-muted">Pedidos totales</p>
                                <h2>
                                    <span data-plugin="counterup"><?= $total_pedidos ?></span>   
                                </h2>
                                <p class="text-muted m-0"><span class="font-weight-medium">Hoy:</span> <?= $pedidos_hoy ?> pedidos</p>
                            </div>
                        </div>
                    </div>
                </div>
            

                   <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-danger bg-soft-danger">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-currency-eur font-30 widget-icon rounded-circle avatar-title text-danger"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-weight-bold text-muted">Ventas Semana</p>
                                    <h2>
                                        <span data-plugin="counterup"><?= number_format($total_semana_actual, 2) ?></span>€ <!-- Total de pedidos semana actual -->
                                        <?php if ($total_semana_pasada > $total_semana_actual): ?>
                                            <i class="mdi mdi-arrow-down text-danger font-24"></i> <!-- Flecha hacia abajo y roja si la semana pasada es mayor -->
                                        <?php else: ?>
                                            <i class="mdi mdi-arrow-up text-success font-24"></i> <!-- Flecha hacia arriba y verde si la semana actual es mayor o igual -->
                                        <?php endif; ?>
                                    </h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Anterior semana:</span> <?= number_format($total_semana_pasada, 2) ?>€</p> <!-- Total de pedidos semana pasada -->
                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-one border border-info bg-soft-info">
                            <div class="card-body">
                                <div class="float-right avatar-lg rounded-circle mt-3">
                                    <i class="mdi mdi-currency-eur font-30 widget-icon rounded-circle avatar-title text-info"></i>
                                </div>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-weight-bold text-muted">Valor Promedio Pedido</p>
                                    <h2>
                                        <span data-plugin="counterup"><?= number_format($valor_promedio_pedido, 2) ?></span>€  <!-- Valor promedio del pedido -->
                                    </h2>
                                    <p class="text-muted m-0"><span class="font-weight-medium">Último Pedido:</span> <?= number_format($ultimo_pedido, 2) ?>€</p> <!-- Valor del último pedido -->
                                </div>
                            </div>
                        </div>
                    </div>
            
                 <div class="col-lg-6 mt-2 mb-3">
                    <div class="bg-light p-4 rounded shadow">
                        <h4 class="fw-bold mb-3">Ventas en el Año</h4>
                        

                        <div class="demo-box">
                            <canvas id="lineChart" height="367" width="783" class="chartjs-render-monitor"></canvas>
                        </div>
                        
                    </div>
                 </div>

            
               <div class="col-xl-3 mt-2">
                    <div class="bg-light p-4 rounded shadow">
                        <h4 class="fw-bold mb-4">Ranking Distribuidores</h4>
                    
                        <?php $i = 1; foreach($top_distribuidores as $distribuidor): ?>
                            <div class="p-3 mb-3 rounded bg-dark text-white d-flex justify-content-between align-items-center shadow-sm">
                                <div>
                                    <span class="badge bg-secondary me-2"><?= $i++ ?></span>
                                    <?= esc($distribuidor->razon_social) ?>
                                </div>
                                <div class="fw-bold">
                                     <?= number_format($distribuidor->total_vendido, 2, ',', '.') ?>€
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            <div class="col-xl-3 mt-2">
                    <div class="bg-light p-4 rounded shadow">
                        <h4 class="fw-bold mb-4">Ranking Productos</h4>

                        <?php $i = 1; foreach($top_productos_cantidad as $producto): ?>
                            <div class="p-3 mb-3 rounded bg-dark text-white d-flex justify-content-between align-items-center shadow-sm">
                                <div>
                                    <span class="badge bg-secondary me-2"><?= $i++ ?></span>
                                    <?= esc($producto->nombre) ?>
                                </div>
                                <div class="fw-bold">
                                    <?= $producto->cantidad_total ?> uds
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            
            <div class="col-xl-4 mt-3 mb-3">
                    <div class="bg-light p-4 rounded shadow position-relative">
                        <h4 class="fw-bold mb-2">Total de Ventas Mes Actual</h4>
                        
                        <!-- Canvas para el gráfico -->
                        <canvas id="barMes" height="376" style="display: block;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            
            
             <div class="col-xl-4 mt-3 mb-3">
                    <div class="bg-light p-4 rounded shadow">
                        <h4 class="fw-bold mb-2">Mayor Stock vs Stock Critico</h4>
                        
                       <div class="demo-box">
                            <canvas id="bar" height="377" width="383" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                 </div>
            
            
            <div class="col-xl-4 mt-3 mb-3">
                    <div class="bg-light p-4 rounded shadow">
                        <h4 class="fw-bold mb-2">Ventas por Categoría</h4>
                        

                        <div id="morris-donut-example" dir="ltr" class="morris-charts mb-4" style="height: 300px;"></div>

                        <div class="text-center">
                            <ul class="list-inline">
                                <li class="list-inline-item me-3">
                                    <h5 class="mb-0 text-info"><i class='bx bxs-cake'></i>  Pasteleria</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="mb-0 text-success"><i class='bx bxs-cookie'></i>  Bolleria</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                 </div>
            

           



        
        </div>
                 
    </div>
</div>
<?php include("templates/parte2.php");?>


<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "<?= session()->getFlashdata('success'); ?>",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>






<script>
    
//CATEGORIAS DE VENTA
!(function (e) {
  "use strict";
  var a = function () {
    this.$realData = [];
  };
 
    (a.prototype.createDonutChart = function (e, a, r) {
      Morris.Donut({ element: e, data: a, resize: !0, colors: r });
    }),
    (a.prototype.init = function () {

      this.createDonutChart(
        "morris-donut-example",
        [
          { label: "Pasteleria", value: <?php echo $pasteleria; ?> },
          { label: "Bolleria", value: <?php echo $bolleria; ?> },
        ],
        ["#3ac9d6", "#4bd396"]
      );
    }),
    (e.Dashboard1 = new a()),
    (e.Dashboard1.Constructor = a);
})(window.jQuery),
  (function (e) {
    "use strict";
    window.jQuery.Dashboard1.init();
  })();

    
    
    
<?php
$meses = $mes; 

switch ($meses) {
    case 1:
        $mesNombre = "Enero";
        break;
    case 2:
        $mesNombre = "Febrero";
        break;
    case 3:
        $mesNombre = "Marzo";
        break;
    case 4:
        $mesNombre = "Abril";
        break;
    case 5:
        $mesNombre = "Mayo";
        break;
    case 6:
        $mesNombre = "Junio";
        break;
    case 7:
        $mesNombre = "Julio";
        break;
    case 8:
        $mesNombre = "Agosto";
        break;
    case 9:
        $mesNombre = "Septiembre";
        break;
    case 10:
        $mesNombre = "Octubre";
        break;
    case 11:
        $mesNombre = "Noviembre";
        break;
    case 12:
        $mesNombre = "Diciembre";
        break;

}
?>    
    
    
    
    
    
    
    
//VENTAS POR AÑO Y STOCK MAYOR VS STOCK MENOR
const ventasPorMes = <?= json_encode($ventas_por_mes); ?>;
const productoMaxStock = <?= json_encode($producto_max_stock); ?>;
const productoMinStock = <?= json_encode($producto_min_stock); ?>;

!(function (s) {
  "use strict";
  var r = function () {};
  (r.prototype.respChart = function (r, o, a, e) {
    (Chart.defaults.global.defaultFontColor = "#6c7897"),
      (Chart.defaults.scale.gridLines.color = "rgba(108, 120, 151, 0.1)");
    var t = r.get(0).getContext("2d"),
      n = s(r).parent();
    function i() {
      r.attr("width", s(n).width());
      switch (o) {
        case "Line":
          new Chart(t, { type: "line", data: a, options: e });
          break;
         case "Bar":
          new Chart(t, { type: "bar", data: a, options: e });
          break;
        case "BarMes":
          new Chart(t, { type: "bar", data: a, options: e });
          break;
      }
    }
    s(window).resize(i), i();
  }),
    (r.prototype.init = function () {
      this.respChart(
        s("#lineChart"),
        "Line",
        {
          labels: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
          ],
          datasets: [
            {
              label: "Ventas Año",
              fill: !1,
              lineTension: 0.1,
              backgroundColor: "#039cfd",
              borderColor: "#039cfd",
              borderCapStyle: "butt",
              borderDash: [],
              borderDashOffset: 0,
              borderJoinStyle: "miter",
              pointBorderColor: "#039cfd",
              pointBackgroundColor: "#fff",
              pointBorderWidth: 1,
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "#039cfd",
              pointHoverBorderColor: "#eef0f2",
              pointHoverBorderWidth: 2,
              pointRadius: 1,
              pointHitRadius: 10,
              data: ventasPorMes,
            },
          ],
        },
        { scales: { yAxes: [{ ticks: { max: 100, min: 0, stepSize: 10 } }] } }
      );
      this.respChart(
              s("#bar"),
              "Bar",
              {
                labels: ["Stock"], // Meses o categorías
                datasets: [
                  {
                    label: productoMaxStock.nombre,
                    backgroundColor: "rgba(54, 162, 235, 0.5)", // Azul
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(54, 162, 235, 0.7)",
                    hoverBorderColor: "rgba(54, 162, 235, 1)",
                    data: [productoMaxStock.stock], // Valores azules
                  },
                  {
                    label: productoMinStock.nombre,
                    backgroundColor: "rgba(255, 99, 132, 0.5)", // Rojo
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(255, 99, 132, 0.7)",
                    hoverBorderColor: "rgba(255, 99, 132, 1)",
                    data: [productoMinStock.stock], // Valores rojos
                  },
                ],
              },
              {
                scales: {
                  yAxes: [
                    {
                      ticks: {
                        beginAtZero: true,
                      },
                    },
                  ],
                },
              }
            );
              this.respChart(s("#barMes"), "BarMes", {
                labels: [
                   "<?php echo $mesNombre; ?>"
                ],
                datasets: [
                  {
                    label:  "<?php echo $mesNombre; ?>",
                    backgroundColor: "rgba(144, 238, 144, 0.3)", 
                    borderColor: "#90ee90",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(144, 238, 144, 0.6)",
                    hoverBorderColor: "#90ee90",
                    data: [<?php echo $ventasDelMes; ?>],
                  },
                ],
              });

     
    }),
    (s.ChartJs = new r()),
    (s.ChartJs.Constructor = r);
})(window.jQuery),
  (function (r) {
    "use strict";
    window.jQuery.ChartJs.init();
  })();


</script>
