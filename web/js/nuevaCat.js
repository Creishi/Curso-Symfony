function cambiarCatSelect() {
    $.getJSON("http://127.0.0.1:8000/api/listarCategorias", function(data){
        var ultimaCategoria = data[data.length-1];
        $(tapa_categria).append(new Option(ultimaCategoria['nombre'],ultimaCategoria['id']));
    });
}
function nuevaCatAdd() {
    var ejecutarNuevaCat = $.post("http://127.0.0.1:8000/api/insertarCategoria/"+$(nuevaCat).val(), function(){
        $(nuevaCat).val("");
        cambiarCatSelect();
        alert("Nueva categoria insertada");
    })
    .fail(function(){
        alert("Se ha producido un error al añadir la nueva categoria");
    });
}