<div class="content-wrapper"> <!-- start path ...............-->
   <section class="content-header"> 
<h1>Gestion de productos</h1>
    <section class="content">


<h1>Productos</h1>
<div class="box-header with-border">
	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-producto">Agregar productos</button>
</div>
<div class="box-body">
	<!-- <div class="table-responsive"> -->
	<table class="table table-bordered table-striped  dt-responsive tabla">
		<thead>
			<tr>
				<th>#</th>
				<th>Imagen</th>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Categoria</th>
				<th>Stock</th>
				<th>Precio de compra</th>
				<th>Precio de venta</th>
				<th>Agregado</th>
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
=            Start Modal insertar usuario           =
============================-->
<!-- Modal -->
<div id="modal-agregar-producto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" name="form_nuevo_producto" id="form_nuevo_producto" enctype="multipart/form-data">
	      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Agregar Productos</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input codigo -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-code"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Codigo" name="txt_nuevo_codigo" required id="txt_nuevo_codigo">
	        			</div>	
        				<span class="error txt_nuevo_codigo"></span>
	        		</div>
					<!-- input descripcion -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-product-hunt"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Descripcion" name="txt_nuevo_descripcion" required id="txt_nuevo_descripcion">
	        			</div>	
        				<span class="error txt_nuevo_descripcion"></span>
	        		</div>
	        		<!-- select categoria -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon"><i class="fa fa-th"></i></span>
	        				<select name="cbo_nuevo_categoria" id="cbo_nuevo_categoria" class="form-control input-lg">
	        					<option value="">Seleccionar Categoria</option>
	        					<option value="administrador">Administrador</option>
	        					<option value="especial">Especial</option>
	        					<option value="vendedor">Vendedor</option>
	        				</select>
	        			</div>
	        			<span class="error cbo_nuevo_categoria"></span>
	        		</div>
	        		<!-- input stock -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-check"></i></span>
	        				<input type="number" class="form-control input-lg" min="0" placeholder="Ingrese Stock" name="txt_nuevo_stock" required id="txt_nuevo_stock">
	        			</div>	
        				<span class="error txt_nuevo_stock"></span>
	        		</div>
	        		<!-- input precio-compra -->
	        		<div class="form-group row">
	        			<div class="col-xs-6">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-arrow-up"></i></span>
	        				<input type="number" class="form-control input-lg" min="0" placeholder="Ingrese Precio Compra" name="txt_nuevo_precio-compra" required id="txt_nuevo_precio-compra">
	        			</div>
        				<span class="error txt_nuevo_precio-compra"></span>
	        			</div>	
	        		
	        		<!-- input precio-venta -->
	        		<div class="col-xs-6">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-arrow-down"></i></span>
	        				<input type="number" class="form-control input-lg" min="0" placeholder="Ingrese Precio Venta" name="txt_nuevo_precio-venta" required id="txt_nuevo_precio-venta">
	        			</div>	
        				<span class="error txt_nuevo_precio-venta"></span>
	        		</div>
	        		</div>
	        		<!-- input photo -->
	        		<div class="form-group">
	        			<div class="panel">SUBIR FOTO</div>
	        			<input type="file" name="file_nuevo_foto" class="file_foto" id="file_nuevo_foto">
	        			<span class="error file_nuevo_foto"></span>
	        			<!-- <span class="error foto"></span> -->
	        			<p class="help-block">Peso máximo de la foto 2MB</p>
	        			<img src="<?php echo IMG?>usuarios/default/anonymous.png" alt="" class="img-thumbnail previsualizar" width="200px">
	        		</div>
	        		<!-- ...................... -->
	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="submit" class="btn btn-primary pull-right" id="btn_guardar_producto" name="btn_guardar_producto">Guardar Producto</button>
	      </div>
	      </form>
    </div>

  </div>
</div>

<!--===========================
=            End Modal            =
============================-->
<!--===========================
=            Start Modal editar usuario           =
============================-->
<!-- Modal -->
<div id="modal-editar-producto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" name="form_editar_producto" id="form_editar_producto">
    		<input type="hidden" id="txt_editar_id" name="txt_editar_id">
	      <div class="modal-header" style="background-color:#f39c12;">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Editar Producto</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input name -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-user"></i></span>
	        				<input type="text" class="form-control input-lg" value="" name="txt_editar_producto" required id="txt_editar_producto">
	        			</div>	
        				<span class="error txt_editar_producto"></span>
	        		</div>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="button" class="btn btn-success pull-right" id="btn_editar_producto" name="btn_editar_producto">Editar Productos</button>
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
<!-- <script src="<?php //echo JS?>producto.js"></script> -->
<script src="<?php echo AJAX?>ajax_producto.js"></script>