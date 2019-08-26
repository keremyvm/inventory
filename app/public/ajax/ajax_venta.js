//CALL
//------------------------------------------------------------------
$('#tbl_tbody').on('click', 'button.btn_agregar_productos', agregar_productos);
$('#form_nuevo_venta').on('click','.remove_producto',eliminar_producto);
$('#form_nuevo_venta').on('click','.btn_agregar_productos_moviles',agregar_productos_moviles);
$('#form_nuevo_venta').on('change','.cbo_nuevo_descripcion_movil',seleccionar_productos_moviles);
$('#form_nuevo_venta').on('change','input.txt_nuevo_cantidad_producto',modificar_cantidad_venta);
$('#form_nuevo_venta').on('change','#txt_nuevo_impuesto_venta',total_con_impuesto);
$('#txt_nuevo_precio_venta').number(true,2);
$('#form_nuevo_venta').on('change','#cbo_metodo_pago',seleccionar_metodo_pago);
$('#form_nuevo_venta').on('change','.txt_nuevo_valor_efectivo',cambio_pago);
$('#form_nuevo_venta').on('change','#txt_nuevo_transaccion',cambio_transaccion);
$('#form_nuevo_venta').on('click','#btn_guardar_venta',guardar_venta);
// var auto=10001;
// $('#txt_nuevo_codigo').val(10001);
//LOAD
//----------------------------------------------------------
$(document).ready(function() {
    mostrar_id_venta();
    mostrar_cliente();
    mostrar_producto();
});
//FUNCTIONS
//--------------------------------
function mostrar_id_venta() {
	// $('#txt_nuevo_codigo').val(10000);
    var url = 'http://127.0.0.1/inventory/venta/mostrar_id_venta';
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: '',
        success: function(call) 
        {
	    	if (!call.msj) 
	    	{
	    		$('#txt_nuevo_codigo').val(Number(10001));
	    	}
	    	else
	    	{
	    		$('#txt_nuevo_codigo').val(Number(call.msj)+1);
	    	}
        }
    });
}
//-----------------------------------
function mostrar_cliente() {
    var url = 'http://127.0.0.1/inventory/venta/mostrar_cliente';
    var combito = '<option value="">Seleccionar Cliente</option>';
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: '',
        success: function(call) {
            $.each(call.msj, function(k, v) {
                combito += '<option value="' + v.id + '">' + v.nombre + '</option>';
            });
            $('#cbo_nuevo_cliente').html(combito);
        }
    });
}
//-----------------------------------
function mostrar_producto() {
    var url = 'http://127.0.0.1/inventory/venta/mostrar_producto';
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: '',
        success: function(call) {
            if (call.status == 1) {
                var tablita = '';
                // var color='';
                $.each(call.msj, function(k, v) {
                    tablita += '<tr>';
                    tablita += '<td>' + v.id + '</td>';
                    tablita += '<td><img src="' + v.imagen + '" width="40"></td>';
                    tablita += '<td>' + v.codigo + '</td>';
                    tablita += '<td>' + v.descripcion + '</td>';
                    tablita += '<td>' + v.stock + '</td>';
                    tablita += '<td><button class="btn btn-info btn_agregar_productos recuperar_productos" title="agregar" id_productos="' + v.id + '">Agregar</button></div></td>';
                    tablita += '</tr>';
                });
                $('#tbl_tbody').html(tablita);
                datatable();
            }
        }
    });
}
//-----------------------------------
//agrega los productos que se van a comprar y desabilita su mismo boton
function agregar_productos() {
    var url = 'http://127.0.0.1/inventory/venta/mostrar_id_producto';
    var id_productos = $(this).attr('id_productos');
    // var data = {
    //     id_productos: id_productos
    // };
    var data = new FormData();
    data.append('id_productos', id_productos);
    $(this).removeClass('btn_agregar_productos btn-info');
    $(this).addClass('btn-default');
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        contentType: false,
        processData: false,
        cache: false,
        success: function(call) {
    	if (call.msj.stock>0) 
    	{
        		$('.nuevo_producto').append(
		'<div class="row">'+
			'<div class="col-xs-6" style="padding-right:0px;">'+
				'<div class="input-group">'+
						'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs remove_producto " id_productos="'+id_productos+'"><i class="fa fa-times"></i></button></span>'+
						'<input type="text" class="form-control txt_nuevo_producto" value="'+call.msj.descripcion+'" id_productos="'+id_productos+'" name="txt_nuevo_producto" id="txt_nuevo_producto" placeholder="Ingrese Producto">'+
					'</div>'+
				'</div>'+
				'<div class="col-xs-3 ingreso_precio_stock">'+
					'<input type="number" min="1" placeholder="0" class="form-control txt_nuevo_cantidad_producto" value="1" stock="'+call.msj.stock+'" name="txt_nuevo_cantidad_producto" id="txt_nuevo_cantidad_producto" nuevo_stock="'+Number(call.msj.stock-1)+'">'+
				'</div>'+
				'<div class="col-xs-3 ingreso_precio_venta" style="padding-left:0px;">'+
					'<div class="input-group">'+
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
						'<input type="text" min="1" placeholder="00000" class="form-control txt_nuevo_precio_producto" precio_real="'+call.msj.precio_venta+'" value="'+call.msj.precio_venta+'" name="txt_nuevo_precio_producto" id="txt_nuevo_precio_producto" readonly>'+
				'</div>'+
			'</div>'+
		'</div>');
        		$('#txt_nuevo_precio_venta').val(call.msj.precio_venta);
    	}
    	else
    	{
    		swal({
                    type: 'error',
                    title: 'No hay stock disponible',
                    showConfirmButton: true,
                    confirmButtonText: 'cerrar',
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                    	$('button[id_productos="'+id_productos+'"]').removeClass('btn-default');
                    	$('button[id_productos="'+id_productos+'"]').addClass('btn-info btn_agregar_productos');
                    }
                });
    	}
    	sumar_total_precios();
    	total_con_impuesto();
    	listar_productos();
    	$('.txt_nuevo_precio_producto').number(true,2);
    }
});
}
//--------------------------------------------------------------
var id_remover_producto=[];
localStorage.removeItem('remove_producto');
//---------------------------------------------------------------
// change al datatable
$('.tablas').on('draw.dt',function(){

if (localStorage.getItem('remove_producto')!=null) {
	var listar_id_productos = JSON.parse(localStorage.getItem('remove_producto'));
	for (var i = 0; i < listar_id_productos.length; i++) {
		console.log(listar_id_productos);
		$('button.recuperar_productos[id_productos="'+listar_id_productos[i]["id_productos"]+'"]').removeClass('btn-default');
		$('button.recuperar_productos[id_productos="'+listar_id_productos[i]["id_productos"]+'"]').addClass('btn-info btn_agregar_productos');						
	}
}
});
//--------------------------------------------------------------
//elimina los productos que no desea y habilita otra vez su boton de agregar
function eliminar_producto()
{
	var padre=$(this).parent().parent().parent().parent().remove();
	var id=$(this).attr('id_productos');
	// almacenar en el storage el id del producto
	if (localStorage.getItem('remove_producto')==null) 
	{
		id_remover_producto=[];
	}
	else
	{
		id_remover_producto.concat(localStorage.getItem('remove_producto'));
	}
	id_remover_producto.push({'id_productos':id});
	localStorage.setItem('remove_producto',JSON.stringify(id_remover_producto));
	//-------------------------------------
	$('button.recuperar_productos[id_productos="'+id+'"]').removeClass('btn-default');
	$('button.recuperar_productos[id_productos="'+id+'"]').addClass('btn-info btn_agregar_productos');
	if ($('.nuevo_producto').children().length==0) 
	{
		$('#txt_nuevo_precio_venta').val(0);
		$('#txt_nuevo_precio_venta').attr('total',0);
		$('#txt_nuevo_impuesto_venta').val(0);
	}
	else
	{
	sumar_total_precios();
	total_con_impuesto();
	listar_productos();
	}
}
//------------------------------------------------------------
var number_product=0;
function agregar_productos_moviles()
{
	number_product++;
	 var url = 'http://127.0.0.1/inventory/venta/mostrar_producto';
	 var id_productos = $('.btn_agregar_productos').val();
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: '',
        success: function(call) {
        $('.nuevo_producto').append(
		'<div class="row">'+
		'<!-- input descripcion -->'+
			'<div class="col-xs-6" style="padding-right:0px;">'+
				'<div class="input-group">'+
						'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs remove_producto" id_productos><i class="fa fa-times"></i></button></span>'+
						'<select id_productos="'+id_productos+'" class="form-control cbo_nuevo_descripcion_movil txt_nuevo_producto" id="cbo_nuevo_descripcion_movil'+number_product+'" name="cbo_nuevo_descripcion_movil" required>'+
						'<option>Seleccione un producto</option>'+
						'</select>'+
					'</div>'+
				'</div>'+
				'<!-- input cantidad -->'+
				'<div class="col-xs-3 ingreso_precio_stock">'+
					'<input type="number" min="1" placeholder="0" class="form-control txt_nuevo_cantidad_producto" value="1" stock name="txt_nuevo_cantidad_producto" id="txt_nuevo_cantidad_producto" nuevo_stock="'+Number(call.msj.stock-1)+'">'+
				'</div>'+
				'<!-- input precio -->'+
				'<div class="col-xs-3 ingreso_precio_venta" style="padding-left:0px;">'+
					'<div class="input-group">'+
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
						'<input type="text" min="1" placeholder="" class="form-control txt_nuevo_precio_producto" precio_real="" value="" name="txt_nuevo_precio_producto" id="txt_nuevo_precio_producto" >'+
				'</div>'+
			'</div>'+
			'</div>');
        // console.log(number_product);
			//---
			call.msj.forEach(functionfor);
			function functionfor(k,v)
			{
				if (k.stock!=0) 
				{
				$('#cbo_nuevo_descripcion_movil'+number_product).append(
					'<option id_productos="'+k.id+'" value="'+k.id+'">'+k.descripcion+'</option>'
				);	
				}
			}
			sumar_total_precios();
			total_con_impuesto();
			$('.txt_nuevo_precio_producto').number(true,2);
        }
    });
}
//------------------------------------------------------------
function seleccionar_productos_moviles()
{
 	var url = 'http://127.0.0.1/inventory/venta/mostrar_id_producto';
	var id_productos=$(this).val();
	//---
	var txt_nuevo_precio_producto = $(this).parent().parent().parent().children('.ingreso_precio_venta').children().children('.txt_nuevo_precio_producto');
	var txt_nuevo_stock_producto = $(this).parent().parent().parent().children('.ingreso_precio_stock').children('.txt_nuevo_cantidad_producto');
	// console.log(txt_nuevo_precio_producto);
	// console.log(txt_nuevo_stock_producto);
	//---
	data={
		id_productos:id_productos
	};
	$.ajax({
		url:url,
		method:'post',
		dataType:'json',
		data:data,
		success:function(call){
			$(txt_nuevo_stock_producto).attr('stock',call.msj.stock);
			$(txt_nuevo_stock_producto).attr('nuevo_stock',Number(call.msj.stock)-1);
			txt_nuevo_precio_producto.val(call.msj.precio_venta);
			txt_nuevo_precio_producto.attr('precio_real',call.msj.precio_venta);
			listar_productos();
		}
	});	
}
//-----------------------------------------
function modificar_cantidad_venta()
{
	var precio=$(this).parent().parent().children('.ingreso_precio_venta').children().children('.txt_nuevo_precio_producto');
	var precio_final=$(this).val() * precio.attr('precio_real');
	// console.log(precio_final);
	precio.val(precio_final);
	var nuevo_stock = Number($(this).attr('stock')) - $(this).val();
	$(this).attr('nuevo_stock',nuevo_stock);
	if (Number($(this).val())>Number($(this).attr('stock'))) 
	{
		$(this).val(1);
		var precio_final_venta=$(this).val()*precio.attr('precio_real');
		precio.val(precio_final_venta);
		swal({
			title:'la cantidad supera el stock',
			text : 'solo hay '+$(this).attr('stock')+' unidades',
			type:'error',
			confirmButtonText:'cerrar!'
		}).then((result)=>{

		});
	}
	sumar_total_precios();
	total_con_impuesto();
	listar_productos();
}
//-------------------------------------------
function sumar_total_precios()
{
	var precio_item=$('.txt_nuevo_precio_producto');
	var array=[];
	for (var i = 0; i < precio_item.length; i++) 
	{
		array.push(Number($(precio_item[i]).val()));
	}


//------------------------------------------
function suma_array_precios(total,numero)
{
	return total+numero;
}
var suma_total_precio = array.reduce(suma_array_precios);
// console.log('total: '+sumar_total_precio);
$('#txt_nuevo_precio_venta').val(suma_total_precio);
$('#txt_nuevo_precio_venta').attr('total',suma_total_precio);
}
//-------------------------------
function total_con_impuesto()
{
	var impuesto=$('#txt_nuevo_impuesto_venta').val();
	var precio_total=$('#txt_nuevo_precio_venta').attr('total');
	var precio_impuesto=Number(precio_total*impuesto/100);
	var total_impuesto=Number(precio_impuesto)+Number(precio_total);
	$('#txt_nuevo_precio_venta').val(total_impuesto);
	$('#txt_nuevo_impuesto_precio').val(precio_impuesto);
	$('#txt_nuevo_impuesto_neto').val(precio_total);
}
//------------------------------------
function seleccionar_metodo_pago()
{
	var pago = $(this).val();
	if (pago=='Efectivo') 
	{
		$(this).parent().parent().removeClass('col-xs-6');
		$(this).parent().parent().addClass('col-xs-4');
		$(this).parent().parent().parent().children('.cbo_caja_metodo_pago').html(
		'<div class="col-xs-4">'+
			'<div class="input-group">'+
				'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
				'<input type="text" class="form-control txt_nuevo_valor_efectivo" id="txt_nuevo_valor_efectivo" name="txt_nuevo_valor_efectivo" placeholder="00000" required>'+
			'</div>'+
		'</div>'+
		'<div class="col-xs-4 capturar_cambio_efectivo">'+
			'<div class="input-group">'+
				'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
				'<input readonly type="text" class="form-control txt_nuevo_cambio_efectivo" id="txt_nuevo_cambio_efectivo" name="txt_nuevo_cambio_efectivo" placeholder="00000" required>'+
			'</div>'+
		'</div>'
			);
		$('.txt_nuevo_valor_efectivo').number(true,2);
		$('.txt_nuevo_cambio_efectivo').number(true,2);
		listar_metodo_pago();
	}
	else
	{
		$(this).parent().parent().removeClass('col-xs-4');
		$(this).parent().parent().addClass('col-xs-6');
		$(this).parent().parent().parent().children('.cbo_caja_metodo_pago').html(
				'<div class="col-xs-6" style="padding-left: 0px;">'+
					'<div class="form-group">'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" placeholder="Código de transacción" id="txt_nuevo_transaccion" name="txt_nuevo_transaccion">'+
							'<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
						'</div>'+
					'</div>'+	
				'</div>'
		);
	}
}
//-----------------------------
function cambio_pago()
{
	var efectivo = $(this).val();
	var cambio = Number(efectivo) - Number($('#txt_nuevo_precio_venta').val());
	// $('#txt_nuevo_cambio_efectivo').val(cambio);
	var nuevo_cambio_efectivo = $(this).parent().parent().parent().children('.capturar_cambio_efectivo').children().children('.txt_nuevo_cambio_efectivo');
	nuevo_cambio_efectivo.val(cambio);
}
//-------------------------------
function cambio_transaccion()
{
	listar_metodo_pago();
}
//--------------------------
function listar_productos()
{
	var listado_productos=[];
	// var id = 
	var descripcion = $('.txt_nuevo_producto');
	var cantidad = $('.txt_nuevo_cantidad_producto');
	var precio = $('.txt_nuevo_precio_producto');

	// var total = 
	for (var i = 0 ; i < descripcion.length; i++) 
	{
		listado_productos.push({
			'id': $(descripcion[i]).attr('id_productos'),
			'descripcion': $(descripcion[i]).val(),
			'cantidad':$(cantidad[i]).val(),
			'stock':$(cantidad[i]).attr('nuevo_stock'),
			'precio':$(precio[i]).attr('precio_real'),
			'total':$(precio[i]).val()
		});

	}
	console.log('listar_productos: ',JSON.stringify(listado_productos));
	$('#listado_productos').val(JSON.stringify(listado_productos));
	}
