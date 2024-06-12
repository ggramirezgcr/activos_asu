
// ##################################################################### //
// ############################### FETCH ############################### //
// ##################################################################### //
fetch("data.json", {
    method: "POST",
    body: formData,
    cache: "no-cache"
})
.then((res) => {
    //Aqui evalua si viene respuesta
    if (!res.ok) {
        throw {ok:false, msg:"Error 404"};
    }
    return res.json();
})
.then((data) => {
    //Aqui trabaja con la respuesta
    data.array.forEach(element => {
        
    });
})
.catch((err) => console.log(err))
.finally();



// ====================================================== //
// =================== // USANDO ASYNC ================== //
// ====================================================== //
const getDatos = async() =>{
    try {
        const respuesta = await fetch("datos.json");
        if (!respuesta.ok) {
            const errorData = {
                ok: false,
                status: respuesta.status,
                statusText: respuesta.statusText
              };
              throw errorData;
            //throw {ok: false, msg:"error 404"};
        }

        const data = await respuesta.json();
        data.forEach((item) => {
            //tratamos el dato
        })

    } catch (error) {
       // console.log(error);
       throw error;
    } finally{
        //Esto siempre se va a ejecutar por ejemplo sirve para un spiner
    }
};