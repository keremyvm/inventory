<div class="content-wrapper"> <!-- start path ...............-->
   <section class="content-header"> 
<h1>Gestion de clientes</h1>
    <section class="content">


<h1>Clientes</h1>
<div class="box-header with-border">
	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-cliente">Agregar clientes</button>
</div>
<div class="box-body">
	<!-- <div class="table-responsive"> -->
	<table class="table table-bordered table-striped  dt-responsive tabla">
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Documento ID</th>
				<th>Email</th>
				<th>Teléfono</th>
				<th>Direccion</th>
				<th>Fecha de nacimiento</th>
				<th>Total de compras</th>
				<th>Última compra</th>
				<th>Ingreso de Sistema</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id="tbl_tbody">
			<!-- <tr>
				<td class="id"></td>
				<td></td>
				<td></td>
				<td></td>
				<td><button class="btn btn-success btn-xs"></button></td>
				<td></td>
				<td>
					<div class="btn-group">
						<button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
						<button class="btn btn-danger"><i class="fa fa-times"></i></button>
					</div>
				</td>
			</tr> -->
		</tbody>
	</table>
	<!-- </div> -->
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
<!--===========================
=            Start Modal editar cliente           =
============================-->
<!-- Modal -->
<div id="modal-editar-cliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" name="form_editar_cliente" id="form_editar_cliente">
    		<input type="hidden" id="txt_editar_id" name="txt_editar_id">
	      <div class="modal-header" style="background:orange;">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Editar Clientes</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input nombre -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-user"></i></span>
	        				<input type="text" class="form-control input-lg" name="txt_editar_nombre" required id="txt_editar_nombre">
	        			</div>	
        				<span class="error txt_editar_nombre"></span>
	        		</div>
	        		<!-- input documento -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-address-card"></i></span>
	        				<input type="text" class="form-control input-lg" name="txt_editar_documento" required id="txt_editar_documento" min="0" maxlength="8">
	        			</div>	
        				<span class="error txt_editar_documento"></span>
	        		</div>
	        		<!-- input email -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-envelope-square"></i></span>
	        				<input type="email" class="form-control input-lg" name="txt_editar_email" required id="txt_editar_email" >
	        			</div>	
        				<span class="error txt_editar_email"></span>
	        		</div>
	        		<!-- input telefono -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-phone-square"></i></span>
	        				<input type="text" class="form-control input-lg" name="txt_editar_telefono" required id="txt_editar_telefono" data-inputmask="'mask':'999-999-999'" data-mask>
	        			</div>	
        				<span class="error txt_editar_telefono"></span>
	        		</div>
	        		<!-- input direccion -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-location-arrow"></i></span>
	        				<input type="text" class="form-control input-lg" name="txt_editar_direccion" required id="txt_editar_direccion" >
	        			</div>	
        				<span class="error txt_editar_direccion"></span>
	        		</div>
	        		<!-- input fecha de nacimiento -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-birthday-cake"></i></span>
	        				<input type="text" class="form-control input-lg" name="txt_editar_fecha_nacimiento" required id="txt_editar_fecha_nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask>
	        			</div>	
        				<span class="error txt_editar_fecha_nacimiento"></span>
	        		</div>
	        		<!--  -->
	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="submit" class="btn btn-primary pull-right" id="btn_editar_cliente" name="btn_editar_cliente" style="background:orange;">Editar Cliente</button>
	      </div>
	      </form>
    </div>

  </div>
</div>
<!--===========================
=            End Modal            =
============================-->
</section>
  </section> 
</div> <!-- end path .........-->
<script src="<?php echo JS?>cliente.js"></script>
<script src="<?php echo AJAX?>ajax_cliente.js"></script>



