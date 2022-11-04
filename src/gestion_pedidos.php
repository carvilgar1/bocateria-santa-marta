<?php
	
	function eliminar_pedido($conexion, $id_pedido){
		try {
		$consulta = "CALL ELIMINAR_PEDIDO(:id_pedido)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':id_pedido',$id_pedido);
		$stmt->execute();
		
		} catch(PDOException $e) {
			//$_SESSION['exception']$e->getMessage();
			return false;
		}
	}






















?>