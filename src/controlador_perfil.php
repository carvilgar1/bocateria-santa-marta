<?php	
	session_start();
	
	if (isset($_SESSION["login"])){
		
		if(isset($_REQUEST["editar"])):
			$_SESSION['mod'] = $_REQUEST["editar"];
		else:
			$datos_perfil['campo_a_modificar'] = $_REQUEST['campo_a_modificar'];
			$datos_perfil['id_usuario'] = $_REQUEST['id_usuario'];
			$datos_perfil['new_value'] = $_REQUEST['new_value'];
			
			$_SESSION['mod'] = $datos_perfil;
		endif;

		
		if (isset($_REQUEST["grabar"])){Header("Location: modificar_perfil.php");}
		else if (isset($_REQUEST["cancelar"])){unset($_SESSION["mod"]);Header("Location: perfil.php");}
		else{Header("Location: perfil.php");}
	}
	else 
		Header("Location: index.php");

?>