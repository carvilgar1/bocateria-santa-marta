<?php
	session_start();
	
	require_once ("gestionBD.php");
	require_once ("gestion_usuarios.php");
	
	
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	$conexion = crearConexionBD();
	$datos_user = obtener_datos_usuario($conexion, $_SESSION['login']['id_usuario']);
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
            
			<?php include_once("templates/menu_per.php");?>
			
			<div class="col-9 col-s-12 titulo"><h1>Información personal</h1></div>
			
			<div class="col-9 col-s-12">
				<form action="controlador_perfil.php" method="get">
				<?php if(isset($_SESSION['mod'])){?>
					<input type="hidden" id="campo_a_modificar" name="campo_a_modificar" value="<?php echo $_SESSION['mod']; ?>">
				<?php } ?>
				<div class="info_perfil">
				
				<div class="nombre">
					<p>Nombre</p>
				</div>
				
				<div class="nombre">
					<p><?php echo $datos_user['NOMBRE']; ?></p>
				</div>
				
				<div class="nombre">
					<p>Este campo no es modificable</p>
				</div>
				
				
				<div class="apellidos">
					<p>Apellidos</p>
				</div>
				
				<div class="apellidos">
					<p><?php echo $datos_user['APELLIDOS']; ?></p>
				</div>
				
				<div class="apellidos">
					<p>Este campo no es modificable</p>
				</div>
				
				
				<div class="dni">
					<p>DNI</p>
				</div>
				
				<div class="dni">
					<p><?php echo $datos_user['DNI']; ?></p>
				</div>
				
				<div class="dni">
					<p>Este campo no es modificable</p>
				</div>
				
				
				<div class="nick">
					<p>Ninckname</p>
				</div>
				
				<div class="nick">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='nick'): ?>
					<input type="text" id="new_value" name="new_value" value ="<?php  echo $datos_user['NICKNAME_USUARIO']; ?>">
				<?php else: 
					echo $datos_user['NICKNAME_USUARIO']; 
					endif;?>
			
				</div>
				
				<div class="nick">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='nick'): ?>
					<button id="grabar" name="grabar" type="submit" class="">
						grabar
					</button>
					
					<button id="cancelar" name="cancelar" type="submit" class="">
						cancelar
					</button>
				<?php else: ?>
					<button id="editar" name="editar" value="nick" type="submit" class="">
						editar
					</button>
					<?php endif; ?>
				</div>
				
				
				<div class="correo">
					<p>Correo electrónico</p>
				</div>
				
				
				<div class="correo">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='correo'): ?>
					<input type="text" id="new_value" name="new_value" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="El correo debe acabar con la terminación de su proveedor" value = "<?php echo $datos_user['CORREO_ELECTRONICO']; ?>">
				<?php else: 
					echo $datos_user['CORREO_ELECTRONICO']; 
					endif;?>
			
				</div>
				
				
				<div class="correo">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='correo'): ?>
					<button id="grabar" name="grabar" type="submit" class="">
						grabar
					</button>
					
					<button id="cancelar" name="cancelar" type="submit" class="">
						cancelar
					</button>
				<?php else: ?>
					<button id="editar" name="editar" value="correo" type="submit" class="">
						editar
					</button>
					<?php endif; ?>
				</div>
				
				
				<div class="telefono">
					<p>Teléfono</p>
				</div>
				
				
				<div class="telefono">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='telefono'): ?>
					<input type="text" id="new_value" name="new_value" pattern="^[0-9]{9}$" value = "<?php echo $datos_user['TELEFONO']; ?>" title="Introduzca los 9 dígitos de su número telefónico" required>
				<?php else: 
					echo $datos_user['TELEFONO']; 
					endif;?>
			
				</div>
				
				
				<div class="telefono">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='telefono'): ?>
					<button id="grabar" name="grabar" type="submit" class="">
						grabar
					</button>
					
					<button id="cancelar" name="cancelar" type="submit" class="">
						cancelar
					</button>
				<?php else: ?>
					<button id="editar" name="editar" value="telefono" type="submit" class="">
						editar
					</button>
					<?php endif; ?>
				</div>
				
				
				<div class="whatsapp">
					<p>WhatsApp</p>
				</div>
				
				
				<div class="whatsapp">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='whatsapp'): ?>
					<select id="new_value" name="new_value">
						<option value="1">Sí</option>
						<option value="0">No</option>
						<option value="">No proporcionar información</option>
					</select>
				<?php else: 
					if($datos_user['WHATSAPP']=='1'){echo "Sí";}
					elseif($datos_user['WHATSAPP']=='0'){ echo "No";}
					else{ echo "No se ha proporcionado información";}
					endif;?>
				</div>
				
				
				<div class="whatsapp">
				<?php if(isset($_SESSION['mod']) and $_SESSION['mod']=='whatsapp'): ?>
					<button id="grabar" name="grabar" type="submit" class="">
						grabar
					</button>
					
					<button id="cancelar" name="cancelar" type="submit" class="">
						cancelar
					</button>
				<?php else: ?>
					<button id="editar" name="editar" value="whatsapp" type="submit" class="">
						editar
					</button>
					<?php endif; ?>
				</div>

				</div>
				</form>
			</div>
        </div>
    </body>
</html>