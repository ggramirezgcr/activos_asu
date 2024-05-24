
document.addEventListener('DOMContentLoaded', function () {



  // ====================================================== //
  // =================== TABLA USUARIOS =================== //
  // ====================================================== //

  try {
    var tablaUsuarios = $("#tablaUsuarios");

    if (tablaUsuarios !== null) {
      tablaUsuarios.DataTable({
        columnDefs: [
          { targets: [0], orderData: [0, 1],  searchable: false }
        ],
        dom: 'B<"row"<"col-sm-6 mt-2"l><"col-sm-6"f>>rtip',
        buttons: [
          {
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel"></i>',
            titleAttr: 'Exportar a Excel',
            title: 'Usuarios.',
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
            title: 'Usuarios.',
            exportOptions: {
              columns: [1, 2, 3, 4, 5, 6, 7]
            }
          },
          {
            extend: 'print',
            text: '<i class="fas fa-print"></i>',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
            title: 'Usuarios.',
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




})// /. FIN 'DOMContentLoaded'



// ====================================================== //
// =========== ASIGNAR SELECT2              ============= //
// ====================================================== //
/*$(window).on('load', function () {
  $('#cmbfuncionarios').select2({});
});*/

$('.select2').select2({
  dropdownParent: $('#modalAgregarUsuario')
});



// ====================================================== //
// ================ SUBIENDO FOTO USUARIO =============== //
// ====================================================== //
$(".nuevaFoto").change(function () {
  var imagen = this.files[0];

  // ~~ VALIDAR FORMATO IMAGEN (JPG o PNG) ~ //
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

    $(".nuevaFoto").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir la imagen",
      text: "Debe ser una imagen en formato JPG o PNG!",
      confirmButtonText: "¡Cerrar!"
    })

  } else if (imagen["size"] > 2000000) {

    $(".nuevaFoto").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar mas de 2MB!",
      confirmButtonText: "¡Cerrar!"
    })

  } else {


    let datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {

      let rutaImagen = event.target.result;

      $(".previsualizar").attr("src", rutaImagen);


    });


  }
})

$(".custom-file-input").on("change", function () {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});




// ====================================================== //
// =================== EDITAR USUARIO =================== //
// ====================================================== //
$(document).on("click", ".btnEditarUsuario", function () {
  let idUsuario = $(this).attr("idUsuario");

  let datos = new FormData();
  datos.append("idUsuario", idUsuario);

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
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarUsuario").val(respuesta["usuario"]);

      $("#editarPerfil").html(respuesta["perfil"]); //Con este se selecciona la opcion en el html
      $("#editarPerfil").val(respuesta["perfil"]);

      $("#fotoActual").val(respuesta["foto"]);
      $("#passwordActual").val(respuesta["password"]);


      if (respuesta["foto"] != "") {
        $(".previsualizar").attr("src", respuesta["foto"]);
      } else {
        $(".previsualizar").attr("src", "vistas/img/usuario/default/default.png");
      }

    })
    .catch(function (error) {
      console.log("***Error***:", error);
    });

})






// ====================================================== //
// =================== ACTIVAR USUARIO ================== //
// ====================================================== //
$(document).on("click", ".btnActivar", function () {
  let idUsuario = $(this).attr('idUsuario');
  let estadoUsuario = $(this).attr('estadoUsuario');

  let datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);


  // Configurar las opciones para la solicitud Fetch
  var opciones = {
    method: 'POST', // Método HTTP
    body: datos, // Datos a enviar (FormData)
    cache: 'no-cache', // Deshabilitar la caché del navegador
  };

  // Realizar la solicitud Fetch
  fetch('ajax/usuario.ajax.php', opciones)
    .then(function (response) {
      // Verificar si la respuesta de la solicitud es exitosa (código 200)
      if (!response.ok) {
        throw new Error('Error en la solicitud: ' + response.status);
      }
      // Procesar la respuesta (por ejemplo, convertirla a JSON)
      return response.text; // Cambia esto según el tipo de respuesta que esperas
    })
    .then(function (data) {
      // Realizar acciones basadas en la respuesta del servidor (data)
      console.log('Respuesta del servidor:', data);

      // if (data['mensaje'] == 'ok') {

      Swal.fire({
        title: 'El usuario ha sido actualizado',
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'Cerrar!'
      }).then((result) => {
        if (result.value) {

          window.location = "usuarios";


        }
      })

      // }

      // Puedes mostrar notificaciones Toastr u otras acciones aquí
    })
    .catch(function (error) {
      // Manejar errores de la solicitud
      console.error('Error de solicitud:', error);

      // Puedes mostrar notificaciones de error Toastr u otras acciones aquí
    });


  if (estadoUsuario == 0) {

    $(this).removeClass('bg-teal');
    $(this).addClass('bg-gray');
    $(this).html('Descativado');
    $(this).attr('estadoUsuario', 1);

  } else {

    $(this).removeClass('bg-gray');
    $(this).addClass('bg-teal');
    $(this).html('Activado');
    $(this).attr('estadoUsuario', 0);
  }


})







