
/**
 * Carga el datatable, ademas realiza algunas configuraciones de la misma
 */
function cargarDatatable() {
    if ($("#tablaMarcas").length) {
        try {
            // Destruir el DataTable existente
            if ($.fn.DataTable.isDataTable('#tablaMarcas')) {
                $("#tablaMarcas").DataTable().destroy();
            }

            // Opcional: limpiar el contenido de la tabla si es necesario
            $('#tablaMarcas tbody').empty();


            return $("#tablaMarcas").DataTable({
                stateSave: false,
                paging: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "ajax/marcas.ajax.php?accion=obtenerMarcas_sside",
                    type: "GET",
                    dataSrc: function (json) {
                        if (json.data && Array.isArray(json.data)) {
                            return json.data;
                        } else {
                            console.error("Formato de datos incorrecto:", json);
                            return [];
                        }
                    }
                },
                order: [[1, 'asc']],
                columns: [
                    { name: 'id_marca', data: 'id_marca' },
                    { name: 'detalle_marca', data: 'detalle_marca' },
                    {
                        name: "acciones", data: "acciones", render: function (data, type, row) {
                            return '<div class="btn-group">' +
                                '<button class="btn btn-warning" id="btnEditarMarca" idMarca="' + row.id_marca + '" valor="' + row.detalle_marca + '"><i class="fas fa-pencil-alt"></i></button>' +
                                '<button class="btn bg-maroon" id="btnEliminarMarca" idMarca="' + row.id_marca + '" valor="' + row.detalle_marca + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                                '</div>';
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false,
                        visible: false
                    },
                    {
                        targets: 2,
                        orderable: false
                    }
                ],
                dom: 'B<"row"<"col-sm-6 mt-2"l><"col-sm-6"f>>rtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        titleAttr: 'Exportar a Excel',
                        title: 'Marcas.',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: [1]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger',
                        title: 'Marcas.',
                        exportOptions: {
                            columns: [1]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info',
                        title: 'Marcas.',
                        exportOptions: {
                            columns: [1],
                            orientation: 'landscape'
                        },

                    }

                ]

            });// /. datatable

        } catch (error) {

        }

    }
}


