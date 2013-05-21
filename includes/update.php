<?php
	require_once('conexion.class.php');
	$id = $_POST['id'];
	$nombre = $_POST['editNombre'];
	$direccion = $_POST['editDireccion'];
	$telefono = $_POST['editTelefono'];
	$datos = array('id' => $id , 'nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono);
	$crud = new conexionMysql();
	echo json_encode($crud -> update($datos));	
?>