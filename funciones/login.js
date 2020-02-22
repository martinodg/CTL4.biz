//arrays with lang traslation
var company_name = ["Company name:", "Compania:"];
var nombre = ["your name:", "nombre del usuario:"];
var emailValidation = ["e-mail validation:", "validacion del email:"];
var password = ["password:", "clave:"];
var passwordValidation = ["password validation:", "validacion de la clave:"];
var member = ["Already a member?", "Ya eres miembro?"];
var golo = ["Go to Login", "Ve a la pagina de acceso"];
var sub = ["Submit", "Envia"];
var details = ["Enter Login Details", "Complete los datos de Acceso"];
var companyCode = ["Company code:", "Codigo de la compania:"];
var signin = ["Sign in Now!", "Inscribete ahora!"];
var noMember = ["Not a member yet?", "Aun no eres miembro?"];



// After document is loaded:

$(document).ready(function() {

    //Set languages on load
    var lang = localStorage.getItem('language');
    if (lang == "") {
        localStorage.setItem('language', '0');
        $("#bandera_lengua").attr("src", "../img/english-language.svg");
    }
    if (lang == "1") {
        $("#bandera_lengua").attr("src", "../img/spanish-language.svg");
    }
    langchange(lang);

    //change language
    $("#espanol").click(function() {
        $("#bandera_lengua").attr("src", "../img/spanish-language.svg");
        $("#language").val("1");
        localStorage.setItem('language', '1');
        lang = localStorage.getItem('language');
        //var lang = '1';
        langchange(lang);
    });
    $("#english").click(function() {
        $("#bandera_lengua").attr("src", "../img/english-language.svg");
        $("#language").val("0");
        localStorage.setItem('language', '0');
        lang = localStorage.getItem('language');
        //var lang = '0';
        langchange(lang);
    });
    
    // validate e-mail on input event
    $("#email-validation-field, #email-field").keyup(function() {
        valmail();
        
    });

    // validate password on input event
    $("#password-validation-field, #password-field").keyup(function() {
        valpass();
    });
    //  hide/show passwords
    $(".icon-wrapper").click(function() {
        if ($("#password-field").attr("type") == "password") {
            $("#password-field").attr("type", "text");
            $("#password-validation-field").attr("type", "text");
            $(".icon-wrapper").toggleClass("pass view");
        } else {
            $("#password-field").attr("type", "password");
            $("#password-validation-field").attr("type", "password");
            $(".icon-wrapper").toggleClass("view pass");
        }
    });

    // strength validation on keyup-event
    $("#password-field").on("keyup", function() {
        var val = $(this).val(),
            color = testPasswordStrength(val);

        styleStrengthLine(color, val);
    });
    

});


// Functions --------------------------------------------------------------------------------------------------
//language change function
function langchange(idioma) {

    $("#companyName").text(company_name[idioma]);
    $("#password").text(password[idioma]);
    $("#passwordValidation").text(passwordValidation[idioma]);
    $("#emailValidation").text(emailValidation[idioma]);
    $("#nombre").text(nombre[idioma]);
    $("#member").text(member[idioma]);
    $("#golo").text(golo[idioma]);
    $("#sub").text(sub[idioma]);
    $("#details").text(details[idioma]);
    $("#signin").text(signin[idioma]);
    $("#companyCode").text(companyCode[idioma]);
    $("#noMember").text(noMember[idioma]);


}
//enable/disable submit button
function togglSub() {
    var inputpass = document.getElementById("password-field").value;
    var inputval = document.getElementById("password-validation-field").value;
    var inputemail = document.getElementById("email-field").value;
    var emailval = document.getElementById("email-validation-field").value;
    if (inputemail == emailval && emailval != "" && inputpass == inputval && inputval != "") {
        $('#btnsubmit').prop('disabled', false);
    } else {
        $('#btnsubmit').prop('disabled', true);

    }
}
// validate mail function
function valmail(){
    
    var inputemail = $("#email-field").val();
    var emailval =  $("#email-validation-field").val();
    //alert(inputpass + "es igual a:?" + inputval);
    console.log(inputemail + "es igual a:?" + emailval);
    if (inputemail == emailval && emailval != "") {
        $(".email-validation-icon-wrapper").removeClass("passdistinta");
        $(".email-validation-icon-wrapper").addClass("passigual");
        togglSub();
    }
    if (inputemail != emailval) {
        $(".email-validation-icon-wrapper").removeClass("passigual");
        $(".email-validation-icon-wrapper").addClass("passdistinta");
        togglSub();
    }

}

   

// validate pass function
function valpass(){
    //alert();
    var inputpass = document.getElementById("password-field").value;
    var inputval = document.getElementById("password-validation-field").value;
    console.log(inputpass + "es igual a:?" + inputval);
    if (inputpass == inputval && inputval != "") {
        $(".validation-icon-wrapper").removeClass("passdistinta");
        $(".validation-icon-wrapper").addClass("passigual");
        togglSub();
    }
    if (inputpass != inputval) {
        $(".validation-icon-wrapper").removeClass("passigual");
        $(".validation-icon-wrapper").addClass("passdistinta");
        togglSub();
    }

}


// check password strength
function testPasswordStrength(value) {
    var strongRegex = new RegExp(
            '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[=/\()%ยง!@#$%^&*])(?=.{8,})'
        ),
        mediumRegex = new RegExp(
            '^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})'
        );

    if (strongRegex.test(value)) {
        return "green";
    } else if (mediumRegex.test(value)) {
        return "orange";
    } else {
        return "red";
    }
}

function styleStrengthLine(color, value) {
    $(".line")
        .removeClass("bg-red bg-orange bg-green")
        .addClass("bg-transparent");

    if (value) {

        if (color === "red") {
            $(".line:nth-child(1)")
                .removeClass("bg-transparent")
                .addClass("bg-red");
        } else if (color === "orange") {
            $(".line:not(:last-of-type)")
                .removeClass("bg-transparent")
                .addClass("bg-orange");
        } else if (color === "green") {
            $(".line")
                .removeClass("bg-transparent")
                .addClass("bg-green");
        }
    }
}