<?php

$n2c = $_POST['number'] ;

// credenciales para la conexion
// ip del servidor
$host = "127.0.0.1";
// puerto de conexion
$puerto = "5038";
// usuario y contraseña que se encuentran en /etc/asterisk/manager.conf
$usuario = "admin";
$contrasena = "R2u7Mg9BJna41BSw";
// canal o extension que hara la llamada inicial, en mi caso SIP/201
$canal = "SIP/100";
// contexto del dialplan donde se encuentran la extension o canal
$contexto = "from-internal";
// tiempo de espera antes de finalizar la llamada si no se contesta
$espera = "30";
// prioridad con que se va a realizar la llamada
$prioridad = "1";
// cantidad de intentos antes de finalizar
$intentos = "2";
// prefijo en caso de que sea necesario para llamadas al exterior
//$prefijo = "9";
// numero que va a marcarse, sin especificas protocolo
$numero = $n2c;
$pos = strpos($numero, "local");
if ($numero == null){
	exit() ;
}
if ($pos === false){
	$errno = 0 ;
	$errstr	= 0 ;
	$caller_id = "Llamada AMI desde $canal";
	// aperturar una conexion mediante un socket
	$socket = fsockopen($host, $puerto, $errno, $errstr, 20);
	// si la conexion falla se imprime el error
	if (!$socket) {
		echo "$errstr ($errno)";
	}
	// si la conexion es satisfactoria se establece la llamada
	else {
		fputs($socket, "Action: login\r\n");
		fputs($socket, "Events: off\r\n");
		fputs($socket, "Username: $usuario\r\n");
		fputs($socket, "Secret: $contrasena\r\n\r\n");
		fputs($socket, "Action: originate\r\n");
		fputs($socket, "Channel: $canal\r\n");
		fputs($socket, "WaitTime: $espera\r\n");
		fputs($socket, "CallerId: $caller_id\r\n");
		fputs($socket, "Exten: $prefijo$numero\r\n");
		fputs($socket, "Context: $contexto\r\n");
		fputs($socket, "Priority: $prioridad\r\n\r\n");
		fputs($socket, "Action: Logoff\r\n\r\n");
		sleep(2);
		fclose($socket);
	}
	// imprimir mensaje sobre los numeros que estan interactuando
	//echo "$canal llamando $numero..." ;
	  echo "Su llamada ha sido asignada a un operador, por favor espere...";
}
else {
	exit() ;
}
?>