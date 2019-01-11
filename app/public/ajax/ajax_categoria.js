//LOAD
$(document).ready(function() {
    mostrar_categoria();
});
//--------------------------------CALL
$('#form_nuevo_categoria').on('click', '#btn_guardar_categoria', guardar_categoria);
$('#tbl_tbody').on('click', '.btnEditarCategoria', mostrar_editar_categoria);
$('#form_editar_categoria').on('click', '#btn_editar_categoria', editar_categoria);
//--------------------------------FUNCTIONS
function guardar_categoria(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/categoria/guardar_categoria';
    var categoria = $('#txt_nuevo_categoria').val();
    var data = {
        txt_nuevo_categoria: categoria
    }
    $.ajax({
        url: url,
        data: data,
        method: 'post',
        dataType: 'json',
        success: function(call) {
            $(".error").text('');
            $('#txt_nuevo_categoria').focus();
            if (call.status == 1) {
                swal({
                    type: 'success',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'CERRAR',
                    closeOnConfirm: false
                }).then((result) => {
                    mostrar_categoria();
                    $('#txt_nuevo_categoria').val('');
                });
            }
            if (call.status == 2) {
                $.each(call.msj, function(k, v) {
                    $('.' + k).text(v);
                    $('.' + k).css('color', 'red');
                    $('#' + k).val('');
                });
            }
            if (call.status == 3) {
                swal({
                    type: 'error',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'CERRAR',
                    closeOnConfirm: false
                }).then((result) => {
                    $('#txt_nuevo_categoria').val('');
                });
            }
        }
    });
}
//------------------------------------------------------------------
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
                var tablita = '';
                $.each(call.msj, function(k, v) {
                    tablita += '<tr>';
                    tablita += '<td>' + v.id + '</td>';
                    tablita += '<td>' + v.categoria + '</td>';
                    tablita += '<td><div class="btn-group"><button class="btn btn-warning btnEditarCategoria" id_categoria=' + v.id + ' title="modificar" data-toggle="modal" data-target="#modal-editar-categoria"><i class="fa fa-pencil"></i></button>';
                    tablita += '<button class="btn btn-danger" title="eliminar" data-toggle="modal" data-target="#modal-eliminar-categoria"><i class="fa fa-times"></i></button></div></td>';
                    tablita += '</tr>';
                });
                $('#tbl_tbody').html(tablita);
                datatable();
            }
        }
    });
}
//--------------------------------------------------------------------------
function mostrar_editar_categoria() {
    var url = 'http://127.0.0.1/inventory/categoria/mostrar_editar_categoria';
    var id = $(this).attr('id_categoria');
    var data = {
        id: id
    }
    $.ajax({
        url: url,
        data: data,
        dataType: 'json',
        method: 'post',
        success: function(call) {
            $('#txt_editar_id').val(call.msj.id);
            $('#txt_editar_categoria').val(call.msj.categoria);
        }
    });
}
//----------------------------------------------------------------------------
function editar_categoria() {
    var url = 'http://127.0.0.1/inventory/categoria/editar_categoria';
    var data = {
        txt_editar_categoria: $('#txt_editar_categoria').val(),
        id: $('#txt_editar_id').val()
    }
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
                window.location = 'http://127.0.0.1/inventory/categoria';
            });
        }
    });
}