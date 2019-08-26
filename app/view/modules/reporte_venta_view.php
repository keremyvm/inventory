<div class="content-wrapper"> <!-- start path ...............-->
   <section class="content-header"> 
<h1>Reporte de Ventas</h1>
    <section class="content">
	<h1>Reporte Ventas</h1>
		<div class="box-header with-border">
			<div class="input-group">
				<button type="button" class="btn btn-default pull-right" id="daterange-btn">
					<span>
						<i class="fa fa-calendar">&nbsp;&nbsp;&nbsp;Rango de Fecha</i>
					</span>
					<i class="fa fa-caret-down"></i>
				</button>
			</div>
			<div class="boxtools pull-right">
				<button class="btn btn-success" style="margin-top:5px;">Descargar Reporte en Excel</button>
			</div>
		</div>
			<div class="box box-solid bg-teal-gradient">
				<div class="box-header">
					<i class="fa fa-th"></i>
					<h3 class="box-title">Gráfico de Ventas</h3>
				</div>
			</div>
		<div class="box-body border-radius-none nuevo_grafico_ventas">
			<div class="chart" id="line-chart-ventas" style="height:250px;background:#7FB02F;">
				
			</div>
		</div>
	</section>
  </section> 
</div> <!-- end path .........-->
<script src="<?php echo JS?>reporte_venta.js"></script>
 <!-- <script src="<?php //echo AJAX?>ajax_administrar_venta.js"></script> -->



