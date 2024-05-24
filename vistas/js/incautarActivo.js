var spinnerContainer = document.getElementById('spinner-container');


$(document).ready(function () {

    $(document).on('click', '#btnDevolverActivo_oe', function () {
        try {
            
            spinnerContainer.style.display = 'flex';

            let idEncautamiento = $(this).attr('idIncautamiento');
            let idPropietario = $(this).attr('idPorpietario_ia');
            let placa = $(this).attr('placa_ia');
            let idUsuario = document.getElementsByName('iduser')[0].value;

            if (idEncautamiento !== null && idUsuario !== null) {
                window.location = "index.php?ruta=incautarActivo&idIncautamiento=" + idEncautamiento + "&idUser=" + idUsuario + "&devolucion=true" + "&idPropiet=" + idPropietario + "&placa=" + placa;
            }

        } catch (error) {

        }finally{
            spinnerContainer.style.display = 'none';
       spinnerContainer = null;
        }


    })

    $(document).on('click', '#btnOcultarIncautamiento', function () {
        let idEncautamiento = $(this).attr('idIncautamiento');
        let idUsuario = document.getElementsByName('iduser')[0].value;

        if (idEncautamiento !== null && idUsuario !== null) {
            window.location = "index.php?ruta=incautarActivo&idIncautamiento=" + idEncautamiento + "&idUser=" + idUsuario + "&ocultar=true";
        }

    })


    //tabla_activosEncautados
    try {
        var tablaActivosIncautados = $("#tabla_activosIncautados");

        if (tablaActivosIncautados !== null) {
            tablaActivosIncautados.DataTable({
                columnDefs: [
                    { targets: [0], orderData: [0, 1], visible: false, searchable: false }
                ],
                dom: 'B<"row"<"col-sm-6 mt-2"l><"col-sm-6"f>>rtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        titleAttr: 'Exportar a Excel',
                        title: 'Historial activos encautados.',
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
                        title: 'Historial activos encautados.',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info',
                        title: 'Historial activos encautados.',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7],
                            orientation: 'landscape'
                        },

                    }

                ]
            });
        }

    } catch (error) {

    }




})