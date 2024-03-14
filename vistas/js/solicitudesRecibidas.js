
$(document).ready(function () {


  // ====================================================== //
  // ================ ACEPTAR SOLICITUD ================== //
  // ====================================================== //
  $(document).on("click", "#btnAceptarPrestamo", function () {
    let id_sa = $(this).attr('idSolicitud');


    let datos = new FormData();
    datos.append("id_sa", id_sa);
    datos.append("respuesta", 'aceptar');



    // Configurar las opciones para la solicitud Fetch
    var opciones = {
      method: 'POST', // Método HTTP
      body: datos, // Datos a enviar (FormData)
      cache: 'no-cache', // Deshabilitar la caché del navegador
    };

    // Realizar la solicitud Fetch
    fetch('ajax/solicitudesRecibidas.ajax.php', opciones)
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
        window.location = "solicitudesRecibidas";

      })
      .catch(function (error) {
        // Manejar errores de la solicitud
        console.error('Error de solicitud:', error);

        // Puedes mostrar notificaciones de error Toastr u otras acciones aquí
      });

  })


  // ====================================================== //
  // ================ RECHAZAR SOLICITUD ================== //
  // ====================================================== //
  $(document).on("click", "#btnRechazarPrestamo", function () {
    let id_sa = $(this).attr('idSolicitud');


    let datos = new FormData();
    datos.append("id_sa", id_sa);
    datos.append("respuesta", 'rechazar');



    // Configurar las opciones para la solicitud Fetch
    var opciones = {
      method: 'POST', // Método HTTP
      body: datos, // Datos a enviar (FormData)
      cache: 'no-cache', // Deshabilitar la caché del navegador
    };

    // Realizar la solicitud Fetch
    fetch('ajax/solicitudesRecibidas.ajax.php', opciones)
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
        window.location = "solicitudesRecibidas";

      })
      .catch(function (error) {
        // Manejar errores de la solicitud
        console.error('Error de solicitud:', error);

        // Puedes mostrar notificaciones de error Toastr u otras acciones aquí
      });

  })


   // ====================================================== //
  // ================ DEVOLVER ACTIVO ================== //
  // ====================================================== //
  $(document).on("click", "#btnDevolverActivo", function () {
    let id_sa = $(this).attr('idSolicitud');


    let datos = new FormData();
    datos.append("id_sa", id_sa);
    datos.append("devolver_activo", true);

    //Mensaje
    Swal.fire({
      title: '¿Desea regresar el activo?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          
 // Configurar las opciones para la solicitud Fetch
 var opciones = {
  method: 'POST', // Método HTTP
  body: datos, // Datos a enviar (FormData)
  cache: 'no-cache', // Deshabilitar la caché del navegador
};

// Realizar la solicitud Fetch
fetch('ajax/solicitudesRecibidas.ajax.php', opciones)
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
    window.location = "solicitudesRecibidas";

  })
  .catch(function (error) {
    // Manejar errores de la solicitud
    console.error('Error de solicitud:', error);

    // Puedes mostrar notificaciones de error Toastr u otras acciones aquí
  });
        
      }
  });

   

  })


});