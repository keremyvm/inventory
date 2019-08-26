function datatable() {
    $('.tablas').DataTable({
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
//-------------------------------------------------------------------------------
//save fecha en el storage
    if (localStorage.getItem('capturarRango')!=null) 
    {
        $('#daterange-btn span').html(localStorage.getItem('capturarRango'));
    }
    else
    {
        $('#daterange-btn span').html('<span>'+
                                        '<i class="fa fa-calendar">&nbsp;&nbsp;&nbsp;Rango de Fecha</i>'+
                                    '</span>');   
    }
//Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        var fechaInicial = start.format('YYYY-M-D');
        var fechaFinal = end.format('YYYY-M-D');
        var capturarRango = $('#daterange-btn span').html();
        // console.log('capturar-rango',capturarRango);
        localStorage.setItem('capturarRango',capturarRango);
      }
    );
//click cancelar eliminar storage
$('.daterangepicker .range_inputs').on('click','.cancelBtn',limpiar_storage_fecha);
function limpiar_storage_fecha()
{
    localStorage.removeItem('capturarRango');
    localStorage.clear();
}
