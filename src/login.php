<?php

	session_start();

	require_once ("gestionBD.php");
	require_once ("gestion_usuarios.php");
	
if (isset($_POST['submit'])){
		$login["nick"]= $_POST['nick'];
		$login["pass"]= $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = comprobar_usuarios($conexion, $login);
		$id_usuario = obtener_id_usuario($conexion, $_POST['nick']);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0){
			$_SESSION['errores_log'] = "El nombre de usuario o la contraseña no son válidos";
			Header("Location: login.php");
		}else {
			unset($_SESSION['errores_log']);
			
			if(isset($_SESSION['tienda'])){
				$datos_usuario['nick'] = $login["nick"];
				$datos_usuario['id_usuario'] = $id_usuario;
				$_SESSION['login'] = $datos_usuario;
				Header("Location: pedidos.php");
			}else{
				$datos_usuario['nick'] = $login["nick"];
				$datos_usuario['id_usuario'] = $id_usuario;
				$_SESSION['login'] = $datos_usuario;
				Header("Location: index.php");
			}
		}	
	}

?>
<!DOCTYPE html>
<html>
    <head>    
        <title>Bocatería Santa Marta</title>    
        <meta charset="UTF-8">
        <link href="estilos/estilos.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
        <link rel="icon" href="images/icon.png">
        <meta name="viewport" content="width=device-width, user-scalable=no">
    </head>  
    <body>
        <?php include_once("templates/header.php");?>
		
        
        <div class="container_log">
		<?php 
			if(isset($_SESSION['errores_log'])){
				print('<h3 class="issue">');
					printf("%s<br>",$_SESSION['errores_log']);
				print("</h3>");
			}
		?>
		
            <div><h1 class="info">Si ya tienes una cuenta, ¡inicia sesión desde aquí!</h1></div>
        
            <div class="login">
		      	<form action="login.php" method="post" novalidate>
		      		 <label for="nick">Nombre de usuario:</label>
		      		<input type="text" id="nick" name="nick" placeholder="jugape1" required><br>
		      		<label for="pass">Contraseña:</label>
		      		<input type="password" id="pass" name="pass" required><br>
		      		<input type="submit" name="submit" value="Iniciar sesión" style="iniciar_ses">
		      	</form>
		      </div>
            <div><h1 class="info">¿No tienes cuenta? <a href="registro.php">REGISTRATE</a></h1></div>
        </div>
    </body>
</html>