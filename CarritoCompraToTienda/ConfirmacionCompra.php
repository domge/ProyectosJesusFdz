<?php
	session_start();
	require 'cargarProductos.php';
?>

<form action="ConfirmacionCompra2.php" method="post">
	<div id="Pedido">
		Nombre&nbsp;<input type='text' name='txtNombre'><br>
		Email&nbsp;<input type='text' name='txtMail'><br>
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
				echo ConfeccionarTablaPedido('Confirmacion');
			}			
		?>
		<input type='submit' value='Validar compra'>
	</div>
</form>