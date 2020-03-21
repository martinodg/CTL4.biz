<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../../estilos/login.css' />
    <script type="text/javascript" src="../../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../../funciones/login.js"></script>
    <script language="javascript">

        function cancelar() {
            location.href="index.php";
        }

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

        function creausuario() {
            $.get( "guardarusuario.php" , { accion : 'alta',
                                            name : document.getElementById('name').value,
                                            email : document.getElementById('email-field').value,
                                            password : document.getElementById('password-field').value
                                        }, function ( data ) { 
                                                            $('#div_datos').html( data );
                                                            location.href="index.php";
                                                            }
                );                            
        }
        

    </script>



    <!link href="../../estilos/menu2.css" type="text/css" rel="stylesheet">
    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
       
        
            <div class="column2" style="background-color:#eee;">
                <center>
                    <form name="frmUser" align="center">
                        <div class="message">
                            <?php if($message!="") { echo $message; } ?>
                        </div>
                        <br> <br>
                        <span id="nombre" class="loginText">Nombre de Usuario:</span><br>
                        <input class="input-wrapper" type="text" id="name" name="name">
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
                    <input type="hidden" id="language" name="language" value="0">


                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnsubmit" onClick="creausuario()" onMouseOver="style.cursor=cursor" disabled=""> <img src="../../img/nuevo.svg" alt="Nuevo" /> <span>Crear Nuevo Usuario</span> </button>

            </div>

            </form>
            <br>
            <div ID="div_datos" name="div_datos" > </div> 

            <br>
        </div>
    </div>
</body>

</html>