<?php
    session_start();
	
	require_once ("gestionBD.php");
	#require_once ("gestion_comentarios.php");
	
	$conexion = crearConexionBD();
	#$n_comentarios = numero_comentarios($conexion);
	#$comentarios = ultimos_comentarios($conexion);
	cerrarConexionBD($conexion);
?>



<!DOCTYPE html>
<html lang="es">  
<head>    
    <title>Bocatería Santa Marta</title>    
    <meta charset="UTF-8">
    <!link href="estilos/estilos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
	<link href="estilos/estilos.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/icon.png">
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>  
<body> 
        <div class="container">
            
            
            <?php include_once("templates/header.php");?>
                
            <div class="banner_padre">
                    <div class="banner_hijo">
                        <h1>NUESTROS DELICIOSOS PLATOS</h1><br>
                        <h3>ESTÁN ESPERANDO A QUE LES ECHES UN VISTAZO</h3>
                    </div>
            </div>
            <div class="col-9 col-s-12">
                <div class="galeria">
                    <div class="foto">
                        <img class="gallery" src="images/galeria/imagen0.png" id="gallery2" class="gallery2" width="100%">
                        <div class="controlador">
                            <div class="anterior"><img onclick="preview()" src="images/galeria/back.png" class="back"></div>
                            <div class="siguiente"><img onclick="next()" src="images/galeria/next.png" class="next"></div>
                        </div>
						<script type="text/javascript" src="js/galeria.js"></script>
                    </div>
                </div>
            </div>
            
            <div class="col-3 col-s-12">
                <div class="aside">
                    <img src="images/aside.png" class="cartel">
                    <h1>¿Quiénes somos?</h1><br>
                    <h3>
                        Santa Marta es alabada
                        por su rapidez a la hora de preparar las comandas de sus clientes. Y no sólo
                        es rápida, sino que sus productos son de calidad, ya que nos aseguramos
                        de que nuestros alimentos estén frescos, comprándolos en un supermercado al por mayor todos los días.
                        <br>
                        <br>
                        Nuestra motivación es facilitar a universitarios comida rápida, de calidad y a buen precio.
                    </h3>
                </div>
            </div>
            
            
             <div class="col-6 col-s-12">
                <div class="comentario1">
					<!--?php
						if($n_comentarios == 0){
							echo "Regalanos una valoración!";
						}else{
							echo "<div width='100%'> Usuario: " . $comentarios[0]['NICKNAME_USUARIO'] . "</div>";
							echo "<div width='100%'> Puntuación: " .determina_estrellas($comentarios[0]['PUNTUACION']) . "</div>";
							echo "<div width='100%'> Comentario: ". $comentarios[0]['COMENTARIO'] . "</div>";
						}
				
					?-->
				</div>
            </div>
            
            <div class="col-6 col-s-12">
                <div class="comentario1">
					<!--?php
						if($n_comentarios <= 1){
							echo "Regalanos una valoración!";
						}else{
							echo "<div width='100%'> Usuario: " . $comentarios[1]['NICKNAME_USUARIO'] . "</div>";
							echo "<div width='100%'> Puntuación: " .determina_estrellas($comentarios[1]['PUNTUACION']) . "</div>";
							echo "<div width='100%'> Comentario: ". $comentarios[1]['COMENTARIO'] . "</div>";
						}
				
					?-->
				</div>
            </div>
			
			<div class="col-12 col-s-12"></div>
            
            <div class="col-6 col-s-12">
                <div class="comentario1">
					<!--?php
						if($n_comentarios <= 2){
							echo "Regalanos una valoración!";
						}else{
							echo "<div width='100%'> Usuario: " . $comentarios[2]['NICKNAME_USUARIO'] . "</div>";
							echo "<div width='100%'> Puntuación: " .determina_estrellas($comentarios[2]['PUNTUACION']) . "</div>";
							echo "<div width='100%'> Comentario: ". $comentarios[2]['COMENTARIO'] . "</div>";
						}
				
					?-->
				</div>
            </div>
            
            <div class="col-6 col-s-12">
                <div class="insertar_comentario">
				<form method="get" action="comentario.php">
						<label for="puntuacion">¡Puntúanos!</label>
						<select name="puntuacion" id="puntuacion">
							<?php
							for($i=0; $i<=5; $i++){
									echo "<option>".$i."</option>";
							}
							?>
						</select>
				
						<div>
						<textarea id="comentario" name="comentario" maxlength="140" rows="10" cols="60">Inserte aquí su comentario...</textarea></div>
						<input type="submit" value="submit">
					</form>
				</div>
            </div>
            
             <div class="col-12 col-s-12"></div>
            
             <div class="col-4 col-s-12">
                <div class="info1">
                    <img src="images/medalla.png" width="100px">
                    <h1>Calidad</h1><p>Compramos nuestros productos a proveedores locales</p>
                </div>
            </div>
            
            
             <div class="col-4 col-s-12">
                <div class="info2">
                    <img src="images/reloj.png" width="100px">
                    <h1>Rapidez</h1><p>Tiempo de espera inferior a 10 minutos</p>
                </div>
            </div>
            
            
            <div class="col-4 col-s-12">
                <div class="info3">
                    <img src="images/pancho.png" width="100px">
                    <h1>Trabajo bien hecho</h1><p>¡Querrás volver a por otro de nuestros bocatas!</p>
                </div>
            </div>
            
            

            <div class="footer"></div>
        
        
        </div>

</body>  
</html>
