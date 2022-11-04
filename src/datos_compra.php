<?php
	session_start();
	
	require_once ("gestionBD.php");
	require_once ("gestion_productos.php");
	
	if(!(isset($_SESSION['ticket']))){
		Header("Location: pedidos.php");
	}else{
	$ticket = $_SESSION['ticket'];
	unset($_SESSION['ticket']);
	
	$conexion = crearConexionBD();
	$plato_principal = obtener_nombre_pp($conexion, $ticket['plato_principal']);
	$plato_secundario = obtener_nombre_pc($conexion, $ticket['plato_secundario']);
	$bebida = obtener_nombre_bebida($conexion, $ticket['bebida']);
	cerrarConexionBD($conexion);
	}
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
			
			<div class="col-9 col-s-12 titulo"><h1>Mi Pedido</h1></div>
			<div class="col-9 col-s-12">
					<fieldset><legend>Bocadillo</legend>
						<div>
							<h1><?php echo $ticket['plato_principal']; ?> - <?php echo $plato_principal; ?></h1>
						</div>
						<div>
							<h2>Salsas:</h2> <?php foreach($ticket['unparsed_salsa_pp'] as $salsa){echo "<h3>".$salsa ."</h3><br>";} ?>
						</div>
					</fieldset>
					
					<fieldset><legend>Complemento</legend>
						<div>
							<h1><?php echo $ticket['plato_secundario']; ?> - <?php echo $plato_secundario; ?></h1>
						</div>
						<div>
							<h2>Salsas:</h2> <?php foreach($ticket['unparsed_salsa_pc'] as $salsa){echo "<h3>".$salsa ."</h3><br>";} ?>
						</div>
					</fieldset>
					
					<fieldset><legend>Bebidas</legend>
						<div>
							<h1><?php echo $ticket['bebida']; ?> - <?php echo $bebida; ?></h1>
						</div>
					</fieldset>
					
					<fieldset><legend>Fecha de recogida</legend>
						<div>
							<h1><?php echo date_format(date_create($ticket['fecha']),'d-M-Y, H:i:s'); ?></h1>
						</div>
					</fieldset>
					
					<fieldset><legend>Importe total</legend>
						<div>
							<h1><?php echo $ticket['precio'] . "€"; ?></h1>
						</div>
					</fieldset>
			</div>
        </div>
    </body>
</html>