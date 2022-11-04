<?php
	session_start();

	require_once ("gestionBD.php");
	require_once ("gestion_productos.php");
	
	if (!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	if(isset($_REQUEST['finalizar'])){
		$menu['id_usuario'] = $_SESSION['login']['id_usuario'];
		$menu['plato_principal'] = $_REQUEST['plato_principal'];
		$menu['salsa_pp'] = obtener_salsas($_REQUEST['salsa_pp']);
		$menu['plato_secundario'] = $_REQUEST['plato_secundario'];
		$menu['salsa_pc'] = obtener_salsas($_REQUEST['salsa_pc']);
		$menu['bebida'] = $_REQUEST['bebida'];
		$menu['precio']= $_REQUEST['precio'];
		$menu['fecha'] = date("Y-m-d H:i:s",strtotime($_REQUEST['recogida']));
		$menu['unparsed_salsa_pc'] = $_REQUEST['salsa_pc'];
		$menu['unparsed_salsa_pp'] = $_REQUEST['salsa_pp'];
		
		
		$conexion = crearConexionBD();
		grabar_pedido($conexion, $menu);
		cerrarConexionBD($conexion);
		
		$_SESSION['ticket'] = $menu;
		Header("Location: datos_compra.php");
		
	}else{
		$datos_compra['plato_principal'] = $_REQUEST['plato_principal'];
		if(isset($_REQUEST['salsa_pp'])){$datos_compra['salsa_plato_principal']=$_REQUEST['salsa_pp'];}else{$datos_compra['salsa_plato_principal']=array();}
		$datos_compra['plato_secundario'] = $_REQUEST['plato_secundario'];
		if(isset($_REQUEST['salsa_pc'])){$datos_compra['salsa_plato_secundario']=$_REQUEST['salsa_pc'];}else{$datos_compra['salsa_plato_secundario']=array();}
		$datos_compra['bebida'] = $_REQUEST['bebida'];
		$datos_compra['fecha'] = $_REQUEST['recogida'];
		
		$conexion = crearConexionBD();
		$datos_compra['precio'] = obtener_precio($conexion,$datos_compra['plato_principal'],$datos_compra['plato_secundario'],$datos_compra['bebida']);
		cerrarConexionBD($conexion);
		
		$_SESSION['compra'] = $datos_compra;
		Header("Location: pedidos.php#plato_principal");
	}
	
	

		
	

?>