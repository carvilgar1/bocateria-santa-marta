<?php 


function alta_usuario($conexion,$usuario) {
	try {
		$consulta = "CALL INSERTAR_USUARIO(:nick, :pass, :dni, :nombre, :apellidos, :correo, :telefono, :whatsapp)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nick',$usuario["nick"]);
		$stmt->bindParam(':pass',$usuario["pass"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':apellidos',$usuario["apellidos"]);
		$stmt->bindParam(':correo',$usuario["correo"]);
		$stmt->bindParam(':telefono',$usuario["telefono"]);
		$stmt->bindParam(':whatsapp',$usuario["whatsapp"]);
		$stmt->execute();
		
	} catch(PDOException $e) {
		//$_SESSION['exception']$e->getMessage();
		return false;
    }
}

function baja_usuario($conexion,$nick) {
	try {
		$consulta = "CALL ELIMINAR_USUARIO(:nick)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nick',$nick);
		$stmt->execute();
		
	} catch(PDOException $e) {
		//$_SESSION['exception']$e->getMessage();
		return false;
    }
}

function comprobar_usuarios($conexion, $login){
	try {
		$consulta="SELECT COUNT(*) FROM USUARIOS WHERE nickname_usuario=:nick and contrasenya=:pass";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':nick',$login["nick"]);
		$stmt->bindParam(':pass',$login["pass"]);
		$stmt->execute();
		$number_of_rows = $stmt->fetchColumn();
		return $number_of_rows;
	} catch(PDOException $e) {
		//$_SESSION['exception']$e->getMessage();
		return false;
    }
}

function obtener_id_usuario($conexion, $nick){
	try{
		$consulta="SELECT ID_USUARIO FROM USUARIOS WHERE nickname_usuario=:nick";
		
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':nick',$nick);
		$stmt->execute();
		return $stmt->fetchColumn();
	}catch(PDOException $e){
		return false;
	}
}



function obtener_datos_usuario($conexion, $id_usuario){
	try{
		$consulta="SELECT NICKNAME_USUARIO,NOMBRE,DNI,APELLIDOS,CORREO_ELECTRONICO,TELEFONO,WHATSAPP FROM USUARIOS WHERE ID_USUARIO=:id_usuario";
		
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':id_usuario',$id_usuario);
		$stmt->execute();
		return $stmt->fetch();
	}catch(PDOException $e){
		return false;
	}
}


function numero_usuarios($conexion){
	try {
		$consulta = "SELECT COUNT(*) FROM USUARIOS";
		$result = $conexion->prepare($consulta); 
		$result->execute(); 
		$number_of_rows = $result->fetchColumn();
		return $number_of_rows;
	} catch(PDOException $e) {
		$_SESSION['exception'] = $e->getMessage();
		return false;
    }
}

function modificar_nickname($conexion,$id_usuario,$new_nick) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_NICK(:id_usuario,:new_nick)');
		$stmt->bindParam(':id_usuario',$id_usuario);
		$stmt->bindParam(':new_nick',$new_nick);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_correo($conexion,$id_usuario,$new_value) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_CORREO(:id_usuario,:new_value)');
		$stmt->bindParam(':id_usuario',$id_usuario);
		$stmt->bindParam(':new_value',$new_value);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_telefono($conexion,$id_usuario,$new_value) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_TELEFONO(:id_usuario,:new_value)');
		$stmt->bindParam(':id_usuario',$id_usuario);
		$stmt->bindParam(':new_value',$new_value);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_whatsapp($conexion,$id_usuario,$new_value) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_WHATSAPP(:id_usuario,:new_value)');
		$stmt->bindParam(':id_usuario',$id_usuario);
		$stmt->bindParam(':new_value',$new_value);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}







?>