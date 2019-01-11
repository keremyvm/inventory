$(document).ready(function() {
    ver_imagen();
    // datatable();
});
//----------------------------------------------------
function datatable() {
    $('.tabla').DataTable({
        //"responsive": true,
        retrieve: true,
        language: {
            processing: "Procesando...",
            search: "Buscar: ",
            lengthMenu: "Mostrar _MENU_ registros.",
            info: "Mostrar del   _START_   al   _END_   de un total de   _TOTAL_   registros.",
            infoEmpty: "Mostrar del 0 al 0 de un total de 0 registros.",
            infoFiltered: "(Filtrando un total de _MAX_ registros.)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados.",
            emptyTable: "Ningun dato disponible en esta tabla",
            paginate: {
                first: "primero",
                previous: "Atrás",
                next: "Siguiente",
                last: "último"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna en orden ascendente.",
                sortDescending: ": Activar para ordenar la columna en orden descendente"
            }
        }
    });
}
//-----------------------------------------------------
function ver_imagen() {
    $(".file_foto").change(function() {
        var img = this.files[0];
        // console.log(img);
        if (img['type'] != "image/jpeg" && img['type'] != "image/png") {
            swal({
                title: "Error al subir la imagen",
                text: "La imagen debe estar en formato jpg o png",
                type: "error",
                confirmButtonText: "Cerrar!"
            });
        } else if (img['size'] > 20000000) {
            swal({
                title: "Error al subir la imagen",
                text: "La imagen no debe pesar mas de 2MB",
                type: "error",
                confirmButtonText: "Cerrar!"
            });
        } else {
            var dataimg = new FileReader;
            dataimg.readAsDataURL(img);
            $(dataimg).on("load", function(event) {
                var rutaimg = event.target.result;
                // console.log(rutaimg);s
                $(".previsualizar").attr("src", rutaimg);
            });
        }
    });
}
//--------------------------------------------------