<?php
	session_start();
	$Pedido=$_SESSION["Pedido"];	

    echo  $_POST['txtNombre'], "<br>", $_POST['txtMail'], "<br>", $Pedido;

	ini_set('display_errors',1);
	require("PHPMailer/class.phpmailer.php");
	require("PHPMailer/class.smtp.php");

	//https://www.google.com/settings/security/lesssecureapps
	//http://phpmailer.worxware.com/

	function sendgmail($correo,$nombre,$cuerpoMail)
	{
		$mail = new PHPMailer() ;

		$body = $cuerpoMail;
					 				 
		$body .= "";

		$mail->IsSMTP(); 

		
		$mail->Host = "smtp.gmail.com";		
		$mail->Port       = 465;  
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl"; 
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		
	 
		$mail->From     = "fordescolj@gmail.com";
		$mail->FromName = "Fulano de tal";
		$mail->Subject  = "Pedido de La tienda de Pepe";
		$mail->AltBody  = "Leer";
		//$mail->AddAttachment('adjunto.pdf');
		$mail->MsgHTML($body);

		
		$mail->AddAddress($correo,'');
		$mail->SMTPAuth = true;

		
		$mail->Username = "direccionMail";
		$mail->Password = "contrasenaMail"; 
		if($mail->Send())
		{
			setcookie("CarritoTiendaPepe", "", time() - 3600, "/");
			return "Email enviado correctamente.";

		}else
		{
			return false;
			die();
		}
	}
	echo sendgmail($_POST['txtMail'],$_POST['txtNombre'],$Pedido);
?>

<a href="catalogo.php">Volver a Tienda</a>