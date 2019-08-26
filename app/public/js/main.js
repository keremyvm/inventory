 $(document).ready(function() {
     $('.sidebar-menu').tree();
 });
 //-----------------------
 // function datatable() {
 //     $('.tabla').DataTable({
 //         //"responsive": true,
 //         retrieve: true,
 //         language: {
 //             processing: "Procesando...",
 //             search: "Buscar: ",
 //             lengthMenu: "Mostrar _MENU_ registros.",
 //             info: "Mostrar del   _START_   al   _END_   de un total de   _TOTAL_   registros.",
 //             infoEmpty: "Mostrar del 0 al 0 de un total de 0 registros.",
 //             infoFiltered: "(Filtrando un total de _MAX_ registros.)",
 //             infoPostFix: "",
 //             loadingRecords: "Cargando...",
 //             zeroRecords: "No se encontraron resultados.",
 //             emptyTable: "Ningun dato disponible en esta tabla",
 //             paginate: {
 //                 first: "primero",
 //                 previous: "Atrás",
 //                 next: "Siguiente",
 //                 last: "último"
 //             },
 //             aria: {
 //                 sortAscending: ": Activar para ordenar la columna en orden ascendente.",
 //                 sortDescending: ": Activar para ordenar la columna en orden descendente"
 //             }
 //         }
 //     });
 // }
 //-----------------------------------------------------
 //-----------------------
 //iCheck for checkbox and radio inputs
 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
     checkboxClass: 'icheckbox_minimal-blue',
     radioClass: 'iradio_minimal-blue'
 })
 //Red color scheme for iCheck
 // $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
 //     checkboxClass: 'icheckbox_minimal-red',
 //     radioClass: 'iradio_minimal-red'
 // })
 // //Flat red color scheme for iCheck
 // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
 //     checkboxClass: 'icheckbox_flat-green',
 //     radioClass: 'iradio_flat-green'
 // })