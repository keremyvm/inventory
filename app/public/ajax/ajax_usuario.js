//CALL
$('#form_nuevo_usuario').on('click', '#btn_guardar_usuario', guardar_usuario);
$('#tbl_tbody').on('click', '.btnEditarUsuario', mostrar_editar_usuario);
$('#form_editar_usuario').on('click', '#btn_editar_usuario', editar_usuario);
$('#tbl_tbody').on('click', '.btn_activar', activar_usuario);
var cnt = 1;
$('#form_nuevo_usuario').on('change', '#txt_nuevo_usuario', validar_repetir_usuario);
$('#tbl_tbody').on('click', '.btnEliminarUsuario', eliminar_usuario);
//----------------------------------------------------
//LOAD
$(document).ready(function() {
    mostrar_usuario();
});
//----------------------------------------------------
//FUNCTIONS
function guardar_usuario(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/usuario/guardar_usuario';
    // var data = $("#form_nuevo_usuario").serialize();
    var data = new FormData();
    data.append('file_nuevo_foto', $("#file_nuevo_foto")[0].files[0]);
    data.append('cbo_nuevo_perfil', $("#cbo_nuevo_perfil").val());
    data.append('txt_nuevo_nombre', $("#txt_nuevo_nombre").val());
    data.append('txt_nuevo_usuario', $("#txt_nuevo_usuario").val());
    data.append('txt_nuevo_password', $("#txt_nuevo_password").val());
    $.ajax({
        url: url,
        data: data,
        method: 'post',
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(call) {
            $(".error").text("");
            $("#txt_nuevo_nombre,#txt_nuevo_usuario,#txt_nuevo_password,#cbo_nuevo_perfil").css("border", "1px solid #d2d6de");
            //success
            if (call.status == 1) {
                swal({
                    type: "success",
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = "http://127.0.0.1/inventory/usuario";
                        mostrar_usuario();
                    }
                });
            }
            //create directory
            if (call.status == 2) {
                swal({
                    type: "error",
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = "http://127.0.0.1/inventory/usuario";
                    }
                });
            }
            //empty
            if (call.status == 3) {
                $.each(call.msj, function(k, v) {
                    // if (!k == 'file_nuevo_foto') {
                    $('.' + k).text(v);
                    $('#' + k).css('border', '1px solid #E43E3E');
                    $('.' + k).css('color', '#E43E3E');
                    $('.file_nuevo_foto').text(call.msj.txt_file_nuevo_foto);
                    $('.file_nuevo_foto').css('color', '#E43E3E');
                    // console.log(call.msj.txt_file_nuevo_foto);
                });
            }
            //character
            if (call.status == 4) {
                swal({
                    type: "error",
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = "http://127.0.0.1/inventory/usuario";
                    }
                });
            }
            //not img
            if (call.status == 5) {
                swal({
                    type: "error",
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = "http://127.0.0.1/inventory/usuario";
                    }
                });
            }
        },
        error: function() {},
    });
}
//-------------------------------------------------------
function mostrar_usuario() {
    // event.preventDefault();
    var url = 'http://127.0.0.1/inventory/usuario/mostrar_usuario';
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
                    // console.log(call.user);
                    if (call.user == v.usuario) {
                        tablita += '<tr style="background-color:yellow;">';
                        tablita += '<td>' + v.id + '</td>';
                        tablita += '<td>' + v.nombre + '</td>';
                        tablita += '<td>' + v.usuario + '</td>';
                        if (v.foto != "") tablita += '<td><img src="' + v.foto + '" alt="" width="40px"></td>';
                        else tablita += '<td><img src="<?php echo IMG?>usuarios/default/anonymous.png" alt="" width="40px"></td>';
                        tablita += '<td>' + v.perfil + '</td>';
                        if (v.estado == 1) tablita += '<td><button class="btn btn-success btn-xs btn_activar" id="activo" id_usuario=' + v.id + ' estado_usuario=0>activado</button></td>';
                        else if (v.estado == 0) tablita += '<td><button class="btn btn-danger btn-xs btn_activar" id="desactivo" id_usuario=' + v.id + ' estado_usuario=1>desactivado</button></td>';
                        tablita += '<td>' + v.ultimo_login + '</td>';
                        tablita += '<td><div class="btn-group"><button class="btn btn-warning btnEditarUsuario" title="modificar" idUsuario=' + v.id + ' data-toggle="modal" data-target="#modal-editar-usuario"><i class="fa fa-pencil"></i></button>';
                        tablita += '<button class="btn btn-danger btnEliminarUsuario" title="eliminar" data-toggle="modal" data-target="#modal-eliminar-usuario" idUsuario="' + v.id + '" fotoUsuario="' + v.foto + '" Usuario="' + v.usuario + '"><i class="fa fa-times"></i></button></div></td>';
                        tablita += '</tr>';
                    } else {
                        tablita += '<tr>';
                        tablita += '<td>' + v.id + '</td>';
                        tablita += '<td>' + v.nombre + '</td>';
                        tablita += '<td>' + v.usuario + '</td>';
                        if (v.foto != "") tablita += '<td><img src="' + v.foto + '" alt="" width="40px"></td>';
                        else tablita += '<td><img src="<?php echo IMG?>usuarios/default/anonymous.png" alt="" width="40px"></td>';
                        tablita += '<td>' + v.perfil + '</td>';
                        if (v.estado == 1) tablita += '<td><button class="btn btn-success btn-xs btn_activar" id="activo" id_usuario=' + v.id + ' estado_usuario=0>activado</button></td>';
                        else if (v.estado == 0) tablita += '<td><button class="btn btn-danger btn-xs btn_activar" id="desactivo" id_usuario=' + v.id + ' estado_usuario=1>desactivado</button></td>';
                        tablita += '<td>' + v.ultimo_login + '</td>';
                        tablita += '<td><div class="btn-group"><button class="btn btn-warning btnEditarUsuario" title="modificar" idUsuario=' + v.id + ' data-toggle="modal" data-target="#modal-editar-usuario"><i class="fa fa-pencil"></i></button>';
                        tablita += '<button class="btn btn-danger btnEliminarUsuario" title="eliminar" data-toggle="modal" data-target="#modal-eliminar-usuario" idUsuario="' + v.id + '" fotoUsuario="' + v.foto + '" Usuario="' + v.usuario + '"><i class="fa fa-times"></i></button></div></td>';
                        tablita += '</tr>';
                    }
                });
                $('#tbl_tbody').html(tablita);
                datatable();
            }
        }
    });
}
//-------------------------------------------------------
function mostrar_editar_usuario() {
    var url = 'http://127.0.0.1/inventory/usuario/mostrar_editar_usuario';
    var idUsuario = $(this).attr('idUsuario');
    var data = new FormData();
    data.append('idUsuario', idUsuario);
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(call) {
            // console.log(call.msj);
            $("#txt_editar_usuario").attr("readonly", true);
            // console.log(call.datos.id);
            $("#txt_editar_nombre").val(call.msj.nombre);
            $("#txt_editar_usuario").val(call.msj.usuario);
            $("#value_editar_perfil").text(call.msj.perfil);
            $("#value_editar_perfil").val(call.msj.perfil);
            $("#txt_password_actual").val(call.msj.password);
            $("#txt_foto_actual").val(call.msj.foto);
            $("#txt_editar_id").val(call.msj.id);
            if (call.msj.foto != '') {
                $(".previsualizar").attr("src", call.msj.foto);
            } else {
                console.log("no hay foto");
            }
        }
    });
}
//---------------------------------------------------------
function editar_usuario(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/usuario/editar_usuario';
    var data = new FormData();
    data.append('file_editar_foto', $("#file_editar_foto")[0].files[0]);
    data.append('txt_foto_actual', $("#txt_foto_actual").val());
    data.append('txt_editar_nombre', $('#txt_editar_nombre').val());
    data.append('txt_editar_usuario', $('#txt_editar_usuario').val());
    data.append('txt_editar_password', $('#txt_editar_password').val());
    data.append('cbo_editar_perfil', $('#cbo_editar_perfil').val());
    data.append('txt_password_actual', $('#txt_password_actual').val());
    data.append('txt_editar_id', $('#txt_editar_id').val());
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
                swal({
                    type: 'success',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'cerrar',
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        mostrar_usuario();
                        // window.location = 'http://127.0.0.1/inventory/usuario';
                        $('#modal-editar-usuario').modal('hide');
                        // $('#modal-editar-usuario').remove();
                        // $('div').removeClass('modal-backdrop');
                    }
                });
            }
            if (call.status == 2 || call.status == 3) {
                swal({
                    type: "error",
                    title: call.msg,
                    showConfirmButton: true,
                    confirmButtonText: "CERRAR",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        // window.location = 'http://127.0.0.1/inventory/usuario';
                    }
                });
            }
            if (call.status == 4) {
                swal({
                    type: 'success',
                    title: call.msj,
                    showConfirmButton: true,
                    confirmButtonText: 'cerrar',
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
//---------------------------------------------------------
function activar_usuario(event) {
    event.preventDefault();
    var url = 'http://127.0.0.1/inventory/usuario/activacion_usuario';
    var id = $(this).attr('id_usuario');
    var estado = $(this).attr("estado_usuario");
    console.log(estado);
    var data = new FormData();
    //success tiene una funcion por eso no lee lo el this que esta afuera
    //por eso se crear una variable global
    var btnactivos = $(this);
    data.append("activar_id", id);
    data.append("activar_estado", estado);
    $.ajax({
        url: url,
        dataType: "json",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        cache: false,
        success: function(call) {
            console.log(this);
            if (estado == 1) {
                $(btnactivos).removeClass("btn-danger");
                $(btnactivos).addClass("btn-success");
                $(btnactivos).attr("estado_usuario", "0");
                $(btnactivos).text("activado");
            } else if (estado == 0) {
                $(btnactivos).removeClass("btn-success");
                $(btnactivos).addClass("btn-danger");
                $(btnactivos).attr("estado_usuario", "1");
                $(btnactivos).text("desactivado");
            }
        },
        complete: function(call) {}
    });
}
//------------------------------------------------
function validar_repetir_usuario(event) {
    event.preventDefault();
    $(".alert").remove();
    var url = 'http://127.0.0.1/inventory/usuario/validar_repetir_usuario';
    var data = new FormData();
    var usuario = $(this).val();
    data.append('txt_nuevo_usuario', usuario);
    $.ajax({
        url: url,
        dataType: "json",
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        cache: false,
        success: function(call) {
            if (call.status == 1) {
                $("#txt_nuevo_usuario").parent().after("<div id='validar_usuario' class='alert alert-warning'>El usuario ya existe intento (" + cnt + ")</div>");
                $(".alert").css("margin-top", "18px");
                $("#btn_guardar_usuario").attr("disabled", "true");
                cnt++;
            }
            if (call.status == 2) {
                let disabled = call.msj;
                $("#btn_guardar_usuario").removeAttr(disabled);
            }
        },
        complete: function(call) {}
    });
}
//----------------------------------------------------------
function eliminar_usuario(event) {
    event.preventDefault();
    var id = $(this).attr('idUsuario');
    var foto = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("Usuario");
    var url = 'http://127.0.0.1/inventory/usuario/eliminar_usuario';
    var data = new FormData();
    data.append('txt_eliminar_id', id);
    data.append('txt_eliminar_foto', foto);
    data.append('txt_eliminar_usuario', usuario);
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
                            title: "Se procedio a eliminar al usuario: " + call.msj,
                            showConfirmButton: true,
                            confirmButtonText: "CERRAR",
                            closeOnConfirm: false
                        }).then((result) => {
                            if (result.value) {
                                mostrar_usuario();
                                $('#modal-eliminar-usuario').modal('hide');
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