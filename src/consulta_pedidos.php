<?php
	session_start();

	require_once ("gestionBD.php");
	require_once ("paginacion_consulta.php");
	
	if (!isset($_SESSION['login'])){
		Header("Location: login.php");

	}
	
	if (isset($_SESSION["paginacion"])){
		$paginacion = $_SESSION["paginacion"];
	}
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = 3;
	
	if ($pagina_seleccionada < 1){$pagina_seleccionada = 1;}
	if ($pag_tam < 1){$pag_tam = 3;}
	
	unset($_SESSION["paginacion"]);

	$nick = $_SESSION['login']['id_usuario'];

	$conexion = crearConexionBD();
	$total_registros = total_consulta( $conexion, $nick );
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0){$total_paginas++;}
	if ($pagina_seleccionada > $total_paginas){$pagina_seleccionada = $total_paginas;}

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada( $conexion, $nick, $pagina_seleccionada, $pag_tam );
	
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html>
    <head>    
        <title>Bocatería Santa Marta</title>    
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<link href="estilos/estilos.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="images/icon.png">
        <meta name="viewport" content="width=device-width, user-scalable=no">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		
    </head>  
    <body>
        
		<?php include_once("templates/header.php");?>
		
        <div class="container" id="container" name="container">
            
			<?php include_once("templates/menu_per.php");?>
			
			<div class="col-9 col-s-12 titulo"><h1>Mis Pedidos</h1></div>
			<div class="col-9 col-s-12">
					<div class = "datos">
						<div class="title">ID_PEDIDO</div>
						<div class="title">FECHA DE COMPRA</div>
						<div class="title">IMPORTE</div>
						<div class="title">CANCELAR PEDIDO</div>
					</div>
					
					<?php foreach ($filas as $fila){ ?>
						<form method="get" action="cancela_pedido.php">
						<input type="hidden" id="id_pedido" name="id_pedido" value="<?php echo $fila['ID_PEDIDO']; ?>">
						<div class = "datos">
							<div class="value"><?php echo $fila['ID_PEDIDO']; ?></div>
							<div class="value"><?php echo $fila[2]; ?></div>
							<div class="value"><?php echo $fila['PRECIO']; ?></div>
							<div class="value">
							<button type="submit">CANCELAR PEDIDO</button>
							</div>
						</div>
						</form>
					<?php } ?>
						<div class = "datos">
							<div style="grid-column: 1; text-align : center;"><a href="consulta_pedidos.php?PAG_NUM=<?php echo $pagina_seleccionada - 1; ?>">Página Anterior</a></div>
							<div style="grid-column: 4; text-align : center;"><a href="consulta_pedidos.php?PAG_NUM=<?php echo $pagina_seleccionada + 1; ?>">Página Siguiente</a></div>
						</div>
			</div>
        </div>
    </body>
</html>