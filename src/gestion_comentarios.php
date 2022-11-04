<?php

function insertar_comentario($conexion, $comentario){
    try{
        $consulta = "CALL INSERTAR_COMENTARIO(:nick, :puntuacion, :comentario)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':nick', $comentario["nick"]);
        $stmt->bindParam(':puntuacion', $comentario["puntuacion"]);
        $stmt->bindParam(':comentario', $comentario["comentario"]);
        $stmt->execute();
    }catch(PDOException $e){
        $_SESSION['exeption'] = $e->getMessage();
        return false;
    }
}


function determina_estrellas($puntuacion){
	if($puntuacion == 0){
		return "☆☆☆☆☆";
	}else if($puntuacion == 1){
		return "⭐☆☆☆☆";
	}else if($puntuacion == 2){
		return "⭐⭐☆☆☆";
	}else if($puntuacion == 3){
		return "⭐⭐⭐☆☆";
	}else if($puntuacion == 4){
		return "⭐⭐⭐⭐☆";
	}else{
		return "⭐⭐⭐⭐⭐";
	}
}


function ultimos_comentarios($conexion){
	try{
        $consulta = "SELECT * FROM COMENTARIOS ORDER BY ID_COMENTARIO DESC";
        $stmt=$conexion->prepare($consulta);
        $stmt->execute();
		return $stmt->fetchAll();
    }catch(PDOException $e){
        $_SESSION['exeption'] = $e->getMessage();
        return false;
    }
}


function numero_comentarios($conexion){
    try{
        $consulta = "SELECT COUNT(*) FROM COMENTARIOS";
        $stmt=$conexion->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchColumn();
    }catch(PDOException $e){
        $_SESSION['exeption'] = $e->getMessage();
        return false;
    }
}



?>