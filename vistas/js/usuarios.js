$(".T").on("click", ".EditarUsuario", function() {
    var Uid = $(this).attr("Uid");
    var datos = new FormData();
    datos.append("Uid", Uid);
    $.ajax({
        url: "Ajax/usuariosA.php",
        method: "POST",
        data: datos,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function(resultado) {
            $("#Uid").val(resultado["id"]);
            $("#nombreEU").val(resultado["nombre"]);
            $("#apellidoEU").val(resultado["apellido"]);
            $("#fechaEU").val(resultado["fechanac"]);
            $("#dniEU").val(resultado["dni"]);
            $("#codigo_postalEU").val(resultado["codigopostal"]);
            $("#celularEU").val(resultado["celular"]);
            $("#emailEU").val(resultado["email"]);
            $("#usuario").val(resultado["libreta"]);
            $("#claveEU").val(resultado["clave"]);
            if(resultado["rol"]=="Administrador"){
                $("#carrera").hide();
            } else{
                $("#carrera").show();
            }
            $("#rolactual").html("Rol Actual: " + resultado["rol"]);
            

        },
    });
});
$(".T").on("click", ".EliminarUsuario", function() {
    var Uid = $(this).attr("Uid");
    window.location = "index.php?url=usuarios&Uid="+Uid;
});


