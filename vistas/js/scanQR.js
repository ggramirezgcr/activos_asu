
var intervalId;


// ====================================================== //
// ======= ACCEDER A LA CAMARA Y MOSTRAR EL VIDEO ======= //
// ====================================================== //
/**
 * 
 * @param {HTMLCanvasElement} canvas El elemento canvas donde se renderiza el video
 * @param {HTMLVideoElement} video El elemento de video donde se mostrará la transmisión de video de la cámara.
 * @param {function} callback Una promesa que se resolverá con el código QR detectado o null si no se detecta ningún código.
 * @returns {Promise<string|null>} Una promesa que se resolverá con el código QR detectado o null si no se detecta ningún código.
 */
async function startCamera(canvas, video, callback) {
    try {

        // Obtener una lista de dispositivos de entrada de medios
        const devices = await navigator.mediaDevices.enumerateDevices();
        // Filtrar solo las cámaras de video
        const videoDevices = devices.filter(device => device.kind === 'videoinput');

        // Intentar encontrar la cámara trasera
        let rearCamera;
        for (const device of videoDevices) {
            if (device.label.toLowerCase().includes('back') || device.label.toLowerCase().includes('rear')) {
                rearCamera = device;
                break;
            }
        }


        if (rearCamera) {

            const stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    deviceId: {
                        exact: rearCamera.deviceId
                    }
                }
            });
            //const videoElement = document.getElementById('videoElement');
            const videoElement = video;
            videoElement.srcObject = stream;

            // Iniciar la detección de QR cuando se capture un fotograma de video
            return new Promise((resolve, reject) => {


                videoElement.addEventListener('play', function () {
                    /*const canvas = document.getElementById('canvas');
                    const video = document.getElementById('videoElement');*/
                    const context = canvas.getContext('2d');

                    // Configurar el intervalo para procesar el fotograma de video
                    intervalId = setInterval(() => {
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, imageData.width, imageData.height);

                        // Si se detecta un código QR, mostrar el resultado y detener la detección
                        if (code) {
                            clearInterval(intervalId); // Detener la detección 
                            //alert('QR Code Decoded: ' + code.data);
                            callback(code.data);
                            resolve(code.data);

                            stopCamera(video);
                        }
                    }, 100);
                });




            })


        } else {

            const stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            //const videoElement = document.getElementById('videoElement');
            const videoElement = video;
            videoElement.srcObject = stream;

            // Iniciar la detección de QR cuando se capture un fotograma de video

            return new Promise((resolve, reject) => {
                videoElement.addEventListener('play', function () {
                    //const canvas = document.getElementById('canvas');
                    //const video = document.getElementById('videoElement');
                    const context = canvas.getContext('2d');

                    // Configurar el intervalo para procesar el fotograma de video
                    intervalId = setInterval(() => {
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, imageData.width, imageData.height);

                        // Si se detecta un código QR, mostrar el resultado y detener la detección
                        if (code) {
                            clearInterval(intervalId); // Detener la detección
                            callback(code.data);
                            resolve(code.data);
                            stopCamera(video);
                        }
                    }, 100);
                });
            })



        }

        // Mejora: Establecer el atributo willReadFrequently en true para optimizar las operaciones de lectura de datos en el canvas
        canvas.willReadFrequently = true;

    } catch (error) {
        console.error('Error accessing camera:', error);
    }
}



// ====================================================== //
// ================== DETENER LA CAMARA ================= //
// ====================================================== //
/**
 * Detiene la camara 
 * @param {HTMLVideoElement} videoElement El elemento de video donde se mostrará la transmisión de video de la cámara.
 */
function stopCamera(videoElement) {
    // const videoElement = document.getElementById('videoElement');
    const stream = videoElement.srcObject;
    if (stream !== null && stream.getTracks) {
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
    }
    clearInterval(intervalId); // Detener el intervalo de detección

}



