<?php
	sleep(2);
	require_once('conexion.class.php');
	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$direccion = $_POST['direccion'];
	$password = $_POST['pass2'];
	$email = $_POST['email'];
	$crud = new conexionMysql();	
	$datos = array('nombre' =>  $nombre, 'telefono' => $telefono, 'direccion' => $direccion, 'password' => $password, 'email' => $email);
	echo json_encode($crud -> create($datos));
?>