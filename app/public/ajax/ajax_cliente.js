//CALL
$('#form_nuevo_cliente').on('click', '#btn_guardar_cliente', guardar_cliente);
$('#tbl_tbody').on('click', '.btnEditarCliente', mostrar_editar_cliente);
$('#form_editar_cliente').on('click', '#btn_editar_cliente', editar_cliente);
$('#tbl_tbody').on('click', '.btnEliminarCliente', eliminar_cliente);
//----------------------------------------------
//LOAD
$(document).ready(function() {
    mostrar_cliente();
});
//-----------------------------------
//FUNCTIONS
function guardar_cliente(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/cliente/guardar_cliente';
    var data = $('#form_nuevo_cliente').serialize();
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        success: function(call) {
            $('.error').text('');
            $('#txt_nuevo_nombre, #txt_nuevo_documento, #txt_nuevo_email, #txt_nuevo_telefono, #txt_nuevo_direccion, #txt_nuevo_fecha_nacimiento').css('border', '1px solid #d2d6de');
            if (call.status == 1) {
                swal({
                    type: 'success',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'CERRAR',
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {}
                });
            }
            //---
            if (call.status == 2) {
                $.each(call.msj, function(k, v) {
                    $('.' + k).text(v);
                    $('#' + k).css('border', '1px solid #E43E3E');
                    $('.' + k).css('color', '#E43E3E');
                });
            }
            //---
            if (call.status == 3) {
                swal({
                    type: 'error',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {}
                });
            }
            //---
        }
    });
}
//--------------------------------------------------------
function mostrar_cliente() {
    var url = 'http://127.0.0.1/inventory/cliente/mostrar_cliente';
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
                    tablita += '<td>' + v.nombre + '</td>';
                    tablita += '<td>' + v.documento + '</td>';
                    tablita += '<td>' + v.email + '</td>';
                    tablita += '<td>' + v.telefono + '</td>';
                    tablita += '<td>' + v.direccion + '</td>';
                    tablita += '<td>' + v.fecha_nacimiento + '</td>';
                    tablita += '<td>' + v.compras + '</td>';
                    tablita += '<td>0000-00-00 00:00:00</td>';
                    tablita += '<td>' + v.fecha + '</td>';
                    tablita += '<td><div class="btn-group"><button class="btn btn-warning btnEditarCliente" idCliente=' + v.id + ' title="modificar" data-toggle="modal" data-target="#modal-editar-cliente"><i class="fa fa-pencil"></i></button>';
                    tablita += '<button class="btn btn-danger btnEliminarCliente" id_cliente=' + v.id + ' title="eliminar" data-toggle="modal" data-target="#modal-eliminar-cliente"><i class="fa fa-times"></i></button></div></td>';
                    tablita += '</tr>';
                });
                $('#tbl_tbody').html(tablita);
                datatable();
            }
        }
    });
}
//----------------------------------------------------------
function mostrar_editar_cliente() {
    var url = 'http://127.0.0.1/inventory/cliente/mostrar_editar_cliente';
    var idCliente = $(this).attr('idCliente');
    var data = new FormData();
    data.append('idCliente', idCliente);
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function(call) {
            $('#txt_editar_nombre').val(call.msj.nombre);
            $('#txt_editar_documento').val(call.msj.documento);
            $('#txt_editar_email').val(call.msj.email);
            $('#txt_editar_telefono').val(call.msj.telefono);
            $('#txt_editar_direccion').val(call.msj.direccion);
            $('#txt_editar_fecha_nacimiento').val(call.msj.fecha_nacimiento);
            $("#txt_editar_id").val(call.msj.id);
        }
    });
}
//--------------------------------------------------------------
function editar_cliente(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/cliente/editar_cliente';
    var data = $('#form_editar_cliente').serialize();
    $.ajax({
        url: url,
        data: data,
        dataType: 'json',
        method: 'post',
        success: function(call) {
            swal({
                type: 'success',
                title: call.msj,
                showConfirmButton: true,
                confirmButtonText: 'CERRAR',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    $('#modal-editar-cliente').modal('hide');
                    mostrar_cliente();
                }
                // window.location = 'http://127.0.0.1/inventory/categoria';
            });
        }
    });
}
//------------------------------------------------------
function eliminar_cliente(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/cliente/eliminar_cliente';
    var id = $(this).attr('id_cliente');
    var data = {
        txt_eliminar_id: id
    };
    swal({
        type: 'warning',
        title: 'Esta seguro de realizar esta accion',
        text: 'Se procedera ha realizar la operacion',
        showCancelButton: true,
        confirmButtonText: 'Si, borrar usuario',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#39CFEA',
        cancelButtonColor: '#F15325'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                data: data,
                method: 'post',
                dataType: 'json',
                success: function(call) {
                    if (call.status == 1) {
                        swal({
                            type: 'info',
                            title: 'Se procedio a eliminar al cliente: ' + call.msj,
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false
                        }).then((result) => {
                            if (result.value) {
                                $('#modal-eliminar-cliente').modal('hide');
                                mostrar_cliente();
                            }
                        });
                    }
                }
            });
        }
        //-------------
    });
}