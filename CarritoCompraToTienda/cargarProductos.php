<?php
	class producto {
		var $codProducto;
		var $Nombre;
		var $Precio;
		var $Existencias;
		var $Imagen;

		function __construct($cp,$nom,$pre,$exis,$imag) {		
				$this->codProducto = $cp;
				$this->Nombre=$nom;
				$this->Precio=$pre;
				$this->Existencias=$exis;
				$this->Imagen=$imag;			
		}
	}

	$ListaProductos = array();
	$xml=simplexml_load_file("productos.xml") or die("Error: Cannot create object");
	foreach($xml->children() as $productos) {
							$producto=new producto($productos->codProducto->__toString(),
										$productos->Nombre->__toString(),
										str_replace(chr(0xE2).chr(0x82).chr(0xAC), '&euro;', $productos->Precio->__toString()),
										$productos->Existencias->__toString(),
										$productos->Imagen->__toString()
							);
							array_push($ListaProductos,$producto);
	}

	// Convertir object(SimpleXMLElement) a string...
	// Convertir símbolos raros a euro;
	//var_dump($ListaProductos);





	function BuscarProductoEnArticulosDisponibles($CodProduct){
		global $ListaProductos;
		for ($z=0;$z<count($ListaProductos);$z++){
			if ($ListaProductos[$z]->codProducto==$CodProduct){
				return $ListaProductos[$z];
			}		
		}		
	}



	function ConfeccionarTablaPedido($Resumen_Or_Confirmacion){
		global $ItemsCarrito;
		$tablaHTML="<table border='1' cellspacing='0' cellpadding='0'>";
		if ($Resumen_Or_Confirmacion=='Resumen') {
			$tablaHTML.="<tr><td id='CeldaCabecera' colspan='5'>Carrito compra <a onclick=". "document.getElementById('CarritoCompra').style.display='none';" .
		 ">X</a></td></tr>".
		"<tr><td>Imagen</td><td>Nombre</td><td>Precio</td><td>Unidades</td><td>Subtotal</td></tr>";
		}
		else
		{
			$tablaHTML.="<tr><td id='CeldaCabecera' colspan='5'>Su pedido</td></tr>".
					"<tr><td>Imagen</td><td>Nombre</td><td>Precio</td><td>Unidades</td><td>Subtotal</td></tr>";
		}
		
		//var_dump($ItemsCarrito);
		$TotalAcumulado=0;
		for ($x=0;$x<count($ItemsCarrito)-1;$x++){
			$Tupla_CodProducto_Unidades=explode(",",$ItemsCarrito[$x]);
			//var_dump($Tupla_CodProducto_Unidades);
			$codProducto=str_replace("[", "", $Tupla_CodProducto_Unidades[0]);
			$Unidades=str_replace("]", "", $Tupla_CodProducto_Unidades[1]);

			$productoCarrito=BuscarProductoEnArticulosDisponibles($codProducto);
			//var_dump($productoCarrito);
			$tablaHTML.="<tr>".
			"<td>"."<img width='125' src=". $productoCarrito->Imagen .">"."</td>".
			"<td>". $productoCarrito->Nombre ."</td>".
			"<td>". $productoCarrito->Precio ."</td>".
			"<td>". $Unidades ."</td>".
			"<td>". $productoCarrito->Precio* $Unidades ."&euro;</td>".			
			"</tr>";
			$TotalAcumulado+=$productoCarrito->Precio * $Unidades;
		}
		$tablaHTML.="<tr><td colspan='5'>Total pedido ". $TotalAcumulado . " &euro;</td></tr>";
		if ($Resumen_Or_Confirmacion=='Resumen') {
			$tablaHTML.="<tr><td colspan='5' id='FilaUltima'><a onclick='VaciarCarritoCompra()'>Vaciar Carrito</a>".
										 "<a onclick=location.href='ConfirmacionCompra.php';>Confirmar Compra</a>".
			"</td></tr>";
		}
		else
		{
			$tablaHTML.="<tr><td colspan='5' id='FilaUltima'>&nbsp;</td></tr>";
		}

		$tablaHTML.="</table>";	
		if ($Resumen_Or_Confirmacion=='Confirmacion') {
					$_SESSION["Pedido"]=$tablaHTML;
				}
		return $tablaHTML;
	}
?>