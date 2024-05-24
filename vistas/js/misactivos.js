


// ====================================================== //
// ======== Función para inicializar la DataTable ======= //
// ====================================================== //
function inicializarTablaMisActivos() {
    // Configuración de DataTable
    $("#tabla_misactivos").DataTable({
        columnDefs: [
            { targets: [0], orderData: [0, 1], visible: false, searchable: false },//id
            { targets: [8], visible: false, searchable: false },//Descripcion
            { targets: [0], visible: false, searchable: false },//imagen
            { targets: [10], visible: false, searchable: false },//Serie
            { targets: [11], visible: false, searchable: false }//Observaciones
        ],
        dom: 'B<"row"<"col-sm-6 mt-2"l><"col-sm-6"f>>rtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                title: 'Activos',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i>',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
                title: 'Activos',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7],
                    orientation: 'landscape'
                },

            }
        ],
        initComplete: function (settings, json) {

        }
    });
}


// ====================================================== //
// =================== Document ready =================== //
// ====================================================== //
$(document).ready(function () {




    // ====================================================== //
    // ================ Inicializar DataTable =============== //
    // ====================================================== //
    if ($("#tabla_misactivos").length) {

        try {
           // var spinnerContainer = document.getElementById('spinner-container');
           /* $(document).on('preInit.dt', function () {
                // Mostrar el contenedor del spinner
                spinnerContainer.style.display = 'flex';
            });*/

            inicializarTablaMisActivos();

            /*//Ocultar spinner
            spinnerContainer.style.display = 'none';
*/

        } catch (error) {
            //Ocultar spinner
           // spinnerContainer.style.display = 'none';
            
        } finally {


        }


    }


});// /. ready
