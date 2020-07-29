<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../../estilos/login.css' />
    <script type="text/javascript" src="../../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../../funciones/login.js"></script>
    <script language="javascript">
       
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

        function modificarole() {
            var status = $("#rActivo").prop('checked');
            if (status == true) {var codstatus="4"}else{var codstatus="5"}
            //alert(codstatus);
            $.get( "guardarRole.php" , { accion : 'modificar',
                                            codigo : document.getElementById('code').value,
                                            nombre : document.getElementById('name').value,
                                            estado : codstatus
                                        }, function ( data ) { 
                                                            $('#div_datos2').html( data );
                                                            location.href="index.php";
                                                            }
                );                            
        }
       
       

        $(document).ready(function() {
           
        });
    </script>

    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
       
    <div id="cabeceraResultado" class="header"> 
    Detalles del role</div>
            <div class="column3" style="background-color:#eee;">
                <center>
                    <form name="frmUser" align="center">
                        <div class="message">
                            <?php if($message!="") { echo $message; } ?>
                        </div>
                        <br> <br>
                        <span id="codigo" class="loginText">Codigo del role:</span><br>
                        <input class="input-wrapper" type="text" id="code" name="code" readonly>                  

                </center>
            </div>
            <div class="column3" style="background-color:#eee;">
                <center>
                <br> <br>
                        <span id="nombre" class="loginText">Nombre de role:</span><br>
                        <input class="input-wrapper" type="text" id="name" name="name" >
                    
                </center>
            </div>
            <div class="column3" style="background-color:#eee;">
                <center>
                    <br> <br>
                    <div><span id="roleDesactivado" class="loginText">Desactivado </span><label class="switch"> <input type="checkbox" id="rActivo" name="rActivo" > <span class="slider round"></span> </label> <span id="roleActivo" class="loginText">Activo</span></div>

                    <input type="hidden" id="language" name="language" value="0">

                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnmodificar" onClick="modificarole()" onMouseOver="style.cursor=cursor"> <img src="../../img/disco.svg" alt="Modificar" /> <span>Guardar modificacion</span> </button>

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