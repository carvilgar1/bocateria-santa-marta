<?php
	session_start();
	
	if(!isset($_SESSION['formulario'])){
		$user['nombre'] = "";
		$user['apellidos'] = "";
		$user['nick'] = "";
		$user['dni'] = "";
		$user['correo'] = "";
		$user['telefono'] = "";
		$user['whatsapp'] = "";
		$user['pass'] = "";
		$user['cpass'] = "";
		
		$_SESSION['formulario']=$user;
		
	}else{
		$user = $_SESSION['formulario'];
	}
	
	if(isset($_SESSION['errores'])){
		$errores = $_SESSION['errores'];
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bocatería Santa Marta</title>    
        <meta charset="UTF-8">
        <link href="estilos/estilos.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
        <link rel="icon" href="images/icon.png">
        <meta name="viewport" content="width=device-width, user-scalable=no">
    </head>
    
    <body>
        
        <?php include_once("templates/header.php");?>
        
	    <div class="registro">
		
        <h1 class="info">¡Regístrate para poder realizar tus pedidos<br>y comentar todo lo que quieras!</h1>
		
		<?php 
			if(isset($_SESSION['errores'])){
				print('<h3 class="issue">');
				foreach($errores as $error){
					printf("%s<br>",$error);
				}
				print("</h3>");
			}
		?>
        
        <div class="formas">
        <form action="verificar_formulario.php" method="get" novalidate>
			<label for="nombre">Nombre*:</label>
			<input type="text" id="nombre" name="nombre" placeholder="Juan" value = "<?php echo $user['nombre']; ?>" pattern="[a-zA-Záéíóú ]"  title="Sólo se permiten caracteres alfabéticos" required><br>
			<label for="apellidos">Apellidos*:</label>			
			<input type="text" id="apellidos" name="apellidos" placeholder="García Perez" value = "<?php echo $user['apellidos']; ?>" pattern="[a-zA-Záéíóú ]{2,48}" title="Sólo se permiten caracteres alfabéticos" required><br>
            <label for="nombre">DNI*:</label>
			<input type="text" id="dni" name="dni" placeholder="12345678Z" value = "<?php echo $user['dni']; ?>" pattern="^[0-9]{8}[A-Z]$" title="Introduzca los 8 dígitos de su DNI junto con la letra en mayúscula" required><br>
            <label for="nick">Nombre de usuario*:</label>
			<input type="text" id="nick" name="nick" placeholder="jugape1" value = "<?php echo $user['nick']; ?>" required><br>
            <label for="correo">Correo electrónico:</label>
			<input type="mail" id="correo" name="correo" placeholder="ejemplo@gmail.com" value = "<?php echo $user['correo']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="El correo debe acabar con la terminación de su proveedor"><br>
			<label for="telefono">Teléfono*:</label>
			<input type="text" id="telefono" name="telefono" placeholder="634215478" pattern="^[0-9]{9}$" value = "<?php echo $user['telefono']; ?>" title="Introduzca los 9 dígitos de su número telefónico" required><br>
			<div>
			<label>¿Dispones de WhatsApp?</label>
			<label for="1">Sí</label>			
			<input type="radio" id="whatsapp" name="whatsapp" value="1" <?php if($user['whatsapp']=="1"){ echo 'checked';}  ?>>
			<label for="0">No</label>
			<input type="radio" id="whatsapp" name="whatsapp" value="0" <?php if($user['whatsapp']=="0"){ echo 'checked';}  ?>>
			<input type="radio" id="whatsapp" name="whatsapp" value="" <?php if($user['whatsapp']==""){ echo 'checked';}  ?> hidden><br>
			</div>
			
			<div>
			<label for="pass">Contraseña*:</label>
			<input type="password" id="pass" name="pass" value = "" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener como mínimo un número, una letra mayúscula, una letra minúscula y 8 caracteres" required><br>
			<label for="cpass">Confirme contraseña*:</label>
			<input type="password" id="cpass" name="cpass" value = "" required><br>
			</div>
			
            <p class="pequenya">Los campos marcados con un * son obligatorios</p>
            
			<input type="submit" value="¡Regístrate ya!" class="enviar">
		</form>
		</div>
        </div>
    </body>
</html>