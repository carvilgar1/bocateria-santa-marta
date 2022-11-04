<?php
	session_start();

	require_once ("gestionBD.php");
	require_once ("paginacion_productos.php");
	
	if (isset($_SESSION["paginacion"])){
		$paginacion = $_SESSION["paginacion"];
	}
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);
	
	if ($pagina_seleccionada < 1){$pagina_seleccionada = 1;}
	if ($pag_tam < 1){$pag_tam = 5;}
	
	unset($_SESSION["paginacion"]);


	$conexion = crearConexionBD();
	$total_registros = total_bebidas( $conexion);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0){$total_paginas++;}
	if ($pagina_seleccionada > $total_paginas){$pagina_seleccionada = $total_paginas;}

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada_bebidas( $conexion, $pagina_seleccionada, $pag_tam);
	
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
    </head>  
    <body>
        
		<?php include_once("templates/header.php");?>
		
        <div class="container">
            
			<?php include_once("templates/menu_prod.php");?>
			
			<div class="col-9 col-s-12 titulo"><h1>Nuestras Bebidas</h1></div>
			<div>
			<form method="get" action="bebidas.php">
				Mostrando :
				<select id="PAG_TAM" name="PAG_TAM" onchange="this.form.submit()">
					<?php for($i=1;$i<=5;$i++){ ?>
						<option value="<?php echo $i;?>" <?php if($i== $paginacion["PAG_TAM"]){echo "selected";} ?>><?php echo $i;?></option>
					<?php } ?>
				</select>
				resultado/os
			</form>
			</div>
			<div class="col-9 col-s-12">
				<?php foreach($filas as $fila){ ?>
					<div class="value"><?php echo $fila['NOMBRE'];?></div>
				<?php } ?>
				<div class = "datos">
							<div style="grid-column: 1; text-align : center;"><a href="bebidas.php?PAG_NUM=<?php echo $pagina_seleccionada - 1; ?>">Página Anterior</a></div>
							<div style="grid-column: 4; text-align : center;"><a href="bebidas.php?PAG_NUM=<?php echo $pagina_seleccionada + 1; ?>">Página Siguiente</a></div>
						</div>
			</div>
        </div>
    </body>
</html>