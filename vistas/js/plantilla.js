/* ##################################################################### //
// ############################# DATATABLE    ############################# //
// ##################################################################### */
$(document).ready(function ($) {

    try {


        // ====================================================== //
        // ================== flatpickr Fechas ================== //
        // ====================================================== //
        config_fecha = {
            enableTime: false,
            dateFormat: "Y-m-d",
            altFormat: "d-m- Y",
            locale: "es"
        }
        flatpickr("input[type=date]", config_fecha);

        /*$('input[date]').datetimepicker({
            format: 'LT'
        });*/


        // ====================================================== //
        // ====================== DataTable ===================== //
        // ====================================================== //
        $.extend(true, $.fn.DataTable.defaults,
            {
                "responsive": true,
                "autoWidth": false,
                "language": {

                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }

                },
                
            })



        /* $.extend(true, $.fn.DataTable.defaults,
             {
                 "responsive": true,
                 "autoWidth": false,
                 "lengthChange": false,
                 "searching": true,
                 "paging": true,
                 "language": {
     
                     "sProcessing": "Procesando...",
                     "sLengthMenu": "Mostrar _MENU_ registros",
                     "sZeroRecords": "No se encontraron resultados",
                     "sEmptyTable": "Ningún dato disponible en esta tabla",
                     "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                     "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                     "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                     "sInfoPostFix": "",
                     "sSearch": "Buscar:",
                     "sUrl": "",
                     "sInfoThousands": ",",
                     "sLoadingRecords": "Cargando...",
                     "oPaginate": {
                         "sFirst": "Primero",
                         "sLast": "Último",
                         "sNext": "Siguiente",
                         "sPrevious": "Anterior"
                     },
                     "oAria": {
                         "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                     }
                 },
                 dom: "B",
                 buttons: [
                     {
                         extend: 'excelHtml5',
                         text: '<i class="fas fa-file-excel"></i>',
                         titleAttr: 'Exportar a Excel',
                         title: 'Lista',
                         className: 'btn btn-success',
                         exportOptions: {
                             columns: [2, 3, 4, 5]
                         }
                     },
                     {
                         extend: 'pdfHtml5',
                         text: '<i class="fas fa-file-pdf"></i>',
                         titleAttr: 'Exportar a PDF',
                         className: 'btn btn-danger',
                         title: 'Lista',
                         exportOptions: {
                             columns: [2, 3, 4, 5]
                         }
                     },
                     {
                         extend: 'print',
                         text: '<i class="fas fa-print"></i>',
                         titleAttr: 'Imprimir',
                         className: 'btn btn-info',
                         exportOptions: {
                             columns: [2, 3, 4, 5]
                         }
                     }
                 ]
             }
         );*/


        if ($("#tabla_solicitudesEnviadas").length) {

            $("#tabla_solicitudesEnviadas").DataTable({
                columnDefs: [
                    { targets: [0], orderData: [0, 1], visible: false, searchable: false }
                ]
            });
        }

        if ($("#tabla_SolicitudesRecibidas").length) {

            $("#tabla_SolicitudesRecibidas").DataTable(
                {
                    columnDefs: [
                        { targets: [0], orderData: [0, 1], visible: false, searchable: false }
                    ]
                }
            );
        }

        if ($("#tabla_activos").length) {

            $("#tabla_activos").DataTable(
                {
                    columnDefs: [
                        { targets: [0], orderData: [0, 1], visible: false, searchable: false },//id
                        { targets: [8], visible: false, searchable: false },//Descripcion
                        { targets: [0], visible: false, searchable: false },//imagen
                        { targets: [10], visible: false, searchable: false },//Serie
                        { targets: [11], visible: false, searchable: false }//Observaciones
                    ]
                }
            );
        }



        try {
            var tablaSolicitudesDevueltas = $("#tabla_activosDevueltos");

            if (tablaSolicitudesDevueltas.length) {
                // Comentamos temporalmente la inicialización de DataTables
                tablaSolicitudesDevueltas.DataTable({
                    columnDefs: [
                        { targets: [0], orderData: [0, 1], visible: false, searchable: false }
                    ]
                });
            } else {
                console.log("La tabla 'tabla_solicitudesDevueltas' no se encontró en el DOM.");
            }
        } catch (error) {
            // Manejar el error aquí, puedes imprimirlo en la consola o mostrar un mensaje al usuario
            console.error("Error en el código JavaScript:", error);
        }






    } catch (error) {
        // Manejar el error aquí, puedes imprimirlo en la consola o mostrar un mensaje al usuario
        alert("Error en el código JavaScript:" + error);
    }

});




