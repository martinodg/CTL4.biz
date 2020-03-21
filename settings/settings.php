
<html>
	<head>
		<title>Settings</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../jquery/jquery331.js"></script>
		<script type="text/javascript" src="../funciones/paginar.js"></script>

		<script language="javascript">
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		
		</script>
	</head>
	<body >
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				    <div id="tituloForm" class="header">Copias de Respaldo </div>
				    
				
					    			
						  
							   
								<button type="button" class="fullwidth" id="btnhacerrespaldo" onClick="window.location.href = '../backup/hacerbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/upload.svg" alt="limpiar" /> <span>Hacer copia de respaldo</span> </button>
								
							  
						   
								
								<button type="button" class="fullwidth" id="btnhacerrespaldo" onClick="window.location.href = '../backup/restaurarbak.php';" onMouseOver="style.cursor=cursor"> <img src="../img/download.svg" alt="limpiar" /> <span>Restaurar copia de respaldo</span> </button> 
						   
                    
				
                   
                    
                    
                    
                    
					<div id="tituloForm" class="header">Administracion de Seguridad </div>
					
               				<button type="button" class="fullwidth" id="btnusuarios" onClick="window.location.href = '../racf/intUsers/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/usuarios.svg" alt="limpiar" /> <span>Usuarios</span> </button>
							  
							<button type="button" class="fullwidth" id="btnroles" onClick="window.location.href = '../racf/roles/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/roles.svg" alt="nuevo" /> <span>Roles</span> </button>

							<button type="button" class="fullwidth" id="btnrecursos" onClick="window.location.href = '../racf/recursos/index.php';" onMouseOver="style.cursor=cursor"> <img src="../img/resources.svg" alt="nuevo" /> <span>Recursos</span> </button>

				</div>
				
            </div>
		</div>		  			
	</body>
</html>
