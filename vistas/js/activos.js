
async function Buscar_activo(strPlaca, callback) {
  try {
      let datos = new FormData();

      datos.append("placa", strPlaca);
      datos.append("consultar", true);

      const respuesta = await // Configurar la solicitud Fetch
      fetch("ajax/activos.ajax.php", {
        method: "POST",
        body: datos,
        cache: "no-cache"
      });

      if (!respuesta.ok) {
        throw{ ok: false, msj:"error 404"};
      }

      const datos_devueltos = await respuesta.json();
      callback(datos_devueltos);

  } catch (error) {
    console.log(error);
    callback(null);
  }
}

$(document).ready(function () {


  //Asignar el boton de choose file al btn  escanear codigo
  /* $(document).on('click', "#btnScanearQrMCA", function (event) {
     event.preventDefault(); // Evita que el formulario se envíe y recargue la página
     document.getElementById("scanearQR").click();
 
        document.getElementById('scanearQR').addEventListener('change', leer_QR);
 
    // document.getElementById("card_principal").style.display = "block";
     //document.getElementById("card_scan_camara").style.display = "none";
   });*/


  //  Esta funcion leer el codigo QR cuando se le pasa el archivo de imagen  //
  function leer_QR(event) {
    try {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (event) {
        const imgData = event.target.result;
        const qrCodeScanner = new Html5Qrcode('qrResult');
        qrCodeScanner.scanFile(file)
          .then(decodedText => {
            document.getElementById("txt_placaBuscarMCA").value = decodedText;
            document.getElementById("btnBuscarActivoMCA").click();
          })
          .catch(err => {
            msj_toastr("Error", 'Error decodificando QR: ' + err.message, 'e');
          });
      };
      reader.readAsDataURL(file);
      event.preventDefault();

    } catch (error) {
      event.preventDefault();
      console.log(error);
    } finally {
      document.getElementById("card_principal").style.display = "block";
    }

  }



 


  // ====================================================== //
  // ================== CONSULTAR ACTIVO ================== //
  // ====================================================== //
  $(document).on("click", "#btnBuscarActivo", function () {
    let placa = document.getElementById("txt_placaBuscar").value;
    let datos = new FormData();

    datos.append("placa", placa);
    datos.append("consultar", true);

    //Limpiar campos
    $("#txt_codigoPlaca").val("");
    $("#txt_Placa").val("");
    $("#txt_Propietario").val("");
    $('#txt_categoria').val("");
    $('#txt_Marca').val("");
    $('#txt_Modelo').val("");
    $('#txt_detalle').val("");
    $('#txt_subCategoria').val("");
    $('#txt_localizacion').val("");
    $('#txt_ubicacion').val("");
    $('#txt_placaBuscar').val("");



    // Configurar la solicitud Fetch
    fetch("ajax/activos.ajax.php", {
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

        $("#txt_codigoPlaca").val(respuesta['id_activo']);
        $("#txt_Placa").val(respuesta["placa_activo"]);
        $("#txt_Propietario").val(respuesta['nombre_funcionario']);
        $('#txt_categoria').val(respuesta["detalle_categoria"]);
        $('#txt_Marca').val(respuesta["detalle_marca"]);
        $('#txt_Modelo').val(respuesta["detalle_modelo"]);
        $('#txt_detalle').val(respuesta["descripcion_activo"]);
        $('#txt_subCategoria').val(respuesta['detalle_subcategoria']);
        $('#txt_localizacion').val(respuesta['detalle_localizacion']);
        $('#txt_ubicacion').val(respuesta['detalle_ubicacion']);
        $('#txt_Observaciones').val(respuesta['observacion_activo']);
        $('#txt_placaBuscar').val("");

      })
      .catch(function (error) {
        console.log("***Error***:", error);
      });

  });



  // ====================================================== //
  // ================== CONSULTAR ACTIVO ================== //
  // ====================================================== //
  $(document).on("click", "#btnBuscarActivoMCA", function () {
    let placa = document.getElementById("txt_placaBuscarMCA").value;
    let datos = new FormData();

    datos.append("placa", placa);
    datos.append("consultar", true);

    //Limpiar campos
    $("#txt_codigoPlacaMCA").val("");
    $("#txt_PlacaMCA").val("");
    $("#txt_PropietarioMCA").val("");
    $('#txt_categoriaMCA').val("");
    $('#txt_MarcaMCA').val("");
    $('#txt_ModeloMCA').val("");
    $('#txt_detalleMCA').val("");
    $('#txt_subCategoriaMCA').val("");
    $('#txt_localizacionMCA').val("");
    $('#txt_ubicacionMCA').val("");
    $('#txt_placaBuscarMCA').val("");



    // Configurar la solicitud Fetch
    fetch("ajax/activos.ajax.php", {
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

        if (Object.keys(respuesta).length === 0) {
          msj_toastr("Error", "No se encontro el activo.", 'e');
        }

        $("#txt_codigoPlacaMCA").val(respuesta['id_activo']);
        $("#txt_PlacaMCA").val(respuesta["placa_activo"]);
        $("#txt_PropietarioMCA").val(respuesta['nombre_funcionario']);
        $('#txt_categoriaMCA').val(respuesta["detalle_categoria"]);
        $('#txt_MarcaMCA').val(respuesta["detalle_marca"]);
        $('#txt_ModeloMCA').val(respuesta["detalle_modelo"]);
        $('#txt_detalleMCA').val(respuesta["descripcion_activo"]);
        $('#txt_subCategoriaMCA').val(respuesta['detalle_subcategoria']);
        $('#txt_localizacionMCA').val(respuesta['detalle_localizacion']);
        $('#txt_ubicacionMCA').val(respuesta['detalle_ubicacion']);
        $('#txt_ObservacionesMCA').val(respuesta['observacion_activo']);
        $('#txt_placaBuscarMCA').val("");

      })
      .catch(function (error) {
        console.log("***Error***:", error);
      });

  });


  // ====================================================== //
  // ================== CONSULTAR ACTIVO ================== //
  // ====================================================== //
 /* $(document).on("click", "#btnBuscarActivo_mEA", function () {
   /~ debugger;~/
    let placa = document.getElementById("txt_placaBuscar_mEA").value;
    let datos = new FormData();

    datos.append("placa", placa);
    datos.append("consultar", true);

    //Limpiar campos
    $("#txt_codigoPlaca_mEA").val("");
    $("#txt_Placa_mEA").val("");
    $("#txt_Propietario_mEA").val("");
    $('#txt_categoria_mEA').val("");
    $('#txt_Marca_mEA').val("");
    
    $('#txt_detalle_mEA').val("");
    $('#txt_subCategoriaMCA').val("");
   
    $('#txt_placaBuscarMCA').val("");



    // Configurar la solicitud Fetch
    fetch("ajax/activos.ajax.php", {
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

        if (Object.keys(respuesta).length === 0) {
          msj_toastr("Error", "No se encontro el activo.", 'e');
        }
        $("#txt_codigoPlaca_mEA").val(respuesta['id_activo']);
        $("#txt_Placa_mEA").val(respuesta["placa_activo"]);
        $("#txt_Propietario_mEA").val(respuesta['nombre_funcionario']);
        $('#txt_categoria_mEA').val(respuesta["detalle_categoria"]);
        $('#txt_Marca_mEA').val(respuesta["detalle_marca"]);
        
        $('#txt_detalle_mEA').val(respuesta["descripcion_activo"]);
        $('#txt_subCategoria_mEA').val(respuesta['detalle_subcategoria']);
        
        $('#txt_placaBuscar_mEA').val("");

      })
      .catch(function (error) {
        console.log("***Error***:", error);
      });

  });*/




  // ====================================================== //
  // =================== EDITAR USUARIO =================== //
  // ====================================================== //
  $(document).on("click", "#btnBuscarPlaca", function () {
    let placaBuscar = document.getElementById('txt_placaBuscar');
    let strPlacaBuscar = placaBuscar.value;

    if (strPlacaBuscar.length === 0) {
      msj_toastr("Error", "Debe ingresar un número de placa de activo.", 'e');
      return;
    }

    // Obtener el usuario logueado
    obtenerUsuarioLogueado().then(async usuario => {
      if (usuario !== null) {

        let datos = new FormData();
        datos.append("strPlacaBuscar", strPlacaBuscar);

        try {
          // Configurar la solicitud Fetch
          const response = await fetch("ajax/activos.ajax.php", {
            method: "POST",
            body: datos,
            cache: "no-cache",
            headers: {
              // 'Content-Type': 'application/json'
            },
          });

          if (!response.ok) {
            throw new Error("Error en la llamada");
          }

          const respuesta = await response.json();

          if (respuesta != false) {
            if (usuario !== respuesta["id_funcionario"]) {
              msj_toastr("Error", "La placa ingresada no corresponde a ninguno de sus activos.", 'w');
              return;
            }
          } else {
            msj_toastr("Upps!", "Algo salió mal, no encontramos el activo, puedes intentar ingresar la placa del activo nuevamente.", 'w');
          }

          // Llamar a la función y asignar el resultado a una variable
          const activoPrestado = await ActivoEnPrestamo(respuesta["id_activo"]);

          if (activoPrestado == true || activoPrestado == false) {

            if (activoPrestado === true) {
              msj_toastr('Activo en prestamo', 'El activo ya se encuentra en prestamo', 'w');
              return;
            }
          } else {
            msj_toastr("Error", "Parece que tuvimos un problema.", 'e');
            return;
          }

          // Resto del código para actualizar elementos HTML
          $("#txt_codigoPlaca").val(respuesta['id_activo']);
          $("#txt_Placa").val(respuesta["placa_activo"]);
          $('#txt_categoria').val(respuesta["detalle_categoria"]);
          $('#txt_Marca').val(respuesta["detalle_marca"]);
          $('#txt_Modelo').val(respuesta["detalle_modelo"]);
          $('#txt_detalle').val(respuesta["descripcion_activo"]);
          $('#txt_subCategoria').val(respuesta['detalle_subcategoria']);
          $('#txt_localizacion').val(respuesta['detalle_localizacion']);
          $('#txt_ubicacion').val(respuesta['detalle_ubicacion']);
          $('#txt_placaBuscar').val("");

        } catch (error) {
          msj_toastr("***Error en la llamada Fetch ***:" + error, "", "e");
        }

      } else {
        console.log("No hay usuario en la sesión");
        msj_toastr("No hay usuario en la sesión", "", 'e');
      }
    }).catch(error => {
      console.log("Error:", error);
    });
  });





  // ====================================================== //
  // ================= ACTIVO EN PRESTAMO ================= //
  // ====================================================== //
  /**
   * Verifica si el activo esta en prestamo o no
   * @returns 
   */
  async function ActivoEnPrestamo(nCodActivo) {
    try {
      let datos = new FormData();
      datos.append("idActivo", nCodActivo);

      const response = await fetch("ajax/activos.ajax.php", {
        method: "POST",
        body: datos,
        cache: "no-cache",
        headers: {
          // Puedes ajustar los encabezados según tus necesidades
          // En este caso, estamos enviando datos en formato FormData
          // 'Content-Type': 'application/json'
        },
      });

      console.log("Código de estado de la respuesta HTTP:", response.status);

      if (!response.ok) {
        throw new Error("Error en la llamada Activo en prestamo");
      }

      const respuesta = await response.json();

      if (respuesta[0].hasOwnProperty('id_activo')) {
        
        if (respuesta[0]['respta_receptor_sa'] == '0') {
          return false;
        }else{
          return respuesta[0]['devuelto_sa'] == '0';
        }
      } else {
        throw new Error("La respuesta no contiene id_activo");
      }
    } catch (error) {
      console.log("***Error en la llamada Fetch de Activo en prestamo***:", error);
      return false; // o null, dependiendo de tu lógica
    }
  }




  // ====================================================== //
  // ================= MOSTRAR DATOS DE TABLA EN CAMPOS==== //
  // ====================================================== //

  let miTabla = $("#tabla_activos").DataTable();

  if (miTabla) {
    $('#tabla_activos tbody').on('click', 'tr', function () {
      // Obtiene los datos de la fila clicada
      // alert('Hola')
      let datos = miTabla.row(this).data();

      $("#lbl_categoria").text(datos[2]);
      $("#lbl_subcategoria").text(datos[3]);
      $("#lbl_placa").text(datos[1]);
      $("#lbl_marca").text(datos[4]);
      $("#lbl_modelo").text(datos[5]);
      $("#lbl_serie").text(datos[10]);
      $("#lbl_descripcion").text(datos[8]);
      $("#lbl_ubicacion").text(datos[6]);
      $("#lbl_localizacion").text(datos[7]);
      $("#lbl_observacion").text(datos[12]);
      //$("#imgActivo").attr('src', 'data:image/jpeg;base64,' + datos[9]);

      DatosDelActivo(datos[1]);


    })


  }





  // ====================================================== //
  // ===================IMAGEN DEL ACTIVO === //
  // ====================================================== //
  function DatosDelActivo(placaActivo) {

    var imgElement = document.getElementById("imgActivo");

    imgElement.onload = function () {
      console.log("La imagen se ha cargado completamente.");
      // Cualquier operación adicional que dependa de la carga completa de la imagen
    };
    // Crear un objeto FormData para enviar datos al servidor
    let datos = new FormData();
    datos.append("placaActivo", placaActivo);
    datos.append("datosDelActivo", true);

    // Obtener la etiqueta img por su ID
    var imgElement = document.getElementById("imgActivo");

    // Limpiar la etiqueta img estableciendo el atributo src en una cadena vacía
    imgElement.src = "";

    // Configurar la solicitud Fetch
    fetch("ajax/activos.ajax.php", {
      method: "POST",
      body: datos,
      cache: "no-cache",
    })
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Error en la llamada (" + response.status + ")");
        }

        // Verificar el tipo de contenido de la respuesta
        const contentType = response.headers.get("content-type");

        if (contentType && contentType.includes("image")) {
          // Si la respuesta es una imagen, devolver la promesa BLOB
          return response.blob();
        } else {
          // Si la respuesta no es una imagen, manejar según tu lógica específica
          throw new Error("La respuesta no es una imagen");
        }
      })
      .then(function (blobData) {

        console.log(blobData);
        // Si los datos son BLOB, manejarlos como una imagen
        var url = window.URL.createObjectURL(blobData);

        // Limpiar la URL de la imagen anterior antes de asignar la nueva URL
        // $("#imgActivo").attr("src", "");
        // $("#imgActivo").attr("src", url);
        // imgElement.src = url;

        // Opcional: Manejar el evento load de la imagen
        imgElement.onload = function () {
          // Acciones después de que la imagen se ha cargado completamente
          console.log("La imagen se ha cargado completamente.");
        };
      })
      .catch(function (error) {
        console.log("Error:", error);
      });
  }




  // ====================================================== //
  // ============== // MODAL BUSCAR ACTIVO ============= //
  // ====================================================== // 
  /**
   * Al abrir el modal se procede a limpiar los campos del mismo
   */
  $('#modalConsultarActivo').on('shown.bs.modal', function () {

    //Limpiar campos
    $("#txt_codigoPlacaMCA").val("");
    $("#txt_PlacaMCA").val("");
    $("#txt_PropietarioMCA").val("");
    $('#txt_categoriaMCA').val("");
    $('#txt_MarcaMCA').val("");
    $('#txt_ModeloMCA').val("");
    $('#txt_detalleMCA').val("");
    $('#txt_subCategoriaMCA').val("");
    $('#txt_localizacionMCA').val("");
    $('#txt_ubicacionMCA').val("");
    $('#txt_placaBuscarMCA').val("");


  });


  // ====================================================== //
  // =============== MODAL CONSULTAR ACTIVO =============== //
  // ====================================================== //

  // Evitar que el modal se cierre al cargar el input type file
  $('#modalConsultarActivo').on('hide.bs.modal', function (event) {
    // event.preventDefault();
  });

  let modal = document.getElementById("modalConsultarActivo");
  let btnCloseModal = document.getElementById("btnCloseModal"); //Btn Cerrar
  //btnCloseModal.addEventListener("click", closeModal);

  // Función para cerrar el modal
  function closeModal(event) {
    // event.preventDefault(); // Evitar que el evento se propague y cierre el modal
    modal.style.display = "none";
  };

});






