<?php
	session_start();
	
	require_once ("gestionBD.php");
	require_once ("gestion_usuarios.php");
	
	if(isset($_SESSION['formulario'])){
		$user = $_SESSION['formulario'];
		unset($_SESSION['formulario'], $_SESSION['errores']);
	}else{
		Header("Location: index.html");
	}
	
	$conexion = crearConexionBD();
	alta_usuario($conexion,$user);
	cerrarConexionBD($conexion);
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
		
        <h1 class="info">
		¡Enhorabuena! El usuario número <?php $conexion=crearConexionBD(); echo numero_usuarios($conexion); cerrarConexionBD($conexion);?> ha sido registrado satisfactoriamente con los siguientes datos: <br> <?php echo $user['nick'] . " - " . $user['apellidos'] . ", " . $user['nombre'];?>
        </h1>
        
    </body>
</html>