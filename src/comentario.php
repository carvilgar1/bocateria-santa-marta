<?php
    session_start();

	require_once ("gestionBD.php");
	require_once ("gestion_comentarios.php");

    if(isset($_SESSION['login'])){
        $comentario["nick"] = $_SESSION['login']['nick'];
        $comentario["puntuacion"] = $_REQUEST['puntuacion'];
        $comentario["comentario"] = $_REQUEST['comentario'];
        $conexion = crearConexionBD();
        insertar_comentario($conexion,$comentario);
        cerrarConexionBD($conexion);
        Header('Location: index.php');
    }else{
        Header('Location: login.php');
    }




?>