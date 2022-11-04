<?php
	session_start();
	
	require_once ("gestionBD.php");
	require_once ("gestion_usuarios.php");
	
	$datos_usuario = $_SESSION['mod'];
	unset($_SESSION['mod']);

	$id_usuario =$_SESSION['login']['id_usuario'];
	$new_value = $datos_usuario['new_value'];
	$campo_a_modificar = $datos_usuario['campo_a_modificar'];
	
	
	$conexion = crearConexionBD();
	if($campo_a_modificar == 'nick'):
		modificar_nickname($conexion,$id_usuario,$new_value);
		$_SESSION['login']['nick'] = $new_value;
	elseif($campo_a_modificar == 'correo'): 
		modificar_correo($conexion,$id_usuario,$new_value);
	elseif($campo_a_modificar == 'telefono'):
		modificar_telefono($conexion,$id_usuario,$new_value);
	else:
		modificar_whatsapp($conexion,$id_usuario,$new_value);
	endif;
	cerrarConexionBD($conexion);
	
	
	Header("Location: perfil.php");
	

?>