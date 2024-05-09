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

                    let color = generarColores(data.length)

                    // Configuración del gráfico
                    let config = {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Activos',
                                data: data,
                                backgroundColor: color,
                                borderColor: color,
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

                    //Generar color
                    let color = generarColores(data.length)

                    // Configuración del gráfico
                    let config = {
                        type: 'polarArea',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Activos',
                                data: data,
                                backgroundColor: color,
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


    // Función para generar un arreglo de colores
    function generarColores(num) {
        let colors = [];

        for (let i = 0; i < num; i++) {
            colors.push(obtenerColor(i));
        }
        return colors;
    }

    // Función para obtener un color aleatorio
    function obtenerColor(index) {
        switch (index) {
            case 0:
                return 'rgba(255, 99, 133, 1)';

            case 1:
                return 'rgba(54, 162, 235, 1)';
            case 2:
                return 'rgba(255, 206, 86, 1)';
        
            case 3:
                return 'rgba(75, 192, 192, 1)';
        
            case 4:
                return 'rgba(153, 102, 255, 1)';
            case 5:
                return 'rgba(255, 153, 204, 1)';
            case 6:
                return 'rgba(153, 255, 153, 1)';
            case 7:
                return 'rgba(255, 0, 255, 1) ';
            case 8:
                return 'rgba(153, 204, 255, 1) ';
            case 9:
                return 'rgba(204, 102, 153, 1)';
        
            default:
                return 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 1)';
                
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
