
$(document).ready(function () {
    // ====================================================== //
    // ================= TABLA FUNCIONARIOS ================= //
    // ====================================================== //
    if ($("#tabla_Funcionarios").length) {

        debugger;
        $("#tabla_Funcionarios").DataTable({
            stateSave: false,
            paging: true,
            columns: [
                { "data": "id" },
                { "data": "nombre" },
                { "data": "usuario_red" },
                { "data": "correo_electronico" }
            ],
            ajax: {
                url: "ajax/funcionarios.ajax.php?accion=obtenerFuncionarios",
                type: "GET",
                dataSrc: ""
            }
        });
    }
})


document.addEventListener('DOMContentLoaded', function () {






})