//-------------------------------
function listar_metodo_pago()
{
	if ($('#cbo_metodo_pago').val()=='Efectivo') 
	{
		$('#listar_metodo_pago').val('Efectivo');
	}
	else
	{
		$('#listar_metodo_pago').val($('#cbo_metodo_pago').val()+'-'+$('#txt_nuevo_transaccion').val());
	}
}
//-----------------------------
function guardar_venta()
{
	var url = 'http://127.0.0.1/inventory/venta/guardar_venta';
	data=
	{
		txt_increment : $('#txt_increment').val(),
		id : $('#txt_nuevo_codigo').val(),
		cliente : $('#cbo_nuevo_cliente').val(),
		vendedor : $('#txt_vendedor_id').val(),
		productos : $('#listado_productos').val(),
		impuesto : $('#txt_nuevo_impuesto_precio').val(),
		neto : $('#txt_nuevo_impuesto_neto').val(),
		total : $('#txt_nuevo_precio_venta').val(),
		metodo_pago : $('#listar_metodo_pago').val()
	}
	$.ajax({
		url : url,
		dataType : 'json',
		method : 'post',
		data : data,
		success : function(call)
		{
			swal({
                    type: 'success',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        mostrar_id_venta();
                    	window.location='http://127.0.0.1/inventory/venta';
                    }
                });
		}
	});
}	