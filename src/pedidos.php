<?php
	session_start();
	
	require_once ("gestionBD.php");
	require_once ("gestion_productos.php");
	
	
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	if(!isset($_SESSION['compra'])){
		$datos_compra['plato_principal'] = "";
		$datos_compra['salsa_plato_principal'] = array();
		$datos_compra['plato_secundario'] = "";
		$datos_compra['salsa_plato_secundario'] = array();
		$datos_compra['bebida'] = "";
		$datos_compra['fecha'] = "";
		$datos_compra['precio'] = "2";
		if(isset($_SESSION['tienda'])){
			$tienda = $_SESSION['tienda'];
			unset($_SESSION['tienda']);
			$datos_compra['plato_principal'] = $tienda['plato_principal'];
			$datos_compra['plato_secundario'] = $tienda['plato_secundario'];
			$datos_compra['bebida'] = $tienda['bebida'];
		}
	}else{
		
		$datos_recuperados = $_SESSION['compra'];
		unset($_SESSION['compra']);
		
		
		$datos_compra['plato_principal'] = $datos_recuperados['plato_principal'];
		$datos_compra['salsa_plato_principal'] = $datos_recuperados['salsa_plato_principal'];
		$datos_compra['plato_secundario'] = $datos_recuperados['plato_secundario'];
		$datos_compra['salsa_plato_secundario'] = $datos_recuperados['salsa_plato_secundario'];
		$datos_compra['bebida'] = $datos_recuperados['bebida'];
		$datos_compra['fecha'] = $datos_recuperados['fecha'];
		$datos_compra['precio'] = $datos_recuperados['precio'];
	}
	
	$salsas = array(
	1=>"cesar",
	2=>"cheddar",
	3=>"carbonara",
	4=>"boloñesa",
	5=>"tres quesos",
	6=>"salsa al whisky",
	7=>"salsa a la pimienta",
	8=>"cuatro quesos",
	9=>"curry",
	10=>"roquefort",
	11=>"mostaza y miel",
	12=>"mayonesa",
	13=>"ketchup",
	14=>"gaucha",
	15=>"mojo picón");
	
	$conexion = crearConexionBD();
	$plato_principal = obtener_bocadillos($conexion);
	$plato_secundario = obtener_plato_secundario($conexion);
	$bebidas = obtener_bebidas($conexion);
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
			
			<div class="col-9 col-s-12 titulo"><h1>Realizar un pedido</h1></div>
			<div class="col-9 col-s-12">
				<form action="realizar_compra.php" method="get">

					<fieldset><legend>Bocadillo</legend>
						<div>
							<label for="plato_principal">¡Elige un delicioso bocata! </label>
							<select id="plato_principal" name="plato_principal" onchange="this.form.submit()" CLASS="plato_principal">
								<?php foreach ($plato_principal as $bocadillo){ ?>
									<option value="<?php echo $bocadillo['ID_PLATO_PRINCIPAL']; ?>" <?php if($bocadillo['ID_PLATO_PRINCIPAL'] == $datos_compra['plato_principal']){echo "selected";} ?>><?php echo $bocadillo['NOMBRE']; ?></option>
								<?php } ?>
							</select>
							
							<div class="salsa_plato_principal">
								<div class="col-4 col-s-12 salsa1">
									<div><p>Escoge hasta tres salsas:</p></div>
									<div>
										<select id="salsa_pp" name="salsa_pp[]" multiple="multiple">
										<?php foreach($salsas as $salsa){ ?>
											<option value="<?php echo $salsa; ?>" <?php if(in_array($salsa, $datos_compra['salsa_plato_principal'])){echo "selected";} ?>><?php echo $salsa; ?></option>
										<?php } ?>
										</select>
										<script>
											var ultimoValorValido = null;
											$("#salsa_pp").on("change", function() {
											  if ($("#salsa_pp option:checked").length > 3) {
												$("#salsa_pp").val(ultimoValorValido);
											  } else {
												ultimoValorValido = $("#salsa_pp").val();
											  }
											});					
										</script>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					
					<fieldset><legend>¿Pasta, Patatas, Ensalada o Nachos?</legend>
						<div>
							<label for="plato_secundario">¡Elige un delicioso complemento! </label>
							<select id="plato_secundario" name="plato_secundario" onchange="this.form.submit()">
								<?php foreach ($plato_secundario as $complemento){ ?>
									<?php if($complemento['NOMBRE'] == "null"){ ?>
										<option value="<?php echo $complemento['ID_PLATO_SECUNDARIO']; ?>" <?php if($complemento['ID_PLATO_SECUNDARIO'] == $datos_compra['plato_secundario']){echo "selected";} ?>>No me apetece ningún complemento</option>
									<?php }else{ ?>
										<option value="<?php echo $complemento['ID_PLATO_SECUNDARIO']; ?>" <?php if($complemento['ID_PLATO_SECUNDARIO'] == $datos_compra['plato_secundario']){echo "selected";} ?>><?php echo $complemento['NOMBRE']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
							
							<div class="salsa_plato_secundario">
								<div class="col-4 col-s-12 salsa1">
									<div><p>Escoge hasta tres salsas:</p></div>
									<div>
										<select id="salsa_pc" name="salsa_pc[]" multiple="multiple">
										<?php foreach($salsas as $salsa){ ?>
												<option value="<?php echo $salsa; ?>" <?php if(in_array($salsa, $datos_compra['salsa_plato_secundario'])){echo "selected";} ?>><?php echo $salsa; ?></option>
										<?php } ?>
										</select>
										<script>
											var ultimoValorValido = null;
											$("#salsa_pc").on("change", function() {
											  if ($("#salsa_pc option:checked").length > 3) {
												$("#salsa_pc").val(ultimoValorValido);
											  } else {
												ultimoValorValido = $("#salsa_pc").val();
											  }
											});					
										</script>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					
					<fieldset><legend>Bebidas</legend>
						<div>
							<label for="bebida">¡Elige tu bebida preferida! </label>
							<select id="bebida" name="bebida" onchange="this.form.submit()">	
								<?php foreach ($bebidas as $bebida){ ?>
									<?php if($bebida['NOMBRE'] == "null"){ ?>
										<option value="<?php echo $bebida['ID_BEBIDA']; ?>" <?php if($bebida['ID_BEBIDA'] == $datos_compra['bebida']){echo "selected";} ?>>No me apetece ninguna bebida</option>
									<?php }else{ ?>
										<option value="<?php echo $bebida['ID_BEBIDA']; ?>" <?php if($bebida['ID_BEBIDA'] == $datos_compra['bebida']){echo "selected";} ?>><?php echo $bebida['NOMBRE']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
					</fieldset>
					
					<fieldset><legend>Fecha de recogida</legend>
						<div>
							<label for="recogida">¡Lo tendremos todo listo! </label>
							<input type="datetime-local" id="recogida" name="recogida" value="<?php $datos_compra['fecha'] ?>">
						</div>
					</fieldset>
					
					<fieldset><legend>Precio</legend>
						<div>
							<label for="recogida">La broma te costará: </label>
							<?php echo $datos_compra['precio'] . "€"; ?>
							<input type="hidden" id="precio" name="precio" value="<?php echo $datos_compra['precio']; ?>">
						</div>
					</fieldset>
					<input type="submit" value="submit" id="finalizar" name="finalizar">
				</form>
			</div>
        </div>
    </body>
</html>