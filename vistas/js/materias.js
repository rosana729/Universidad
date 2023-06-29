$(".T").on("click", ".EliminarMateria", function() {
        var Mid = $(this).attr("Mid");
        var Cid = $(this).attr("Cid");
        window.location = "http://localhost/universidad/index.php?url=CrearMaterias/" + Cid + "&Mid=" + Mid + "&Cid=" + Cid;
 });

