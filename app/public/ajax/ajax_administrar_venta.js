//CALL
$(document).on('click','.btnEditarVenta',go_venta);
// $('#tbl_tbody').on('click','.btnImprimirVenta',imprimir_factura);
//---------------------------------
//LOAD
$(document).ready(function() {
    mostrar_venta();
    // datatable_producto();
});
//------------------------------
//FUNCTIONS
function mostrar_venta()
{
	var url = 'http://127.0.0.1/inventory/administrar-venta/mostrar_venta';
	$.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: '',
        success: function(call) {
            if (call.status == 1) {
                var tablita = '';
                $.each(call.msj, function(k, v) {
                    tablita += '<tr>';
                  	tablita += '<td>'+v.id+'</td>';
                  	tablita += '<td>'+v.codigo+'</td>';
                  	tablita += '<td>'+v.id_cliente+'</td>';	
                  	tablita += '<td>'+v.id_vendedor+'</td>';
                  	tablita += '<td>'+v.metodo_pago+'</td>';
                  	tablita += '<td>'+v.neto+'</td>';
                  	tablita += '<td>'+v.total+'</td>';
                  	tablita += '<td>'+v.fecha+'</td>';
                  	// tablita += '<td><div class="btn-group"><button class="btn btn-warning btnEditarVenta" id_venta="'+v.id+'" title="modificar" data-toggle="modal" data-target="#modal-editar-venta"><i class="fa fa-pencil"></i></button>';
                    tablita += '<td><button class="btn btn-danger btnEliminarVenta" title="eliminar" data-toggle="modal" data-target="#modal-eliminar-venta"><i class="fa fa-times"></i></button></div>';
                  	tablita += '<div class="btn-group"><form method="post" action="http://127.0.0.1/inventory/administrar-venta/reporte_venta" target="_blank"><input type="hidden" value="'+v.id+'" name="id_venta"><input type="hidden" value="'+v.id_cliente+'" name="id_cliente"><input type="hidden" value="'+v.id_vendedor+'" name="id_vendedor"><input type="hidden" value="'+v.productos+'" name="id_productos"><button type="submit" class="btn btn-info" title="imprimir" > </form><i class="fa fa-print"></i></button></td>';
                    tablita += '</tr>';
                });
                //---
                $('#tbl_tbody').html(tablita);
                datatable();
            }
        }
    });
}
//-----------------------------
function go_venta()
{
	window.location='http://127.0.0.1/inventory/venta';
	var id = $(this).attr('id_venta');
	console.log(id);
}
//------------------------
// function imprimir_factura()
// {
//   var url = 'http://127.0.0.1/inventory/administrar-venta/reporte_venta';
//   var id = $(this).attr('id_venta');
//   var data={
//     id:id
//   };
//   $.ajax({
//         url: url,
//         method: 'post',
//         dataType: 'html',
//         data: data,
//         success: function(call) {
//          // console.log(call);
// 	       // window.open('http://127.0.0.1/inventory/administrar-venta/reporte_venta','_blank');
//            window.location='http://127.0.0.1/inventory/administrar-venta/reporte_venta';
//         }
//     });
// }