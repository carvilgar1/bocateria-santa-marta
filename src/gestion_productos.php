<?php



function obtener_bocadillos($conexion){
	try{
		$consulta="SELECT * FROM PLATO_PRINCIPAL";
		$stmt = $conexion->prepare($consulta);
		$stmt->execute();
		return $stmt;
	}catch(PDOException $e){
		return false;
	}
}

function obtener_plato_secundario($conexion){
	try{
		$consulta="SELECT * FROM PLATO_SECUNDARIO";
		$stmt = $conexion->prepare($consulta);
		$stmt->execute();
		return $stmt;
	}catch(PDOException $e){
		return false;
	}
}

function obtener_bebidas($conexion){
	try{
		$consulta="SELECT * FROM BEBIDAS";
		$stmt = $conexion->prepare($consulta);
		$stmt->execute();
		return $stmt;
	}catch(PDOException $e){
		return false;
	}
}


function obtener_precio($conexion,$plato_principal,$plato_secundario,$bebida){
	try{
		$consulta="select calcula_precio_menu(:plato_principal,:plato_secundario,:bebida) from dual";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':plato_principal',$plato_principal);
		$stmt->bindParam(':plato_secundario',$plato_secundario);
		$stmt->bindParam(':bebida',$bebida);
		$stmt->execute();
		return $stmt->fetchColumn();
	}catch(PDOException $e){
		return false;
	}
}

function generar_tikect($conexion){
	try{
		$consulta="select SEC_MEN.CURRVAL from dual";
		$stmt = $conexion->prepare($consulta);
		$stmt->execute();
		return $stmt->fetchColumn();
	}catch(PDOException $e){
		return false;
	}
}

function obtener_salsas($salsas_seleccionadas){
	$res = array();
	if(count($salsas_seleccionadas)==0):
		$res['salsa_1'] = 'null';
		$res['salsa_2'] = 'null';
		$res['salsa_3'] = 'null';
	elseif(count($salsas_seleccionadas)==1):
		$res['salsa_1'] = $salsas_seleccionadas[0];
		$res['salsa_2'] = 'null';
		$res['salsa_3'] = 'null';
	elseif(count($salsas_seleccionadas)==2):
		$res['salsa_1'] = $salsas_seleccionadas[0];
		$res['salsa_2'] = $salsas_seleccionadas[1];
		$res['salsa_3'] = 'null';
	else:
		$res['salsa_1'] = $salsas_seleccionadas[0];
		$res['salsa_2'] = $salsas_seleccionadas[1];
		$res['salsa_3'] = $salsas_seleccionadas[2];
	endif;
	return $res;
}


function grabar_pedido($conexion, $menu){
	try {
		$consulta = "CALL INSERTAR_PEDIDO(:id_usuario,:plato_principal,:salsa_1_pp,:salsa_2_pp,:salsa_3_pp,:plato_secundario,:salsa_1_pc,:salsa_2_pc,:salsa_3_pc,:bebida,:fecha,:precio)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':id_usuario',$menu['id_usuario']);
		$stmt->bindParam(':plato_principal',$menu['plato_principal']);
		$stmt->bindParam(':salsa_1_pp',$menu['salsa_pp']['salsa_1']);
		$stmt->bindParam(':salsa_2_pp',$menu['salsa_pp']['salsa_2']);
		$stmt->bindParam(':salsa_3_pp',$menu['salsa_pp']['salsa_3']);
		$stmt->bindParam(':plato_secundario',$menu['plato_secundario']);
		$stmt->bindParam(':salsa_1_pc',$menu['salsa_pc']['salsa_1']);
		$stmt->bindParam(':salsa_2_pc',$menu['salsa_pc']['salsa_2']);
		$stmt->bindParam(':salsa_3_pc',$menu['salsa_pc']['salsa_3']);
		$stmt->bindParam(':bebida',$menu['bebida']);
		$stmt->bindParam(':fecha',$menu['fecha']);
		$stmt->bindParam(':precio',$menu['precio']);
		$stmt->execute();
		
	} catch(PDOException $e) {
		//$_SESSION['exception']$e->getMessage();
		return $e->getMessage();
    }
}

function obtener_nombre_pp($conexion, $plato_principal){
	try {
		$consulta = "SELECT NOMBRE FROM PLATO_PRINCIPAL WHERE ID_PLATO_PRINCIPAL = :plato_principal";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':plato_principal',$plato_principal);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		//$_SESSION['exception']$e->getMessage();
		return $e->getMessage();
    }
}


function obtener_nombre_pc($conexion, $plato_secundario){
	try {
		$consulta = "SELECT NOMBRE FROM plato_secundario WHERE id_plato_secundario = :plato_secundario";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':plato_secundario',$plato_secundario);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		//$_SESSION['exception']$e->getMessage();
		return $e->getMessage();
    }
}

function obtener_nombre_bebida($conexion, $bebida){
	try {
		$consulta = "SELECT NOMBRE FROM BEBIDAS WHERE ID_BEBIDA = :bebida";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':bebida',$bebida);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		//$_SESSION['exception']$e->getMessage();
		return $e->getMessage();
    }
}



?>