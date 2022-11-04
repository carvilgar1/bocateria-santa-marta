<header>
                <div class="header">
                    <div class="logo_cont">
                        <img src="images/logo.png" class="logo">
                    </div>
                </div>
            
                <div class="navegador">
                    <nav>
                        <a href="index.php">INICIO</a>
                        <a href="contacto.php">CONTACTO</a>
                        <a href="bocadillos.php">PRODUCTOS</a>
						<?php 
						if(isset($_SESSION['login'])):?>
							<a href='perfil.php'>MI PERFIL</a>
						<?php else: ?>
							<a href='login.php'>INICIAR SESIÓN</a>
						<?php endif; ?>
                    </nav>
                </div>
            </header>