$(document).ready(function () {

    let miTabla = cargarDatatable();



    // ====================================================== //
    // =============== OCULTAR VENTANA EDITAR =============== //
    // ====================================================== //
    /**
     * Oculta la ventana donde se edita
     */
    function ocultarFormEditar() {
        try {

            let rowNuevo = document.getElementById('rowNuevaMarca');
            let rowEditar = document.getElementById('rowEditarMarca');
            let txt_MarcaEditar = document.getElementById('txt_MarcaEditar');
            let btnGuardarEdicion = document.getElementById('btnGuardarMarcaEditar')

            rowNuevo.style.display = 'block';
            rowEditar.style.display = 'none'
            txt_MarcaEditar.value = '';

            txt_MarcaEditar.setAttribute('valor', '');
            btnGuardarEdicion.setAttribute('idmarca', '');

        } catch (error) {

        }
    }// /.ocultarFormEditar




    // btnGuardarMarca
    $(document).on('click', '#btnGuardarMarca', async function () {

        let strMarca = document.getElementById('txt_Marca');
        let formData = new FormData();

        if (strMarca === '' || strMarca === null) {
            return msj_toastr('¡Campo incompleto!', 'Debe completar el campo correctamente.', 'w', '');
        }

        formData.append('accion', 'nuevaMarca');
        formData.append('marca', strMarca.value);

        try {

            const respuesta = await fetch(
                "ajax/marcas.ajax.php", {
                method: "POST",
                body: formData,
                cache: "no-cache"
            });
            if (!respuesta.ok) {
                const errorData = {
                    ok: false,
                    status: respuesta.status,
                    statusText: respuesta.statusText
                }
                throw errorData;
            }

            //  debugger;
            const data = await respuesta.json();

            if (data !== null) {
                if (data == 'existe') {
                    msj_toastr('¡Ya existe!', 'La marca ya se encuentra registrada', 'w');
                } else if (data == 'error' || data == 'false') {
                    msj_toastr('¡Upps!', 'Ocurrio un problema.', 'e');
                } else if (data == 'ok') {
                    strMarca.value = '';

                    msj_toastr('', 'La marca se ha guardado correctamente.', 's');
                    miTabla = cargarDatatable();
                }
            }

        } catch (error) {
            throw error;
        } finally {

        }






    });// /. btnGuardarMarca


    // btnEliminarMarca
    $(document).on('click', '#btnEliminarMarca', async function () {
        // debugger;
        const msj = await msj_sweetalert_retorno('!Eliminar¡', '¿Desea eliminar la marca?');

        if (msj !== true) {
            return;
        }

        let idmarca = $(this).attr('idmarca')
        let formData = new FormData();

        formData.append('accion', 'eliminarMarca');
        formData.append('valor', idmarca);

        const respeuesta = await fetch("ajax/marcas.ajax.php", {
            method: "POST",
            body: formData,
            cache: "no-cache"
        });

        if (!respeuesta.ok) {
            const errorData = {
                ok: false,
                status: respeuesta.status,
                statusText: respeuesta.statusText
            }
            throw errorData;
        }

        const data = await respeuesta.json();

        if (data !== null) {
            switch (data) {

                case 'ok':
                    msj_sweetalert('!Eliminado¡', 'La marca fue elimanada.', 's', '');
                    cargarDatatable();
                    break;

                case 'error':
                    msj_sweetalert('!Upps¡', 'No se puedo eliminar la marca.', 'e', '');
                    break;
                default:
                    msj_sweetalert('!Upps¡', 'No se puedo eliminar la marca.', 'e', '');
                    break;
            }
        }



    })// /. btnEliminarMarca


    //btnEditarMarca
    $(document).on('click', '#btnEditarMarca', function () {


        let rowNuevo = document.getElementById('rowNuevaMarca');
        let rowEditar = document.getElementById('rowEditarMarca');
        let txt_MarcaEditar = document.getElementById('txt_MarcaEditar');
        let btnGuardarEdicion = document.getElementById('btnGuardarMarcaEditar')
        let nId = $(this).attr('idmarca');
        let strValor = $(this).attr('valor');


        var row = $(this).closest('tr');
        var rowIndex = miTabla.row(row).index();
        var columnIndex = miTabla.column('detalle_marca:name').index();
        var specificCellData = miTabla.cell({ row: rowIndex, column: columnIndex }).data();


        rowNuevo.style.display = 'none';
        rowEditar.style.display = 'block'

        btnGuardarEdicion.setAttribute('idmarca', nId);
        btnGuardarEdicion.setAttribute('valor', strValor);


        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Esto hace que el scroll sea suave
        });

        if (specificCellData !== null) {
            txt_MarcaEditar.setAttribute('valor', strValor)
            txt_MarcaEditar.value = strValor;
            txt_MarcaEditar.select();
        }




    })// /. btnEditarMarca

    //btnGuardarMarcaEditar
    $(document).on('click', '#btnGuardarMarcaEditar', async function () {
        let txt_MarcaEditar = document.getElementById('txt_MarcaEditar');
        let strMarca = $(this).attr('valor');
        let nIdMarca = $(this).attr('idmarca');
        let formData = new FormData();

        if (txt_MarcaEditar.value == '' || txt_MarcaEditar.value == null) {
            return msj_toastr('¡Campo incompleto!', 'Debe completar el campo correctamente.', 'w', '');
        }

        formData.append('accion', 'editarMarca');
        formData.append('marca', strMarca);
        formData.append('id', nIdMarca);
        formData.append('marcaEditada', txt_MarcaEditar.value);


        try {

            const respuesta = await fetch("ajax/marcas.ajax.php", {
                method: "POST",
                body: formData,
                cache: "no-cache"
            })

            if (!respuesta.ok) {
                const errorData = {
                    ok: false,
                    status: respuesta.status,
                    statusText: respuesta.statusText
                };

                throw errorData;
            }

            const data = await respuesta.json();

            if (data !== null) {
                switch (data) {
                    case 'ok':
                        ocultarFormEditar();
                        msj_sweetalert('!Editado¡', 'Marca editada con éxito.', 's', '');
                        miTabla = cargarDatatable();

                        break;

                    case 'existe':
                        msj_sweetalert('!Upps¡', 'El nombre de la marca ya se encuentra registrada.', 'w', '');
                        break;

                    case 'incompleto':
                        msj_sweetalert('!Upps¡', 'Los datos estan incompletos, no podemos procesar tu solicitud.', 'e', '');
                        break;

                    default:
                        msj_sweetalert('!Upps¡', 'No pudimos ejecutar tu solucitud.', 'e', '');
                        break;
                }
            } else {
                msj_sweetalert('!Upps¡', 'El servidor no responde.', 'e', '');
            }


        } catch (error) {
            throw error;
        } finally {

        }



    })// /.btnGuardarMarcaEditar

    //btnCancelarEditar
    $(document).on('click', '#btnCancelarEditar', function () {

        ocultarFormEditar();

    })// /. btnCancelarEditar


    //txt_Marca
    document.getElementById("txt_Marca").addEventListener("keydown", function (event) {
        let teclaPresionada = event.key;

        // Permitir teclas de control como Backspace, Delete, flechas, y espacio
        if (teclaPresionada === "Backspace" ||
            teclaPresionada === "ArrowLeft" ||
            teclaPresionada === "ArrowRight" ||
            teclaPresionada === "Delete" ||
            teclaPresionada === " " ||
            teclaPresionada === "Tab" || // Permitir Tabulación
            teclaPresionada === "Shift" ||
            teclaPresionada === "Control" ||
            teclaPresionada === "Meta") {
            return true;
        }

        // Validar si la tecla presionada es una letra, una vocal con tilde o un espacio
        let esLetraOespacio = /^[a-zA-ZáéíóúÁÉÍÓÚ0-9\s]$/.test(teclaPresionada);
        if (!esLetraOespacio) {
            event.preventDefault();
        }
    });// /.txt_Marca



    //txt_MarcaEditar
    document.getElementById("txt_MarcaEditar").addEventListener("keydown", function (event) {
        let teclaPresionada = event.key;

        // Permitir teclas de control como Backspace, Delete, flechas, y espacio
        if (teclaPresionada === "Backspace" ||
            teclaPresionada === "ArrowLeft" ||
            teclaPresionada === "ArrowRight" ||
            teclaPresionada === "Delete" ||
            teclaPresionada === " " ||
            teclaPresionada === "Tab" || // Permitir Tabulación
            teclaPresionada === "Shift" ||
            teclaPresionada === "Control" ||
            teclaPresionada === "Meta") {
            return true;
        }

        // Validar si la tecla presionada es una letra, una vocal con tilde o un espacio
        let esLetraOespacio = /^[a-zA-ZáéíóúÁÉÍÓÚ0-9\s]$/.test(teclaPresionada);
        if (!esLetraOespacio) {
            event.preventDefault();
        }
    });// /.txt_MarcaEditar




}); // /. ready