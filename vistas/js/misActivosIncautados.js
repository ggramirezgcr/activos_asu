var spinnerContainer = document.getElementById('spinner-container');


$(document).ready(function () {


    // ====================================================== //
    // ======================= POPOVER ====================== //
    // ====================================================== //

    $(function () {
        $('#popCommentIncaut').popover({
            trigger: 'hover',
            delay: { "show": 100, "hide": 500 }
        })
    })




    //tabla_activosEncautados
    try {
        var tablaActivosIncautados = $("#tabla_misactivosincautados");

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
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger',
                        title: 'Historial activos encautados.',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info',
                        title: 'Historial activos encautados.',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6],
                            orientation: 'landscape'
                        },

                    }

                ]
            });
        }

    } catch (error) {

    }
    // ====================================================== //
    // ============== BTN ACEPTAR INCAUTAMIENTO ============= //
    // ====================================================== //
    $(document).on('click', "#btn_aceptarIncautamiento", function () {
       debugger;
        
       if (spinnerContainer) {
            spinnerContainer.style.display = 'flex';
        }


            var idIncautamiento = $(this).attr('idIncautamiento');
            var idIncaut = $(this).attr('idIncaut');
            var placa = $(this).attr('placa_incaut');
            var nombre = document.getElementById('nombre_mAI').value;
            var foto = document.getElementById('foto_mAI').value;

            var formData = new FormData();

            formData.append('idIncautamiento', idIncautamiento);
            formData.append('aceptarIncaut', true);
            formData.append('incautador', idIncaut);
            formData.append('placa', placa);
            formData.append('nombre', nombre);
            formData.append('foto', foto);


            fetch("ajax/misActivosIncautados.ajax.php", {
                method: "POST",
                body: formData,
                cache: "no-cache"
            }).then((respuesta) => {
                if (!respuesta.ok) {
                    throw { ok: false, msj: "error 404" };
                }
                return respuesta.json();
            }).then((datos) => {
                if (datos && Object.keys(datos).length > 0) {
                    if (datos === 'ok') {
                        window.location = "misActivosIncautados";
                    }
                } else {
                    throw { ok: false, msj: "Datos vacíos o no es JSON" };
                }
            }).catch((error) => {
                // Ocultamos el spinner
                if (spinnerContainer) {
                    spinnerContainer.style.display = 'none';
                }
                console.log(error);
            }).finally(() => {
                // Ocultamos el spinner
                if (spinnerContainer) {
                    spinnerContainer.style.display = 'none';
                }
            });
            
    });// /. ACEPTAR INCAUTAMIENTO



    // ====================================================== //
    // ============= BTN RECHAZAR INCAUTAMIENTO ============= //
    // ====================================================== //
    $(document).on('click', "#btn_rechazarIncautamiento", async function () {
        debugger;

        if (spinnerContainer) {
            spinnerContainer.style.display = 'flex';
        }


       

            var idIncautamiento = $(this).attr('idIncautamiento');
            var idIncaut = $(this).attr('idIncaut');
            var placa = $(this).attr('placa_incaut');
            var nombre = document.getElementById('nombre_mAI').value;
            var foto = document.getElementById('foto_mAI').value;

            var formData = new FormData();

            formData.append('idIncautamiento', idIncautamiento);
            formData.append('rechazarIncaut', true);
            formData.append('incautador', idIncaut);
            formData.append('placa', placa);
            formData.append('nombre', nombre);
            formData.append('foto', foto);

            fetch("ajax/misActivosIncautados.ajax.php", {
                method: "POST",
                body: formData,
                cache: "no-cache"
            }).then((respuesta) => {
                if (!respuesta.ok) {
                    throw { ok: false, msj: "error 404" };
                }
                return respuesta.json();
            }).then((datos) => {
                if (datos && Object.keys(datos).length > 0) {
                    if (datos === 'ok') {
                        window.location = "misActivosIncautados";
                    }
                } else {
                    throw { ok: false, msj: "Datos vacíos o no es JSON" };
                }
            }).catch((error) => {
                // Ocultamos el spinner
                if (spinnerContainer) {
                    spinnerContainer.style.display = 'none';
                }
                console.log(error);
            }).finally(() => {
                // Ocultamos el spinner
                if (spinnerContainer) {
                    spinnerContainer.style.display = 'none';
                }
            });
      
    }); // /.RECHAZAR INCAUTAMIENTO



})