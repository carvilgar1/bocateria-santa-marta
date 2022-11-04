<?php
	session_start();
	
	
	$tienda['plato_principal'] ="";
	$tienda['plato_secundario'] = "";
	$tienda['bebida'] = "";
	
	if(isset($_REQUEST['carta_pp'])){
		$tienda['plato_principal'] = $_REQUEST['carta_pp'];
	}else if(isset($_REQUEST['carta_pc'])){
		$tienda['plato_secundario'] = $_REQUEST['carta_pc'];
	}else{
		$tienda['bebida'] = $_REQUEST['bebida'];
	}

	$_SESSION['tienda'] = $tienda;
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}else{
		Header("Location: pedidos.php");
	}


?>