<?php

	session_start();
	
	require_once ("gestionBD.php");
	require_once ("gestion_pedidos.php");
	
	if (!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	if (!isset($_REQUEST['id_pedido'])){
		Header("Location: consulta_pedidos.php");

	}
	
	$conexion = crearConexionBD();
	eliminar_pedido($conexion, $_REQUEST['id_pedido']);
	cerrarConexionBD($conexion);
	
	Header("Location: consulta_pedidos.php");
?>