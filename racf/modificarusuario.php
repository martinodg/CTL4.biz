<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../estilos/login.css' />
    <script type="text/javascript" src="../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../funciones/login.js"></script>
    <script language="javascript">
        //get proceso code from Url hash on last page.
        var usuario = window.location.hash.substring(1);
        buscausuario(usuario);
        var cursor;
        if (document.all) {
                // Está utilizando EXPLORER
                cursor='hand';
        } else {
                // Está utilizando MOZILLA/NETSCAPE
                cursor='pointer';
        }

        function limpiar() {
            document.getElementById("formulario").reset();
        }

        function cancelar() {
            location.href="index.php";
        }

        function modificausuario() {
            var status = $("#uActivo").prop('checked');
            if (status == true) {var codstatus="4"}else{var codstatus="5"}
            //alert(codstatus);
            $.get( "guardarusuario.php" , { accion : 'modificar',
                                            name : document.getElementById('name').value,
                                            email : document.getElementById('email-field').value,
                                            password : document.getElementById('password-field').value,
                                            estado : codstatus
                                        }, function ( data ) { 
                                                            $('#div_datos').html( data );
                                                            location.href="index.php";
                                                            }
                );                            
        }
        //search user
        function buscausuario(usuario) {
            //alert(usuario);
            $.getJSON("./buscarUsuario.php", {
                                                    criterio1 : 'id_intUser',
                                                    parametro1 : usuario,
                                                    paginainicio: '0',
                                                    tipoBusqueda: 'modificar'
                                                },
                                                function(data) {
                                                                //alert(data.nombre);
                                                                $('#name').val(data.nombre);
                                                                $('#password-field').val(data.clave);
                                                                $('#email-field').val(data.mail);
                                                                $('#password-validation-field').val(data.clave);
                                                                $('#email-validation-field').val(data.mail);
                                                                var uActivo = data.codestado;
                                                                if (uActivo == "4") {
                                                                    $('input[type="checkbox"]').attr('checked', true);
                                                                } else {
                                                                    $('input[type="checkbox"]').attr('checked', false);
                                                                }
                                                                //$('#div_datos').html( data );
                                                                //calculaPaginacion();
                                                                }
                        );                        
        }
        //procs search fucnction
        function buscaRole(usuario){
                                    $.get( "buscarRole.php" , { criterio1 : 'id_intUser',
                                                                    parametro1 : usuario,
                                                                    tipoBusqueda: 'listar'
                                                                    //paginainicio : document.getElementById('iniciopagina').value
                                                              },function ( data ) { 
                                                                                        $('#div_datos').html( data );
                                                                                        //calculaPaginacion();
                                                                                  }
                                         );
                                    
                              }
        function ABRole(idRole,id_intUser,action){
            //alert(idRole+action+id_intUser);
            $.get( "ABRole.php" , { role : idRole,
                                    user : id_intUser,
                                    accion: action
                                    },function ( data ) { 
                                                        $('#div_datos2').html( data );
                                                        buscaRole(id_intUser);
                                                        }
                 );
        }
        // validate mail function
   /*     function valmail(){
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

        }*/

        $(document).ready(function() {
            window.onload = function(){
            valmail();
            valpass();
            }
            buscaRole(usuario);
        });
    </script>

    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
       
    <div id="cabeceraResultado" class="header"> 
    Detalles del Usuario</div>
            <div class="column2" style="background-color:#eee;">
                <center>
                    <form name="frmUser" align="center">
                        <div class="message">
                            <?php if($message!="") { echo $message; } ?>
                        </div>
                        <br> <br>
                        <span id="nombre" class="loginText">Nombre de Usuario:</span><br>
                        <input class="input-wrapper" type="text" id="name" name="name" readonly>
                        <br> <br>

                        <span class="loginText">e-mail:</span><br>
                        <input id="email-field" class="input-wrapper" type="text" name="email">
                        <br> <br>
                        <span id="password" class="loginText">clave:</span><br>
                        <div class="password-wrapper">
                            <input id="password-field" type="password" class="input" name="password">
                            <div class="icon-wrapper pass">
                                <span toggle="#password-field" class="field-icon toggle-password"></span>
                            </div>
                            <div class="strength-lines">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>

                </center>
            </div>
            <div class="column2" style="background-color:#eee;">
                <center>
                    <br> <br>

                   
                    <span id="emailValidation" class="loginText">validacion de e-mail:</span><br>
                    <div class="email-validation-wrapper">
                        <input id="email-validation-field" type="text" class="input" name="email-validation" onpaste="return false;">
                        <div class="email-validation-icon-wrapper passdistinta"></div>
                    </div>
                    <br>
                    <span id="passwordValidation" class="loginText">validacion de clave:</span><br>
                    <div class="password-validation-wrapper">
                        <input id="password-validation-field" type="password" class="input" name="password-validation" onpaste="return false;">
                        <div class="validation-icon-wrapper passdistinta">
                            <span toggle="#password-validation-field" class="field-icon toggle-password"></span>
                        </div>
                    </div>
                    <br> <br> <br>
                    <div><span id="usuarioDesactivado" class="loginText">Desactivado </span><label class="switch"> <input type="checkbox" id="uActivo" name="uActivo" > <span class="slider round"></span> </label> <span id="usuarioActivo" class="loginText">Activo</span></div>

                    <input type="hidden" id="language" name="language" value="0">


                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnsubmit" onClick="modificausuario()" onMouseOver="style.cursor=cursor" disabled=""> <img src="../img/disco.svg" alt="Nuevo" /> <span>Guardar modificacion</span> </button>

            </div>

            </form>
            <br>
            <div ID="div_datos" name="div_datos" > </div> 
            <div ID="div_datos" name="div_datos2" > </div> 


            <br>
        </div>
    </div>
</body>

</html>