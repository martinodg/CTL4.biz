

function verify(idRes, idSubRes) {
    $.getJSON("/racf/verify.php", {
        idResource : idRes,
        idSresource : idSubRes   
    },
    function(data) {
                    if (data.answer != "Allowed") {
                        window.location.href = "/racf/forbiden.html";
                    } 
                    }
);                                        
    
}   
    
 
                                      