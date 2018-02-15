<?php
	require 'cargarProductos.php';
?>

<?php
	$NombreCookieCarrito = "CarritoTiendaPepe";
	$ItemsCarrito="";
	if(!isset($_COOKIE[$NombreCookieCarrito])) {
		echo "Cookie named '" . $NombreCookieCarrito . "' is not set!";
	} else {
		//echo "Cookie '" . $NombreCookieCarrito . "' is set!<br>";
		//echo "Value is: " . $_COOKIE[$NombreCookieCarrito];
		$ItemsCarrito=explode("@@@",$_COOKIE[$NombreCookieCarrito]);
		//var_dump($ListaProductos);
		//var_dump($ItemsCarrito);
		echo ConfeccionarTablaPedido('Resumen');
	}	
?>