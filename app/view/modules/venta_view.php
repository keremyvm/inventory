<div class="content-wrapper"> <!-- start path ...............-->
   <section class="content-header"> 
<h1>Gestion de Ventas</h1>
    <section class="content">
		<div class="row">
			<div class="col-lg-5 col-xs-12">
				<div class="box box-success">
					<div class="box-header with-border">
					<form action="" role="form" method="post" id="form_nuevo_venta">
						<input type="hidden" value="10001" name="txt_increment" class="txt_increment" id="txt_increment">
						<div class="box-body">
								<div class="box">
									<!-- vendedor -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<input type="text" class="form-control" id="txt_nuevo_vendedor" id="txt_nuevo_vendedor" name="txt_nuevo_vendedor" placeholder="Ingrese vendedor" value="<?php echo $_SESSION['nombre']?>" readonly>
											<input type="hidden" name="txt_vendedor_id" id="txt_vendedor_id" value="<?php echo $_SESSION['id']?>">
										</div>
									</div>
									<!-- codigo -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"></i></span>
											<input type="text" class="form-control" id="txt_nuevo_codigo" name="txt_nuevo_codigo" placeholder="Ingrese Codigo" readonly>
										</div>
									</div>
									<!-- cliente -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"></i></span>
											<select name="cbo_nuevo_cliente" id="cbo_nuevo_cliente" class="form-control">
											</select>
											<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-agregar-cliente" data-dismiss="modal">Crear Cliente</button></span>
										</div>
									</div>
									<!-- producto -->
									<div class="row form-group nuevo_producto">
									<!-- <div class="row">
										<div class="col-xs-6" style="padding-right:0px;">
											<div class="input-group">
												<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs remove_producto"><i class="fa fa-times"></i></button></span>
												<input type="text" class="form-control" name="txt_nuevo_producto" id="txt_nuevo_producto" placeholder="Ingrese Producto">
											</div>
										</div>
										<div class="col-xs-3">
											<input type="number" min="1" placeholder="0" class="form-control" value="1" name="txt_nuevo_cantidad_producto" id="txt_nuevo_cantidad_producto">
										</div>
										<div class="col-xs-3" style="padding-left:0px;">
											<div class="input-group">
												<input type="number" min="1" placeholder="00000" class="form-control" name="txt_nuevo_precio_producto" id="txt_nuevo_precio_producto" readonly>
												<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
											</div>
										</div>
									</div> -->
									</div>
									<input type="hidden" id="listado_productos" class="listado_productos" name="listado_productos">
									<!--  -->
									<button type="button" class="btn btn-default hidden-lg btn_agregar_productos_moviles">Crear Producto</button>
									<hr>
									<!-- impuesto y total -->
									<div class="row">
										<div class="col-xs-8 pull-right">
											<table class="table">
													<thead>
														<tr>
															<th>Impuesto</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td style="width:50%">
																<div class="input-group">
																	<input type="number" class="form-control" min="0" id="txt_nuevo_impuesto_venta" name="txt_nuevo_impuesto_venta" placeholder="0">
																	<input type="hidden" name="txt_nuevo_impuesto_precio" id="txt_nuevo_impuesto_precio">
																	<input type="hidden" name="txt_nuevo_impuesto_neto" id="txt_nuevo_impuesto_neto">
																	<span class="input-group-addon"><i class="fa fa-percent"></i></span>
																</div>
															</td>	
															<td style="width:50%">
																<div class="input-group">
																	<input type="text" class="form-control" id="txt_nuevo_precio_venta" name="txt_nuevo_precio_venta" total="" placeholder="00000" required readonly>
																	<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
																</div>
															</td>
														</tr>
													</tbody>
											</table>
										</div>
									</div>
									<hr>
									<!-- metodo de pago -->
									<div class=" form-group row">
										<div class="col-xs-6" style="padding-right: 0px;">
											<div class="input-group">
												<select name="cbo_metodo_pago" id="cbo_metodo_pago" class="form-control">
													<option >Seleccione método de pago</option>
													<option value="Efectivo">Efectivo</option>
													<option value="TC">Tarjeta de Crédito</option>
													<option value="TD">Tarjeta Débito</option>
												</select>
											</div>	
										</div>
										<div class="cbo_caja_metodo_pago"></div>
										<input type="hidden" id="listar_metodo_pago" class="listar_metodo_pago" name="listar_metodo_pago">
										<!-- <div class="col-xs-6" style="padding-left: 0px;">
											<div class="form-group">
												<div class="input-group">
													<input type="text" class="form-control" placeholder="Código de transacción" id="txt_nuevo_transaccion" name="txt_nuevo_transaccion">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
												</div>
											</div>	
										</div> -->
									</div>
								</div>
						</div>
						<div class="box-footer">
							<button class="btn btn-success pull-right" type="button" id="btn_guardar_venta">Guardar Venta</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			<div class="col-lg-7 hidden-md hidden-sm hidden-xs">
				<div class="box box-warning">
					<div class="box-header with-border"></div>
					<div class="box-body">
						<table class="table table-bordered table-striped dt-responsive tablas">
							<thead>
								<tr>
									<th>#</th>
									<th>Imagen</th>
									<th>Código</th>
									<th>Descripción</th>
									<th>Stock</th>
									<th>Acciones</th>	
								</tr>
							</thead>
							<tbody id="tbl_tbody">
								<!-- <tr>
									<td>1</td>
									<td><img src="<?php //echo IMG?>productos/default/anonymous.png" alt="" width="40"></td>
									<td>123456789</td>
									<td>internet inalambrico</td>
									<td>98</td>
									<td>
										<div class="btn-group">
											<button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger"><i class="fa fa-times"></i></button>
										</div>
									</td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--===========================
