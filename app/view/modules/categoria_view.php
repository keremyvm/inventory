<div class="content-wrapper"> <!-- start path ...............-->
   <section class="content-header"> 
<h1>Gestion de categorias</h1>
    <section class="content">


<h1>Categorias</h1>
<div class="box-header with-border">
	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-categoria">Agregar categorias</button>
</div>
<div class="box-body">
	<!-- <div class="table-responsive"> -->
	<table class="table table-bordered table-striped  dt-responsive tabla">
		<thead>
			<tr>
				<th>#</th>
				<th>Categoria</th>
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
<div id="modal-agregar-categoria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" name="form_nuevo_categoria" id="form_nuevo_categoria">
	      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Agregar Categorias</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input categoria -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-th"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Categoria" name="txt_nuevo_categoria" required id="txt_nuevo_categoria">
	        			</div>	
        				<span class="error txt_nuevo_categoria"></span>
	        		</div>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="submit" class="btn btn-primary pull-right" id="btn_guardar_categoria" name="btn_guardar_categoria">Guardar Categoria</button>
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
<div id="modal-editar-categoria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" name="form_editar_categoria" id="form_editar_categoria">
    		<input type="hidden" id="txt_editar_id" name="txt_editar_id">
	      <div class="modal-header" style="background-color:#f39c12;">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Editar Categoria</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input name -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-user"></i></span>
	        				<input type="text" class="form-control input-lg" value="" name="txt_editar_categoria" required id="txt_editar_categoria">
	        			</div>	
        				<span class="error txt_editar_categoria"></span>
	        		</div>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="button" class="btn btn-success pull-right" id="btn_editar_categoria" name="btn_editar_categoria">Editar Usuario</button>
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
<script src="<?php echo JS?>categoria.js"></script>
<script src="<?php echo AJAX?>ajax_categoria.js"></script>