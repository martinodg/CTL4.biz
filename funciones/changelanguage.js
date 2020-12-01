//arrays with lang traslation
var company_name = ["Company name:", "Compania:","Nazwa Firma:"];
var nombre = ["your name:", "nombre del usuario:","Nazwa Uzytkownika"];
var emailValidation = ["e-mail validation:", "validacion del email:","Weryficacja adresu"];
var password = ["password:", "clave:", "haslo"];
var passwordValidation = ["password validation:", "validacion de la clave:","Weryficacja Hasla"];
var member = ["Already a member?", "Ya eres miembro?","Jestes juz czlonkiem"];
var golo = ["Go to Login", "Ve a la pagina de acceso","przejdz do logowania"];
var sub = ["Submit", "Envia","Zatwierdz"];
var details = ["Enter Login Details", "Complete los datos de Acceso","Wprrowadz dane logowania"];
var companyCode = ["Company code:", "Codigo de la compania:","kod frimowy"];
var signin = ["Sign in Now!", "Inscribete ahora!","Spewam teraz"];
var noMember = ["Not a member yet?", "Aun no eres miembro?","nie jestes jeszcze chlonkiem"];


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
    if (lang == "2") {
        $("#bandera_lengua").attr("src", "../img/polish-language.svg");
    }
    langchange(lang);

    //change language
    $("#espanol").click(function() {
        $("#bandera_lengua").attr("src", "../img/spanish-language.svg");
        $("#language").val("1");
        localStorage.setItem('language', '1');
        lang = localStorage.getItem('language');
        langchange(lang);
    });
    $("#english").click(function() {
        $("#bandera_lengua").attr("src", "../img/english-language.svg");
        $("#language").val("0");
        localStorage.setItem('language', '0');
        lang = localStorage.getItem('language');
        langchange(lang);
    });
    $("#polish").click(function() {
        $("#bandera_lengua").attr("src", "../img/polish-language.svg");
        $("#language").val("2");
        localStorage.setItem('language', '2');
        lang = localStorage.getItem('language');
        langchange(lang);
    });
}
