document.getElementById("forma_dispositivo").addEventListener("submit", function (event){
    event.preventDefault();

    var nombre_dispositivo = document.getElementById("nombre_dispositivo").value.trim();
    var tipo_dispositivo = document.getElementById("tipo_dispositivo").value.trim();
    var fk_sucursal = document.getElementById("fk_sucursal").value.trim();
    var device_agent = document.getElementById("device_agent").value.trim();
    var id_dispositivo = document.getElementById("id").value;

    var nd_length = nombre_dispositivo.length;
    var td_length = tipo_dispositivo.length;
    var fs_length = fk_sucursal.length;
    var da_length = device_agent.length;

    console.log("Values");
    console.log(nombre_dispositivo);
    console.log(tipo_dispositivo);
    console.log(fk_sucursal);
    console.log(device_agent);
    console.log("");
    console.log("Lengths")
    console.log(nd_length);
    console.log(td_length);
    console.log(fs_length);
    console.log(da_length);
    console.log(id_dispositivo);

    if(nombre_dispositivo == "" || nd_length == 0){
        alert("El nombre del dispositivo se encuentra vacio.");
    }else if(nd_length < 3 || nd_length > 35){
        alert("Nombre del dispositivo:\nEscribe minimo de 3 a 35 caracteres.");
    }else if(tipo_dispositivo == "" || td_length == 0){
        alert("Selecciona un tipo de dispositivo.");
    }else if(fk_sucursal == ""|| fs_length == 0){
        alert("Selecciona una sucursal");
    }else if(da_length > 3 && da_length > 150){
        alert("Device Agent:\nSe ha excedido la cantidad de caracteres, recuerda que si ingresas caracteres deben ser entre 3 y 150 caracteres.");
    }else{
        alert("Se han validado todos los campos");
        $.ajax({
            type: 'POST',
            url: '../php/actualizar_dispositivo.php',
            data: {
                'id_dispositivo': id_dispositivo,
                'nombre_dispositivo': nombre_dispositivo,
                'tipo_dispositivo': tipo_dispositivo,
                'fk_sucursal': fk_sucursal,
                'device_agent': device_agent
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

})