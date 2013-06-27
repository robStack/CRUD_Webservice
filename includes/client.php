<?php
	require_once('lib/nusoap.php');
	$client = new nusoap_client("http://localhost/webservice/includes/webservice.php");
	$datos = array('nombre' => 'sting','telefono' => 'asdqwe','direccion' => 'localhost','password' => 'megaz1','email' => 'megazlocalhostcom');
	$update = array('id' => 5,'nombre' => 'testing','telefono' => '0123456789','direccion' => 'localhost');
	//echo $client->call('conexionMysql.create',array('parameters' => $datos));	
	//echo $client->call('conexionMysql.update',array('parameters' => $update));
	echo $client->call('conexionMysql.read');
	//echo $client->call('conexionMysql.delete',array('id' => 5));
?>