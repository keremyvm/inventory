<div class="content-wrapper"> <!-- start path ...............-->
   <section class="content-header"> 
<h1>Gestion de usuarios</h1>
    <section class="content">


<h1>Usuarios</h1>
<div class="box-header with-border">
	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-usuario">Agregar usuario</button>
</div>
<div class="box-body">
	<!-- <div class="table-responsive"> -->
	<table class="table table-bordered table-striped  dt-responsive tabla">
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Usuario</th>
				<th>Foto</th>
				<th>Perfil</th>
				<th>Estado</th>
				<th>Ultimo Login</th>
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
<div id="modal-agregar-usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" enctype="multipart/form-data" name="form_nuevo_usuario" id="form_nuevo_usuario">
	      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Agregar Usuarios</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input name -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-user"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Nombre" name="txt_nuevo_nombre" required id="txt_nuevo_nombre">
	        			</div>	
        				<span class="error txt_nuevo_nombre"></span>
	        		</div>
	        		<!-- input user -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-key"></i></span>
	        				<input type="text" class="form-control input-lg" placeholder="Ingrese Usuario" name="txt_nuevo_usuario" required id="txt_nuevo_usuario">
	        			</div>	
        				<span class="error txt_nuevo_usuario"></span>
	        		</div>
	        		<!-- input password -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-lock"></i></span>
	        				<input type="password" class="form-control input-lg" placeholder="Ingrese Contraseña" name="txt_nuevo_password" required id="txt_nuevo_password">
	        			</div>	
        				<span class="error txt_nuevo_password"></span>
	        		</div>
	        		<!-- select perfil -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon"><i class="fa fa-users"></i></span>
	        				<select name="cbo_nuevo_perfil" id="cbo_nuevo_perfil" class="form-control input-lg">
	        					<option value="">Seleccionar Perfil</option>
	        					<option value="administrador">Administrador</option>
	        					<option value="especial">Especial</option>
	        					<option value="vendedor">Vendedor</option>
	        				</select>
	        			</div>
	        			<span class="error cbo_nuevo_perfil"></span>
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

	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="submit" class="btn btn-primary pull-right" id="btn_guardar_usuario" name="btn_guardar_usuario">Guardar Usuario</button>
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
<div id="modal-editar-usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form action="" role="form" method="post" enctype="multipart/form-data" name="form_editar_usuario" id="form_editar_usuario">
    		<input type="hidden" id="txt_editar_id" name="txt_editar_id">
	      <div class="modal-header" style="background-color:#f39c12;">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Editar Usuarios</h4>
	      </div>
	      <div class="modal-body">
	        	<div class="box-body">
	        		<!-- input name -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-user"></i></span>
	        				<input type="text" class="form-control input-lg" value="" name="txt_editar_nombre" required id="txt_editar_nombre">
	        			</div>	
        				<span class="error txt_editar_nombre"></span>
	        		</div>
	        		<!-- input user -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-key"></i></span>
	        				<input type="text" class="form-control input-lg" value="" name="txt_editar_usuario" required id="txt_editar_usuario">
	        			</div>	
        				<span class="error txt_editar_usuario"></span>
	        		</div>
	        		<!-- input password -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon input-icono"><i class="fa fa-lock"></i></span>
	        				<input type="password" class="form-control input-lg" placeholder="Ingrese Nueva Contraseña" name="txt_editar_password" required id="txt_editar_password">
	        				<input type="hidden" id="txt_password_actual" name="txt_password_actual">
	        			</div>	
        				<span class="error txt_editar_password"></span>
	        		</div>
	        		<!-- select perfil -->
	        		<div class="form-group">
	        			<div class="input-group">
	        				<span class="input-group-addon"><i class="fa fa-users"></i></span>
	        				<select name="cbo_editar_perfil" id="cbo_editar_perfil" class="form-control input-lg">
	        					<option value="" id="value_editar_perfil"></option>
	        					<option value="administrador">Administrador</option>
	        					<option value="especial">Especial</option>
	        					<option value="vendedor">Vendedor</option>
	        				</select>
	        			</div>	
	        		</div>
	        		<!-- input photo -->
	        		<div class="form-group">
	        			<div class="panel">SUBIR FOTO</div>
	        			<input type="file" name="file_editar_foto" class="file_foto" id="file_editar_foto">
	        			<p class="help-block">Peso máximo de la foto 2MB</p>
	        			<img src="<?php echo IMG?>usuarios/default/anonymous.png" alt="" class="img-thumbnail previsualizar" width="200px">
	        			<input type="hidden" id="txt_foto_actual" name="txt_foto_actual">
	        		</div>

	        	</div>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	        	<button type="button" class="btn btn-success pull-right" id="btn_editar_usuario" name="btn_editar_usuario">Editar Usuario</button>
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
<script src="<?php echo JS?>usuario.js"></script>
<script src="<?php echo AJAX?>ajax_usuario.js"></script>