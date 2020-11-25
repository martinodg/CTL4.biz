function verify(idRes, idSubRes) {
    alert("verifico pagina con recurso "+idRes+" y subrecurso "+idSubRes);
    $.getJSON("/racf/verify.php", {
        idResource : idRes,
        idSresource : idSubRes   
    },
    function(data) {
                    alert(data.answer);
                    $('#telefono').val(data.answer);
                    /*
                    $('#name').val(data.nombre);
                    var rActivo = data.codestado;
                    if (rActivo == "4") {
                        $('input[type="checkbox"]').attr('checked', true);
                    } else {
                        $('input[type="checkbox"]').attr('checked', false);
                    }
                    //$('#div_datos').html( data );
                    //calculaPaginacion();*/
                    }
);                                        
    
}   
    
 
                                      