=            Start Modal insertar cliente           =
============================-->
<!-- Modal -->
<div id="modal-agregar-cliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" name="form_nuevo_cliente" id="form_nuevo_cliente">
	      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Guardar Clientes</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input nombre -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-user"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Nombre" name="txt_nuevo_nombre" required id="txt_nuevo_nombre">
	        			</div>	
        				<span class="error txt_nuevo_nombre"></span>
	        		</div>
	        		<!-- input documento -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-address-card"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Documento ID" name="txt_nuevo_documento" required id="txt_nuevo_documento" min="0" maxlength="8">
	        			</div>	
        				<span class="error txt_nuevo_documento"></span>
	        		</div>
	        		<!-- input email -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-envelope-square"></i></span>
	        				<input type="email" class="form-control input-lg" placeholder="Ingrese Email" name="txt_nuevo_email" required id="txt_nuevo_email" >
	        			</div>	
        				<span class="error txt_nuevo_email"></span>
	        		</div>
	        		<!-- input telefono -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-phone-square"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Telefono" name="txt_nuevo_telefono" required id="txt_nuevo_telefono" data-inputmask="'mask':'999-999-999'" data-mask>
	        			</div>	
        				<span class="error txt_nuevo_telefono"></span>
	        		</div>
	        		<!-- input direccion -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-location-arrow"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Direccion" name="txt_nuevo_direccion" required id="txt_nuevo_direccion" >
	        			</div>	
        				<span class="error txt_nuevo_direccion"></span>
	        		</div>
	        		<!-- input fecha de nacimiento -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-birthday-cake"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese fecha de nacimiento" name="txt_nuevo_fecha_nacimiento" required id="txt_nuevo_fecha_nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask>
	        			</div>	
        				<span class="error txt_nuevo_fecha_nacimiento"></span>
	        		</div>
	        		<!--  -->
	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="submit" class="btn btn-primary pull-right" id="btn_guardar_cliente" name="btn_guardar_cliente" >Guardar Cliente</button>
	      </div>
	      </form>
    </div>

  </div>
</div>

<!--===========================
=            End Modal            =
============================-->
<!--=========================== -->
	</section>
  </section> 
</div> <!-- end path .........-->
<script src="<?php echo JS?>venta.js"></script>
<script src="<?php echo AJAX?>ajax_venta.js"></script>



