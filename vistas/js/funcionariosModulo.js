
$(document).ready(function () {

    cargarTabla();
    // ====================================================== //
    // ================= TABLA FUNCIONARIOS ================= //
    // ====================================================== //
    function cargarTabla() {


        if ($("#tabla_Funcionarios").length) {
            try {
                // Destruir el DataTable existente
                if ($.fn.DataTable.isDataTable('#tabla_Funcionarios')) {
                    $("#tabla_Funcionarios").DataTable().destroy();
                }

                // Opcional: limpiar el contenido de la tabla si es necesario
                $('#tabla_Funcionarios tbody').empty();


                $("#tabla_Funcionarios").DataTable({

                    stateSave: true,
                    paging: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "ajax/funcionarios.ajax.php?accion=obtenerFuncionarios_ssidep",
                        type: "GET"
                    },
                    order: [[0, 'asc']], // Ordena por la primera columna (ID) en orden ascendente por defecto
                    columns: [
                        { data: 'id_funcionario' },
                        { data: 'tipo_ced_funcionario' },
                        { data: 'cedula_funcionario' },
                        { data: 'nombre_funcionario' },
                        { data: 'usuario_red_funcionario' },
                        { data: 'estado_funcionario' },
                        {
                            data: "acciones", render: function (data, type, row) {

                                if (row.estado_funcionario == 1) {
                                    return '<div class="btn-group">' +
                                        '<button class="btn bg-maroon" id="btnEliminarFunc" id_fun="' + row.id_funcionario + '"> Eliminar</button>' +
                                        '<button class="btn bg-indigo" id="btnInabilitarFunc" id_fun="' + row.id_funcionario + '">Inhabilitar</button>' +
                                        '</div>';

                                } else {
                                    return '<div class="btn-group">' +
                                        '<button class="btn bg-maroon" id="btnEliminarFunc" id_fun="' + row.id_funcionario + '"> Eliminar</button>' +
                                        '<button class="btn bg-gray" id="btnHabilitarFunc" id_fun="' + row.id_funcionario + '">Habilitar</button>' +
                                        '</div>';
                                }


                            }
                        }
                    ],
                    columnDefs: [
                        {
                            "targets": [0, 1, 5], "visible": false, "searchable": false
                        },
                        { targets: 6, orderable: false }//Columna de botones no reordenable

                    ],
                    dom: 'B<"row"<"col-sm-6 mt-2"l><"col-sm-6"f>>rtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            titleAttr: 'Exportar a Excel',
                            title: 'Funcionarios.',
                            className: 'btn btn-success',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn btn-danger',
                            title: 'Funcionarios.',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i>',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-info',
                            title: 'Funcionarios.',
                            exportOptions: {
                                columns: [1, 2, 3],
                                orientation: 'landscape'
                            },

                        }

                    ]

                });// /. datatable

            } catch (error) {

            }

        }
    }


    // ##################################################################### //
    // ############################## EVENTOS ############################## //
    // ##################################################################### //

    // ====================================================== //
    // ================ ELIMINAR FUNCIONARIO ================ //
    // ====================================================== //
    $(document).on('click', '#btnEliminarFunc', function () {
        try {

            var idFun = $(this).attr('id_fun');
            var formData = new FormData();

            formData.append('idfun', idFun);
            formData.append('eliminarFuncionario', true);

            fetch("ajax/funcionarios.ajax.php", {
                method: "POST",
                body: formData,
                cache: "no-cache"
            })
                .then((res) => {
                    if (!res.ok) {
                        throw { ok: false, msj: "Error 404" };
                    }
                    return res.json();
                })
                .then((data) => {

                    if (data && Object.keys(data).length > 0) {
                        if (data == 'ok') {
                            msj_sweetalert('¡Eliminado!', 'El usuario se ha eliminado correctamente.', 's', '');//window.location = "index.php?ruta=funcionarios"
                            cargarTabla();
                        } else if (data == 'activos') {
                            msj_sweetalert('¡Atención!', 'No se puede eliminar este usuario por que posee activos a su nombre.', 'w', '');

                        } else {
                            msj_sweetalert('Error', 'Se ha presentado un error al intentar eliminar los datos.', 'e', '');

                        }
                    } else {
                        msj_sweetalert('Error', 'Se ha presentado un error al intentar eliminar los datos.', 'e', '');
                    }

                })
                .catch((error) => {

                })
                .finally(() => {

                })

        } catch (error) {

        }
    })// /. #btnEliminarFunc


    // ====================================================== //
    // ================ INHABILITAR FUNCIONARIO =============== //
    // ====================================================== //
    $(document).on('click', '#btnInabilitarFunc', function () {
        try {
            var idFun = $(this).attr('id_fun');
            var formData = new FormData();

            formData.append('idfun', idFun);
            formData.append('inhabilitarFuncionario', true);
            formData.append('estado', false);

            fetch("ajax/funcionarios.ajax.php", {
                method: 'POST',
                body: formData,
                cache: 'no-cache'
            })
                .then((res) => {
                    if (!res.ok) {
                        throw { ok: false, msj: 'Error 404' };
                    }
                    return res.json();
                })
                .then((data) => {

                    if (Object.keys(data) > 0) {
                        msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        throw { msj: 'json vacio' };
                    }

                    if (data) {
                        if (data == 'ok') {
                            msj_sweetalert('¡Inhabiltado!', 'El usuario ha sido inhabilitado.', 's', '');
                            cargarTabla();
                        } else if (data == 'false') {
                            msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        } else if (data == 'error') {
                            msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        } else if (data == 'activos') {
                            msj_sweetalert('¡Atención!', 'El funcionario posee activos a su nombre, por lo que no se puede proceder con dicha solicitud.', 'w', '');

                        } else if (data == 'prestamos') {
                            msj_sweetalert('¡Atención!', 'El funcionario posee uno o vacios procesos de prestamo de activo, por lo que no se puede proceder con dicha solicitud.', 'w', '');
                        }
                    } else {
                        msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        throw { msj: 'json vacio' };
                    }
                })
                .catch((error) => {
                    msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                })
                .finally({

                })

        } catch (error) {

        }
    })// /.btnInabilitarFunc


    // ====================================================== //
    // ================ HABILITAR FUNCIONARIO =============== //
    // ====================================================== //
    $(document).on('click', '#btnHabilitarFunc', function () {
        try {

            var idFun = $(this).attr('id_fun');
            var formData = new FormData();

            formData.append('idfun', idFun);
            formData.append('habilitarFuncionario', true);
            formData.append('estado', true);

            fetch("ajax/funcionarios.ajax.php", {
                method: 'POST',
                body: formData,
                cache: 'no-cache'
            })
                .then((res) => {
                    if (!res.ok) {
                        throw { ok: false, msj: 'Error 404' };
                    }
                    return res.json();
                })
                .then((data) => {

                    if (Object.keys(data) > 0) {
                        msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        throw { msj: 'json vacio' };
                    }

                    if (data) {
                        if (data == 'ok') {
                            msj_sweetalert('¡Habiltado!', 'El usuario ha sido habilitado.', 's', '');
                            cargarTabla();
                        } else if (data == 'false') {
                            msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        } else if (data == 'error') {
                            msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        } else if (data == 'prestamos') {
                            msj_sweetalert('¡Atención!', 'El funcionario posee prestamos a su nombre.', 'w', '');
                        }
                    } else {
                        msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                        throw { msj: 'json vacio' };
                    }
                })
                .catch((error) => {
                    msj_sweetalert('¡Error!', 'Error al procesar la petición.', 'e', '');
                })
                .finally({

                })

        } catch (error) {

        }
    })// /.btnHabilitarFunc



})// /. ready

