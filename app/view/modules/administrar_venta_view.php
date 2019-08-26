<div class="content-wrapper"> <!-- start path ...............-->
   <section class="content-header"> 
<h1>Gestion de Ventas</h1>
    <section class="content">


<h1>Ventas</h1>
<div class="box-header with-border">
	<a href="venta"><button class="btn btn-primary">Crear Venta</button></a>
	<button type="button" class="btn btn-default pull-right" id="daterange-btn">
		<span>
			<i class="fa fa-calendar">&nbsp;&nbsp;&nbsp;Rango de Fecha</i>
		</span>
		<i class="fa fa-caret-down"></i>
	</button>
</div>
<div class="box-body">
	<!-- <div class="table-responsive"> -->
	<table class="table table-bordered table-striped  dt-responsive tabla">
		<thead>
			<tr>
				<th>#</th>
				<th>Codigo de Factura</th>
				<th>Cliente</th>
				<th>Vendedor</th>
				<th>Forma de pago</th>
				<th>Neto</th>
				<th>Total</th>
				<th>Fecha de Transaccion</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id="tbl_tbody">
			<!-- <tr>
				<td class="id"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><button class="btn btn-success btn-xs">Nose</button></td>
				<td></td>
				<td>
					<div class="btn-group">
						<button class="btn btn-info"><i class="fa fa-print"></i></button>
						<button class="btn btn-danger"><i class="fa fa-times"></i></button>
					</div>
				</td>
			</tr> -->
		</tbody>
	</table>
	<!-- </div> -->
</div>
</section>
  </section> 
</div> <!-- end path .........-->
 <script src="<?php echo JS?>administrar_venta.js"></script>
 <script src="<?php echo AJAX?>ajax_administrar_venta.js"></script>



