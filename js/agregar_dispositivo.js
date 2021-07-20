document.getElementById("formr_dispositivo").addEventListener('submit', function (event) {
    event.preventDefault();

    var iNombreDisp = document.getElementById('nombre_dispositivo');
    var tipo_dispositivo = document.getElementById('tipo_dispositivo');
    var sucursal = document.getElementById('fk_sucursal');
    var device_agent = document.getElementById('device_agent');
    var div_resultado = document.getElementById('div_resultado');


    //Valor que contienen los id obtenidos
    var valueDispositivo = iNombreDisp.value;
    var valueTipo_disp = tipo_dispositivo.value;
    var valueSucursal = sucursal.value;
    var valueDA = device_agent.value;

    //Console.log de los valores obtenidos
    console.log(valueDispositivo);
    console.log(valueTipo_disp);
    console.log(valueSucursal);
    console.log(valueDA);

    //Longitud que contienen los id obtenidos
    var lengthDispositivo = valueDispositivo.length;
    var lengthTipo_disp = valueTipo_disp.length;
    var lengthSucursal = valueSucursal.length;
    var lengthDA = valueDA.length;
    var lengthDemas = lengthDA - 300;
    //Console.log de la longitud de los valores obtenidos
    console.log(lengthDispositivo);
    console.log(lengthTipo_disp);
    console.log(lengthSucursal);
    console.log(lengthDA);

    if (lengthDispositivo == 0) {
        alert("El nombre del dispositivo esta vacio, intente nuevamente.");
    } else if ((lengthDispositivo < 3) || (lengthDispositivo > 35)) {
        alert("Ingresa más de 3 caracteres en el nombre del dispositivo y menos de 35 caracteres.")
    } else if (lengthTipo_disp == 0) {
        alert("Selecciona un tipo de dispositivo.")
    } else if (lengthSucursal == 0) {
        alert("Selecciona un tipo de Sucursal.")
    } else if (lengthDA > 1 && lengthDA > 300) {
        alert("Se ha excedido la cantidad de caracteres en el ultimo campo.\nCon " + lengthDemas + " caracteres demas.");
    } else {
        // alert("Los datos han sido procesados exitosamente.\nEspera un momento.")
        $.ajax({
            type: 'POST',
            url: '../php/agregar_dispositivo.php',
            data: {
                'nombre_dispositivo': valueDispositivo,
                'tipo_dispositivo': valueTipo_disp,
                'fk_sucursal': valueSucursal,
                'device_agent': valueDA
            },
            success: function (data) {
                div_resultado.innerHTML = data;
                console.log("Se obtuvo una respuesta de la base de datos.")
                $("#avisoDispositivo").modal({
                    'show': true
                });
            }
        })
    }
});