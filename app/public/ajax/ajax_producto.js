//CALL
$('#form_nuevo_producto').on('change', '#cbo_nuevo_categoria', generar_codigo_producto);
$('#form_nuevo_producto').on('change', '#txt_nuevo_precio-compra,.nuevo_porcentaje', calcular_precio_venta);
$('#form_editar_producto').on('change', '#txt_editar_precio-compra,.editar_porcentaje', calcular_precio_venta_editar);
$('.porcentaje').on('ifUnchecked', desactivar_check);
$('.porcentaje').on('ifChecked', activar_check);
$('.porcentaje_editar').on('ifUnchecked', desactivar_check_editar);
$('.porcentaje_editar').on('ifChecked', activar_check_editar);
$('#form_nuevo_producto').on('click', '#btn_guardar_producto', guardar_producto);
$('#tbl_tbody').on('click', '.btnEditarProducto', mostrar_editar_producto);
$('#form_editar_producto').on('click', '#btn_editar_producto', editar_producto);
$('#tbl_tbody').on('click', '.btnEliminarProducto', eliminar_producto);
//---------------------------------
//LOAD
$(document).ready(function() {
    mostrar_producto();
    mostrar_categoria();
    mostrar_categoria_editar();
    // datatable_producto();
});
//------------------------------
//FUNCTIONS
function mostrar_producto() {
    var url = 'http://127.0.0.1/inventory/producto/mostrar_producto';
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
                    tablita += '<td>' + v.id + '</td>';
                    if (v.imagen != "") tablita += '<td><img src="' + v.imagen + '" alt="" width="40px"></td>';
                    else tablita += '<td><img src="http://127.0.0.1/inventory/app/media/img/productos/default/anonymous.png" alt="" width="40px"></td>';
                    tablita += '<td>' + v.codigo + '</td>';
                    tablita += '<td>' + v.descripcion + '</td>';
                    tablita += '<td>' + v.id_categoria + '</td>';
                    if (v.stock <= 10) {
                        tablita += '<td><button class="btn btn-danger">' + v.stock + '</button></td>';
                    } else if (v.stock > 10 && v.stock <= 15) {
                        tablita += '<td><button class="btn btn-warning">' + v.stock + '</button></td>';
                    } else {
                        tablita += '<td><button class="btn btn-success">' + v.stock + '</button></td>';
                    }
                    tablita += '<td>' + v.precio_compra + '</td>';
                    tablita += '<td>' + v.precio_venta + '</td>';
                    tablita += '<td>' + v.fecha + '</td>';
                    tablita += '<td><div class="btn-group"><button class="btn btn-warning btnEditarProducto" title="modificar" idProducto=' + v.id + ' data-toggle="modal" data-target="#modal-editar-producto"><i class="fa fa-pencil"></i></button>';
                    tablita += '<button class="btn btn-danger btnEliminarProducto" title="eliminar" data-toggle="modal" data-target="#modal-eliminar-producto" idProducto="' + v.id + '" fotoProducto="' + v.imagen + '" Producto="' + v.descripcion + '"><i class="fa fa-times"></i></button></div></td>';
                    tablita += '</tr>';
                });
                $('#tbl_tbody').html(tablita);
                datatable();
            }
        }
    });
}
//---------------------------------------------------------
function mostrar_categoria() {
    // event.preventDefault();
    var url = 'http://127.0.0.1/inventory/categoria/mostrar_categoria';
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: '',
        success: function(call) {
            if (call.status == 1) {
                var combito = '';
                combito += '<option>Seleccionar Categoria</option>';
                $.each(call.msj, function(k, v) {
                    combito += '<option value="' + v.id + '">' + v.categoria + '</option>';
                });
                $('#cbo_nuevo_categoria').html(combito);
                // console.log(combito);
            }
        }
    });
}
//------------------------------------------------------------
function mostrar_categoria_editar() {
    // event.preventDefault();
    var url = 'http://127.0.0.1/inventory/categoria/mostrar_categoria';
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: '',
        success: function(call) {
            if (call.status == 1) {
                var combito = '';
                combito += '<option>Seleccionar Categoria</option>';
                combito += '<option value="" selected id="value_editar_categoria"></option>';
                $.each(call.msj, function(k, v) {
                    combito += '<option value="' + v.id + '">' + v.categoria + '</option>';
                });
                $('#cbo_editar_categoria').html(combito);
                // console.log(combito);
            }
        }
    });
}
//------------------------------------------------------------
function generar_codigo_producto() {
    var url = 'http://127.0.0.1/inventory/producto/generar_codigo_producto';
    var id_categoria = $(this).val();
    var data = {
        id_categoria: id_categoria
    };
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        success: function(call) {
            if (!call.msj) {
                $('#txt_nuevo_codigo').val(id_categoria + '01');
            } else {
                $('#txt_nuevo_codigo').val(Number(call.msj.codigo) + 1);
            }
        }
    });
} //----------------------------------------------------
function calcular_precio_venta() {
    if ($('.porcentaje').prop('checked')) {
        var precio_compra = $('#txt_nuevo_precio-compra').val();
        var porcentaje = $('.nuevo_porcentaje').val();
        var precio_venta = Number(precio_compra * porcentaje / 100) + Number(precio_compra);
        $('#txt_nuevo_precio-venta').val(precio_venta);
        $('#txt_nuevo_precio-venta').prop('readonly', true);
    }
}
//------------------------------------------------------
function calcular_precio_venta_editar() {
    if ($('.porcentaje_editar').prop('checked')) {
        var precio_compra = $('#txt_editar_precio-compra').val();
        var porcentaje = $('.editar_porcentaje').val();
        var precio_venta = Number(precio_compra * porcentaje / 100) + Number(precio_compra);
        $('#txt_editar_precio-venta').val(precio_venta);
        $('#txt_editar_precio-venta').prop('readonly', true);
    }
}
//-------------------------------------------
function activar_check() {
    $('#txt_nuevo_precio-venta').prop('readonly', true);
    $('.nuevo_porcentaje').prop('readonly', false);
}
//-------------------------------------------
function activar_check_editar() {
    $('#txt_editar_precio-venta').prop('readonly', true);
    $('.editar_porcentaje').prop('readonly', false);
}
//-----------------------------------------------------
function desactivar_check() {
    $('#txt_nuevo_precio-venta').prop('readonly', false);
    $('.nuevo_porcentaje').val('');
    $('.nuevo_porcentaje').prop('readonly', true);
    $('#txt_editar_precio-venta').prop('readonly', false);
}
//---------------------------------------------------
function desactivar_check_editar() {
    $('#txt_editar_precio-venta').prop('readonly', false);
    $('.editar_porcentaje').val('');
    $('.editar_porcentaje').prop('readonly', true);
    $('#txt_editar_precio-venta').prop('readonly', false);
}
//-------------------------------------------------
function guardar_producto(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/producto/guardar_producto';
    var data = new FormData();
    data.append('cbo_nuevo_categoria', $('#cbo_nuevo_categoria').val());
    data.append('txt_nuevo_codigo', $('#txt_nuevo_codigo').val());
    data.append('txt_nuevo_descripcion', $('#txt_nuevo_descripcion').val());
    data.append('txt_nuevo_stock', $('#txt_nuevo_stock').val());
    data.append('txt_nuevo_precio-compra', $('#txt_nuevo_precio-compra').val());
    data.append('txt_nuevo_precio-venta', $('#txt_nuevo_precio-venta').val());
    data.append('file_nuevo_foto', $('#file_nuevo_foto')[0].files[0]);
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        processData: false,
        contentType: false,
        success: function(call) {
            $('.error').text('');
            $('#cbo_nuevo_categoria,#txt_nuevo_codigo,#txt_nuevo_descripcion,#txt_nuevo_stock,#txt_nuevo_precio-compra,#txt_nuevo_precio-venta').css("border", "1px solid #d2d6de");
            if (call.status == 1) {
                swal({
                    type: 'success',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        mostrar_producto();
                        $('#modal-agregar-producto').modal('hide');
                    }
                });
            }
            //---
            if (call.status == 2) {
                $.each(call.msj, function(k, v) {
                    $('.' + k).text(v);
                    $('#' + k).css('border', '1px solid #E43E3E');
                    $('.' + k).css('color', '#E43E3E');
                    $('.file_nuevo_foto').text(call.msj.txt_file_nuevo_foto);
                    $('.file_nuevo_foto').css('color', '#E43E3E');
                    // mostrar_categoria();
                });
            }
            //---
            if (call.status == 3) {
                swal({
                    type: 'error',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }).then((result) => {
                    // if (result.value) {
                    // mostrar_producto();
                    // $('#modal-agregar-producto').modal('hide');
                    // }
                });
            }
        }
    });
}
//-------------------------------------------------
function mostrar_editar_producto() {
    var url = 'http://127.0.0.1/inventory/producto/mostrar_editar_producto';
    var id_producto = $(this).attr('idProducto');
    var data = new FormData();
    data.append('id_producto', id_producto);
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(call) {
            if (call.status == 1) {
                $('#txt_editar_id').val(call.msj.id);
                $('#value_editar_categoria').text(call.msj.id_categoria);
                $('#value_editar_categoria').val(call.msj.id_categoria);
                $('#txt_editar_codigo').val(call.msj.codigo);
                $('#txt_editar_descripcion').val(call.msj.descripcion);
                $('#txt_editar_stock').val(call.msj.stock);
                $('#txt_editar_precio-compra').val(call.msj.precio_compra);
                $('#txt_editar_precio-venta').val(call.msj.precio_venta);
                if (call.msj.imagen != '') {
                    $('#txt_foto_actual').val(call.msj.imagen);
                    $('.previsualizar').attr('src', call.msj.imagen);
                } else {
                    console.log('no hay foto');
                }
            }
        }
    });
}
//---------------------------------------
function editar_producto(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/producto/editar_producto';
    var data = new FormData();
    data.append('file_editar_foto', $('#file_editar_foto')[0].files[0]);
    data.append('txt_foto_actual', $('#txt_foto_actual').val());
    data.append('cbo_editar_categoria', $('#cbo_editar_categoria').val());
    data.append('txt_editar_codigo', $('#txt_editar_codigo').val());
    data.append('txt_editar_descripcion', $('#txt_editar_descripcion').val());
    data.append('txt_editar_stock', $('#txt_editar_stock').val());
    data.append('txt_editar_precio-compra', $('#txt_editar_precio-compra').val());
    data.append('txt_editar_precio-venta', $('#txt_editar_precio-venta').val());
    data.append('txt_editar_id', $('#txt_editar_id').val());
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(call) {
            if (call.status == 1) {
                swal({
                    type: 'success',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'cerrar',
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        $('#modal-editar-producto').modal('hide');
                        mostrar_producto();
                    }
                });
            }
            if (call.status == 2) {
                swal({
                    type: "error",
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = 'http://127.0.0.1/inventory/usuario';
                    }
                });
            }
            if (call.status == 3) {
                swal({
                    type: "error",
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = 'http://127.0.0.1/inventory/usuario';
                    }
                });
            }
        }
    });
}
//------------------------------------------
function eliminar_producto(event) {
    event.preventDefault();
    var id = $(this).attr('idProducto');
    var foto = $(this).attr("fotoProducto");
    var producto = $(this).attr("Producto");
    var url = 'http://127.0.0.1/inventory/producto/eliminar_producto';
    var data = new FormData();
    data.append('txt_eliminar_id', id);
    data.append('txt_eliminar_foto', foto);
    data.append('txt_eliminar_descripcion', producto);
    swal({
        type: "warning",
        title: "Esta seguro de realizar esta accion",
        text: "Se procedera ha realizar la operacion",
        showCancelButton: true,
        confirmButtonText: "Si, borrar usuario",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#39CFEA",
        cancelButtonColor: "#F15325"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                processData: false,
                contentType: false,
                url: url,
                data: data,
                method: 'post',
                dataType: 'json',
                success: function(call) {
                    if (call.status == 1) {
                        swal({
                            type: "info",
                            title: "Se procedio a eliminar al producto: " + call.msj,
                            showConfirmButton: true,
                            confirmButtonText: "CERRAR",
                            closeOnConfirm: false
                        }).then((result) => {
                            if (result.value) {
                                $('#modal-eliminar-producto').modal('hide');
                                mostrar_producto();
                            }
                            // window.location = 'http://127.0.0.1/inventory/usuario';
                        });
                    }
                }
            });
            //----------------- 
        }
    });
}
//--------------------------------------
// $('.porcentaje').on('ifUnchecked', function(event) {
//     $('#txt_nuevo_precio-venta').prop('readonly', false);
//     $('.nuevo_porcentaje').val('');
//     $('.nuevo_porcentaje').prop('readonly', true);
// });
// $('.porcentaje').on('ifChecked', function(event) {
//     $('#txt_nuevo_precio-venta').prop('readonly', true);
//     $('.nuevo_porcentaje').prop('readonly', false);
// });
//-----------------------------------------------------
// function datatable_producto() {
// var url = 'app/controller/Prueba.php';
// var url = 'app/controller/Prueba.php';
// $.ajax({
//     url: url,
//     success: function(call) {
//         console.log(call);
//     }
// })
// $('.tabla_producto').DataTable({
//     "ajax": "app/controller/Prueba.php"
// "ajax": 'http://127.0.0.1/inventory/producto/datatable_producto'
// });
// }
//--------------------------------