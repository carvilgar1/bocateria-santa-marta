<?php

function consulta_paginada( $conn, $nick, $pag_num, $pag_size ){
	try {
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta_paginada = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM ( SELECT ID_PEDIDO,to_char(FECHA_RECOGIDA,'YYYY-MM-DD HH:MI:SS'),PRECIO FROM PEDIDOS WHERE ID_USUARIO=:nick ) AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";

		$stmt = $conn->prepare( $consulta_paginada );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->bindParam( ':nick',  $nick );
		$stmt->execute();
		return $stmt;
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 


function total_consulta( $conexion, $nick ){
	try{
			$consulta = "SELECT COUNT(*) FROM PEDIDOS WHERE ID_USUARIO=:nick";
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':nick',$nick);
			$stmt->execute();
			$number_of_rows = $stmt->fetchColumn();
			return $number_of_rows;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 
?>