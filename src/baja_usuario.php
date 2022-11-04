<?php
	session_start();
	
	require_once ("gestionBD.php");
	require_once ("gestion_usuarios.php");
	
	$conexion = crearConexionBD();
	baja_usuario($conexion, $_SESSION['login']);
	cerrarConexionBD($conexion);
	unset($_SESSION['login']);
	
	Header("Location: index.php");
?>