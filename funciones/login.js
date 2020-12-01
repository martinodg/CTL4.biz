// After document is loaded:

$(document).ready(function() {
    
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
            '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[=/\()%ยง!@#$%^&*])(?=.{48,})'
        ),
        mediumRegex = new RegExp(
            '^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{16,})'
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