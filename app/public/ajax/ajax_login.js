//CALL
//----------------------------------------------------
$('#frm_login').on('click', '#btn_logeo', logeo);
//----------------------------------------------------
//FUNCTIONS
// ----------------------------------------------------
function logeo(event) {
    event.preventDefault();
    $('.input-error').text('');
    $('.input-error').css('color', '#000000');
    let url = $("#frm_login").attr('action');
    var data = $("#frm_login").serialize();
    $.ajax({
        url: url,
        data: data,
        method: 'post',
        dataType: 'json',
        success: function(call) {
            //correct
            if (call.status == 1) {
                window.location.href = call.msj;
            }
            //incorrect
            if (call.status == 2) {
                $('#caracter-error').text(call.msj);
                $('#caracter-error').css('color', '#D71910');
            }
            //empty
            if (call.status == 3) {
                $.each(call.msj, function(k, v) {
                    $('.' + k).text(v);
                    $('.' + k).css('color', '#D71910');
                });
            }
            //character special
            if (call.status == 4) {
                $('#caracter-error').text(call.msj);
                $('#caracter-error').css('color', '#D71910');
            }
        },
        error: function() {},
    });
}
//------------------------------------------------