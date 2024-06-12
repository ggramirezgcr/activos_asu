
// ====================================================== //
// ========= OBTIENE LOS DATOS DE UN FUNCIONARIO ======== //
// ====================================================== //
async function datosFuncionario(idFuncionario) {
  try {
   
    datos = new FormData();

    datos.append('idFun', idFuncionario);
    datos.append('datosFuncionarios', true);

    const respuesta = await fetch("ajax/funcionarios.ajax.php", {
      method: "POST",
      body: datos,
      cache: "no-cache",
      headers: {
        // Puedes ajustar los encabezados según tus necesidades
        // En este caso, estamos enviando datos en formato FormData
      },
    });

    if (!respuesta.ok) {
      const errorData = {
        ok: false,
        status: respuesta.status,
        statusText: respuesta.statusText
      };
      throw errorData; 
    }

    const text = await respuesta.text(); // Obtener el texto de la respuesta
    const trimmedText = text.trim(); // Eliminar espacios en blanco adicionales
    const data = JSON.parse(trimmedText); // Intentar analizar la respuesta como JSON

    return data;

  } catch (error) {
    throw error;
  }

}

document.addEventListener('DOMContentLoaded', function () {



})

$(document).ready(function () {


  // ====================================================== //
  // =================== CARGAR USUARIO DE RED============= //
  // ====================================================== //

  function obtenerUsuarioRed(idFuncionario_) {
    let idfuncionario = idFuncionario_;
    let nuevoUsuario = document.getElementById('nuevoUsuario');
    let nuevoNombre = document.getElementById('nuevoNombre');
    let txt_usuarioRedSolEnv = document.getElementById('txt_usuarioRedSolEnv');

    let datos = new FormData();


    datos.append('idFuncionario', idfuncionario);

    // Configurar la solicitud Fetch
    fetch("ajax/funcionarios.ajax.php", {
      method: "POST",
      body: datos,
      cache: "no-cache",
      headers: {
        // Puedes ajustar los encabezados según tus necesidades
        // En este caso, estamos enviando datos en formato FormData
      },
    })
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Error en la llamada");
        }
        return response.json();
      })
      .then(function (respuesta) {

        // Actualizar los elementos HTML con los datos de la respuesta
        if (nuevoUsuario) {

          //Formulario de nuevo usuario
          $("#nuevoUsuario").val(respuesta["usuario_red_funcionario"]);
          $("#nuevoNombre").val(respuesta["nombre_funcionario"]);

          $("#nuevoEmail").val(respuesta["usuario_red_funcionario"] + "" + '@ccss.sa.cr');

        } if (txt_usuarioRedSolEnv) {

          //Formulario de solicitudes enviadas
          $("#idFunReceptor").val(respuesta["id_funcionario"]);
          $("#txt_usuarioRedSolEnv").val(respuesta["usuario_red_funcionario"]);
        }
      })
      .catch(function (error) {
        console.log("***Error***:", error);
      });



  }


  function comprobarUsuarioRed() {

    let usuario = $("#nuevoUsuario").val();

    let datos = new FormData();
    datos.append("validarUsuario", usuario);


    // Configurar la solicitud Fetch
    fetch("ajax/usuario.ajax.php", {
      method: "POST",
      body: datos,
      cache: "no-cache",
      headers: {
        // Puedes ajustar los encabezados según tus necesidades
        // En este caso, estamos enviando datos en formato FormData

      },
    })
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Error en la llamada");
        }
        return response.json();
      })
      .then(function (respuesta) {

        // Actualizar los elementos HTML con los datos de la respuesta
        if (Object.keys(respuesta).length === 0) {
          console.log("REPUESTA VACIA");
        } else {
          toastr["error"]("!El usuario ya se encuentra registrado¡", "Error");
          $("#nuevoUsuario").val("");
        }

      })
      .catch(function (error) {
        console.log("***Error***:", error);
      });


  }

  // ====================================================== //
  // ============== // MODAL AGREGAR USUARIO ============= //
  // ====================================================== // 
  /**
   * Llama la funciones hasta que el modal se abra
   */
  $('#modalAgregarUsuario').on('shown.bs.modal', function () {

    $('#cmbfuncionarios').val(0);

    $('#cmbfuncionarios').change(function () {
      var idfun = $('#cmbfuncionarios').val();
      obtenerUsuarioRed(idfun);
    })

  });






})










