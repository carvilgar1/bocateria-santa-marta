<?php

function consulta_paginada_bebidas( $conn, $pag_num, $pag_size ){
	try {
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta_paginada = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM ( SELECT ID_BEBIDA,NOMBRE FROM BEBIDAS WHERE NOMBRE NOT LIKE 'null') AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";

		$stmt = $conn->prepare( $consulta_paginada );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
	}	
	catch ( PDOException $e ) {
		return $e->GetMessage();
		
	}
} 


function total_bebidas( $conexion){
	try{
			$consulta = "SELECT COUNT(*) FROM BEBIDAS";
			$stmt = $conexion->prepare($consulta);
			$stmt->execute();
			$number_of_rows = $stmt->fetchColumn();
			return $number_of_rows;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 


function consulta_paginada_complementos( $conn, $pag_num, $pag_size ,$plato){
	try {
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta_paginada = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM ( SELECT ID_PLATO_SECUNDARIO,NOMBRE FROM PLATO_SECUNDARIO WHERE NOMBRE NOT LIKE 'null' AND PLATO=:plato) AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";

		$stmt = $conn->prepare( $consulta_paginada );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->bindParam( ':plato',  $plato  );
		$stmt->execute();
		return $stmt;
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		//header("Location: excepcion.php");
	}
} 


function total_complementos( $conexion ,$plato){
	try{
			$consulta = "SELECT COUNT(*) FROM PLATO_SECUNDARIO WHERE NOMBRE NOT LIKE 'null' AND PLATO=:plato";
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam( ':plato',  $plato  );
			$stmt->execute();
			$number_of_rows = $stmt->fetchColumn();
			return $number_of_rows;
	}
	catch ( PDOException $e ) {
		return $e->GetMessage();
		//header("Location: excepcion.php");
	}
} 

function consulta_paginada_bocadillos( $conn, $pag_num, $pag_size ){
	try {
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta_paginada = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM ( SELECT ID_PLATO_PRINCIPAL,NOMBRE FROM PLATO_PRINCIPAL ) AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";

		$stmt = $conn->prepare( $consulta_paginada );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 


function total_bocadillos( $conexion){
	try{
			$consulta = "SELECT COUNT(*) FROM PLATO_PRINCIPAL";
			$stmt = $conexion->prepare($consulta);
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