// ====================================================== //
// =================== INCAUTAR ACTIVO ================== //
// ====================================================== //
$(document).on("click", ".btnIncautar", function () {
  let idUsuario = $(this).attr('idUsuario');
  let incautar = $(this).attr('incautar');
  let datos = new FormData();

  if (incautar == "1") {
    incautar = "0";
  } else {
    incautar = "1";
  }

  datos.append("iduser", idUsuario);
  datos.append("incautar", incautar);


  // Configurar las opciones para la solicitud Fetch
  var opciones = {
    method: 'POST', // Método HTTP
    body: datos, // Datos a enviar (FormData)
    cache: 'no-cache', // Deshabilitar la caché del navegador
  };

  // Realizar la solicitud Fetch
  fetch('ajax/usuario.ajax.php', opciones)
    .then(function (response) {
      // Verificar si la respuesta de la solicitud es exitosa (código 200)
      if (!response.ok) {
        throw new Error('Error en la solicitud: ' + response.status);
      }
      // Procesar la respuesta (por ejemplo, convertirla a JSON)
      return response.text; // Cambia esto según el tipo de respuesta que esperas
    })
    .then(function (data) {
      // Realizar acciones basadas en la respuesta del servidor (data)
      console.log('Respuesta del servidor:', data);

      // if (data['mensaje'] == 'ok') {

      Swal.fire({
        title: 'El usuario ha sido actualizado',
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'Cerrar!'
      }).then((result) => {
        if (result.value) {

          window.location = "usuarios";


        }
      })

      // }

      // Puedes mostrar notificaciones Toastr u otras acciones aquí
    })
    .catch(function (error) {
      // Manejar errores de la solicitud
      console.error('Error de solicitud:', error);

      // Puedes mostrar notificaciones de error Toastr u otras acciones aquí
    });


  if (estadoUsuario == 0) {

    $(this).removeClass('bg-teal');
    $(this).addClass('bg-gray');
    $(this).html('Descativado');
    $(this).attr('estadoUsuario', 1);

  } else {

    $(this).removeClass('bg-gray');
    $(this).addClass('bg-teal');
    $(this).html('Activado');
    $(this).attr('estadoUsuario', 0);
  }


})




// ====================================================== //
// ======== VERIFICAR NICK USUARIO YA REGISTRADO ======== //
// ====================================================== //
$("#nuevoUsuario").change(function () {
  let usuario = $(this).val();

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



});







// ====================================================== //
// ================== ELIMINAR USUARIO ================== //
// ====================================================== //
$(document).on("click", ".btnEliminarUsuario", function () {

  let idUsuario = $(this).attr("idUsuario");
  let fotoUsuario = $(this).attr("fotoUsuario");
  let usuario = $(this).attr("usuario");

  Swal.fire({
    title: '¿Esta seguro de eliminar el usuario?',
    text: "Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar usuario!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {

      window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario + "&fotoUsuario=" + fotoUsuario + "&usuario=" + usuario;


    }
  })

})



// ====================================================== //
// ================ LIMPIAR MODAL EDITAR ================ //
// ====================================================== //
$("#btnAgregarUsuario").click(function () {

  $(".previsualizar").attr("src", "vistas/img/usuario/default/default.png");
});



// ====================================================== //
// ============ OBTENER USUARIO LOGUEADO ================ //
// ====================================================== //
/**
  * Obtiene el valor del id del usuario logueado en el sistema
  * @returns 
  */
function obtenerUsuarioLogueado() {
  let datos = new FormData();
  datos.append("ObtenerID", "true");

  // Configurar la solicitud Fetch
  return fetch("ajax/usuario.ajax.php", {
    method: "POST",
    body: datos,
    cache: "no-cache",
    headers: {
      // Puedes ajustar los encabezados según tus necesidades
      // En este caso, estamos enviando datos en formato FormData
      // 'Content-Type': 'application/json'
    },
  })
    .then(function (response) {

      console.log("Código de estado de la respuesta HTTP:", response.status);

      if (!response.ok) {
        throw new Error("Error en la llamada obtenerUsuarioLogueado");
      }
      return response.json();
    })
    .then(function (respuesta) {

      console.log("Respuesta completa:", respuesta);

      // Verificar si la respuesta tiene el campo nIdUsuario
      if (respuesta.hasOwnProperty('nIdUsuario')) {
        const usuario = respuesta.nIdUsuario;
        console.log(respuesta);
        return usuario;
      } else {
        throw new Error("La respuesta no contiene nIdUsuario");
      }
    })
    .catch(function (error) {
      console.log("***Error en la llamada Fetch de obtenerUsuarioLogueado***:", error);
      throw error; // Propagar el error para que se maneje externamente si es necesario
    });
}//. fin obtenerUsuarioLogueado





