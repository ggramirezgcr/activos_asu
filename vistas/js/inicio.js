$(document).ready(function () {

    let graficoCanva = document.getElementById('lineChart');

    if (graficoCanva) {
        // Puedes hacer algo aquí si el elemento canvas está presente en el DOM
        TotalActivosXCategoria();
        TotalActivosXSolicitud(); //Para traer los datos los activos pero solicitados
    }

    // ====================================================== //
    // ============ CARGAR INFORMACION DE GRAFICO =========== //
    // ====================================================== //
    function cargarGraficoInicio(respuesta) {
        try {
            // Asegúrate de que haya una respuesta válida y contenga el array necesario
            if (respuesta && typeof respuesta === 'object') {
                // Convierte el objeto a un array de sus valores
                let respuestaArray = Object.values(respuesta);

                // Verifica que ahora sea un array
                if (Array.isArray(respuestaArray)) {
                    // Obtén el contexto del canvas
                    let ctx = document.getElementById("lineChart").getContext('2d');

                    // Mapea las etiquetas y datos desde el array
                    let labels = respuestaArray.map(function (e) {
                        return e.detalle_categoria;
                    });

                    let data = respuestaArray.map(function (e) {
                        return e.cantidad;
                    });

                    // Configuración del gráfico
                    let config = {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Activos',
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 133, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 133, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 4
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            legend: {
                                display: false
                              },
                            scales: {
                                
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display: false,
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                                
                            }
                        }
                    };

                    // Crea el gráfico con la configuración proporcionada
                    let myChart = new Chart(ctx, config);
                } else {
                    throw new Error("La respuesta no es válida o no contiene el formato esperado.");
                }
            } else {
                throw new Error("La respuesta no es válida o no contiene el formato esperado.");
            }
        } catch (error) {
            console.error("Error al cargar el gráfico:", error);
            // Puedes manejar el error de la manera que desees
        }
    }



     // ====================================================== //
    // = CARGAR INFORMACION DE GRAFICO XSOLICITUD =========== //
    // ====================================================== //
    function cargarGraficoInicioSolicitud(respuesta) {
        try {
            // Asegúrate de que haya una respuesta válida y contenga el array necesario
            if (respuesta && typeof respuesta === 'object') {
                // Convierte el objeto a un array de sus valores
                let respuestaArray = Object.values(respuesta);

                // Verifica que ahora sea un array
                if (Array.isArray(respuestaArray)) {
                    // Obtén el contexto del canvas
                    let ctx = document.getElementById("polarChartSolicitudes").getContext('2d');

                    // Mapea las etiquetas y datos desde el array
                    let labels = respuestaArray.map(function (e) {
                        return e.detalle_categoria;
                    });

                    let data = respuestaArray.map(function (e) {
                        return e.cantidad;
                    });

                    // Configuración del gráfico
                    let config = {
                        type: 'polarArea',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Activos',
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 133, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                ],
                                borderColor: [
                                    'rgba(255, 255, 255, 1)'
                                    
                                ],
                                borderWidth: 4
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            legend: {
                                display: false
                              },
                            scales: {
                                
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display: false,
                                    },
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                                
                            }
                        }
                    };

                    // Crea el gráfico con la configuración proporcionada
                    let myChart = new Chart(ctx, config);
                } else {
                    throw new Error("La respuesta no es válida o no contiene el formato esperado.");
                }
            } else {
                throw new Error("La respuesta no es válida o no contiene el formato esperado.");
            }
        } catch (error) {
            console.error("Error al cargar el gráfico:", error);
            // Puedes manejar el error de la manera que desees
        }
    }




    // ====================================================== //
    // =================== TOTAL DE ACTIVOS POR CATEGORIA === //
    // ====================================================== //
    function TotalActivosXCategoria() {
        let nidUser = document.getElementById('id').value;

        let datos = new FormData();
        datos.append("id", nidUser);
        datos.append("totalActivosXcat", true);
        

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
                //alert("Hola");
                //console.log("Estos son los datos", respuesta);
               
                    cargarGraficoInicio(respuesta);

              
            })
            .catch(function (error) {
                console.log("***Error***:", error);
            });
    }

     // ====================================================== //
    // =================== TOTAL DE ACTIVOS POR CATEGORIA === //
    // ====================================================== //
    function TotalActivosXSolicitud() {
        let nidUser = document.getElementById('id').value;

        let datos = new FormData();
        datos.append("id", nidUser);
        datos.append("totalActivosXsol", true);
        

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
                //alert("Hola");
                //console.log("Estos son los datos", respuesta);
                    cargarGraficoInicioSolicitud(respuesta);
                })
            .catch(function (error) {
                console.log("***Error***:", error);
            });
    }



    document.addEventListener('DOMContentLoaded', function () {

    });
});
