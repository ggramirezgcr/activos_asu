
$(document).ready(function () {



  // ====================================================== //
  // =================== EDITAR USUARIO =================== //
  // ====================================================== //
  $(document).on("click", "#btnActivosDevueltosXFecha", function (event) {
    event.preventDefault(); // Evita que el formulario se envíe y recargue la página

    if (document.getElementsByName('from_date')[0].value == null || document.getElementsByName('from_date')[0].value == "" || 
        document.getElementsByName('to_date')[0].value == null || document.getElementsByName('to_date')[0].value == "") {
      msj_toastr("", "Debe seleccionar una fecha para el campo del día que quiere que comience la busqueda y otra fecha para el campo hasta el día.","i");
      return;
    }

    let fechaInicio = formatearFechaParaMySQL(document.getElementsByName('from_date')[0].value);
    let fechaFin = formatearFechaParaMySQL(document.getElementsByName('to_date')[0].value, false);
    let iduser = document.getElementsByName('iduser')[0].value;


    let datos = new FormData();
    datos.append("fechaInicio", fechaInicio);
    datos.append("fechaFin", fechaFin);
    datos.append("iduser", iduser);

    // Configurar la solicitud Fetch
    fetch("ajax/solicitudesDevueltas.ajax.php", {
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
        //alert("Hola");
        // console.log("Estos son los datos", respuesta);
        contenido_tabla(respuesta);
      })
      .catch(function (error) {
        console.log("***Error***:", error);
      });

  });


  // ====================================================== //
  // =================== FORMATEAR FECHA ================== //
  // ====================================================== //
  function formatearFecha(fecha) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    const fechaFormateada = new Date(fecha).toLocaleDateString('es-ES', options);
    return fechaFormateada;
  }


  // ====================================================== //
  // ============= FORMATEAR FECHA PARA MYSQL ============= //
  // ====================================================== //
  function formatearFechaParaMySQL(fecha, inicial = true) {
    const fechaObj = new Date(fecha);

    const año = fechaObj.getFullYear();
    const mes = ('0' + (fechaObj.getMonth() + 1)).slice(-2);  // Se agrega 1 porque los meses comienzan desde 0
    const dia = ('0' + fechaObj.getDate()).slice(-2);
    const horas = ('0' + fechaObj.getHours()).slice(-2);
    const minutos = ('0' + fechaObj.getMinutes()).slice(-2);
    const segundos = ('0' + fechaObj.getSeconds()).slice(-2);

    // return `${año}-${mes}-${dia} ${horas}:${minutos}:${segundos}`;
    if (inicial) {
      return `${año}-${mes}-${dia} ${"00"}:${"00"}:${"00"}`;
    } else {
      return `${año}-${mes}-${dia} ${"23"}:${"59"}:${"59"}`;
    }
  }



  // ====================================================== //
  // ========== IMPRIME EL CONTENIDO EN LA TABLA ========== //
  // ====================================================== //
  function contenido_tabla(respuesta) {
    let contenido = document.getElementById("contenido_tabla");
    contenido.innerHTML = "";

    let tabla = $("#tabla_activosDevueltos").DataTable();
    let spanRechazada = '<span class="badge badge-danger"></i>Rechazada</span>'

    // Limpiar la tabla antes de agregar nuevas filas
    tabla.clear().draw();

    if (Array.isArray(respuesta)) {

      // Agregar nuevas filas
      respuesta.forEach(function (fila) {
        tabla.row.add([
          fila.id_sa,
          fila.placa_activo,
          fila.detalle_categoria,
          fila.detalle_subcategoria == null ? " " : fila.detalle_subcategoria,
          fila.detalle_marca == null ? " " : fila.detalle_marca,
          fila.nombre_funcionario,
          fila.fecha_crea_sa == null ? " " : formatearFecha(fila.fecha_crea_sa),
          fila.fecha_devol_sa == null ? spanRechazada :formatearFecha(fila.fecha_devol_sa)
        ]).draw();
      });


    }
  }

});