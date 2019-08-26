//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', {
    'placeholder': 'dd/mm/yyyy'
})
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', {
    'placeholder': 'mm/dd/yyyy'
})
//Money Euro
$('[data-mask]').inputmask();

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