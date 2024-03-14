$(document).ready(function () {

 //ABRIR EL CUADRO DE DIALOGO DE SELECCION DE IMAGEN
  $(document).on('click', "#imagenPreview" , function () {
    document.getElementById("editarFoto_config").click();
  });



 let inputFile = document.getElementById("editarFoto_config");
 inputFile.addEventListener("change", mostrarImagenSeleccionada);


  function mostrarImagenSeleccionada() {
 
    let input = document.getElementById("editarFoto_config");
    let preview = document.getElementById("imagenPreview");

    if (input.files && input.files[0]) {
      var maxSize = 2 *1024 *1024;
      if (input.files[0].size > maxSize) {
        toastr["error"]("!La imagen debe ser menor o igual a 2mb¡", "Error");
      }else{
        if (input.files[0].type.startsWith("image/")) {
          
          let reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
        }else{
          toastr["error"]("!No es un archivo de imagen¡", "Error");
        }
      }
    }
  }


 



    
// ====================================================== //
// ======== MOSTRAR DATOS FORM CONFIG =================== //
// ====================================================== //
$(document).on("click", "#itemConfigPrinc", function () {
    let idUsuario = $(this).attr("iduser");
    
  
    let datos = new FormData();
    datos.append("iduser", idUsuario);
    datos.append('modalConfiguraciones', true);
  
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
        $("#editarNombre_config").val(respuesta["nombre"]);
        $("#editarUsuario_config").val(respuesta["usuario"]);
  
  
        $("#fotoActual_config").val(respuesta["foto"]);
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
// ======== VERIFICAR LA CONTRASEÑA DEL USUARIO ======== //
// ====================================================== //
$("#passwordActual_config").change(function () {
    let pass = $(this).val();
    let idUsuario = $("#itemConfigPrinc").attr("iduser"); //Accedo por el elemento a si ID y luego a su atributo
  
    let datos = new FormData();
    datos.append("validarPass", pass);
    datos.append("modalConfiguraciones", true);
    datos.append("iduser", idUsuario);
  
  
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
          alert("");
        let passwordActual = document.getElementById("passwordActual_config");
  
        // Actualizar los elementos HTML con los datos de la respuesta
        if (Object.keys(respuesta).length === 0) {
          console.log("REPUESTA VACIA");
          passwordActual.setAttribute("valido", false);
          toastr["error"]("!La contraseña no esta correcta¡", "Error");
        } else {
          passwordActual.setAttribute("valido", true);
        }
  
      })
      .catch(function (error) {
        console.log("***Error***:", error);
      });
  
  
  
  });


 





}); // /. $(document).ready(function ()