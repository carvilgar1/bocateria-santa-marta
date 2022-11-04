<?php
	
	$letra_nif = array( 0 => 'T' ,  1 => 'R' ,  2 => 'W' ,  3 => 'A' ,  4 => 'G' ,  5 => 'M' ,  6 => 'Y' ,  7 => 'F' ,  8 => 'P' ,  9 => 'D' ,  10 => 'X' ,  11 => 'B' ,  12 => 'N' ,  13 => 'J' ,  14 => 'Z' ,  15 => 'S' ,  16 => 'Q' ,  17 => 'V' ,  18 => 'H' ,  19 => 'L' ,  20 => 'C' ,  21 => 'K' ,  22 => 'E');
	
	function comprueba_datos_usuario($datos_usuario, $letra_nif){
		$res = array();
		
        //Comprobación de NOMBRE
		if($datos_usuario['nombre'] == null){$res[0] = "El campo nombre no puede estar vacío";}
        if(!preg_match("/^([a-zA-Záéíóú ]+)$/", $datos_usuario['nombre'])){$res[8] = "Sólo se permiten caracteres alfabéticos para el nombre";}
        
        //Comprobación de APELLIDOS
		if($datos_usuario['apellidos'] == null){$res[1] = "El campo apellidos no pueden estar vacío";}
        if(!preg_match("/^([a-zA-Záéíóú ]+)$/", $datos_usuario['apellidos'])){$res[9] = "Sólo se permiten caracteres alfabéticos para los apellidos";}
        
        //Comprobación de NICK
		if($datos_usuario['nick'] == null){$res[2] = "El campo nombre de usuario no puede estar vacío";}
        
        //Comprobación de TELEFONO
		if($datos_usuario['telefono'] == null){$res[3] = "El campo teléfono no puede estar vacío";}
        
        //Comprobación de EMAIL
		if($datos_usuario['correo'] == null){$res[10] = "El campo correo electrónico no puede estar vacío";}
        if (!filter_var($datos_usuario['correo'], FILTER_VALIDATE_EMAIL)){$res[11] = "La dirección de correo introducida no es válida";}
        
        //Comprobación de CONTRASENYA
		if($datos_usuario['pass'] == null){$res[4] = "El campo contraseña no puede estar vacío";}
        if(strlen($datos_usuario['pass'])<8){$res[13] = "La contraseña debe contener como mínimo 8 caracteres";}
        if(!preg_match('@[A-Z]@', $datos_usuario['pass'])){$res[14] = "La contraseña debe contener como mínimo una letra mayúscula";}
        if(!preg_match('@[a-z]@', $datos_usuario['pass'])){$res[15] = "La contraseña debe contener como mínimo una letra minúscula";}
        if(!preg_match('@[0-9]@', $datos_usuario['pass'])){$res[16] = "La contraseña debe contener como mínimo un dígito";}
        
        //Comprobación de CONTRASENYA
		if($datos_usuario['cpass'] == null){$res[5] = "El campo confirme contraseña no puede estar vacío";}
        if($datos_usuario['cpass'] != $datos_usuario['pass']){$res[12] = "Las contraseñas no coinciden";}
        
        
        //Comprobación de DNI
        if($datos_usuario['dni'] == null){$res[6] = "El campo DNI no puede estar vacío";}
        if(!($letra_nif[(int)substr($datos_usuario['dni'], 0, 8)%23] == substr($datos_usuario['dni'], -1, 1))){$res[7] = "El DNI introducido no es correcto";}
		
        return $res;
	}


	session_start();
	
	
	if(!isset($_SESSION['formulario'])){
		header('Location: index.html');
	}else{
		$new_user['nombre'] = $_REQUEST['nombre'];
		$new_user['apellidos'] = $_REQUEST['apellidos'];
		$new_user['nick'] = $_REQUEST['nick'];
		$new_user['dni'] = $_REQUEST['dni'];
		$new_user['correo'] = $_REQUEST['correo'];
		$new_user['telefono'] = $_REQUEST['telefono'];
		$new_user['whatsapp'] = $_REQUEST['whatsapp'];
		$new_user['pass'] = $_REQUEST['pass'];
		$new_user['cpass'] = $_REQUEST['cpass'];
		
		$_SESSION['formulario'] = $new_user;
	}
	
	$_SESSION['errores'] = comprueba_datos_usuario($new_user, $letra_nif);
	
	
	if(count($_SESSION['errores'])>0){
		header("Location: registro.php");
	}else{
		unset($_SESSION['errores']);
		header("Location: alta_usuario.php");
	}

?>