document.addEventListener('DOMContentLoaded', function () {



});

//dropdownParent: $('#modalEnviarPrestamo'),
//dropdownParent: $('.container-fluid'),

$(document).ready(function () {
    let selectFocused = false;

    $('#cmbfuncionarios_mES').select2({
        dropdownParent: $('#modalEnviarPrestamo'),
        dropdownAutoWidth: true,
        dropdownPosition: 'below'
    });



    // ====================================================== //
    // ============== // MODAL ENVIAR SOLICITUD ============= //
    // ====================================================== // 
    /**
     * Llama la funciones hasta que el modal se abra
     */
    $('#modalEnviarPrestamo').on('shown.bs.modal', function () {

        $('#cmbfuncionarios_mE').val(0);

        // Evento cuando el combobox obtiene el foco
        $('#cmbfuncionarios_mES').on('select2:open', function () {
            selectFocused = true;
        });

        // Evento cuando el combobox pierde el foco
        $('#cmbfuncionarios_mES').on('select2:close', function () {
            selectFocused = false;
        });
 


    $('#cmbfuncionarios_mES').change( async function () {
        try {
            
            if (selectFocused === false) {
                return;
            }

            let idfun = $('#cmbfuncionarios_mES').val();
            let txt_usuarioRed = document.getElementById('txt_usuarioRedSolEnv')
            let receptor = document.getElementById('idFunReceptor');
            let miCombobox = document.getElementById('cmbfuncionarios_mES');
              
                receptor.value = '';
                txt_usuarioRed.value = '';

                
                const datosFun = await datosFuncionario(idfun);
               
                if (datosFun !== null) {
                    txt_usuarioRed.value = datosFun['usuario_red_funcionario'];
                    receptor.value = datosFun['id_funcionario'];
                }
        

            

        } catch (error) {

        }
    })

    });




});
